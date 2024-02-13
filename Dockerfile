FROM php:8-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git unzip 

RUN docker-php-ext-install mysqli pdo pdo_mysql 

RUN docker-php-ext-configure mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
