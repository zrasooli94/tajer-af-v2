# Use FrankenPHP — a modern PHP application server
FROM dunglas/frankenphp:1-php8.4

# Install system dependencies for Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions Laravel needs
RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    opcache

# Install Node.js 20 for building frontend assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer (PHP package manager)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy composer files first (for better Docker layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts --prefer-dist

# Copy package files for Node
COPY package.json package-lock.json* ./

# Install Node dependencies
RUN npm ci

# Copy the rest of the application
COPY . .

# Build frontend assets (Vite -> public/build)
RUN npm run build

# Run composer scripts now that all files are present
RUN composer dump-autoload --optimize

# Set proper permissions for Laravel
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Set the document root for FrankenPHP
ENV SERVER_NAME=":8000"
ENV APP_RUNTIME="frankenphp"

# Expose the port
EXPOSE 8000

# Start command: run migrations, seed if empty, then start FrankenPHP
CMD sh -c "\
    php artisan config:clear || true && \
    php artisan cache:clear || true && \
    php artisan view:clear || true && \
    php artisan route:clear || true && \
    php artisan migrate --force --no-interaction && \
    php artisan db:seed --force --no-interaction 2>&1 || true && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    frankenphp run --config /app/Caddyfile"