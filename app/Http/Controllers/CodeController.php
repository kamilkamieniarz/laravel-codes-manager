<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCodeRequest;
use App\Http\Requests\CreateCodeRequest;
use App\Models\Code;
use App\Services\CodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CodeController extends Controller
{
    /**
     * Service responsible for handling code generation business logic.
     * Injected via setter to ensure flexibility and loose coupling.
     */
    protected ?CodeService $codeService = null;

    /**
     * Injects the CodeService dependency.
     *
     * @param CodeService $codeService
     */
    public function setCodeService(CodeService $codeService): void
    {
        $this->codeService = $codeService;
    }

    /**
     * Display a listing of the generated codes with dynamic sorting.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['id', 'code', 'created_at'];

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }
        
        $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';

        $codes = Code::with('user')
            ->where('user_id', auth()->id())
            ->orderBy($sort, $direction)
            ->paginate(15)
            ->withQueryString();

        return view('codes.index', compact('codes'));
    }

    /**
     * Show the form for creating new codes.
     *
     * @return View
     */
    public function create(): View
    {
        return view('codes.create');
    }

    /**
     * Generate unique numeric codes based on user input.
     * Delegates the generation logic to the injected CodeService.
     *
     * @param CreateCodeRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCodeRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $amount = (int) $validated['amount'];
        $userId = auth()->id();
        
        $codesToInsert = [];
        $generatedCodes = [];

        for ($i = 0; $i < $amount; $i++) {
            $code = $this->codeService->generateUniqueCode($generatedCodes);
            
            $generatedCodes[] = $code;
            
            $codesToInsert[] = [
                'user_id' => $userId,
                'code' => $code,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bulk insert for maximum performance
        Code::insert($codesToInsert);

        return redirect()->route('codes.index')
            ->with('success', 'Kody zostały pomyślnie wygenerowane');
    }

    /**
     * Show the form for deleting specific codes.
     *
     * @return View
     */
    public function deleteForm(): View
    {
        return view('codes.delete');
    }

    /**
     * Delete a set of codes ensuring data integrity.
     * Implements database transactions for atomic operations.
     *
     * @param DeleteCodeRequest $request
     * @return RedirectResponse
     */
    public function destroy(DeleteCodeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $inputCodes = preg_split('/[\s,]+/', $validated['codes'], -1, PREG_SPLIT_NO_EMPTY);

        $existingCodes = auth()->user()->codes()
            ->whereIn('code', $inputCodes)
            ->pluck('code')
            ->toArray();

        $missingCodes = array_diff($inputCodes, $existingCodes);

        if (!empty($missingCodes)) {
            return back()
                ->withInput()
                ->with('warning', 'Nie znaleziono następujących kodów w bazie danych: ' . implode(', ', $missingCodes));
        }

        DB::transaction(function () use ($inputCodes): void {
            auth()->user()->codes()->whereIn('code', $inputCodes)->delete();
        });

        return redirect()->route('codes.index')
            ->with('success', 'Pomyślnie usunięto podane kody.');
    }
}