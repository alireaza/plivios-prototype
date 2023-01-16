FROM alireaza/php-fpm:8.2.0

USER root

RUN apk --no-cache --virtual .pdo_pgsql add --update postgresql-dev \
&& apk --no-cache add postgresql-libs \
&& NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
&& docker-php-ext-install -j${NPROC} pdo pdo_pgsql pgsql \
&& apk del .pdo_pgsql

RUN apk --no-cache --virtual .redis add --update autoconf build-base \
&& pecl install redis && docker-php-ext-enable redis \
&& apk del .redis

RUN apk --no-cache --virtual .supervisord add --update \
&& apk --no-cache add supervisor \
&& touch /etc/supervisord.conf \
&& echo "[supervisord]" >> /etc/supervisord.conf \
&& echo "nodaemon=true" >> /etc/supervisord.conf \
&& apk del .supervisord

USER $UNAME

ENTRYPOINT ["/bin/sh", "-c", "php-fpm & supervisord --configuration /etc/supervisord.conf"]
