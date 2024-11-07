# Sử dụng image PHP-FPM phiên bản nhẹ hơn
FROM php:8.2-fpm-alpine

# Đặt biến môi trường để giảm độ tương tác khi chạy Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Cài đặt các tiện ích cần thiết trong một lệnh duy nhất để giảm số lượng layer
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql opcache \
    && rm -rf /var/cache/apk/*

# Cài Composer từ image chính thức của Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc là /var/www
WORKDIR /var/www

# Sao chép composer.json và composer.lock trước để cache layer phụ thuộc Composer
COPY composer.json composer.lock ./

# Cài đặt các phụ thuộc Composer với tối ưu hóa
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && rm -rf /root/.composer/cache

# Sao chép mã nguồn vào container
COPY . .

# Cấp quyền cho các thư mục lưu trữ và bộ nhớ cache (tạo một layer)
RUN chown -R www-data:www-data storage bootstrap/cache public

# Cấu hình Opcache để tăng hiệu suất PHP
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.memory_consumption=128"; \
    echo "opcache.interned_strings_buffer=8"; \
    echo "opcache.max_accelerated_files=10000"; \
    echo "opcache.revalidate_freq=0"; \
    echo "opcache.fast_shutdown=1"; \
    echo "opcache.validate_timestamps=0"; \
} > /usr/local/etc/php/conf.d/opcache.ini

# Chạy PHP-FPM
CMD ["php-fpm"]