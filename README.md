# RetroGaming.it

A retro video game blog built with Laravel. Users register and log in, then can read articles, browse console and game timelines, leave reviews and play Snake.

The whole site runs in Docker, so you don't need to install PHP, Composer, a web server or a database. To install those yourself instead, see [Running without Docker](docs/local-setup.md).

## Get started with Docker

1. Install [Docker Desktop](https://www.docker.com/products/docker-desktop/) and start it.
2. From the project folder, run:

   ```
   docker compose up -d --build
   ```

3. Open <http://localhost:8080>.
4. The first time, follow the link to register (the password needs at least 6 characters), then log in. You will land on the home page.

The first launch takes a few minutes, and the page won't load until it's finished: Docker downloads what it needs, then the site installs its dependencies and fills the database. You can follow this with `docker compose logs -f web`. Later launches take a few seconds, and you can leave out `--build`.

## Everyday commands

| Task | Command |
| --- | --- |
| Start the site | `docker compose up -d` |
| Stop the site (keeps your data) | `docker compose down` |
| Stop the site and delete all data | `docker compose down -v` |
| See the logs | `docker compose logs -f web` |
| Run the tests | `docker compose exec web php artisan test` |
| Run any Artisan command | `docker compose exec web php artisan <command>` |

Changes to the site's files appear as soon as you reload the page, with no restart. If you change `Dockerfile` or anything in `docker/`, run `docker compose up -d --build`.

## How it's set up

- **`web`** runs PHP 8.4 with Apache on port 8080. On every start it installs dependencies, creates `.env` if it's missing, and applies database migrations.
- **`db`** runs MariaDB, a MySQL-compatible database, and keeps its data in a Docker volume. The site's content is added the first time the database is empty.

The database has an empty root password. This is fine for local use because the database can't be reached from outside Docker, but don't deploy this setup to a public server.

## Troubleshooting

| Problem | Cause and fix |
| --- | --- |
| `failed to connect to the docker API` | Docker Desktop isn't running. Start it and try again. |
| `docker-credential-desktop: executable file not found` | Docker's `resources\bin` folder isn't on your `PATH`. Restart your terminal; if that doesn't help, add the folder to `PATH`. |
| `port is already allocated` | Something else is using port 8080. In `docker-compose.yml`, change `"8080:80"` to a free port such as `"8081:80"`, then open that port instead. |
| The page doesn't load right after starting | The first launch is still running. Check progress with `docker compose logs -f web`. |
| "419 Page Expired" | The form was open too long or you logged out in another tab. Reload the page and try again. |
