@extends('layouts.main')

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h2>Adaugă Sponsor</h2>
    <form method="POST" action="{{ route('sponsori.store') }}">
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
