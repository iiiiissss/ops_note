show variables like '%time_zone%';

Variable_name	Value
system_time_zone	
time_zone	SYSTEM


my.cnf
�� [mysqld] ֮�¼�
default-time-zone=timezone
���޸�ʱ�����磺
default-time-zone = '+8:00'

php:date_default_timezone_set('Etc/GMT-8');