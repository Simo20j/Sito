@extends('layouts.app')

@section('title', $article->titolo.' - RetroGaming.it')

@section('content')
    <!-- CONTENUTO ARTICOLO COMPLETO -->
    <main class="main-container">
        <div class="articolo-box">
            <a href="{{ route('home') }}" class="back-link">&larr; Torna alla Home</a>
            <div class="card-tag" style="margin-top: 15px;">{{ $article->tag }}</div>
            <h1 class="articolo-titolo">{{ $article->titolo }}</h1>
            <p class="card-date">{{ $article->firma }}</p>
            <div class="articolo-testo">
                {!! nl2br(e($article->testo)) !!}
            </div>
        </div>
    </main>
@endsection
