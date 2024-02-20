@extends("layouts/main")

@section('content')
<div class="container mt-5">
    <h2>Detalii Sponsor</h2>
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">Nume: {{ $sponsor->nume }}</h5>
            @if (Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('sponsori.edit', ['sponsor_id' => $sponsor->sponsor_id]) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('sponsori.destroy', ['sponsor_id' => $sponsor->sponsor_id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Șterge</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
