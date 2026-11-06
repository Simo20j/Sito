FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql

COPY docker/apache.conf /etc/apache2/conf-enabled/sito.conf
