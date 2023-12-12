@extends ("layouts/main")

@push('styles')
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endpush

@section('content')
  <div class="welcome-text">
    <div class="text">
        <h3> Bun venit pe </h3>
        <a href="/">EventGlowy</a>
    </div>
    <div class="bttn">
      <a href="{{ route('events.index') }}" class="button">Evenimente</a>
    </div>
  </div>
@stop

