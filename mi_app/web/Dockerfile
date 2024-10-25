# FROM php:8.2-apache
# RUN apt

FROM php:8.2-apache
# son para apache 
RUN a2enmod rewrite
COPY index.php /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]