# Swap RPG Web

## Deployment to production (Dinahosting etc.)

1. Upload **all files** to server domain root (www/), OR:
   - public/ contents to www/ (index.php, .htaccess).
   - Other folders (app/, assets/, config/) to parent of www/.

2. **Assets outside www/:** 
   - .htaccess now auto-redirects /assets/ -> ../assets/ (works).
   - config/app.php 'asset_base' => '' (default).

3. Test: https://domain/assets/css/main.css returns 200.

## Local dev
- VSCode PHP Server on cwd works.
- `php -S localhost:8000 -t public/`

See TODO.md for status.

