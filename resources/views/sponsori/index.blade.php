@extends ("layouts/main")

@push('styles')
    <link href="{{ asset('css/guests.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="guests">
            <h2>Listă Sponsori</h2>
            @if (Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('sponsori.create') }}" class="button">Adaugă Sponsori</a>
            @endif
            @foreach ($sponsori as $sponsor)
                <div class="guest">
                    <div class="photo">
                        <img src='images/sponsor.jpg' alt='partener'>
                    </div>
                    <div class="details">
                        <p> {{ $sponsor->nume }} </p>
                    </div>
                    <div class="actions">
                        <a href="{{ route('sponsori.show', ['sponsor_id' => $sponsor->sponsor_id]) }}">Detalii</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
