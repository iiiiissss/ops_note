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