<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['producto_id', 'codigo', 'color', 'talla_us', 'existencia_pares', 'stock_minimo_pares', 'activo'])]
class VarianteProducto extends Model
{
    protected $table = 'variantes_producto';

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function movimientosInventario(): HasMany
    {
        return $this->hasMany(MovimientoInventario::class, 'variante_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'talla_us' => 'decimal:1',
            'existencia_pares' => 'integer',
            'stock_minimo_pares' => 'integer',
            'activo' => 'boolean',
        ];
    }
}
