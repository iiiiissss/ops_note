
php:  service php5-fpm reload/status/start/stop
nginx: service nginx  configtest/start/stop/reload



INT, TERM ������ֹ
QUIT ƽ����ֹ
USR1 ���´���־�ļ�
USR2 ƽ����������worker���̲������������úͶ�����ģ��

ʾ����
php-fpm �رգ�
kill -INT `cat /var/run/php5-fpm.pid`
php-fpm ������
kill -USR2 `cat /var/run/php5-fpm.pid`

�鿴php-fpm��������

ps aux | grep -c php-fpm
ps aux | grep php-fpm

//�������
killall php5-fpm

pkill -f php-fpm
ps -ef|grep php-fpm|grep -v grep|cut -c 9-15|xargs kill -9
ps aux |grep php-fpm|grep -v auto|awk '{print $2}'|xargs kill -9
