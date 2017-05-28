apt-get update
apt-get install -y mysql-client-core-5.6 mysql-client-5.6 mysql-server-5.6

ps -ef | grep mysql 看运行
netstat -tap | grep mysql 看端口

service mysql stop / restart / start

mac:  mysql.server start

 /etc/mysql/my.cnf   去除 bind address

GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'youpassword' WITH GRANT OPTION;
FLUSH PRIVILEGES;


[mysqld]下追加:
character_set_server = utf8

show variables like '%time_zone%';

Variable_name	Value
system_time_zone	
time_zone	SYSTEM


my.cnf
在 [mysqld] 之下加
default-time-zone=timezone
来修改时区。如：
default-time-zone = '+8:00'

php:date_default_timezone_set('Etc/GMT-8');