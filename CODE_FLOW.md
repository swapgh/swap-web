# CODE_FLOW

## Current Structure

- `www/index.php`
  - boots the app
  - starts the session
  - loads `routes/web.php`
  - loads `routes/api.php`
  - tracks page views
  - dispatches the request through `App\Core\Router`

- `routes/web.php`
  - registers the public web routes
  - maps them to `App\Http\Controllers\Web\...`
  - protects account routes with `App\Http\Middleware\RequireAuth`

- `routes/api.php`
  - registers API routes
  - exposes `/api/health`
  - exposes auth endpoints such as `/api/auth/login`
  - exposes account endpoints such as `/api/account/profile`
  - maps them to `App\Http\Controllers\Api\...`

## HTTP Layer

- `app/Http/Controllers/Web/HomeController.php`
  - renders the homepage
  - renders the 404 page

- `app/Http/Controllers/Web/PageController.php`
  - renders the static public pages:
    - project
    - contact
    - help
    - privacy
    - cookies

- `app/Http/Controllers/Web/AuthController.php`
  - shows the login page
  - handles login
  - handles logout

- `app/Http/Controllers/Web/ProfileController.php`
  - renders the signed-in profile page

- `app/Http/Controllers/Web/CharacterController.php`
  - renders the signed-in character page

- `app/Http/Middleware/RequireAuth.php`
  - redirects guests to `/login`

- `app/Http/Controllers/Api/HealthController.php`
  - returns a JSON health payload for `/api/health`

- `app/Http/Controllers/Api/AuthController.php`
  - handles API login and logout

- `app/Http/Controllers/Api/AccountController.php`
  - returns the current profile and character data

- `app/Http/Controllers/Api/BillingController.php`
  - exposes billing config
  - creates placeholder checkout sessions
  - reads the latest or requested checkout session

- `app/Http/Controllers/Api/BillingWebhookController.php`
  - accepts billing webhook events
  - updates persisted checkout status records

- `app/Http/Middleware/RequireApiAuth.php`
  - returns `401` JSON for unauthenticated API requests

## Content Layer

- `app/Content/Web/home-page.php`
  - builds the structured data used by the homepage

- `app/Content/Web/site-pages.php`
  - builds the structured data for public static pages

## Domain Layer

- `app/Domain/Auth/Entities/User.php`
  - defines the current placeholder authenticated user payload

- `app/Domain/Auth/DTOs/LoginCredentials.php`
  - defines normalized login input

- `app/Domain/Auth/DTOs/AuthResult.php`
  - defines the login result contract

- `app/Domain/Auth/Repositories/PlaceholderUserRepository.php`
  - resolves the current placeholder user source

- `app/Domain/Auth/Services/LoginManager.php`
  - validates sign-in input
  - logs users into the current session
  - centralizes logout for web and API flows

- `app/Domain/Account/Services/CharacterCatalog.php`
  - provides the current placeholder character roster

- `app/Domain/Account/Services/ProfileReader.php`
  - shapes the current signed-in profile payload

- `app/Domain/Billing/Services/CheckoutService.php`
  - validates checkout input
  - creates checkout sessions through the configured gateway
  - reads persisted checkout state

- `app/Domain/Billing/Services/CheckoutGatewayFactory.php`
  - resolves the active billing gateway from config

- `app/Domain/Billing/Services/WebhookProcessor.php`
  - maps webhook events to persisted billing status updates

- `app/Domain/Billing/Services/StripeWebhookVerifier.php`
  - validates Stripe webhook signatures using the configured webhook secret

- `app/Domain/Billing/Gateways/StripeCheckoutGateway.php`
  - creates Stripe checkout sessions through Stripe's HTTPS API when Stripe is configured

## Views

- `app/Views/web/layouts/`
  - shared head, header, footer, and scripts

- `app/Views/web/pages/`
  - `home.php`
  - `page.php`
  - `login.php`
  - `profile.php`
  - `characters.php`
  - `404.php`

## Current Direction

- `app/Http/...` is the web delivery layer
- `app/Http/Controllers/Api/...` is the API delivery layer
- `app/Content/...` holds page-content builders
- `app/Domain/...` holds feature-oriented business logic
- `app/Services/...` currently holds cross-cutting services such as analytics

## Next Refactor Candidates

- add request/response DTOs for API endpoints as the surface grows
- introduce repositories or gateways inside each domain once persistence starts
- split config and service wiring once auth, billing, and API integrations become real
