FROM php:7.3-fpm-alpine
RUN apk add --no-cache --update --virtual buildDeps autoconf curl
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev \
    libmcrypt-dev perl bc \
    imagemagick-dev alpine-sdk libtool make g++ icu-dev
RUN docker-php-ext-install opcache pdo_pgsql bcmath sockets intl \
        && docker-php-ext-enable sockets intl
RUN pecl install imagick \
    	&& docker-php-ext-enable imagick
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

WORKDIR /var/www/vhosts

RUN curl -s https://getcomposer.org/installer | php \
  && alias composer='php composer.phar'

CMD ["php-fpm"]