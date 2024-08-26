# Use the official PHP 8.1.1 image with Apache as the base image
FROM php:8.1.1-apache

# Install Docker dependencies
RUN apt-get update && \
    apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common

# Add Docker's official GPG key
RUN curl -fsSL https://download.docker.com/linux/debian/gpg | apt-key add -

# Set up the stable repository
RUN add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/debian \
   $(lsb_release -cs) \
   stable"

# Install Docker
RUN apt-get update && apt-get install -y docker-ce docker-ce-cli containerd.io

# Install docker-compose
RUN curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
RUN chmod +x /usr/local/bin/docker-compose

# Copy the application code into the container
COPY . /var/www/html/

# Set the working directory to the web root
WORKDIR /var/www/html

# Enable Apache mod_rewrite module (if necessary)
RUN a2enmod rewrite

# Set the appropriate file permissions (optional, adjust as needed)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy the entrypoint script into the container
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose port 80 and 443
EXPOSE 80 443

# Run the entrypoint script
ENTRYPOINT ["/entrypoint.sh"]