FROM php:7.3-fpm

RUN docker-php-ext-install pdo_mysql

RUN apt-get update
RUN apt-get install libssl-dev pkg-config -y

RUN pecl install -o -f mongodb \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable mongodb
