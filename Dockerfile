# Use official PHP image with PostgreSQL support
FROM php:8.2-cli

# Install PostgreSQL PDO extension
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy app files
WORKDIR /app
COPY . .

# Expose Render's port
EXPOSE 10000

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:10000", "marks.php"]
