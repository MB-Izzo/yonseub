# AGENTS.md

## Build, Lint, and Test Commands

- **Frontend (JS/TS):**
    - Build: `npm run build`
    - Dev server: `npm run dev`
    - Lint: `npm run lint` (auto-fix)
    - Format: `npm run format` (Prettier)
    - Type-check: `npm run types`
- **Backend (Laravel/PHP):**
    - Run tests: `composer test` or `php artisan test`
    - Run a single test: `php artisan test --filter=TestClassName` (replace with test class/method)
    - Migrate DB: `php artisan migrate`
    - Start server: `php artisan serve`

## Code Style Guidelines

- **JS/TS/React:**
    - Use 4 spaces for indentation, LF line endings.
    - Prefer single quotes, always use semicolons.
    - Organize imports (Prettier plugin).
    - Max line length: 150 chars.
    - Use TypeScript types; avoid `any`.
    - React: No prop-types, hooks rules enforced.
    - Use Tailwind CSS for styles.
- **PHP/Laravel:**
    - PSR-4 autoloading, PSR-12 style.
    - Use strict types, descriptive names.
    - Handle errors with exceptions.
    - Place tests in `tests/Unit` or `tests/Feature`.

- **General:**
    - Remove trailing whitespace, insert final newline.
    - Ignore `vendor`, `node_modules`, `public` for linting.
