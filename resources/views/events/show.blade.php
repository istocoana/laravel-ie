@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class='container'>
        <h2>Detalii Eveniment</h2>
        <div class="box">
            <div class="image">
                @if($event->image_path)
                    <img src="{{ asset('storage/images/' . $event->image_path) }}" alt="Imagine eveniment">
                @else
                    <img src="{{ asset('../images/no_photo.jpg') }}" alt="Imagine eveniment">
                @endif
            </div>
            <div class="details">
                <div class='title'>
                    <p>{{ \Carbon\Carbon::parse($event->data)->isoFormat('DD MMM YYYY [ora] HH:mm') }}</p>
                    <p>
                        <i class='bi bi-geo-alt-fill'></i>
                        {{ $event->locatie }}
                    </p>
                   <h3><strong>{{ $event->titlu }}</strong> </h3>
                </div>   
                <p>{{ $event->descriere }}</p>
                <p><strong>Bilete Disponibile:</strong> {{ $event->bilete_disponibile }}</p>
                <p><strong>Pret:</strong> {{ $event->pret }}</p>   

                <p> <strong> Sponsori: </strong></p>
                @if (isset($event->sponsori) && $event->sponsori->count() > 0)
                    <ul>
                        @foreach ($event->sponsori as $sponsor)
                            <li>{{ $sponsor->nume }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Niciun sponsor asociat acestui eveniment.</p>
                @endif

                <p> <strong> Speakeri: </strong></p>
                @if (isset($event->sponsori) && $event->sponsori->count() > 0)
                    <ul>
                        @foreach ($event->sponsori as $sponsor)
                            <li>{{ $sponsor->nume }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Niciun sponsor asociat acestui eveniment.</p>
                @endif

                <p> <strong> Sponsori: </strong></p>
                @if (isset($event->sponsori) && $event->sponsori->count() > 0)
                    <ul>
                        @foreach ($event->sponsori as $sponsor)
                            <li>{{ $sponsor->nume }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Niciun sponsor asociat acestui eveniment.</p>
                @endif

                <div class="actions">
                    @if (Auth::check() && Auth::user()->isAdmin())   
                        <a href="{{ route('events.edit', ['event_id' => $event->event_id]) }}">Edit</a>
                        <a href="{{ route('comenzi.comenziEveniment', ['event_id' => $event->event_id ]) }}">Vizualizați comenzile pentru acest eveniment</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
