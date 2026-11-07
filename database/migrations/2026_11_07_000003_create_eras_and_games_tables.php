<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descrizione');
            $table->timestamps();
        });

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('era_id')->constrained()->cascadeOnDelete();
            $table->string('titolo');
            $table->string('anno', 4);
            $table->string('piattaforma');
            $table->text('descrizione');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
        Schema::dropIfExists('eras');
    }
};
