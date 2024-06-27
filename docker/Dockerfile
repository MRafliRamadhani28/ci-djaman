# Stage 1: Build CodeIgniter
FROM php:8.1-fpm AS php

# Install dependensi yang diperlukan oleh CodeIgniter
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli pdo pdo_mysql \
    && php -m \
    && php -r "print_r(get_loaded_extensions());"

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/application

# Copy CodeIgniter project
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Stage 2: Setup Nginx
FROM nginx:latest

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx/snippets/ /etc/nginx/snippets/

# Copy built CodeIgniter from previous stage
COPY --from=php /var/www/html /var/www/html
