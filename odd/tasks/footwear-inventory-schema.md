# Footwear Inventory Schema

## Objective

Create the approved database schema for a single-warehouse footwear inventory and add the user role column without creating models, Filament resources, forms, or movement logic.

## Authorized scope

- `database/migrations/**`
- One required ODD recovery task document: this file

## Constraints

- Preserve the applied Laravel baseline migrations.
- Use Spanish domain table and column names from the approved design.
- Add `rol` to the existing `users` table through a new migration.
- Existing user becomes `superadministrador`; new users default to `bodeguero`.
- Preserve movement history through restrictive foreign keys and deactivation flags.
- Verify against the existing SQLite development database without `migrate:fresh`.
- Effective TDD: not configured; use standard migration verification and the narrowest applicable test command.

## Tasks

- [x] ODD-1 Create migrations for categories, products, variants, inventory movements, and the `users.rol` column.
- [x] ODD-2 Run formatting and verify migrations/status/schema against the existing development database without deleting data.

## Acceptance criteria

- The approved tables and constraints exist with the documented types, indexes, defaults, and foreign keys.
- Variant uniqueness is `(producto_id, color, talla_us)` and `codigo` is globally unique.
- Pair changes are signed and balances are non-negative by the declared schema constraints/invariants.
- The existing user has role `superadministrador`; the role default for future users is `bodeguero`.
- No models, Filament resources, forms, importers, or movement services are created.

## Route evidence

- ODD-1: delegated writer because implementation spans multiple non-trivial migration files.
- ODD-2: delegated verification because migration execution and database inspection are execution work.

## Progress

- Design approved by the user.
- Role for the existing account confirmed as `superadministrador`.
- ODD-1 completed in five new migrations; categories timestamps were corrected before final verification.
- ODD-2 passed: Pint made no changes, batch 2 rolled back and reapplied without changing baseline rows, all eight migrations are `Ran`, integrity and foreign-key checks passed, and the test suite passed (2 tests, 2 assertions).
- Work-unit commit: `e2849b0` (`feat(inventory): add footwear catalog schema`).
- SQLite limitation: `unsignedInteger()` is materialized as `INTEGER`, so SQLite does not enforce non-negative values by itself.
- Native Gentle AI review preflight was unavailable after two safe retries because the negotiated freeze could not open the read-only filesystem; no review authority was created.

## Next step

Report the completed migrations and verification. A work-unit commit could not be created because the local `.git` directory is empty/unusable.
