<ul>
    <li><a href="/">Acasă</a></li>
    <li><a href="{{ route('events.index') }}">Evenimente</a></li>
    <li><a href="{{ route('sponsori.index') }}">Sponsori</a></li>
    <li><a href="{{ route('speakeri.index') }}">Speakeri</a></li>
    <li><a href="{{ route('parteneri.index') }}">Parteneri</a></li>
    @if(Auth::check())
        @if(Auth::user()->hasRole('client'))
            <li><a href="{{ route('comenzi') }}">Comenzile mele</a></li>
        @endif
        <li><a href="{{ route('logout') }}">Logout</a></li>

    @else
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    @endif
</ul>
