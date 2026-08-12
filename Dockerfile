FROM php:8.2-apache

# Variables d'environnement
ARG APP_VERSION=v0.0.0
ENV APP_VERSION=${APP_VERSION}

# Activation du module rewrite et bascule sur le port 8080 (accessible en non-root)
RUN a2enmod rewrite \
    && sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf

# Copie de la configuration Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copie du code avec attribution des droits
COPY --chown=www-data:www-data . /var/www/html/

# Sonde de santé
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:8080/ || exit 1

# Sécurité
EXPOSE 8080
USER www-data