#!/bin/sh

sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

php-fpm -D

# while ! nc -w 1 -z 127.0.0.1 9000; do sleep 0.1; done;

nginx

# php artisan migrate:fresh --force
# php artisan db:seed --force

php artisan view:clear
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan optimize:clear
php artisan optimize
