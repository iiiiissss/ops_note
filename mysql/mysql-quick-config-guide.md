# MySQL Quick Config Guide


## Can't connect to local MySQL server through socket

Testing environment: OSX, MySQL install via MacPorts

Problem

    _mysql_exceptions.OperationalError: (2002, "Can't connect to local MySQL server through socket '/opt/local/var/run/mysql5/mysqld.sock' (2)")

Solutin:

A. delete /etc/my.cnf
B. update /etc/my.cnf, 

    socket = /tmp/mysql.sock

to
    socket = /opt/local/var/run/mysql5/mysqld.sock


## enable remote access

update /etc/mysql/my.cnf on Ubuntu

    $ grep bind  /etc/mysql/my.cnf 
    #bind-address		= 127.0.0.1
    bind-address		= 0.0.0.0

    $ sudo service mysql restart
			
on remote host

    $ mysql -u root -p
    mysql> GRANT USAGE ON *.* TO root@"%" IDENTIFIED BY "<password>";
    mysql> FLUSH PRIVILEGES; 


on local box
   
   $ mysql -h <remote-host> -u root -p 



##  missing my.cnf configuration file

安装通过官方下载的包，默认在 /etc 可能没有生成配置文件，复制一个

    sudo cp  /usr/local/mysql/support-files/my-huge.cnf  /etc/my.cnf


http://support.apple.com/kb/TA23907?viewlocale=en_US


## Fixing encoding, using  Unicode/UTF-8 


It expected `show variables like '%colla%';` output `utf8_unicode_ci`,
and expected `show variables like '%character%';` output `utf8`.

Ubuntu 12.04 MySQL configuration file path /etc/mysql/my.cnf

Fix it

append

    ...

    [mysqld]                                                                        
    ...
    init_connect='SET NAMES utf8'
    character-set-server = utf8
    collation-server = utf8_unicode_ci
    ...		  


into section [mysqld]


fix existed database

    ALTER DATABSE `lunacms` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


http://stackoverflow.com/questions/3513773/change-mysql-default-character-set-to-utf8-in-my-cnf


## slow log 

show config 

    show variables like '%slow%';

config it runtime

    set global log_slow_queries=1;
    set global slow_launch_time=1;
    set global slow_query_log=1;
    set global slow_query_log_file='/var/log/mysql/mysql-slow.log';


persistence config in my.cnf

    slow_launch_time=1
    slow_query_log=on
    slow_query_log_file=/usr/local/var/mysql/slow.log


