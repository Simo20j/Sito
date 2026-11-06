# RetroGaming.it

A retro video game blog built with plain PHP, HTML, CSS and JavaScript. Users register and log in, then can read articles, browse console and game timelines, leave reviews and play Snake.

The whole site runs in Docker, so you don't need to install PHP, a web server or a database.

## Launch the site

1. Install [Docker Desktop](https://www.docker.com/products/docker-desktop/) and start it.
2. From the project folder, run:

   ```
   docker compose up -d --build
   ```

3. Open <http://localhost:8080>.
4. The first time, follow the link to register (the password needs at least 6 characters), then log in. You will land on the home page.

The first launch takes a few minutes while Docker downloads what it needs. Later launches take a few seconds, and you can leave out `--build`.

## Everyday commands

| Task | Command |
| --- | --- |
| Start the site | `docker compose up -d` |
| Stop the site (keeps accounts) | `docker compose down` |
| Stop the site and delete all accounts | `docker compose down -v` |
| See the logs | `docker compose logs -f` |

Changes to the site's files appear as soon as you reload the page, with no restart. If you change `Dockerfile` or `docker/apache.conf`, run `docker compose up -d --build`. If you change `docker/init.sql`, run `docker compose down -v` and start again, because it only runs when the database is first created.

## How it's set up

- **`web`** runs PHP 8.3 with Apache on port 8080 and serves this folder directly.
- **`db`** runs MariaDB, a MySQL-compatible database. It creates the `utenti` database and the `registrazioni` table on first launch, and keeps its data in a Docker volume.

The database has an empty root password to match the site's code. This is fine for local use because the database can't be reached from outside Docker, but don't deploy this setup to a public server.

## Troubleshooting

| Problem | Cause and fix |
| --- | --- |
| `failed to connect to the docker API` | Docker Desktop isn't running. Start it and try again. |
| `docker-credential-desktop: executable file not found` | Docker's `resources\bin` folder isn't on your `PATH`. Restart your terminal; if that doesn't help, add the folder to `PATH`. |
| `port is already allocated` | Something else is using port 8080. In `docker-compose.yml`, change `"8080:80"` to a free port such as `"8081:80"`, then open that port instead. |
| Blank page at `Login.php` | This file only processes the login form. The pages for reviews, consoles, games and articles send you here when you aren't logged in. Go to <http://localhost:8080/Login> instead. |
| "Not Found" after clicking **Esci** on an article | The link points to `Logout.php`, but the file is `Logut.php`. Go back to `Home.php` and log out from there. |
| "Not Found" after clicking **Video Giochi** on the reviews page | The link points to `VideoGiochi.php`, but the file is `Video_Giochi.php`. Use the link on any other page. |
| Reviews disappear | This is expected: reviews are kept only in the login session, so they are lost when you log out. |
