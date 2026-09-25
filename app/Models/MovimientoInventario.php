<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['variante_id', 'usuario_id', 'tipo', 'cambio_pares', 'saldo_anterior', 'saldo_resultante', 'motivo', 'ocurrido_en'])]
class MovimientoInventario extends Model
{
    protected $table = 'movimientos_inventario';

    public function variante(): BelongsTo
    {
        return $this->belongsTo(VarianteProducto::class, 'variante_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cambio_pares' => 'integer',
            'saldo_anterior' => 'integer',
            'saldo_resultante' => 'integer',
            'ocurrido_en' => 'datetime',
        ];
    }
}
