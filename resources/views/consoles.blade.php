@extends('layouts.app')

@section('title', 'Cronologia Console - RetroGaming.it')

@section('content')
    <!-- CONTENUTO PRINCIPALE -->
    <main class="main-container">
        @include('partials.search')

        <h1 class="section-title">Cronologia delle Console (1972 - 2000)</h1>
        <p style="color: #aaa; margin-bottom: 30px;">Tutte le piattaforme che hanno fatto la storia, suddivise per generazioni ed ere tecnologiche.</p>

        <div class="generazioni-container">
            @foreach ($generations as $generation)
                <div class="gen-section">
                    <h2 class="gen-title">{{ $generation->nome }}</h2>
                    <p class="gen-desc">{{ $generation->descrizione }}</p>

                    <div class="console-grid">
                        @foreach ($generation->consoles as $console)
                            @include('partials.timeline-card', [
                                'anno' => $console->anno,
                                'badge' => $console->tipo,
                                'titolo' => $console->nome,
                                'descrizione' => $console->descrizione,
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
