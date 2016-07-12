ps -ef|grep php-fpm|grep -v grep|cut -c 9-15|xargs kill -9

 ps aux | grep defunct|wc -l