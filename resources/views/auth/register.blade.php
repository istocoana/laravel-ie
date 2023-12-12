@extends('layouts.main')

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <h2>Înregistrare</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-field">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
          @error('username')
              <span>{{ $message }}</span>
          @enderror
        </div>
      
        <div class="form-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="form-field">
            <label for="password">Parolă:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="form-field">
            <label for="password_confirmation">Confirmă parola:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Înregistrează-te</button>
    </form>
</div>
@endsection
