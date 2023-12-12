@extends('layouts.main')

@push('styles')
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endpush

@section('content')
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
<form method="POST" action="{{ route('events.update', ['event_id' => $event->event_id]) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  @if($event->image_path)
        <img src="{{ asset('storage/images/' . $event->image_path) }}" alt="Imagine eveniment" width="200">
    @else
        <p>Nici o imagine încărcată.</p>
    @endif

    <div class="form-field">
        <label for="image" class="form-label">Schimbați imaginea evenimentului:</label>
        <input type="file" name="image" accept="image/*" class="form-control mb-2" >
        @if($event->image_path)
            <img id="preview" src="#" alt="Previzualizare imagine" width="200">
        @endif
    </div>

    <label for="titlu">Titlu eveniment:</label>
    <input type="text" id="titlu" name="titlu" value="{{ $event->titlu }}" required>
    <br>

    <label for="descriere">Descriere:</label>
    <textarea id="descriere" name="descriere" required>{{ $event->descriere }}</textarea>
    <br>

    <label for="data">Data evenimentului:</label>
    <input type="datetime-local" id="data" name="data" value="{{ date('Y-m-d\TH:i', strtotime($event->data)) }}" required>
    <br>

    <label for="locatie">Locație:</label>
    <input type="text" id="locatie" name="locatie" value="{{ $event->locatie }}" required>
    <br>

    <label for="bilete_disponibile">Bilete disponibile:</label>
    <input type="number" id="bilete_disponibile" name="bilete_disponibile" value="{{ $event->bilete_disponibile }}" required>
    <br>

    <label for="pret">Preț bilet:</label>
    <input type="number" id="pret" name="pret" value="{{ $event->pret }}" required step="0.01">
    <br>

    <div class="form-field">
        <label for="sponsori">Selectați sponsori:</label>
        <select name="sponsori[]" multiple id="selectSponsors">
            @foreach($allSponsors as $sponsor)
                <option value="{{ $sponsor->sponsor_id }}" {{ in_array($sponsor->sponsor_id, $selectedSponsors) ? 'selected' : '' }}>{{ $sponsor->nume }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-field">
        <label for="speakers">Selectați speakers:</label>
        <select name="speakers[]" multiple id="selectSpeakers">
            @foreach($allSpeakers as $speaker)
                <option value="{{ $speaker->speaker_id }}" {{ in_array($speaker->speaker_id, $selectedSpeakers) ? 'selected' : '' }}>{{ $speaker->nume }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-field">
        <label for="parteneri">Selectați parteneri:</label>
        <select name="parteneri[]" multiple id="selectParteneri">
            @foreach($allPartners as $partener)
                <option value="{{ $partener->partener_id }}" {{ in_array($partener->partener_id, $selectedPartners) ? 'selected' : '' }}>{{ $partener->nume }}</option>
            @endforeach
        </select>
    </div>


  <br>

  <button type="submit">Actualizare Eveniment</button>
</form>
<script>
    const input = document.querySelector('input[type="file"]');
    const preview = document.querySelector('#preview');
    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
        }
    });
</script>
@endsection
