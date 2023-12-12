@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Comenzile pentru acest eveniment</h1>
        @if(count($comenzi) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Comandă</th>
                        <th>ID Eveniment</th>
                        <th>Număr bilete achiziționate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comenzi as $comanda)
                        <tr>
                            <td>{{ $comanda->id }}</td>
                            <td>{{ $comanda->event_id }}</td>
                            <td>{{ $comanda->numar_bilete_achizitionate }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Nu există comenzi pentru acest eveniment.</p>
        @endif
    </div>
@endsection
