# execute the following command
# docker image build -t annurschule/gibbon:php7.4 .
# docker-compose up
# open localhost:8081

FROM php:7.4.32-apache

RUN apt-get update && apt-get -y upgrade && \
    apt-get install -y libzip-dev zip gettext-base default-mysql-client libpng-dev locales libicu-dev
 
RUN docker-php-ext-install zip pdo_mysql gettext gd
RUN docker-php-ext-install intl
RUN docker-php-ext-enable intl
RUN locale-gen de_DE.UTF-8
RUN echo "de_DE.UTF-8 UTF-8\nar_SA.UTF-8 UTF-8\nen_GB.UTF-8 UTF-8" >> /etc/locale.gen && locale-gen


RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN printf "; Gibbon Parameters\nextension=intl\nexpose_php=Off\nupload_max_filesize = 20M\npost_max_size = 20M\nmemory_limit = 512M\nmax_input_vars=5000\nregister_globals = off\nmax_file_uploads=30\nerror_reporting = E_ALL & ~E_NOTICE\nallow_url_fopen=On" >> "$PHP_INI_DIR/php.ini"

RUN chmod -Rv 755 /var/www/html/ 

COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod ssl && a2enmod rewrite
RUN echo 'root:Rsfoot!1&%^243598vdhosd' | chpasswd

EXPOSE 80
EXPOSE 3306
