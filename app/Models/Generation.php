<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nome', 'descrizione'])]
class Generation extends Model
{
    public function consoles(): HasMany
    {
        return $this->hasMany(Console::class);
    }
}
