@extends('layouts.guest')

@section('title', 'Retro Gaming - Accedi')

@section('content')
    <h1>RetroGaming.it</h1>

    <div class="form-container">
        @include('partials.form-messages')

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nome@esempio.com" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="********" required>

            <button type="submit">Accedi</button>
        </form>
    </div>

    <div class="link-container">
        <a href="{{ route('register') }}">Non hai un account? Registrati</a>
    </div>
@endsection
