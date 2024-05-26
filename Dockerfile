FROM 123rosyid123/voas:v1.20

RUN mkdir -p /app
COPY . /app
# COPY ./src /app

COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# install zip
# Install PHP zip extension
RUN apk add --no-cache zlib-dev libzip-dev \
    && docker-php-ext-install zip

RUN cd /app/src && \
    /usr/local/bin/composer update && \
    /usr/local/bin/composer install --no-dev && \
    npm install && \
    npm run build

RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh