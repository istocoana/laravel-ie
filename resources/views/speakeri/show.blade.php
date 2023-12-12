@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section ('content')
  <h2>Detalii Speaker</h2>
  <div>
      <p>Nume: {{ $speaker->nume }}</p>
      @if (Auth::check() && Auth::user()->isAdmin())   
        <a href="{{ route('speakeri.edit', ['speaker_id' => $speaker->speaker_id]) }}">Edit</a>
        <form action="{{ route('speakeri.destroy', ['speaker_id' => $speaker->speaker_id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit">Șterge</button>
        </form>   
      @endif   
  </div>
  
@endsection
