
@extends('layouts.main')

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h2>Adaugă Partener</h2>
    <form method="POST" action="{{ route('parteneri.store') }}">
        @csrf

        <div>
            <label for="nume">Nume:</label>
            <input type="text" id="nume" name="nume" required>
            @error('nume')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Adaugă Sponsor</button>
    </form>
@endsection
