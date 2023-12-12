<!DOCTYPE html>
<html>
  <head>
    <title>EventGlowy</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/selectSponsori.js') }}"></script>
    <script src="{{ asset('js/selectSpeakeri.js') }}"></script>
    <script src="{{ asset('js/selectParteneri.js') }}"></script>
    <script src="{{ asset('js/events.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @stack('styles')
  </head>
  <body>

    <div class="main-container">
      <div class="{{ Request::is('/') ? 'home-page-style' : 'navbar' }} ">
        @include ('layouts.navbar')
      </div>
      <div class="content">
        @yield ('content')
      </div>
  </div>
  </body>
</html>
