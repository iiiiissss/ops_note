apt-get install php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode  php5-sqlite php5-tidy php5-xmlrpc php5-xsl

// apt-get remove php5-snmp
**常用管理**
sudo nginx -t     sudo service nginx reload  
sudo service php5-fpm restart
mysqld
**mysql**
sudo apt-get install mysql-server mysql-client

#密码输入帐号密码 (dos2unix file.sh)

**nginx** sudo nginx -t     sudo service nginx reload  
apt-get install nginx
sudo /etc/init.d/nginx reload    #start 
sudo service nginx reload
#document root /usr/share/nginx/html   localhost可以访问
#vi /etc/nginx/nginx.conf  vi /etc/nginx/sites-available/default
error_log /var/log/nginx/error.log;
(sudo /etc/init.d/nginx configtest)

location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_index index.php;
                include fastcgi_params;
        }


**php**  sudo service php5-fpm restart
sudo apt-get install php5-fpm php5-cli php5-mysql
#script /etc/init.d/php5-fpm that runs a FastCGI server on port 9000
#sudo /etc/init.d/php5-fpm reload
kill/reload

sudo service php5-fpm stop   #status  start

pid=/var/run/php5-fpm.pid
kill -INT `cat /var/run/php5-fpm.pid`
kill -USR2 `cat /var/run/php5-fpm.pid`

x
查看模块: php -m|grep openssl

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

[xdebug]
xdebug.default_enable=on;显示默认的错误信息
xdebug.collect_params = 1;打开收集“函数参数”的功能。将函数调用的参数值列入函数过程调用的监测信息中。此配置项的默认值为off。
xdebug.profiler_enable=on    ;打开效能监测器
xdebug.auto_trace=on
xdebug.profiler_output_dir="C:\phpStudy\tmp\xdebug"
xdebug.trace_output_dir="C:\phpStudy\tmp\xdebug"
;zend_extension="C:\phpStudy\php\php-5.6.27-nts\ext\php_xdebug.dll"

慢:
short_open_tag
file_get_content
dns

telnet