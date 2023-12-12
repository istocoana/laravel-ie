@extends ("layouts/main")

@push('styles')
    <link href="{{ asset('css/guests.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="guests">
            <h2>Listă Speakeri</h2>
            @if (Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('speakeri.create') }}" class="button">Adaugă Speakeri</a>
            @endif
            @foreach ($speakeri as $speaker)
                <div class="guest">
                    <div class="photo">
                        <img src='images/speaker.jpg' alt='partener'>
                    </div>
                    <div class="details">
                        <p> {{ $speaker->nume }} </p>
                    </div>
                    <div class="actions">
                        <a href="{{ route('speakeri.show', ['speaker_id' => $speaker->speaker_id]) }}">Detalii</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
