
php:  service php5-fpm reload/status/start/stop
nginx: service nginx  configtest/start/stop/reload



INT, TERM 立刻终止
QUIT 平滑终止
USR1 重新打开日志文件
USR2 平滑重载所有worker进程并重新载入配置和二进制模块

示例：
php-fpm 关闭：
kill -INT `cat /var/run/php5-fpm.pid`
php-fpm 重启：
kill -USR2 `cat /var/run/php5-fpm.pid`

查看php-fpm进程数：

ps aux | grep -c php-fpm
ps aux | grep php-fpm

//多个进程
killall php5-fpm

pkill -f php-fpm
ps -ef|grep php-fpm|grep -v grep|cut -c 9-15|xargs kill -9
ps aux |grep php-fpm|grep -v auto|awk '{print $2}'|xargs kill -9
