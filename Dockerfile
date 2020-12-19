FROM php:7.2-apache
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli
RUN apt-get update && docker-php-ext-install pdo_mysql