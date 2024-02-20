@extends("layouts/main")

@push('styles')
<link href="{{ asset('css/guests.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Listă Parteneri</h2>
    @if (Auth::check() && Auth::user()->isAdmin())
    <a href="{{ route('parteneri.create') }}" class="btn btn-primary mb-3">Adaugă Parteneri</a>
    @endif
    <div class="row">
        @foreach ($parteneri as $partener)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="{{ asset('images/partener.jpg') }}" class="card-img-top" alt="{{ $partener->nume }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $partener->nume }}</h5>
                    <a href="{{ route('parteneri.show', ['partener_id' => $partener->partener_id]) }}" class="btn btn-secondary">Detalii</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
