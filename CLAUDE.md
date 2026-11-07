# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

RetroGaming.it: a retro video game blog on Laravel 13 (PHP 8.4 in Docker, MariaDB). All UI text and code comments are in Italian; keep new ones in Italian. Class names are English, but database columns are Italian (`titolo`, `nome`, `descrizione`, `voto`).

## Commands

Run everything through Docker. The local PHP in `C:\Users\loryp\php` has no `php.ini` and no `ext` folder, so it can't load the extensions Laravel needs, and Composer is not installed on the host. `docs/local-setup.md` covers running without Docker. The minimum PHP is 8.4.1.

```
docker compose up -d --build                                   # start, site at http://localhost:8080
docker compose down                                            # stop, keeps data
docker compose down -v                                         # stop, delete database and vendor volumes
docker compose logs -f web                                     # Apache, PHP and startup output
docker compose exec web php artisan test                       # all tests
docker compose exec web php artisan test --filter=AuthTest     # one class or test method
docker compose exec web composer require <package>             # add a dependency
```

Tests use in-memory SQLite (`phpunit.xml`), so they don't touch the MariaDB data.

If Docker reports `docker-credential-desktop` not found, Docker Desktop's `resources\bin` folder is missing from `PATH` in that shell; prepend it for the command.

In Git Bash, `MSYS_NO_PATHCONV=1` is needed for `docker run -v` paths, but it also breaks `/tmp` and `/dev/null` paths passed to Windows programs such as `curl`.

## Docker behaviour

`docker/entrypoint.sh` runs on every start of `web`: it creates `.env` from `.env.example` if missing, runs `composer install`, generates `APP_KEY`, then `php artisan migrate --force --seed`.

- `DatabaseSeeder` runs on every start, so it returns early if articles already exist. New seeders added to it do not run on an existing database; use `docker compose down -v` or run them with `db:seed --class=`.
- The repo is bind-mounted, so code edits are live. `vendor/` is a named volume to keep it out of the OneDrive folder, which means it is empty on the host.
- `.env` is gitignored: defaults for a fresh clone belong in `.env.example`.

## Architecture

Standard Laravel MVC: `routes/web.php` maps to controllers in `app/Http/Controllers`, which load Eloquent models and return Blade views. Every page needs the `auth` middleware except login and registration (`guest`). `/` is the home page, so guests reach the login form through the `auth` redirect.

**Auth** is hand-written on Laravel's `Auth` facade (`Auth\LoginController`, `Auth\RegisterController`), with no starter kit. Registration does not log the user in; it redirects to the login form with a `status` flash message. `users` has `nome` and `cognome` instead of Laravel's default `name`. Logout is a POST form.

**Data:** content comes from seeders in `database/seeders`.
- `Generation` has many `Console`; `Era` has many `Game`. Both timelines share `partials/timeline-card`.
- `Article::firma` builds the "12 Ottobre 1985 • di Redazione" line. Article text is stored as plain text and rendered with `nl2br(e(...))`.
- `Review` keeps the author's name in `autore`, and `user_id` is nullable, because seeded reviews have no real account.

**Views:** `layouts/app` has the navbar and footer for logged-in pages, `layouts/guest` is for the auth forms. Pages add scripts through `@push('scripts')`.

**Assets** are plain files in `public/css` and `public/js`, with no Vite or npm build. Link them with `asset()`.
- `public/js/script.js` (search, detail modal, mobile menu) is loaded by the console and games pages. It depends on the `#searchInput`, `#infoModal` and `.console-card` markup.
- `public/js/home.js` (mini-game dropdown, Snake) is loaded only by the home page. Tetris, Flappy Bird and Pong are "coming soon" placeholders.
- The second `DOMContentLoaded` block in `script.js` targets the home dropdown, so it never runs.

**Language:** `APP_LOCALE=it` but the repo has no `lang/it` files. Laravel's built-in validation messages fall back to English, so Italian messages are set per rule in the Form Requests and controllers.
