FROM amazonlinux:2

RUN yum -y update
RUN yum -y upgrade
RUN yum -y install curl
RUN yum -y install git

# Install PHP v8.2
RUN amazon-linux-extras enable php8.2
RUN yum clean metadata
RUN yum -y install php php-{fpm,cli,pear,cgi,common,curl,mbstring,gd,mysqlnd,gettext,bcmath,json,xml,intl,zip,mysqli,pdo,pgsql,sodium}
RUN yum -y install procps

# Install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN ln -s /usr/local/bin/composer /usr/bin/composer

# Install unzip
RUN yum -y install unzip

# Install Set LANG, Timezone
ENV TZ America/Mexico_City

WORKDIR /var/www/html