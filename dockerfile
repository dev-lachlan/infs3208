FROM php:8.2-fpm

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    nodejs \
    npm \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN rm -rf /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini

COPY . /var/www/html
COPY ./local.ini /usr/local/etc/php/conf.d/local.ini
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --working-dir="/var/www/html"

RUN npm install
RUN npm run build

RUN php artisan key:generate --force
# RUN php artisan migrate --force
RUN php artisan up

WORKDIR /var/www/html/public

EXPOSE 9000

CMD ["php-fpm"]
