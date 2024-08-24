FROM openswoole/swoole:4.12.1-php8.2
ARG UID
ARG GID
ENV UID $UID
ENV GID $GID

RUN apt-get update && apt-get install --no-install-recommends -y \
        wget \
        vim \
        git \
        unzip \
        libzip-dev \
        coreutils \
        make \
        curl \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        zlib1g-dev \
        libicu-dev \
        g++ \
        unixodbc-dev \
        openssh-client \
        libxml2-dev \
        libaio-dev \
        libmemcached-dev \
        freetds-dev \
        libssl-dev \
        wkhtmltopdf \
        openssl 

RUN echo "$(curl -sS https://composer.github.io/installer.sig) -" > composer-setup.php.sig \
        && curl -sS https://getcomposer.org/installer | tee composer-setup.php | sha384sum -c composer-setup.php.sig \
        && php composer-setup.php && rm composer-setup.php* \
        && chmod +x composer.phar && mv composer.phar /usr/bin/composer
RUN docker-php-ext-install \
            iconv \
            intl \
            gd \
            mysqli \
            pdo_mysql
COPY ./docker/php/symfony.ini /usr/local/etc/php/conf.d
COPY ./docker/php/symfony.ini /etc/php/cli/conf.d/


RUN groupadd -o -g ${GID} appuser
RUN useradd -r -u  ${UID} -g appuser appuser
USER appuser

WORKDIR /var/www/symfony
ENTRYPOINT ["php", "-S", "0.0.0.0:8081", "-t", "./public"]
EXPOSE 8081