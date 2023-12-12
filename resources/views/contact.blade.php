@extends('layouts/main')

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
  <h2>Contactează-ne</h2>
  <form method="POST" action="{{ route('send') }}">
      @csrf
      <label for="name">Nume:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Mesaj:</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <input type="submit" value="Trimite" class="button">
  </form>
</div>

@endsection
