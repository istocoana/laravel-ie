@extends ("layouts/main")

@section ('content')
  <h2>Detalii Sponsor</h2>
  <div>
      <p>Nume: {{ $sponsor->nume }}</p>
      @if (Auth::check() && Auth::user()->isAdmin())   
        <a href="{{ route('sponsori.edit', ['sponsor_id' => $sponsor->sponsor_id]) }}">Edit</a>
        <form action="{{ route('sponsori.destroy', ['sponsor_id' => $sponsor->sponsor_id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit">Șterge</button>
        </form>   
      @endif   
  </div>
  
@endsection
