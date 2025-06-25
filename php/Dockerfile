# 1) Build stage: cài Composer và dependencies
FROM php:7.4-fpm-alpine AS builder

# Cài các package dependencies
RUN apk add --no-cache \
      git \
      unzip \
      libzip-dev \
      bzip2-dev \
      libpng-dev \
      libjpeg-turbo-dev \
      freetype-dev \
      gettext-dev \
      libxslt-dev \
      icu-dev \
      libxml2-dev

# Cài các extension PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) \
        zip \
        pdo \
        pdo_mysql \
        mysqli \
        bz2 \
        calendar \
        exif \
        gd \
        gettext \
        sockets \
        xsl \
        bcmath \
        intl \
        opcache

WORKDIR /var/www/html

# 2) Runtime stage
FROM php:7.4-fpm-alpine

# Cài lại các package dependencies cho runtime
RUN apk add --no-cache \
      libzip \
      bzip2 \
      libpng \
      libjpeg-turbo \
      freetype \
      gettext \
      libxslt \
      icu-libs \
      libxml2

# Copy extension files từ builder stage
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Copy chỉ những gì cần thiết từ builder
COPY --from=builder /var/www/html /var/www/html

# Copy cấu hình php
COPY php.ini /usr/local/etc/php/php.ini

# Người dùng và quyền
RUN addgroup -g 1000 www \
  && adduser -D -u 1000 -G www www \
  && chown -R www:www /var/www/html

USER www

WORKDIR /var/www/html
