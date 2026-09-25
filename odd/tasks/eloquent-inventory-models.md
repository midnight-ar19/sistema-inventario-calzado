# Eloquent Inventory Models

## Objective

Implement the Eloquent models and relationships for the footwear inventory schema without adding Filament resources, forms, or inventory movement business logic.

## Authorized scope

- `app/Models/**`
- `tests/Feature/Models/**`
- This ODD task document

## Constraints

- Follow existing Laravel 13 model conventions in this project.
- Use concrete Eloquent relationship return types.
- Keep Spanish domain table/column names mapped explicitly where Laravel conventions do not infer them.
- Do not alter migrations, seeders, Filament resources, routes, or dependencies.
- Effective TDD: add focused Pest feature coverage for model relationships.

## Tasks

- [x] ODD-1 Create Eloquent models with fillable/casts and relationships for categories, products, variants, inventory movements, and users.
- [x] ODD-2 Add focused Pest coverage proving the relationship graph and casts.
- [x] ODD-3 Run formatting and the narrowest relevant tests.

## Acceptance criteria

- `CategoriaCalzado` has many `Producto` records.
- `Producto` belongs to a category and has many variants.
- `VarianteProducto` belongs to a product and has many inventory movements.
- `MovimientoInventario` belongs to a variant and a user.
- `User` has many inventory movements.
- Boolean, decimal, datetime, and password casts remain appropriate.

## Route evidence

- ODD-1/ODD-2 delegated to a bounded writer because implementation touches multiple non-trivial files.
- ODD-3 delegated/handled as verification work.

## Progress

- Exploration found only `User` exists as a model; the inventory tables already exist through local migrations.
- ODD-1/ODD-2 completed by bounded writer: added four inventory models, updated `User`, and added focused Pest relationship/cast coverage.
- Writer reported `vendor/bin/pint --dirty --format agent` passed and `php artisan test --compact tests/Feature/Models/EloquentInventoryRelationshipsTest.php` passed (1 test, 18 assertions).
- Independent verifier inspected models/tests and ran `php artisan test tests/Feature/Models/EloquentInventoryRelationshipsTest.php --compact`: passed (1 test, 18 assertions). Pint was not rerun by the verifier because it can mutate files in read-only verification mode.
- Work-unit commit: `e71b110` (`feat(inventory): add Eloquent models and relationships`).

## Next step

Report completed model relationships and verification results.
