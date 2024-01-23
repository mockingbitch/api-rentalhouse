FROM php:8.2-fpm
WORKDIR "/var/www/html"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y --no-install-recommends apt-utils

# Update packages & Install Git and Supervisor
RUN apt-get update -y && \
    apt-get install -yq libzip-dev git supervisor unzip zip vim curl  \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Swoole extension
RUN pecl install swoole
RUN docker-php-ext-enable swoole
RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install pcntl;

## Install Nodejs
#RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
#RUN apt-get install -y nodejs
#RUN apt-get install -y npm
RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
## Added supervisor config
COPY supervisord.conf /etc/supervisor/conf.d/supervisor.conf
CMD ["/usr/bin/supervisord"]
EXPOSE 8000