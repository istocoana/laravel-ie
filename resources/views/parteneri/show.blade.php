@extends("layouts/main")

@push('styles')
<link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h2>Detalii Partener</h2>
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">Nume: {{ $partener->nume }}</h5>
            @if (Auth::check() && Auth::user()->isAdmin())   
            <a href="{{ route('parteneri.edit', ['partener_id' => $partener->partener_id]) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('parteneri.destroy', ['partener_id' => $partener->partener_id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Șterge</button>
            </form>   
            @endif
        </div>
    </div>
</div>
@endsection
