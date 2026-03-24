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

- `app/Support/PageCatalog.php`
  - loads `config/pages.php`
  - centralizes the public page catalog
  - is reused by web routes and sitemap generation

- `app/Core/Router.php`
  - registers `GET` and `POST` routes
  - dispatches exact-match paths
  - executes route middleware before handlers

- `app/Core/Controller.php`
  - renders views and page layouts
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
    - `/store`
    - `/aviso-legal`
    - `/privacy`
    - `/cookies`
    - `/payment-disclaimer`
    - `/support-terms`
  - auth/account routes:
    - `/login`
    - `/logout`
    - `/account`
    - `/account/characters`
    - `/account/support/history`
    - `/account/support/checkout`

- `app/Http/Controllers/Web/HomeController.php`
  - renders the homepage
  - renders the active 404 page

- `app/Http/Controllers/Web/PublicPageController.php`
  - resolves public pages from `PageCatalog`
  - renders project, legal, contact, help, store, and game-detail pages from content builders

- `app/Http/Controllers/Web/AuthController.php`
  - shows login
  - handles login/logout
  - marks auth pages as non-indexable and non-cacheable

- `app/Http/Controllers/Web/AccountController.php`
  - renders the private account dashboard
  - renders account characters
  - renders support history
  - starts web checkout

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

- `app/Content/Pages/home.php`
  - builds the homepage content structure
  - defines hero, carousel, featured games, and CTA copy

- `app/Content/Pages/public-pages.php`
  - builds public page content for project, contact, legal pages, store, help, and featured-game detail pages

- `config/pages.php`
  - is the source of truth for public page slugs and paths

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
  - `site.php`

- `app/Views/web/partials/`
  - `head.php`
  - `site-header.php`
  - `site-footer.php`
  - `scripts.php`
  - `account-nav.php`

- `app/Views/web/pages/public/`
  - `home.php`
  - `content-page.php`
  - `error-404.php`

- `app/Views/web/pages/auth/`
  - `login.php`

- `app/Views/web/pages/account/`
  - `dashboard.php`
  - `characters.php`
  - `support-history.php`

### CSS in Use

- `www/assets/css/app.css`
  - imports the shared CSS stack

- `www/assets/css/tokens/`
  - `core.css`
  - `themes.css`

- `www/assets/css/base/`
  - `reset.css`
  - `base.css`
  - `typography.css`
  - `accessibility.css`

- `www/assets/css/layouts/`
  - `section.css`
  - `site-header.css`
  - `site-footer.css`
  - `legal-nav.css`
  - `account.css`

- `www/assets/css/components/`
  - `buttons.css`
  - `chips.css`
  - `banners.css`
  - `badges.css`
  - `cards.css`
  - `dropdowns.css`
  - `cookie-banner.css`
  - `forms.css`

- `www/assets/css/pages/`
  - `home.css`
  - `content-page.css`
  - `error-404.css`
  - `home/*`

### JavaScript in Use

- `www/assets/js/app.js`
  - initializes the shared site modules on `DOMContentLoaded`

- `www/assets/js/modules/`
  - `theme.js`
  - `cookie-consent.js`
  - `dropdowns.js`
  - `mobile-nav.js`
  - `code-toggle.js`
  - `lightbox.js`
  - `footer-accordion.js`
  - `account-nav.js`

- `www/assets/js/pages/home.js`
  - homepage carousel, filters, and reveal behavior

## Persistence and Sensitive Data

- sessions live under `storage/cache/sessions`
- session files are generated runtime cache and are safe to clear locally
- file-backed billing fallback lives under `storage/billing/`
- `storage/cache/sessions/` and `storage/billing/` are intentionally gitignored as runtime data
- private pages are rendered with `noindex,nofollow,noarchive`
- JSON API responses send `no-store`/`no-cache`

## Local Development

- start the local server with:
  - `php -S localhost:8000 -t www www/router.php`

- if DB-backed billing is needed:
  - configure `DB_*`
  - run `php scripts/migrate.php`

## Current Source of Truth

The active architecture is the `app/Http`, `app/Domain`, `app/Content/Pages`, `config/pages.php`, and `app/Views/web` layout above. That is the structure future changes should follow.
