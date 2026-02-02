FROM php:8.2-apache

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libpq-dev \
        default-mysql-client && \
    docker-php-ext-install pdo pdo_mysql && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module (optional)
RUN a2enmod rewrite