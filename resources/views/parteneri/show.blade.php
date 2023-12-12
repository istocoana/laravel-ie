@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section ('content')
  <h2>Detalii Partener</h2>
  <div>
      <p>Nume: {{ $partener->nume }}</p>
      @if (Auth::check() && Auth::user()->isAdmin())   
        <a href="{{ route('parteneri.edit', ['partener_id' => $partener->partener_id]) }}">Edit</a>
        <form action="{{ route('parteneri.destroy', ['partener_id' => $partener->partener_id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit">Șterge</button>
        </form>   
      @endif   
  </div>
  
@endsection
