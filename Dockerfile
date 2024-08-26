# Use the official PHP 8.1.1 image with Apache as the base image
FROM php:8.1.1-apache

# Install additional PHP extensions if needed
# Uncomment and add any other necessary extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy the application code into the container
COPY . /var/www/html/

# Set the working directory to the web root
WORKDIR /var/www/html

# Enable Apache mod_rewrite module (if necessary)
RUN a2enmod rewrite

# Set the appropriate file permissions (optional, adjust as needed)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN chmod +x start.sh

# Expose port 80 and 443 (these are already exposed by default in your docker-compose.yml)
EXPOSE 80
EXPOSE 443

# Restart Apache to apply changes (optional)
CMD ["apache2-foreground"]
CMD ["/start.sh"]