FROM php:8-fpm-alpine

ENV PHPUSER=laravel
ENV PHPGROUP=laravel

RUN adduser -g ${PHPGROUP} -s /bin/sh -D ${PHPUSER}

RUN sed -i "s/user = www-data/user = ${PHPUSER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = ${PHPGROUP}/g" /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /var/www/html/public

ADD ./php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

RUN docker-php-ext-install pdo pdo_mysql

# Install GD extension
RUN apk add --no-cache \
  libjpeg-turbo-dev \
  libpng-dev \
  libwebp-dev \
  freetype-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd

# Install exif extentsion
RUN docker-php-ext-install exif

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]