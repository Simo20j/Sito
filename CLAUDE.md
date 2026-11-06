# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

RetroGaming.it: a retro video game blog in plain PHP, HTML, CSS and JavaScript. There is no framework, package manager, build step, linter or test suite. All UI text and code comments are in Italian; keep new ones in Italian.

## Running locally

Run everything through Docker; PHP and MySQL are not installed on this machine.

```
docker compose up -d --build              # start, site at http://localhost:8080
docker compose down                       # stop, keeps accounts
docker compose down -v                    # stop and delete the database
docker compose logs -f web                # Apache and PHP errors
docker compose exec web php -l <file>.php # syntax-check one file
```

The repo folder is bind-mounted into the `web` container, so PHP, CSS and JS edits are live. `docker/init.sql` runs only when the database volume is first created.

If Docker reports `docker-credential-desktop` not found, Docker Desktop's `resources\bin` folder is missing from `PATH` in that shell; prepend it for the command.

The site connects as `root` with an empty password. `$host` comes from the `DB_HOST` environment variable (`db` in Compose) and falls back to `localhost`. `Registrazione.php` treats SQLSTATE 23000 as "email already registered", so `email` must stay UNIQUE.

There is no index page. `docker/apache.conf` redirects `/` to `Login` and forces `Login` to be served as `text/html`, because it has no extension.

## Architecture

Each page is a self-contained file: PHP logic at the top, HTML below. There are no shared includes, so these blocks are copy-pasted and a change must be repeated in every page:

- the session guard (`session_start()` plus a redirect if `$_SESSION['nome']` is unset)
- the `<header class="navbar">` navigation, with `class="active"` set per page
- the footer and the `#infoModal` markup
- the PDO connection settings (in `Login.php` and `Registrazione.php`)

**Auth flow:** `Registrazione.html` posts to `Registrazione.php`; the `Login` page posts to `Login.php`. Both handlers have no HTML output of their own: they redirect back with query parameters (`?errore=...`, `?successo=1`), and inline JS in the form page reads those to show messages. `$_SESSION['nome']` is what marks a user as logged in.

**Data:** only user accounts are in MySQL. All other content is hardcoded PHP arrays in the page that renders it:

- `Articolo.php`: articles keyed by `?id=`. The cards in `Home.php` are separate static HTML, so adding an article means editing both files.
- `Console.php` and `Video_Giochi.php`: nested arrays (generation/era containing items), rendered with the same `.gen-section` / `.console-card` markup.
- `Recensioni.php`: reviews live in `$_SESSION['recensioni_blog']`, so they are per-user and are lost on logout.

**JavaScript:** `Script.js` provides live search (`#searchInput`), the detail modal for `.console-card` elements and the mobile menu. It is loaded only by `Console.php` and `Video_Giochi.php`. `Home.php` does not load it: it has its own inline script for the mini-game dropdown and the Snake game (the other mini-games are "coming soon" placeholders). The second `DOMContentLoaded` block in `Script.js` targets the Home dropdown, so it currently never runs.

**CSS:** everything is in `style.css`, in sections by feature. Many one-off styles are inline in the pages. The theme is dark with `#00ffcc` as the accent.

## Naming traps

Check these before renaming or linking to anything:

- `Login` (no extension) is the login form, and is plain HTML. `Login.php` is only the POST handler and outputs nothing on GET, yet the session guards in `Articolo.php`, `Console.php`, `Recensioni.php` and `Video_Giochi.php` redirect to it, which gives a blank page. `Home.php` and `Logut.php` correctly redirect to `Login`.
- `Home` (no extension) is an outdated copy of `Home.php`. `Home.php` is the live page.
- `Logut.php` is the real logout script, misspelled. `Articolo.php` links to `Logout.php`, which does not exist.
- `Login.php` redirects to `Login.html` on a database error; that file does not exist.
- `Recensioni.php` links to `VideoGiochi.php`; the real file is `Video_Giochi.php`.
- File names are case-sensitive in the container, even though Windows ignores case: always match the exact name (`Script.js`, not `script.js`).
- Navigation is inconsistent: `Articolo.php` and `Video_Giochi.php` still have `#` placeholder links.
