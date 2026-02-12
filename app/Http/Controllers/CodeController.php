<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
{
    /**
     * List codes with pagination and eager-loaded user relation.
     * Ensuring data isolation: users only see their own codes.
     */
    public function index()
    {
        $codes = Auth::user()->codes()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('codes.index', compact('codes'));
    }

    public function create()
    {
        return view('codes.create');
    }

    /**
     * Generate unique numeric codes based on user input (1-10).
     * Uses random_int for cryptographically secure pseudo-random integers.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|integer|min:1|max:10',
        ]);

        $amount = (int) $validated['amount'];
        $userId = Auth::id();
        $codesToInsert = [];

        for ($i = 0; $i < $amount; $i++) {
            $codesToInsert[] = [
                'user_id' => $userId,
                'code' => $this->generateUniqueCode(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bulk insert for better performance
        Code::insert($codesToInsert);

        return redirect()->route('codes.index')
            ->with('success', 'Kody zostały pomyślnie wygenerowane');
    }

    public function deleteForm()
    {
        return view('codes.delete');
    }

    /**
     * Delete a set of codes only if every provided code belongs to the user.
     * Implements database transaction to ensure atomicity.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'codes' => 'required|string',
        ]);

        // Normalize input: handle spaces, commas, and new lines
        $inputCodes = preg_split('/[\s,]+/', $validated['codes'], -1, PREG_SPLIT_NO_EMPTY);

        // Verify ownership and existence
        $existingCodes = Auth::user()->codes()
            ->whereIn('code', $inputCodes)
            ->pluck('code')
            ->toArray();

        $missingCodes = array_diff($inputCodes, $existingCodes);

        // All-or-nothing validation logic as per technical requirements
        if (!empty($missingCodes)) {
            return back()
                ->withInput()
                ->with('warning', 'Nie znaleziono następujących kodów w bazie danych: ' . implode(', ', $missingCodes));
        }

        // Use transaction to ensure data integrity during deletion
        DB::transaction(function () use ($inputCodes) {
            Auth::user()->codes()->whereIn('code', $inputCodes)->delete();
        });

        return redirect()->route('codes.index')
            ->with('success', 'Pomyślnie usunięto podane kody.');
    }

    /**
     * Generates a unique 10-digit numeric string.
     * Prevents collisions by checking database existence.
     */
    private function generateUniqueCode(): string
    {
        do {
            $code = str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (Code::where('code', $code)->exists());

        return $code;
    }
}