@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section ('content')

<h2>Editare Sponsor</h2>

<form method="POST" action="{{ route('sponsori.update', ['sponsor_id' => $sponsor->sponsor_id]) }}">
    @csrf
    @method('PUT') 
    <div>
        <label for="nume">Nume:</label>
        <input type="text" id="nume" name="nume" value="{{ $sponsor->nume }}" required>
    </div>

    <button type="submit">Actualizare</button>
</form>
@endsection

