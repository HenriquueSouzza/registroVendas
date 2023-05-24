<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PgmtForma extends Model
{
    use HasFactory;

    public function pgmtDetalhes(): HasMany
    {
        return $this->hasMany(PgmtDetalhe::class);
    }
}
