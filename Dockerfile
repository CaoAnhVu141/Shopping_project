# Sử dụng PHP-FPM image phiên bản nhẹ hơn
FROM php:8.2-fpm-alpine

# Cài đặt các tiện ích cần thiết
RUN apk update && apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    zip \
    unzip \
    git \
    curl \
    && apk del --purge gcc musl-dev make

# Cài đặt các tiện ích mở rộng cho PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Cài Composer từ image chính thức của Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc là /var/www
WORKDIR /var/www

# Sao chép composer.json và composer.lock trước để cache phụ thuộc Composer
COPY composer.json composer.lock ./

# Chạy lệnh cài đặt Composer với tối ưu hóa
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && rm -rf /root/.composer/cache

# Sao chép mã nguồn vào container
COPY . .

# Cấp quyền cho thư mục lưu trữ và bộ nhớ cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Cấu hình Opcache cho PHP
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Chạy PHP-FPM
CMD ["php-fpm"]
