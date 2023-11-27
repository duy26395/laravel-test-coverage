FROM php:8.2-fpm

COPY . /var/www/html
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    git

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/html