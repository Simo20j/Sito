<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RetroGaming.it - Blog Videogiochi')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- NAVIGAZIONE SUPERIORE -->
    <header class="navbar">
        <div class="logo">RetroGaming.it</div>
        <nav class="nav-links">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
            <a href="{{ route('reviews.index') }}" @class(['active' => request()->routeIs('reviews.*')])>Recensioni</a>
            <a href="{{ route('consoles.index') }}" @class(['active' => request()->routeIs('consoles.*')])>Console</a>
            <a href="{{ route('games.index') }}" @class(['active' => request()->routeIs('games.*')])>Video Giochi</a>
        </nav>
        <div class="user-info">
            <span>Ciao, <strong>{{ auth()->user()->nome }}</strong>!</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Esci</button>
            </form>
        </div>
    </header>

    @yield('content')

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 RetroGaming.it — Tutti i diritti riservati.</p>
    </footer>

    @stack('scripts')

</body>
</html>
