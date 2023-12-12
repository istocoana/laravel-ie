@extends('layouts.main')

@section('content')
    <div class="container">
      <h2>Istoric Comenzi</h2>
        @foreach ($comenzi as $comanda)
          <h4>Detalii comandă</h4>
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
                  <li>
                    Data: {{ $comanda->data_achizitiei }}
                  </li>
                
              @endforeach
          </ul>
        
        @endforeach
    </div>
@endsection
