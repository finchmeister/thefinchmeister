FROM php:7.1-fpm-alpine

RUN apk add --no-cache --virtual .persistent-deps \
		git \
		icu-libs \
		zlib

ENV APCU_VERSION 5.1.8

RUN set -xe \
	&& apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		zlib-dev \
		libxml2-dev \
	&& docker-php-ext-install \
		intl \
		pdo_mysql \
		zip \
		soap \
	&& pecl install \
		apcu-${APCU_VERSION} \
	&& docker-php-ext-enable --ini-name 20-apcu.ini apcu \
	&& docker-php-ext-enable --ini-name 05-opcache.ini opcache \
	&& apk del .build-deps

COPY docker/php/php.ini /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1

# Run composer installs in parallel
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative \
	&& composer clear-cache

WORKDIR /var/www/thefinchmeister

COPY composer.json ./
COPY composer.lock ./

RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest

COPY app app/
COPY bin bin/
COPY src src/
COPY web web/

RUN composer dump-autoload --optimize --classmap-authoritative --no-dev