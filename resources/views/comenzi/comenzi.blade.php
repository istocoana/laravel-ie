@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Istoric Comenzi</h2>
    @if ($comenzi->isEmpty())
        <p>Nu există comenzi înregistrate.</p>
    @else
        @foreach ($comenzi as $comanda)
        <div class="card mb-3">
            <div class="card-header">
                <h4 class="mb-0">Comandă #{{ $comanda->id }}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Produse achiziționate:</h5>
                <ul class="list-group list-group-flush">
                    @foreach ($comanda->eveniment as $event)
                    <li class="list-group-item">Nume event: {{ $event->titlu }}</li>
                    <li class="list-group-item">Pret bilet: {{ $event->pret }} RON</li>
                    <li class="list-group-item">Total comandă: {{ $comanda->numar_bilete_achizitionate }} x {{ $event->pret }} RON = {{ $comanda->numar_bilete_achizitionate * $event->pret }} RON</li>
                    <li class="list-group-item">Data: {{ \Carbon\Carbon::parse($comanda->data_achizitiei)->format('d-m-Y H:i') }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('detalii-comanda', ['comanda_id' => $comanda->id]) }}" class="btn btn-primary">Vezi detalii</a>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
