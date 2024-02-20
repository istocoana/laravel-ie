@extends("layouts/main")

@push('styles')
<link href="{{ asset('css/guests.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Listă Sponsori</h2>
    @if (Auth::check() && Auth::user()->isAdmin())
    <a href="{{ route('sponsori.create') }}" class="btn btn-primary mb-3">Adaugă Sponsori</a>
    @endif
    <div class="row">
        @foreach ($sponsori as $sponsor)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('images/sponsor.jpg') }}" class="card-img-top" alt="Sponsor">
                <div class="card-body">
                    <h5 class="card-title">{{ $sponsor->nume }}</h5>
                    <a href="{{ route('sponsori.show', ['sponsor_id' => $sponsor->sponsor_id]) }}" class="btn btn-sm btn-secondary">Detalii</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
