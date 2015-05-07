服务器A   192.168.1.108
服务器B   192.168.1.110
Mysql版本：5.1.26
System OS：CentOS release 5.4
 
二、主主配置过程
 1、创建同步用户：
服务器A：
grant replication slave,file on *.* to 'replication'@'192.168.1.110' identified by '123456';
flush privileges;
服务器B：
grant replication slave,file on *.* to 'replication'@'192.168.1.108' identified by '123456';
flush privileges;

参数选项说明：
log-slave-updates    将执行的复制sql记录到二进制日志
sync_binlog  当有二进制日志写入binlog文件的时候，mysql服务器将它同步到磁盘上
auto_increment_increment，auto_increment_offset 主要用于主主复制中，用来控制AUTO_INCREMENT列的操作

A：
log-bin=mysql-bin
server-id       = 1
binlog-do-db=test
binlog-ignore-db=mysql
replicate-do-db=test
replicate-ignore-db=mysql
log-slave-updates
sync_binlog=1
auto_increment_increment=2
auto_increment_offset=1
B：
log-bin=mysql-bin
server-id       = 2
binlog-do-db=test
binlog-ignore-db=mysql
replicate-do-db=test
replicate-ignore-db=mysql
log-slave-updates
sync_binlog=1
auto_increment_increment=2
auto_increment_offset=2

重启mysql服务后，进入mysql命令行，执行操作如下：
A:
mysql> flush tables with read lock;
mysql> show master status\G
*************************** 1. row ***************************
            File: mysql-bin.000028
            Position: 866
                   Binlog_Do_DB: test
Binlog_Ignore_DB: mysql
1 row in set (0.00 sec)
         mysql> unlock tables;
              mysql> stop slave;
mysql> change master to master_host='192.168.1.110',master_user='replication',master_password='123456',master_log_file='mysql-bin.000014', master_log_pos=704;
mysql> start slave;

			  
B：
mysql> flush tables with read lock;
mysql> show master status\G
*************************** 1. row ***************************
            File: mysql-bin.000014
            Position: 704
                   Binlog_Do_DB: test
Binlog_Ignore_DB: mysql
1 row in set (0.00 sec)
         mysql> unlock tables;
              mysql> stop slave;
mysql> change master to master_host='192.168.1.108',master_user='replication',master_password='123456',master_log_file='mysql-bin.000028', master_log_pos=866;
mysql> start slave;
 
4、查看各服务器的状态：
mysql> show slave status\G;
出现：Slave_IO_Running: Yes
Slave_SQL_Running: Yes
则状态正常，直接测试数据能否同步就OK了！
