@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista kodów</h5>
        <a href="{{ route('codes.create') }}" class="btn btn-primary btn-sm">Generuj nowe</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Kod</th>
                    <th>Właściciel (E-mail)</th> <th>Data utworzenia</th>
                </tr>
            </thead>
            <tbody>
                @forelse($codes as $code)
                    <tr>
                        <td>{{ $code->id }}</td>
                        <td class="fw-bold">{{ $code->code }}</td>
                        <td>{{ $code->user->email }}</td> <td>{{ $code->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Brak kodów w bazie danych</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $codes->links() }}
        </div>
    </div>
</div>
@endsection