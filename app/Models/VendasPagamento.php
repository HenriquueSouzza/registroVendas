<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class VendasPagamento extends Model
{
    use HasFactory;

    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }

    public function pgmtDetalhe(): BelongsTo
    {
        return $this->belongsTo(PgmtDetalhe::class, 'detalhe_id');
    }
}
