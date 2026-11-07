<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Le recensioni di esempio non appartengono a un account reale
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('autore');
            $table->string('titolo');
            $table->unsignedTinyInteger('voto');
            $table->text('commento');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
