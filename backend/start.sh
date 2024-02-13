composer install
php artisan migrate --force
php artisan db:seed
/usr/local/sbin/php-fpm -F -O
tail -f /dev/null