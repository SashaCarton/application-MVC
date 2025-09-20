# Utiliser une image PHP avec Apache
FROM php:8.2-apache

# Activer mod_rewrite et autres modules nécessaires
RUN a2enmod rewrite
RUN a2enmod headers

# Installer des extensions PHP si nécessaire
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Configuration Apache pour permettre les .htaccess
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copier les fichiers de l'application
COPY . /var/www/html/

# Définir les permissions appropriées
RUN chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html/

# Exposer le port 80
EXPOSE 80

# Redémarrer Apache pour appliquer les changements
CMD ["apache2-foreground"]