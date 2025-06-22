# 1) Build stage: cài Composer và dependencies
FROM php:7.4-fpm-alpine AS builder

# Cài các extension cần thiết
RUN apk add --no-cache \
      git \
      unzip \
      libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

WORKDIR /var/www/html

# 2) Runtime stage
FROM php:7.4-fpm-alpine

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
