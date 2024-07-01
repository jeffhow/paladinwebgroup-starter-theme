=== paladinwebgroup ===

Tags: accessibility-ready, one-column, two-columns, custom-menu, featured-images, microformats, sticky-post, threaded-comments, translation-ready
Requires at least: 5.2
Tested up to: 6.5
Stable tag: trunk
License: GNU General Public License v3 or Later
License URI: https://www.gnu.org/licenses/gpl.html

== Description ==

PaladinWebGroup Starter

== Directions ==

1. Add folder for custom SCSS
    - `/assets/css/[client-name]`
2. Write SCSS in that folder
3. Update `main.scss` to import those files
4. Run sass from theme folder: 
    - `sass --watch ./assets/css/main.scss ./assets/css/main.css`
    or
    `sass ./assets/css/main.scss ./assets/css/main.css`

5. Modify `/assets/inc/google-fonts.php` as necessary