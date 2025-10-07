# Dockerfile для Laravel + Node/Vite
FROM php:8.3-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    npm \
    libicu-dev \
    libzip-dev \
    g++ \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Установка Node.js (18.x LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get update && apt-get install -y nodejs && rm -rf /var/lib/apt/lists/*

# Установка расширения pdo_mysql, intl и zip
RUN docker-php-ext-install pdo_mysql intl zip

# Копирование кастомной конфигурации PHP
COPY php.ini /usr/local/etc/php/conf.d/uploads.ini

# Копирование файлов проекта
WORKDIR /var/www
COPY . .

# Установка зависимостей PHP и Node
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist && \
    npm install && \
    npm run build

# Настройка прав
RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
