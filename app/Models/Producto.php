<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['categoria_id', 'modelo', 'marca', 'descripcion', 'activo'])]
class Producto extends Model
{
    protected $table = 'productos';

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaCalzado::class, 'categoria_id');
    }

    public function variantes(): HasMany
    {
        return $this->hasMany(VarianteProducto::class, 'producto_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }
}
