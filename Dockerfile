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
    
# Instalar Apache, PHP, y programas complementarios. openssh-server, curl, y lynx-cur son para ofrecer opciones de debugging.
RUN apt-get -y install \
    apache2 php php-mysql php-pgsql php-zip libapache2-mod-php curl lynx-cur postgresql-client postgresql-client-common
    
# Habilitar modulos de apache.
RUN a2enmod php7.0
RUN a2enmod rewrite

# Actualizar el archivo php.ini, Habilitar las etiquetas cortas <? ?> y el logging.
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/7.0/apache2/php.ini

# Establecer variables de entorno de apache
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Exponer puerto de apache y adicionalmente el puerto por defecto de PostgreSQL aunque no esté instalado en el contenedor.
EXPOSE 80
EXPOSE 5432

# Actualizar la configuracion inicial de host de apache
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Iniciar apache por defecto en modo background, sobrescribiendo la directiva bash por defecto del contenedor.
CMD /usr/sbin/apache2ctl -D FOREGROUND
