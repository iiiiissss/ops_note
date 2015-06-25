Ö÷:
grant replication slave,file on *.* to 'replication'@'192.168.1.%' identified by 'yf*k|r57J=d';
flush privileges;

#slave #myedit
#server-id       =  21962
server-id       =  1002
log-bin=mysql-bin
auto_increment_increment=2
auto_increment_offset=1
#skip_slave_start

conf:


´Ó:
²âÊÔ: /usr/local/mysql/bin/mysql -u replication -h192.168.1.202 -P6301 -pyf*k|r57J=d
flush tables with read lock;
unlock tables;
stop slave;
change master to master_host='192.168.1.202',master_user='replication',master_port=6301,master_password='yf*k|r57J=d',master_log_file='mysql-bin.000001', master_log_pos=1;
start slave;