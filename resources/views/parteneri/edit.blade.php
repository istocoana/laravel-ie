@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section ('content')

<h2>Editare Partener</h2>

<form method="POST" action="{{ route('parteneri.update', ['partener_id' => $partener->partener_id]) }}">
    @csrf
    @method('PUT') 
    <div>
        <label for="nume">Nume:</label>
        <input type="text" id="nume" name="nume" value="{{ $partener->nume }}" required>
    </div>

    <button type="submit">Actualizare</button>
</form>
@endsection

