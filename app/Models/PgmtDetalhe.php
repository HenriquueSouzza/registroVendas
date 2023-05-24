<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PgmtDetalhe extends Model
{
    use HasFactory;

    public function pgmtForma(): BelongsTo
    {
        return $this->belongsTo(PgmtForma::class, 'forma_id');
    }

    public function pgmtBandeira(): BelongsTo
    {
        return $this->belongsTo(PgmtBandeira::class, 'bandeira_id');
    }
}
