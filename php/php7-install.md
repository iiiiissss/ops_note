add-apt-repository ppa:ondrej/php
apt-get update
apt-get install php7.0 php7.0-mysql php7.0-fpm php7.0-mbstring php7.0-curl php7.0-gd php7.0-opcache


https://www.digitalocean.com/community/tutorials/how-to-upgrade-to-php-7-on-ubuntu-14-04
https://www.digitalocean.com/community/tutorials/how-to-install-the-latest-version-of-nginx-on-ubuntu-12-10


when composer install

mbstring
- sudo apt-get install php7.0-mbstring

phpunit/phpunit 4.8.22 requires ext-dom * -> the requested PHP extension dom is missing from your system.
- sudo apt-get install php7.0-xml




redis:
( https://anton.logvinenko.name/en/blog/how-to-install-redis-and-redis-php-client.html )
apt-get install php7.0-dev
Download PhpRedis
cd /tmp && wget https://github.com/phpredis/phpredis/archive/php7.zip -O phpredis.zip
unzip -o /tmp/phpredis.zip && mv /tmp/phpredis-* /tmp/phpredis && cd /tmp/phpredis && phpize && ./configure && make && sudo make install

/usr/lib/php/20151012/
Add PhpRedis extension to PHP 7
sudo touch /etc/php/mods-available/redis.ini && echo extension=redis.so > /etc/php/mods-available/redis.ini
sudo ln -s /etc/php/mods-available/redis.ini /etc/php/7.0/apache2/conf.d/redis.ini
sudo ln -s /etc/php/mods-available/redis.ini /etc/php/7.0/fpm/conf.d/redis.ini
sudo ln -s /etc/php/mods-available/redis.ini /etc/php/7.0/cli/conf.d/redis.ini