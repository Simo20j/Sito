@extends('layouts.app')

@section('title', 'Valuta il Blog - RetroGaming.it')

@section('content')
    <!-- CONTENUTO PRINCIPALE -->
    <main class="main-container">
        <h1 class="section-title">Cosa pensano gli utenti del nostro Blog</h1>
        <p style="color: #aaa; margin-bottom: 30px;">Lascia un feedback sulla tua esperienza su RetroGaming.it per aiutarci a migliorare!</p>

        <!-- FORM PER LASCIARE UNA RECENSIONE SUL SITO -->
        <div class="gen-section" style="margin-bottom: 30px; border-left: 4px solid #00ffcc;">
            <h2 class="gen-title">Lascia la tua Recensione sul Blog</h2>
            @include('partials.form-messages')
            <form action="{{ route('reviews.store') }}" method="POST" style="margin-top: 15px; display: flex; flex-direction: column; gap: 15px;">
                @csrf
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label style="color: #ccc; font-size: 14px; display: block; margin-bottom: 5px;">Titolo del feedback:</label>
                        <input type="text" name="titolo" value="{{ old('titolo') }}" placeholder="Es. Bellissima grafica e ottimi contenuti!" required style="width: 100%; padding: 10px; background-color: #222; border: 1px solid #333; color: #fff; border-radius: 6px;">
                    </div>
                    <div style="width: 160px;">
                        <label style="color: #ccc; font-size: 14px; display: block; margin-bottom: 5px;">Valutazione Sito:</label>
                        <select name="voto" required style="width: 100%; padding: 10px; background-color: #222; border: 1px solid #333; color: #fff; border-radius: 6px;">
                            @foreach ([5 => '⭐⭐⭐⭐⭐', 4 => '⭐⭐⭐⭐', 3 => '⭐⭐⭐', 2 => '⭐⭐', 1 => '⭐'] as $valore => $stelle)
                                <option value="{{ $valore }}" @selected(old('voto') == $valore)>{{ $stelle }} ({{ $valore }}/5)</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label style="color: #ccc; font-size: 14px; display: block; margin-bottom: 5px;">La tua opinione sul blog:</label>
                    <textarea name="commento" rows="4" placeholder="Cosa ti piace del sito o cosa potremmo migliorare?" required style="width: 100%; padding: 10px; background-color: #222; border: 1px solid #333; color: #fff; border-radius: 6px; resize: vertical;">{{ old('commento') }}</textarea>
                </div>

                <button type="submit" style="align-self: flex-start; background-color: #00ffcc; color: #121212; border: none; font-weight: bold; padding: 12px 24px; border-radius: 6px; cursor: pointer; transition: 0.2s;">
                    Pubblica Recensione
                </button>
            </form>
        </div>

        <!-- LISTA DELLE RECENSIONI SUL BLOG -->
        <h2 style="color: #fff; font-size: 20px; margin-bottom: 20px;">Opinioni degli utenti ({{ $reviews->count() }})</h2>

        <div class="generazioni-container">
            @foreach ($reviews as $review)
                <div class="gen-section">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                        <div>
                            <h2 class="gen-title" style="margin: 0; font-size: 18px; color: #fff;">{{ $review->titolo }}</h2>
                            <span style="color: #777; font-size: 12px;">Recensione inviata da <strong>{{ $review->autore }}</strong> il {{ $review->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div style="background-color: #222; color: #00ffcc; font-weight: bold; padding: 4px 12px; border-radius: 6px; font-size: 14px; border: 1px solid #00ffcc;">
                            {{ $review->voto }}/5
                        </div>
                    </div>
                    <p style="color: #ccc; font-size: 14px; line-height: 1.6; margin-top: 10px;">{{ $review->commento }}</p>
                </div>
            @endforeach
        </div>
    </main>
@endsection
