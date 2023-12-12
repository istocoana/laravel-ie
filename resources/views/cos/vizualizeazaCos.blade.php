@extends('layouts.main')

@section('content')
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
        @foreach($cos as $item)
            <div>
                <p>Eveniment: {{ $item->eveniment->titlu }}</p>
                <p>Cantitate: {{ $item->nr_bilete_selectate }}</p>
                <p>Pret total:
                    {{ $item->nr_bilete_selectate }} x {{ $item->eveniment->pret }} =
                    {{ $item->nr_bilete_selectate * $item->eveniment->pret }} RON
                </p>
                <form action="{{ route('cos.actualizeaza') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $item->event_id }}">
                    <label for="numar_bilete">Număr bilete:</label>
                    <input type="number" name="numar_bilete" id="numar_bilete" min="1" max="{{ $item->eveniment->bilete_disponibile }}" required>
                    <button type="submit" name="actiune" value="adauga">Adaugă</button>
                    <button type="submit" name="actiune" value="scade">Scade</button>
                </form>

                <form action="{{ route('cos.sterge') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="event_id" value="{{ $item->event_id }}">
                    <button type="submit">Șterge</button>
                </form>
            </div>
        @endforeach
        <a href="{{ route('comenzi.formularPlata') }}">Cumpara</a>
        @endif
@endsection
