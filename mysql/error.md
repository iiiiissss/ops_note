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