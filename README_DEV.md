# Local Development

## Run locally with VS Code

From the project root, open a terminal and run:

```
php -S localhost:8000 -t www
```

Then open: http://localhost:8000

That's it. No extra config needed.

## How it works locally vs production

| | Local (php -S) | Dinahosting |
|---|---|---|
| Entry point | `www/index.php` | `www/index.php` |
| Assets URL | `/www/assets/...` | `/assets/...` |
| Base path | `/www` (auto-detected) | `` (empty, auto-detected) |

The `asset_url()` and `page_url()` functions detect the environment
automatically using `$_SERVER['SCRIPT_NAME']`, so no config changes
are needed between local and production.

## Upload to Dinahosting (FileZilla)

Upload to FTP root `/`:

```
/                       <- FTP root
├── app/
├── config/
├── lang/
├── routes/
├── storage/
└── www/
    ├── assets/         <- CSS, JS, images go HERE (inside www/)
    ├── index.php
    ├── .htaccess
    ├── robots.txt
    └── sitemap.php
```

**IMPORTANT:** `assets/` must be INSIDE `www/` on the server,
not at the FTP root. It needs to be publicly accessible.

## Files NOT to upload

- `.git/`
- `storage/cache/sessions/*` (created automatically)
- `README_DEV.md`
