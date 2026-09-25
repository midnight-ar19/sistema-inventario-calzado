<?php

use App\Models\CategoriaCalzado;
use App\Models\MovimientoInventario;
use App\Models\Producto;
use App\Models\User;
use App\Models\VarianteProducto;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('traverses inventory relationships with domain casts', function () {
    $usuario = User::factory()->create(['rol' => 'bodeguero']);
    $categoria = CategoriaCalzado::create(['nombre' => 'Botines']);
    $producto = Producto::create([
        'categoria_id' => $categoria->id,
        'modelo' => 'Urbano',
        'marca' => 'Norte',
        'descripcion' => 'Botín de cuero',
        'activo' => 1,
    ]);
    $variante = VarianteProducto::create([
        'producto_id' => $producto->id,
        'codigo' => 'BOT-URB-95-NEG',
        'color' => 'Negro',
        'talla_us' => '9.5',
        'existencia_pares' => '12',
        'stock_minimo_pares' => '3',
        'activo' => 0,
    ]);
    $movimiento = MovimientoInventario::create([
        'variante_id' => $variante->id,
        'usuario_id' => $usuario->id,
        'tipo' => 'existencia_inicial',
        'cambio_pares' => '12',
        'saldo_anterior' => '0',
        'saldo_resultante' => '12',
        'motivo' => 'Carga inicial',
        'ocurrido_en' => '2026-09-25 10:30:00',
    ]);

    $categoria->refresh();
    $producto->refresh();
    $variante->refresh();
    $movimiento->refresh();
    $usuario->refresh();

    expect($categoria->productos)->toHaveCount(1)
        ->and($categoria->productos->first()->is($producto))->toBeTrue();

    expect($producto->categoria->is($categoria))->toBeTrue()
        ->and($producto->variantes)->toHaveCount(1)
        ->and($producto->activo)->toBeTrue();

    expect($variante->producto->is($producto))->toBeTrue()
        ->and($variante->movimientosInventario)->toHaveCount(1)
        ->and($variante->talla_us)->toBe('9.5')
        ->and($variante->existencia_pares)->toBe(12)
        ->and($variante->stock_minimo_pares)->toBe(3)
        ->and($variante->activo)->toBeFalse();

    expect($movimiento->variante->is($variante))->toBeTrue()
        ->and($movimiento->usuario->is($usuario))->toBeTrue()
        ->and($usuario->movimientosInventario)->toHaveCount(1)
        ->and($movimiento->cambio_pares)->toBe(12)
        ->and($movimiento->saldo_anterior)->toBe(0)
        ->and($movimiento->saldo_resultante)->toBe(12)
        ->and($movimiento->ocurrido_en->toDateTimeString())->toBe('2026-09-25 10:30:00');
});
