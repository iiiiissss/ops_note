SHOW FULL PROCESSLIST;


# mysql5.6�汾���ϣ�ȡ���˲���log-slow-queries������Ϊslow-query-log-file���мǣ���
# ����Ҫ���� slow_query_log = on ���򣬻���û��
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

MySQL 5.6��������ʼ���ű���������µĲ������ʵ����MySQL 5.6���������κβ����

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
������ܼ򵥣�ִ�����

mysql> delete from mysql.plugin;
Query OK, 4 rows affected (0.00 sec)




 /usr/bin/mysqld_safe --defaults-file=/root/sqlbackup/mcboxback/my.cnf --user=mysql --datadir=/root/sqlbackup/mcboxback &
 
 
 
/usr/bin/mysqld_safe --defaults-file=/etc/mysql/my.conf --user=mysql --datadir=/var/lib/mysql &


/usr/bin/mysqld_safe --defaults-file=/tmp/my.conf --user=mysql --datadir=/root/sqlbackup/mcboxback &
/usr/sbin/mysqld
 apparmour
 
 
 
 http://blog.51yip.com/mysql/1005.html
 
 1��.frm������������˱�Ľṹ
2��.MYD������Ǳ�����ݼ�¼
3��.MYI������Ǳ������ 
4��.opt����������ݿ���ַ���


CREATE DATABASE tmp; 
CREATE TABLE innodb (`id` int(11) NOT NULL) ) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
(����.frm)
SHOW CREATE TABLE innodb \G;