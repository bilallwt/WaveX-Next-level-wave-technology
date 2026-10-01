# WaveX Technology theme

Install: zip the `wavex/` folder (or copy it to `wp-content/themes/wavex`) and activate it.
On activation the theme creates the Home, Blog, core and service pages, the five Projects, sets the static front page and `/%postname%/` permalinks (only if none are set). Existing pages are never overwritten.

- Header, mega menus, footer: `template-parts/header`, `template-parts/footer`, data in `inc/data.php`
- Home page: `front-page.php` + `template-parts/sections/`
- Home text/image: Appearance > Customize > "WaveX: Home Page"
- Projects (Our Work): custom post type in `inc/post-types.php`

Still to build: Contact / Free Consultation forms and the dedicated content for the inner pages.
