FROM php:8.1-fpm-alpine

ADD php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

ADD src /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R laravel:laravel /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
