@extends('layouts.app')

@section('title', 'Cronologia Video Giochi - RetroGaming.it')

@section('content')
    <!-- CONTENUTO PRINCIPALE -->
    <main class="main-container">
        @include('partials.search')

        <h1 class="section-title">Cronologia dei Video Giochi (1972 - 2000)</h1>
        <p style="color: #aaa; margin-bottom: 30px;">I titoli leggendari che hanno segnato le varie epoche videoludiche, dalle sale giochi ai grandi classici per casa.</p>

        <div class="generazioni-container">
            @foreach ($eras as $era)
                <div class="gen-section">
                    <h2 class="gen-title">{{ $era->nome }}</h2>
                    <p class="gen-desc">{{ $era->descrizione }}</p>

                    <div class="console-grid">
                        @foreach ($era->games as $game)
                            @include('partials.timeline-card', [
                                'anno' => $game->anno,
                                'badge' => $game->piattaforma,
                                'titolo' => $game->titolo,
                                'descrizione' => $game->descrizione,
                            ])
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    @include('partials.modal')
@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
