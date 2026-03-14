# Styles Map

This file summarizes which stylesheet is responsible for each part of the site.

## Shared styles

- `assets/css/main.css`
  Shared layout and global UI.
  Includes reset, `body`, page shell, header, footer, navigation, shared buttons, and the 404 page.

## Page-specific styles

- `assets/css/home.css`
  Homepage only.
  Includes hero, showcase carousel, roadmap/devlog cards, gallery, closing section, and lightbox.

- `assets/css/auth.css`
  Login, profile, and characters pages.
  Includes auth layout, form styles, profile card styles, and character grid/card styles.

- `assets/css/devlog.css`
  Devlog and milestone pages.
  Includes sidebar layout, milestone content blocks, embedded code areas, and milestone images.

## Header and footer

- Header styles are in `assets/css/main.css`
  Main selectors include `header`, `.header-inner`, `.logo-*`, `nav`, `.nav-list`, `.nav-btn`, `.dropdown-*`, `.header-lang`, `.lang-link`, and `.hamburger`.

- Footer styles are in `assets/css/main.css`
  Main selectors include `footer`, `.footer-content`, `.footer-top`, `.footer-links`, and `.footer-bottom`.

## Which pages load which CSS

- All pages load `assets/css/main.css` from `app/Views/layouts/head.php`.
- Home also loads `assets/css/home.css` from `app/Views/pages/home.php`.
- Login also loads `assets/css/auth.css` from `app/Views/pages/login.php`.
- Profile also loads `assets/css/auth.css` from `app/Views/pages/profile.php`.
- Characters also loads `assets/css/auth.css` from `app/Views/pages/characters.php`.
- Devlog pages also load `assets/css/devlog.css` from `app/Views/devlog/template.php`.
