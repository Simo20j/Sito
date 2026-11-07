@extends('layouts.app')

@section('content')
    <!-- SEZIONE HERO -->
    <section class="hero">
        <h1>Il Blog della Storia dei Videogiochi</h1>
        <p>Rivivi l'era d'oro degli 8-bit, 16-bit e i grandi classici da sala giochi.</p>
    </section>

    <div class="retro-search-wrapper" style="position: relative;">
        <input type="text" id="retroSearchInput" class="retro-search-input" placeholder="🔍 Cerca o seleziona un mini-gioco retrò...">
        <div id="retroDropdown" class="retro-dropdown">
            <a href="#" class="dropdown-item" data-game="tetris">🧱 Tetris Classico (Gioca)</a>
            <a href="#" class="dropdown-item" data-game="flappy">🐥 Flappy Bird Retro (Gioca)</a>
            <a href="#" class="dropdown-item" data-game="snake">🐍 Snake Storico (Gioca)</a>
            <a href="#" class="dropdown-item" data-game="pong">🏓 Pong Arcade (Gioca)</a>
        </div>
    </div>

    <!-- CONTENUTO PRINCIPALE / GRIGLIA ARTICOLI -->
    <main class="main-container">
        <h2 class="section-title">Ultimi Articoli</h2>

        <div class="articles-grid">
            @foreach ($articles as $article)
                <article class="card">
                    <div class="card-tag">{{ $article->tag }}</div>
                    <h3>{{ $article->titolo }}</h3>
                    <p class="card-date">{{ $article->firma }}</p>
                    <p class="card-excerpt">{{ $article->estratto }}</p>
                    <a href="{{ route('articles.show', $article) }}" class="read-more">Leggi di più &rarr;</a>
                </article>
            @endforeach
        </div>
    </main>

    @include('partials.modal', ['centered' => true])
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush
