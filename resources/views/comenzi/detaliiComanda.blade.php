@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detalii comandă</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID comandă: {{ $comanda->id }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Produse achiziționate:</h6>
            <ul class="list-group list-group-flush">
                @foreach ($comanda->eveniment as $event)
                <li class="list-group-item">
                    Nume event: <strong>{{ $event->titlu }}</strong>
                </li>
                <li class="list-group-item">
                    Pret bilet: <strong>{{ $event->pret }} RON</strong>
                </li>
                <li class="list-group-item">
                    Total comandă: <strong>{{ $comanda->numar_bilete_achizitionate }} x {{ $event->pret }} RON = {{ $comanda->numar_bilete_achizitionate * $event->pret }} RON</strong>
                </li>
                @endforeach
            </ul>
            <a href="{{ route('descarca-pdf', ['comanda_id' => $comanda->id]) }}" target="_blank" class="btn btn-sm btn-primary mt-3">Descarcă PDF-ul</a>
        </div>
    </div>
</div>
@endsection
