FROM php:8.2

RUN apt update && apt install -y \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    default-mysql-client \
 && docker-php-ext-install pdo_mysql

WORKDIR /app
