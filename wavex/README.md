# WaveX Technology theme

**Install:** zip the `wavex/` folder (or copy it to `wp-content/themes/wavex`) and activate it.

On activation the theme creates the Home, Blog, core and service pages, the five Projects, sets the static front page, `/%postname%/` permalinks (only if none are set) and the Privacy Notice page. Existing pages are never overwritten, and starter text is only written into pages that are still empty.

## After activating
1. Appearance > Customize > **WaveX: Footer & Contact**: set the WhatsApp number (country code, digits only), contact email and phone. The WhatsApp buttons only appear once a number is set.
2. Appearance > Customize > **WaveX: Home Page**: change hero text. The hero and section visuals are drawn in code (animated technology scenes, no image files). Upload an image in the same panel only if you prefer a photo.
3. Add a Featured Image to each Project (Our Work) and write its details.
4. Review the Privacy Notice text with your own legal advice before going live.

## Where things are
- Header, mega menus, footer: `template-parts/header`, `template-parts/footer`; menu structure in `inc/data.php`
- Home page: `front-page.php` + `template-parts/sections/`; the animated service demos: `template-parts/studio/` + `inc/studio-data.php`
- Service pages: `template-service.php` (content in `inc/pages-data.php`)
- Page templates by slug: `page-about.php`, `page-our-approach.php`, `page-why-wavex.php`, `page-contact.php`, `page-free-consultation.php`, `page-faq.php`; Privacy Notice uses `page.php`
- Our Work: custom post type in `inc/post-types.php`; templates `archive-project.php`, `single-project.php`
- Forms: `inc/forms.php` (nonce, honeypot, rate limit, email + private "Enquiries" records in the admin menu)
- Blog: `index.php`, `single.php`, `archive.php`, `search.php`, `404.php`

No page builder and no plugins are required. A standard SEO plugin works with the theme's title tag, headings and breadcrumbs.
