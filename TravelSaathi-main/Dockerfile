# Use official PHP image with Apache
FROM php:8.2-apache

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite (useful for frameworks like Laravel)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files into container
COPY . /var/www/html/

# Expose port (Render will map this automatically)
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
