# CODE_FLOW

## Runtime Entry

- `www/index.php`
  - loads `app/Support/bootstrap.php`
  - starts the session
  - loads `routes/web.php` and `routes/api.php`
  - tracks page views through `App\Services\AnalyticsService`
  - dispatches the request through `App\Core\Router`

- `www/router.php`
  - supports the PHP built-in server in local development
  - serves real files from `www/` directly
  - falls back to `www/index.php` for application routes

## Active App Layers

### Support and Core

- `app/Support/bootstrap.php`
  - autoloads `App\...`
  - loads config
  - defines helpers for URLs, money formatting, dates, CSRF, and page language
  - initializes translations and the global site/page context

- `app/Support/i18n.php`
  - loads `lang/es.php` and `lang/en.php`
  - exposes `t(...)`

- `app/Core/Router.php`
  - registers `GET` and `POST` routes
  - dispatches exact-match paths
  - executes route middleware before handlers

- `app/Core/Controller.php`
  - renders views
  - sends JSON responses
  - centralizes sensitive-page and no-store response headers

- `app/Core/View.php`
  - resolves dot-notation views into `app/Views/...`
  - injects shared globals plus controller data

- `app/Core/Auth.php`
  - wraps current session-based auth state

- `app/Core/Session.php`
  - stores sessions under `storage/cache/sessions`
  - provides flash helpers and invalidation

### Web HTTP Layer

- `routes/web.php`
  - public routes:
    - `/`
    - `/projects/swap-rpg`
    - `/games/*`
    - `/contact`
    - `/help`
    - `/privacy`
    - `/cookies`
  - auth/account routes:
    - `/login`
    - `/profile`
    - `/billing/history`
    - `/characters`

- `app/Http/Controllers/Web/HomeController.php`
  - renders the homepage
  - renders the active 404 page

- `app/Http/Controllers/Web/PageController.php`
  - renders static/public project and game pages using content builders

- `app/Http/Controllers/Web/AuthController.php`
  - shows login
  - handles login/logout
  - marks auth pages as non-indexable and non-cacheable

- `app/Http/Controllers/Web/ProfileController.php`
  - renders the private profile/account dashboard

- `app/Http/Controllers/Web/BillingController.php`
  - renders billing history
  - starts web checkout

- `app/Http/Controllers/Web/CharacterController.php`
  - renders the private character/roster page

- `app/Http/Middleware/RequireAuth.php`
  - redirects guests to `/login`

### API HTTP Layer

- `routes/api.php`
  - `/api/health`
  - `/api/auth/login`
  - `/api/auth/logout`
  - `/api/account/profile`
  - `/api/account/characters`
  - `/api/billing/config`
  - `/api/billing/checkout`
  - `/api/billing/webhook`

- `app/Http/Controllers/Api/*.php`
  - expose JSON contracts for auth, account, billing, and health
  - all JSON responses go through `Controller::json(...)`

- `app/Http/Middleware/RequireApiAuth.php`
  - returns `401` JSON when the current session is not authenticated

### Content Layer

- `app/Content/Web/home-page.php`
  - builds the homepage content structure
  - defines hero, carousel, featured games, and CTA copy

- `app/Content/Web/site-pages.php`
  - builds the public page content for project, contact, legal pages, and featured-game detail pages

### Domain Layer

- `app/Domain/Auth`
  - DTOs for login input/result
  - placeholder user repository
  - `LoginManager` for session login/logout orchestration

- `app/Domain/Account`
  - `ProfileReader` for current account payloads
  - `CharacterCatalog` and `CharacterRepository` for the current roster data

- `app/Domain/Billing`
  - DTOs for checkout and webhook data
  - gateway abstraction plus placeholder and Stripe gateways
  - `CheckoutService`, `CheckoutGatewayFactory`, `WebhookProcessor`, `StripeWebhookVerifier`
  - repositories for billing records and webhook events

### Infrastructure

- `app/Infrastructure/Database/Connection.php`
  - creates the PDO connection from `config/database.php`

- `app/Infrastructure/Database/Migrator.php`
  - runs SQL migrations from `database/migrations`

- `scripts/migrate.php`
  - CLI entrypoint for migrations

## View and Asset Structure

### Views in Use

- `app/Views/web/layouts/`
  - `head.php`
  - `header.php`
  - `footer.php`
  - `scripts.php`

- `app/Views/web/pages/`
  - `home.php`
  - `page.php`
  - `login.php`
  - `profile.php`
  - `billing-history.php`
  - `characters.php`
  - `404.php`

### CSS in Use

- `www/assets/css/system/`
  - `base.css`
  - `components.css`
  - `layout.css`
  - `chrome.css`
  - `pages.css`

- `www/assets/css/pages/`
  - `home.css`
  - `auth.css`
  - `site.css`

### JavaScript in Use

- `www/assets/js/main.js`
  - shared site/header behavior

- `www/assets/js/home.js`
  - homepage carousel/filter behavior

## Persistence and Sensitive Data

- sessions live under `storage/cache/sessions`
- file-backed billing fallback lives under `storage/billing/`
- `storage/billing/` is intentionally gitignored
- private pages are rendered with `noindex,nofollow,noarchive`
- JSON API responses send `no-store`/`no-cache`

## Local Development

- start the local server with:
  - `php -S localhost:8000 -t www www/router.php`

- if DB-backed billing is needed:
  - configure `DB_*`
  - run `php scripts/migrate.php`

## Current Source of Truth

The active architecture is the `app/Http`, `app/Domain`, `app/Content`, and `app/Views/web` layout above. That is the structure future changes should follow.
