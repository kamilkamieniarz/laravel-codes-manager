@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generuj nowe kody</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('codes.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="amount" class="form-label">Liczba kodów (1-10)</label>
                            <input type="number" 
                                name="amount" 
                                id="amount" 
                                class="form-control" 
                                min="1" max="10" 
                                required 
                                autofocus 
                                autocomplete="off"
                                placeholder="Enter amount (1-10)">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('codes.index') }}" class="btn btn-secondary">Anuluj</a>
                            <button type="submit" class="btn btn-primary">
                                Generuj kody
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection