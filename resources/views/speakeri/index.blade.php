@extends("layouts/main")

@push('styles')
<link href="{{ asset('css/guests.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Listă Speakeri</h2>
    @if (Auth::check() && Auth::user()->isAdmin())
    <a href="{{ route('speakeri.create') }}" class="btn btn-primary mb-3">Adaugă Speakeri</a>
    @endif
    <div class="row">
        @foreach ($speakeri as $speaker)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="{{ asset('images/speaker.jpg') }}" class="card-img-top" alt="{{ $speaker->nume }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $speaker->nume }}</h5>
                    <a href="{{ route('speakeri.show', ['speaker_id' => $speaker->speaker_id]) }}" class="btn btn-sm btn-secondary">Detalii</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
