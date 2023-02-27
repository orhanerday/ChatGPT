FROM php:8.1

WORKDIR /home/php/app

COPY . .

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_sqlite zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer update
CMD php -S 0.0.0.0:8000 -t .
EXPOSE 8000