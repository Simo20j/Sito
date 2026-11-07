<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::forceCreate([
            'autore' => 'Elena_Retro',
            'titolo' => 'Un tuffo nel passato',
            'voto' => 5,
            'commento' => "Ottimo lavoro con gli articoli. La navigazione è velocissima e la sezione dedicata ai videogiochi anni '80 è fatta benissimo.",
            'created_at' => '2026-10-10 12:00:00',
        ]);

        Review::forceCreate([
            'autore' => 'Marco88',
            'titolo' => 'Sito fantastico!',
            'voto' => 5,
            'commento' => 'La grafica dark-mode con dettagli neon è spettacolare! Trovo la cronologia delle console davvero ben organizzata e facile da consultare.',
            'created_at' => '2026-10-14 12:00:00',
        ]);
    }
}
