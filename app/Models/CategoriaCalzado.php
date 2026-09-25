<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre'])]
class CategoriaCalzado extends Model
{
    protected $table = 'categorias_calzado';

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
