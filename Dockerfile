# Sử dụng image PHP-FPM với các tiện ích mở rộng
FROM php:8.2-fpm

# Cài đặt các tiện ích cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/*

# Cài đặt các tiện ích mở rộng cho PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc là /var/www
WORKDIR /var/www

# Sao chép tất cả các file vào container
COPY . .

# Chạy lệnh cài đặt Composer
RUN composer install

# Cấp quyền cho thư mục lưu trữ và bộ nhớ cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Chạy PHP-FPM
CMD ["php-fpm"]
