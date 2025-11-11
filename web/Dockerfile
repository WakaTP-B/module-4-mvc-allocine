FROM php:8.2-apache

# Installer les extensions MySQL/PDO
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Activer mod_rewrite pour routes MVC
RUN a2enmod rewrite

# Copier le code PHP
COPY . /var/www/html/

EXPOSE 80
