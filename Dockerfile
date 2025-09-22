Use an official PHP image as the base
FROM php:8.2-apache

Install the PostgreSQL client libraries
'libpq-dev' contains the development files needed for the 'pdo_pgsql' extension
RUN apt-get update && apt-get install -y libpq-dev 

&& docker-php-ext-install pdo pdo_pgsql pgsql

Copy the source code into the container's web root
COPY . /var/www/html/

Enable the required Apache module for URL rewriting
RUN a2enmod rewrite

Expose port 80 to the outside world
EXPOSE 80
