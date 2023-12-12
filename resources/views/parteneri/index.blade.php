@extends ("layouts/main")

@push('styles')
    <link href="{{ asset('css/guests.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="guests">
            <h2>Listă Parteneri</h2>
            @if (Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('parteneri.create') }}" class="button">Adaugă Parteneri</a>
            @endif
            @foreach ($parteneri as $partener)
                <div class="guest">
                    <div class="photo">
                        <img src='images/partener.jpg' alt='partener'>
                    </div>
                    <div class="details">
                        <p> {{ $partener->nume }} </p>
                    </div>
                    <div class="actions">
                        <a href="{{ route('parteneri.show', ['partener_id' => $partener->partener_id]) }}">Detalii</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
