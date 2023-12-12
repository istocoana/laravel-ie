@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section ('content')

<h2>Editare Speaker</h2>

<form method="POST" action="{{ route('speakeri.update', ['speaker_id' => $speaker->speaker_id]) }}">
    @csrf
    @method('PUT') 
    <div>
        <label for="nume">Nume:</label>
        <input type="text" id="nume" name="nume" value="{{ $speaker->nume }}" required>
    </div>

    <button type="submit">Actualizare</button>
</form>
@endsection

