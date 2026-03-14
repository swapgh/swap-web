# Project Changes

## Recent Updates (Deployment-Ready Build)

### Commit b0ef8b8: Fix asset URLs to use absolute paths for nested routes
asset_url() now returns absolute paths (e.g., /assets/css/main.css) instead of relative paths (e.g., assets/css/main.css). This ensures CSS, JS, and images load correctly on nested routes like /devlog/hito1.

Previously, relative paths would resolve incorrectly in nested paths to /devlog/assets/css/main.css instead of /assets/css/main.css.

### Commit dd66039: Fix Windows path separator issue in URL generation and add router.php
Fixed two critical issues:
1. page_base_path() was returning backslashes on Windows because dirname() returns backslashes. Now converts them to forward slashes before rtrim().
2. Added www/router.php to support PHP development server. Sets $_SERVER['SCRIPT_NAME'] and routes asset requests to ../assets/

This allows the project to work correctly on both Windows and Unix-like systems, and enables running with PHP's built-in server: php -S localhost:3000 router.php

### Commit 9b60cff: Move assets outside www/ and update references
All assets moved from www/assets/ to root-level assets/ directory. Updated all view files to use correct asset_url() paths and updated config to point to new asset location. No hardcoded paths - works on any server with correct .htaccess.

This completes the asset restructuring, ensuring the project structure is deployment-ready.

## Deployment Instructions

### For Dinahosting (Apache):
```bash
git clone <repo> or git pull origin main
```
The server already has .htaccess configured to:
- Rewrite /assets/ requests to ../assets/ directory
- Route all requests through www/index.php

### For Local Development:
```bash
cd www/
php -S localhost:3000 router.php
```

### Project Structure:
```
project-root/
├── www/                    # Public web root
│   ├── index.php
│   ├── .htaccess          # Apache routing rules
│   └── router.php         # LOCAL DEV ONLY
├── assets/                # Static assets (CSS, JS, images)
├── app/
├── config/
└── routes/
```

### Key Features:
✅ Works on Windows and Unix-like systems
✅ No hardcoded paths - all relative
✅ CSS/JS/images load on all routes (home, nested devlog routes, etc)
✅ Deployment-ready without code changes
✅ PHP built-in server support for development
✅ Apache .htaccess support for production
