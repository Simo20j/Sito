<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descrizione');
            $table->timestamps();
        });

        Schema::create('consoles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generation_id')->constrained()->cascadeOnDelete();
            $table->string('nome');
            $table->string('anno', 4);
            $table->string('tipo');
            $table->text('descrizione');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consoles');
        Schema::dropIfExists('generations');
    }
};
