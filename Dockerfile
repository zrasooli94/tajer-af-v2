FROM dunglas/frankenphp:1-php8.3

# Install dependencies
RUN install-php-extensions pdo_mysql gd zip bcmath opcache intl

# Install Node.js
RUN apt-get update && apt-get install -y curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm ci && npm run build

# Set proper permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Cache Laravel configs
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Configure FrankenPHP to serve Laravel
ENV SERVER_NAME=":8000"
ENV APP_RUNTIME="frankenphp"

# Expose port
EXPOSE 8000

# Start command: migrate + seed + start server
CMD php artisan migrate --force --no-interaction && \
    php artisan db:seed --force --no-interaction 2>/dev/null || true && \
    frankenphp run --config /etc/Caddyfile