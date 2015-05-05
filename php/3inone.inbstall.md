**mysql**
sudo apt-get install mysql-server mysql-client

#密码输入帐号密码

**nginx**
apt-get install nginx
/etc/init.d/nginx start   / reload

#document root /usr/share/nginx/html   localhost可以访问
#vi /etc/nginx/nginx.conf  vi /etc/nginx/sites-available/default
error_log /var/log/nginx/error.log;

location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_index index.php;
                include fastcgi_params;
        }


**php**
sudo apt-get install php5-fpm php5-cli php5-mysql
#script /etc/init.d/php5-fpm that runs a FastCGI server on port 9000
#/etc/init.d/php5-fpm reload

apt-get install php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl

**PHP-FPM Use A Unix Socket**
vi /etc/php5/fpm/pool.d/www.conf
;listen = 127.0.0.1:9000
listen = /var/run/php5-fpm.sock   #/tmp/php5-fpm.sock  

vi /etc/nginx/sites-available/default
location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass unix:/var/run/php5-fpm.sock;
                fastcgi_index index.php;
                include fastcgi_params;
        }