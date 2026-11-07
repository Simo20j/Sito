#!/bin/sh
set -e

cd /var/www/html

[ -f .env ] || cp .env.example .env

composer install --no-interaction --no-progress

grep -q '^APP_KEY=base64:' .env || php artisan key:generate --force

php artisan migrate --force --seed

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
