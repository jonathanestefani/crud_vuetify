composer install
php artisan migrate --force
/usr/local/sbin/php-fpm -F -O
tail -f /dev/null