<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['titolo', 'tag', 'autore', 'pubblicato_il', 'estratto', 'testo'])]
class Article extends Model
{
    protected function casts(): array
    {
        return [
            'pubblicato_il' => 'date',
        ];
    }

    /** Riga mostrata sotto il titolo, es. "12 Ottobre 1985 • di Redazione". */
    protected function firma(): Attribute
    {
        return Attribute::get(fn () => Str::title($this->pubblicato_il->translatedFormat('d F Y')).' • di '.$this->autore);
    }
}
