<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Docker esegue il seed a ogni avvio: i contenuti vanno creati una volta sola. */
    public function run(): void
    {
        if (Article::exists()) {
            return;
        }

        $this->call([
            ArticleSeeder::class,
            GenerationSeeder::class,
            EraSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
