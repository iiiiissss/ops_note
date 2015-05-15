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