FROM php:8.1-fpm

# コピーする前にmbstring関連の設定を変更する
RUN set -eux; \
    echo 'mbstring.internal_encoding = UTF-8' >> /usr/local/etc/php/php.ini; \
    echo 'mbstring.func_overload = 0' >> /usr/local/etc/php/php.ini

COPY php.ini /usr/local/etc/php/

RUN apt update \
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

WORKDIR /var/www
