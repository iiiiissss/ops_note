# wget http://repo.zabbix.com/zabbix/3.0/ubuntu/pool/main/z/zabbix-release/zabbix-release_3.0-1+trusty_all.deb
# dpkg -i zabbix-release_3.0-1+trusty_all.deb
# apt-get update
apt-get install zabbix-server-mysql zabbix-frontend-php

# cd /usr/share/doc/zabbix-server-mysql
# zcat create.sql.gz | mysql -uroot zabbix
Starting Zabbix server process

Edit database configuration in zabbix_server.conf

# vi /etc/zabbix/zabbix_server.conf
DBHost=localhost
DBName=zabbix
DBUser=zabbix
DBPassword=zabbix


service zabbix-server start


 /etc/apache2/conf.d/zabbix or /etc/apache2/conf-enabled/zabbix.conf. Some PHP settings are already configured.

php_value max_execution_time 300
php_value memory_limit 128M
php_value post_max_size 16M
php_value upload_max_filesize 2M
php_value max_input_time 300
php_value always_populate_raw_post_data -1
# php_value date.timezone Europe/Riga

service apache2 restart
 
客户端
# apt-get install zabbix-agent

/etc/zabbix/zabbix_agentd.conf
Server=serverip
 
apache2 port  servername 

192.168.1.202  82


