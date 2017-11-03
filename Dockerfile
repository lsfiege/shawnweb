FROM ubuntu:16.04

LABEL maintainer="lsfiege@gmail.com"

ENV DEBIAN_FRONTEND noninteractive
ENV LC_ALL          C.UTF-8

RUN apt-get update && \
    apt-get -y dist-upgrade

#Instalar dependencias
RUN apt-get update && apt-get -y upgrade && apt-get -y install cmake \
    cmake-curses-gui \
    libcairo-ocaml-dev \
    libboost-regex1.58-dev \
    libboost-thread1.58-dev \
    libboost-system1.58-dev \
    liblablgl-ocaml-dev \
    libstdc++6 \
    strace \
    libcgal-dev
    
# Install apache, PHP, and supplimentary programs. openssh-server, curl, and lynx-cur are for debugging the container.
RUN apt-get -y install \
    apache2 php php-mysql php-pgsql libapache2-mod-php curl lynx-cur postgresql-client postgresql-client-common
    
# Enable apache mods.
RUN a2enmod php7.0
RUN a2enmod rewrite

# Update the PHP.ini file, enable <? ?> tags and quieten logging.
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/7.0/apache2/php.ini

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
EXPOSE 80
EXPOSE 5432

# Update the default apache site with the config we created.
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# By default start up apache in the foreground, override with /bin/bash for interative.
CMD /usr/sbin/apache2ctl -D FOREGROUND
