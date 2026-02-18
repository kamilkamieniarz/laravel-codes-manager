@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">Usuń kody</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        Wpisz kody do usunięcia (oddzielone przecinkami lub enterami).<br>
                        <strong>Uwaga:</strong> Operacja zostanie wykonana tylko wtedy, gdy WSZYSTKIE podane kody istnieją w bazie.
                    </div>

                    <form method="POST" action="{{ route('codes.destroy', 'bulk') }}">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="codes" class="form-label">Kody do usunięcia</label>
                            <textarea class="form-control"
                                      id="codes" 
                                      name="codes" 
                                      rows="5" 
                                      required>{{ old('codes') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('codes.index') }}" class="btn btn-secondary">Anuluj</a>
                            <button type="submit" class="btn btn-danger">
                                Usuń wybrane kody
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection