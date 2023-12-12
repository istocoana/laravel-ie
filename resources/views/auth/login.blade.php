@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <h2>Logare</h2>
    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>
    </div>

    <div class="form-field">
        <label for="password">Parolă</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-field">
        <button type="submit">Conectare</button>
    </div>
    </form>
</div>
@endsection
