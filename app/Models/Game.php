<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['titolo', 'anno', 'piattaforma', 'descrizione'])]
class Game extends Model
{
    public function era(): BelongsTo
    {
        return $this->belongsTo(Era::class);
    }
}
