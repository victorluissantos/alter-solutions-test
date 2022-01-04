FROM php:7.2.19-fpm-alpine3.9
RUN apk update
RUN docker-php-ext-configure mysqli --with-mysqli && docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-configure pdo --with-pdo && docker-php-ext-install pdo && docker-php-ext-enable pdo
RUN docker-php-ext-configure pdo_mysql --with-pdo_mysql && docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN apk add icu-dev && docker-php-ext-configure intl --with-intl && docker-php-ext-install intl && docker-php-ext-enable intl

COPY php.ini /usr/local/etc/php/php.ini 

RUN chmod 777 -R /var/www/html

RUN apk update and apk add
RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN apk add composer