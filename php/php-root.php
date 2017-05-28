php-root

//多个进程
killall php5-fpm

pkill -f php-fpm
ps -ef|grep php-fpm|grep -v grep|cut -c 9-15|xargs kill -9
ps aux |grep php-fpm|grep -v auto|awk '{print $2}'|xargs kill -9


pool.d/www.conf
user = root
group = root
listen.owner = root
listen.group = root

php5-fpm -R


