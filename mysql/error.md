SHOW FULL PROCESSLIST;


# mysql5.6版本以上，取消了参数log-slow-queries，更改为slow-query-log-file，切记！！
# 还需要加上 slow_query_log = on 否则，还是没用
#log-slow-queries = /home/db/madb/log/slow-query.log
slow_query_log = on
slow-query-log-file = /home/db/madb/log/slow-query.log
long_query_time = 1




Solution from Titanicx worked for me. Ran

dpkg -S etc/mysql
to see that mysql-common was the problem. Removed MySQL completely:
sudo apt-get remove --purge mysql-server mysql-client mysql-common
sudo apt-get autoremove
sudo apt-get autoclean

MySQL 5.6服务器初始化脚本添加了以下的插件表，而实际上MySQL 5.6不依赖于任何插件。

mysql> select * from mysql.plugin;
+-----------+-----------------+
| name      | dl              |
+-----------+-----------------+
| innodb    | ha_innodb.so    |
| federated | ha_federated.so |
| blackhole | ha_blackhole.so |
| archive   | ha_archive.so   |
+-----------+-----------------+
4 rows in set (0.00 sec)
解决它很简单，执行命令：

mysql> delete from mysql.plugin;
Query OK, 4 rows affected (0.00 sec)




 /usr/bin/mysqld_safe --defaults-file=/root/sqlbackup/mcboxback/my.cnf --user=mysql --datadir=/root/sqlbackup/mcboxback &
 
 
 
/usr/bin/mysqld_safe --defaults-file=/etc/mysql/my.conf --user=mysql --datadir=/var/lib/mysql &


/usr/bin/mysqld_safe --defaults-file=/tmp/my.conf --user=mysql --datadir=/root/sqlbackup/mcboxback &
/usr/sbin/mysqld
 apparmour
 
 
 
 http://blog.51yip.com/mysql/1005.html
 
 1，.frm保存的是描述了表的结构
2，.MYD保存的是表的数据记录
3，.MYI保存的是表的索引 
4，.opt保存的是数据库的字符集


CREATE DATABASE tmp; 
CREATE TABLE innodb (`id` int(11) NOT NULL) ) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
(拷贝.frm)
SHOW CREATE TABLE innodb \G;