FROM php:8.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer \
    TZ=Asia/Tokyo

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install git unzip libzip-dev libicu-dev libonig-dev libjpeg62-turbo-dev libpng-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    mkdir /var/run/php-fpm && \
    docker-php-ext-configure gd --with-jpeg &&\
    docker-php-ext-install intl pdo_mysql zip bcmath gd && \
    composer config -g process-timeout 3600 && \
    composer config -g repos.packagist composer https://packagist.org

COPY ./infra/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./infra/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /work