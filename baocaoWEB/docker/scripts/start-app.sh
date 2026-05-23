#!/bin/sh
set -e

if [ ! -f vendor/autoload.php ]; then
    composer install
fi

if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    php artisan key:generate --force
fi

php artisan config:clear

exec php-fpm
