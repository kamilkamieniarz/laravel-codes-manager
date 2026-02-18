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
                    <th>
                        <a href="{{ route('codes.index', ['sort' => 'id', 'direction' => (request('sort') === 'id' && request('direction') === 'desc') ? 'asc' : 'desc']) }}" class="text-decoration-none text-dark">
                            ID @if(request('sort', 'id') === 'id') <i class="fas fa-sort-{{ request('direction', 'desc') === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('codes.index', ['sort' => 'code', 'direction' => (request('sort') === 'code' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                            Code @if(request('sort') === 'code') <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </a>
                    </th>
                    <th>Owner (Email)</th>
                    <th>
                        <a href="{{ route('codes.index', ['sort' => 'created_at', 'direction' => (request('sort') === 'created_at' && request('direction') === 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                            Created At @if(request('sort') === 'created_at') <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i> @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($codes as $code)
                    <tr>
                        <td>{{ $code->id }}</td>
                        <td class="fw-bold">{{ $code->code }}</td>
                        <td>{{ $code->user->email }}</td> 
                        <td>{{ $code->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Brak kodów w bazie danych</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper mt-4">
            {{ $codes->links() }}
        </div>
    </div>
</div>
@endsection