@extends('layouts.guest')

@section('title', 'Retro Gaming - Registrazione')

@section('content')
    <h1 style="text-align: center;">
        Benvenuto su RetroGaming.it
    </h1>

    <div style="display: flex; justify-content: center; margin-top: 50px;">
        <div class="form-container">
            @include('partials.form-messages')

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <table border="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th colspan="2" style="color: #00ffcc;">Registrazione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="nome">Nome:</label></td>
                            <td><input type="text" id="nome" name="nome" value="{{ old('nome') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="cognome">Cognome:</label></td>
                            <td><input type="text" id="cognome" name="cognome" value="{{ old('cognome') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="email" id="email" name="email" value="{{ old('email') }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="password" id="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <button type="submit">Invia</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <!-- Collegamento per andare al Login -->
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('login') }}">Hai già un account? Accedi</a>
            </div>
        </div>
    </div>
@endsection
