@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Detalii comandă</h1>
        <p>ID comandă: {{ $comanda->id }}</p>
        <p>Produse achiziționate:</p>
        <ul>
            @foreach ($comanda->eveniment as $event)
                <li>
                    Nume event: {{ $event->titlu }}
                </li>
                <li>
                  Pret bilet:{{ $event->pret }}
                </li>
                <li>
                  Total comandă: {{ $comanda->numar_bilete_achizitionate }} x {{ $event->pret }} RON = 
                  {{ $comanda->numar_bilete_achizitionate * $event->pret }} RON
              </li>
            @endforeach
        </ul>
        <a href="{{ route('descarca-pdf', ['comanda_id' => $comanda->id]) }}" target="_blank">Descarcă PDF-ul</a>

    </div>
@endsection
