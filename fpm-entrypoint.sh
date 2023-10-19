#!/bin/sh

php artisan key:generate --force
php artisan migrate --force

exec php-fpm