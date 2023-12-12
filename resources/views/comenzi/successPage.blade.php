@extends('layouts.main')

@section('content')
    <div class="container">
     <h3>Comanda inregistrata cu success!</h3>
     <a href="{{ route('detalii-comanda', ['comanda_id' => $comanda_id]) }}">Detalii Comanda</a>
    </div>
@endsection
