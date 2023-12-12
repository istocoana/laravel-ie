@extends('layouts.main')

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

  @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
  @endif
  <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-field">
      <label for="image" class="form-label">Imagine eveniment:</label>
      <input type="file" name="image" accept="image/*" class="form-control mb-2">
    </div>

    <div  class="form-field">
      <label for="titlu">Titlu eveniment:</label>
      <input type="text" id="titlu" name="titlu" required maxlength="255">
    </div>
    
    <div  class="form-field">
      <label for="descriere">Descriere:</label>
      <textarea id="descriere" name="descriere" ></textarea>
    </div>

    <div  class="form-field">
      <label for="data">Data evenimentului:</label>
      <input type="datetime-local" id="data" name="data" required>
    </div>

    <div  class="form-field">
      <label for="locatie">Locație:</label>
      <input type="text" id="locatie" name="locatie" required maxlength="255">
    </div>

    <div class="form-field">
      <label for="bilete_disponibile">Bilete disponibile:</label>
      <input type="number" id="bilete_disponibile" name="bilete_disponibile" required min="0">
    </div>

    <div  class="form-field">
      <label for="pret">Preț bilet:</label>
      <input type="number" id="pret" name="pret" required min="0" step="0.01">
    </div>

    <div class="form-field">
      <label for="sponsori">Selectați sponsori:</label>
      <select name="sponsori[]" multiple id="selectSponsors">
          @foreach($allSponsors as $sponsor)
              <option value="{{ $sponsor->sponsor_id }}">{{ $sponsor->nume }}</option>
          @endforeach
      </select>
    </div>

    <div class="form-field">
      <label for="speakers">Selectați speakeri:</label>
      <select name="speakers[]" multiple id="selectSpeakers">
          @foreach($allSpeakers as $speaker)
              <option value="{{ $speaker->speaker_id }}">{{ $speaker->nume }}</option>
          @endforeach
      </select>
    </div>

    <div class="form-field">
      <label for="parteneri">Selectați parteneri:</label>
      <select name="parteneri[]" multiple id="selectParteneri">
          @foreach($allPartners as $partener)
              <option value="{{ $partener->partener_id }}">{{ $partener->nume }}</option>
          @endforeach
      </select>
    </div>

    <button type="submit">Creează Eveniment</button>
  </form>
@endsection

