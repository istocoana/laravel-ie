@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h1>Coș de Cumpărături</h1>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($cos->isEmpty())
            <p>Coșul tău este gol.</p>
        @else
            <div class="row">
                @foreach($cos as $item)
                    <div class="col-md-20 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Eveniment: {{ $item->eveniment->titlu }}</h5>
                                <p class="card-text">Cantitate: {{ $item->nr_bilete_selectate }} bilete</p>
                                <p class="card-text">Pret total: {{ $item->nr_bilete_selectate * $item->eveniment->pret }} RON</p>
                                <form action="{{ route('cos.actualizeaza') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $item->event_id }}">
                                    <div class="mb-3">
                                        <label for="numar_bilete" class="form-label">Număr bilete:</label>
                                        <input type="number" class="form-control" name="numar_bilete" id="numar_bilete" min="1" max="{{ $item->eveniment->bilete_disponibile }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="actiune" value="adauga">Adaugă</button>
                                    <button type="submit" class="btn btn-secondary" name="actiune" value="scade">Scade</button>
                                </form>
                                <br>
                                <form action="{{ route('cos.sterge') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="event_id" value="{{ $item->event_id }}">
                                    <button type="submit" class="btn btn-danger btn-sm mt-2">Șterge toate elementele din cos</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('comenzi.formularPlata') }}" class="btn btn-success mt-4">Cumpara</a>
        @endif
    </div>
@endsection
