#!/bin/sh
set -e

PORT="${PORT:-10000}"

if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

if [ -n "${APP_KEY:-}" ]; then
    if grep -q '^APP_KEY=' .env 2>/dev/null; then
        sed -i "s#^APP_KEY=.*#APP_KEY=${APP_KEY}#" .env
    else
        printf '\nAPP_KEY=%s\n' "$APP_KEY" >> .env
    fi
fi

php artisan config:clear
php artisan route:clear
php artisan view:clear

exec php -S 0.0.0.0:"$PORT" -t public
