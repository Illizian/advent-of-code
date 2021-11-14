FROM lorisleiva/laravel-docker:7.4

RUN apk add --no-cache autoconf

RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo -e "memory_limit = -1\nmax_input_time = -1\nmax_exection_time = -1" >> /usr/local/etc/php/conf.d/aoc.ini
RUN mkdir /.config && chmod 777 /.config

USER 1000:1000

EXPOSE 3000

ENTRYPOINT ["tail", "-f", "/dev/null"]
