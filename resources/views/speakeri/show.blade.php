@extends("layouts/main")

@push('styles')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h2>Detalii Speaker</h2>
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">Nume: {{ $speaker->nume }}</h5>
            @if (Auth::check() && Auth::user()->isAdmin())   
            <a href="{{ route('speakeri.edit', ['speaker_id' => $speaker->speaker_id]) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('speakeri.destroy', ['speaker_id' => $speaker->speaker_id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Șterge</button>
            </form>   
            @endif
        </div>
    </div>
</div>
@endsection
