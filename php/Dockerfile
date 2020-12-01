FROM php:7.4-fpm

RUN apt update

# compression
RUN apt install -y libbz2-dev zlib1g-dev libzip-dev \
  && docker-php-ext-install zip bz2

# database
RUN apt install -y libicu-dev mariadb-client
RUN docker-php-ext-configure intl
RUN docker-php-ext-install mysqli pdo pdo_mysql intl

# PHP ini
#RUN echo "memory_limit = 2G" >> /usr/local/etc/php/conf.d/docker-php-ext.ini

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
USER www

WORKDIR /var/www/html