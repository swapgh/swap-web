# Swap Web

Small PHP web project for the Swap RPG portfolio site.

## Run locally

1. Clone the repo:
```bash
git clone git@github.com:swapgh/swap-web.git
cd swap-web
```

2. Check PHP:
```bash
php -v
php -m
```

Recommended extensions:
- `pdo`
- `pdo_mysql`
- `intl`

3. Prepare writable storage:
```bash
mkdir -p storage/cache/sessions storage/logs storage/billing
chmod -R u+rwX storage
```

4. Start the local server:
```bash
php -S localhost:8000 -t www www/router.php
```

5. Open the site:
- `http://localhost:8000`

## Database setup

If you want database-backed billing or future account persistence, provide DB config in the environment:

```bash
export DB_HOST=127.0.0.1
export DB_PORT=3306
export DB_DATABASE=swap_web
export DB_USERNAME=your_user
export DB_PASSWORD=your_password
```

Then run migrations:

```bash
php scripts/migrate.php
```

MariaDB works fine here through `pdo_mysql`.

## Billing setup

The site can run without live billing keys. For real Stripe checkout, set:

```bash
export BILLING_PROVIDER=stripe
export STRIPE_PUBLIC_KEY=your_public_key
export STRIPE_SECRET_KEY=your_secret_key
export STRIPE_WEBHOOK_SECRET=your_webhook_secret
export BILLING_SUCCESS_URL=https://your-site.example/profile?checkout=success
export BILLING_CANCEL_URL=https://your-site.example/profile?checkout=cancel
```

Without these values, the public site still runs, but live Stripe payments will not.

## Notes

- `storage/` must stay writable.
- `storage/billing/` is ignored on purpose and should not be committed.
- Private account pages and API responses are marked to avoid indexing/caching.
