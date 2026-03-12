# Swap RPG - Portfolio Site (`swap-web`)

This repo contains the PHP/HTML/CSS/JS portfolio + promo site for the **Swap RPG** (ECS-based RPG prototype).

- Web root: `www/`
- Game code lives in a separate repo: `swap-rpg` (linked from the site)
- Screenshots/assets are copied manually into `www/img` (e.g. from `Swap/res`) to keep this site self-contained

## Run locally (PHP built-in server)

From the repo root:

```powershell
cd .\www
php -S localhost:8000
```

Then open:

- `http://localhost:8000/index.php`

Notes:

- PHP’s built-in server **does not** apply Apache `.htaccess` rules. If you want to test the rewrite rules
  (extensionless URLs, custom 404), use Apache (e.g. XAMPP/WAMP) or deploy to your hosting.

## Structure

- `www/index.php`: main portfolio page (carousel + architecture + roadmap + gallery)
- `www/html/hito*.php`: devlog/milestones pages
- `www/includes/`: shared PHP includes (header/footer/navigation helpers)
- `www/.htaccess`: Apache rewrite rules + `ErrorDocument 404`
- `www/404.php`: 404 handler page
- `www/css/`, `www/js/`, `www/img/`: site assets

## Hosting / deployment (Dinahosting + GoDaddy)

You have:

- **GoDaddy**: domain registrar (and optionally DNS management)
- **Dinahosting**: the web hosting where the PHP site runs

Typical setup options:

1) **Move DNS to Dinahosting (nameservers)**
   - In GoDaddy, change the domain’s nameservers to the ones provided by Dinahosting.
   - Manage DNS records inside Dinahosting.

2) **Keep DNS at GoDaddy (A/CNAME records)**
   - Keep GoDaddy nameservers.
   - Point the domain to Dinahosting by setting:
     - `@` (root) **A record** → Dinahosting server IP
     - `www` **CNAME** → `@` (or the hostname Dinahosting provides)
   - Configure any additional records you need (MX for mail, etc.) in GoDaddy.

Deployment checklist on Dinahosting:

- Upload the *contents* of `www/` to your hosting web root (commonly `public_html/`).
  - The site should end up like `public_html/index.php`, `public_html/css/style.css`, etc.
- Ensure `.htaccess` is uploaded (it enables rewrites + the custom 404 handler).
- Ensure your hosting uses Apache with `mod_rewrite` enabled (common in shared hosting).
- Confirm the PHP version you want in Dinahosting’s control panel (and that `short_open_tag` is not required).

Troubleshooting tips:

- If `/hito1` style URLs don’t work, your `.htaccess` may not be applied (wrong web root) or rewrites are disabled.
- If assets 404, you likely uploaded `www/` as a folder instead of uploading its contents to the web root.

## Next steps (ideas)

- Add a short “Tech details” section explaining the ECS goals and how input/render/systems interact.
- Curate/optimize screenshots (size, naming, alt text) and add a dedicated “Media” section.
- Add a small “Build/Run” section linking to `swap-rpg` docs (controls, how to compile/run the game).

