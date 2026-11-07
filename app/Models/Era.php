<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nome', 'descrizione'])]
class Era extends Model
{
    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
