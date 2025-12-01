FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy package files for npm
COPY package.json package-lock.json ./
RUN npm ci

# Copy application files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Build assets
RUN npm run build

# Run composer scripts
RUN composer dump-autoload --optimize

# Create storage link
RUN php artisan storage:link || true

# Expose port (Render uses dynamic ports)
EXPOSE 10000

# Start PHP development server (Render sets PORT env var)
CMD sh -c "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"

