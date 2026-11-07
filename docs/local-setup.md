# Running without Docker

This guide runs RetroGaming.it directly on your computer. If you just want the site running, [Docker](../README.md) is quicker because it needs only one install.

## What you need

| Software | Version | Purpose |
| --- | --- | --- |
| PHP | 8.4.1 or newer | Runs the site |
| PHP extensions | `curl`, `fileinfo`, `mbstring`, `openssl`, `pdo_mysql`, `pdo_sqlite`, `zip` | Needed by Laravel, the database and the tests |
| Composer | 2.x | Installs the site's dependencies |
| MariaDB or MySQL | MariaDB 11 is the tested version | Stores accounts and content |

You don't need Node.js, Apache or nginx.

## 1. Install the requirements

### Windows

**PHP**

1. Go to <https://windows.php.net/download/> and download the **VS17 x64 Thread Safe** zip of PHP 8.4 or 8.5.
2. Extract it to a folder such as `C:\php`. Check that the folder contains `php.exe` and an `ext` folder.
3. In that folder, make a copy of `php.ini-development` and name it `php.ini`.
4. Open `php.ini` in a text editor. Find these lines and remove the `;` at the start of each one:

   ```ini
   extension_dir = "ext"
   extension=curl
   extension=fileinfo
   extension=mbstring
   extension=openssl
   extension=pdo_mysql
   extension=pdo_sqlite
   extension=zip
   ```

5. Add the folder to your `PATH`: open the Start menu, search for **Edit environment variables for your account**, select **Path**, then **Edit** > **New**, and enter `C:\php`.
6. Open a new terminal and check the result:

   ```
   php -v
   php -m
   ```

   `php -v` should show 8.4.1 or newer, and `php -m` should list all the extensions above with no warnings.

**Already have PHP installed?** Run `php --ini` and `php -m` to check it. If there's no `php.ini`, follow steps 3 and 4. If its folder has no `ext` folder, the install is incomplete and no extension can load: extract a fresh zip over it, then follow steps 3 and 4.

**Composer**

Download and run [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe). It finds your PHP and adds Composer to your `PATH`. Open a new terminal and check it with `composer --version`.

**MariaDB**

Download the MSI installer from <https://mariadb.org/download/> and run it. Choose a root password when asked and keep the option to install it as a service, so it starts by itself.

To run the commands in step 3, open **Command Prompt (MariaDB)** from the Start menu.

### macOS

With [Homebrew](https://brew.sh/) installed, run:

```
brew install php composer mariadb
brew services start mariadb
```

### Ubuntu or Debian

```
sudo apt update
sudo apt install php-cli php-curl php-mbstring php-mysql php-sqlite3 php-xml php-zip composer unzip mariadb-server
sudo systemctl enable --now mariadb
```

Then check your version with `php -v`. Ubuntu 24.04 includes PHP 8.3, which is too old, so you'll need PHP 8.4 from another source such as the [Ondřej Surý repository](https://launchpad.net/~ondrej/+archive/ubuntu/php).

## 2. Install the site's dependencies

From the project folder, run:

```
composer install
```

This creates a `vendor` folder with thousands of files. If the project is in a synced folder such as OneDrive, expect the sync to take a while.

## 3. Create the database

Open a database prompt:

- **Windows:** `mariadb -u root -p`, then enter the root password you chose.
- **macOS and Linux:** `sudo mariadb`

Then run these commands, replacing `choose-a-password` with a password of your own:

```sql
CREATE DATABASE utenti CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'retrogaming'@'%' IDENTIFIED BY 'choose-a-password';
GRANT ALL PRIVILEGES ON utenti.* TO 'retrogaming'@'%';
EXIT;
```

## 4. Configure the site

Create your settings file from the project folder:

- **Windows (PowerShell):** `Copy-Item .env.example .env`
- **macOS and Linux:** `cp .env.example .env`

Open `.env` and change these lines:

```ini
APP_URL=http://localhost:8000

DB_HOST=127.0.0.1
DB_USERNAME=retrogaming
DB_PASSWORD=choose-a-password
```

If you've already run the site with Docker, `.env` exists: edit it the same way. Docker needs `DB_HOST=db`, `DB_USERNAME=root` and an empty `DB_PASSWORD`, so put those back if you return to it.

Then generate the app key, and create the tables and content:

```
php artisan key:generate
php artisan migrate --seed
```

## 5. Start the site

```
php artisan serve
```

Open <http://localhost:8000>, then register an account and log in. The site runs until you press `Ctrl+C` in the terminal.

The next time, you only need `php artisan serve`, as long as the database service is running.

## Everyday commands

| Task | Command |
| --- | --- |
| Run the tests | `php artisan test` |
| Apply new database changes after pulling | `php artisan migrate` |
| Install new dependencies after pulling | `composer install` |
| Delete all data and start again | `php artisan migrate:fresh --seed` |

## Troubleshooting

| Problem | Cause and fix |
| --- | --- |
| `php` or `composer` isn't recognized | The folder isn't on your `PATH`, or the terminal was already open. Check `PATH`, then open a new terminal. |
| `Your Composer dependencies require a PHP version ">= 8.4.1"` | Your PHP is too old. Install PHP 8.4 or newer. |
| `... requires ext-mbstring` or a similar extension error | That extension is off. Remove the `;` from its line in `php.ini`; `php --ini` shows which file is in use. |
| `Unable to load dynamic library` | PHP can't find the `ext` folder. Set the full path in `php.ini`, such as `extension_dir = "C:\php\ext"`, and check that the folder exists. |
| `could not find driver` | `pdo_mysql` is off. Enable it in `php.ini`. |
| `Connection refused` or `No connection could be made` | The database isn't running. Start the MariaDB service. |
| `php_network_getaddresses` or `getaddrinfo for db failed` | `.env` still has `DB_HOST=db`. Change it to `127.0.0.1`. |
| `Access denied for user` | `DB_USERNAME` or `DB_PASSWORD` in `.env` doesn't match step 3. |
| `No application encryption key has been specified` | Run `php artisan key:generate`. |
| `Failed to listen on 127.0.0.1:8000` | Port 8000 is in use. Run `php artisan serve --port=8001` and open that port instead. |
