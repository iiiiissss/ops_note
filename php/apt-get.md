
php:
sudo apt-get install php5-fpm php5-cli php5-mysql php5-redis php5-curl php5-mcrypt php5-gd
sudo php5enmod mcrypt
sudo service php5-fpm restart

php框架:
sudo apt-get install software-properties-common
sudo apt-add-repository ppa:phalcon/stable
sudo apt-get update
sudo apt-get install php5-phalcon

php:  service php5-fpm reload/status/start/stop
nginx: service nginx  configtest/start/stop/reload


php5-fpm -t 看配置
强制用root 启动:  php5-fpm -R

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
