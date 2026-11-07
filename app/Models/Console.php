<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nome', 'anno', 'tipo', 'descrizione'])]
class Console extends Model
{
    public function generation(): BelongsTo
    {
        return $this->belongsTo(Generation::class);
    }
}
