wget http://dev.mysql.com/get/Downloads/MySQL-5.6/mysql-5.6.35.tar.gz

����mysql�飺groupadd mysql
����mysql�û���useradd -g mysql mysql
����mysql�İ�װλ�ã�mkdir /usr/local/mysql
����mysql�����ļ��Ĵ��λ�ã�mkdir /usr/local/mysql/mysqldata


tar xvf mysql-5.6.35.tar.gz
cd mysql-5.6.35/
apt-get install cmake
apt-get install libncurses5-dev
cmake -DCMAKE_INSTALL_PREFIX=/usr/local/mysql

make && make install

chown -R mysql:mysql /usr/local/mysql/
/usr/local/mysql/scripts/mysql_install_db --user=mysql --basedir=/usr/local/mysql --datadir=/usr/local/mysql/data
cp support-files/my-default.cnf /etc/mysql/my.cnf(���Դ������ط�copyһ�ݹ���)

����Ϊ���밲װmysql

����Ϊ��װ��ʵ��:
mkdir /data/{3307,3308}/data

cp /etc/mysql/my.cnf /data/{3307,3308}/my.cnf(�޸�my.cnf�����ļ�)

touch mysql3307.err  (�������ļ��Ĵ�����־����Ҫ�Ƚ���,��Ȼ��������)
touch mysql3308.err

chown mysql:mysql mysql3307.err
chown mysql:mysql mysql3308.err


/usr/local/mysql/scripts/mysql_install_db --basedir=/usr/local/mysql --datadir=/data/3307/data --user=mysql
/usr/local/mysql/scripts/mysql_install_db --basedir=/usr/local/mysql --datadir=/data/3308/data --user=mysql

chown -R mysql:mysql /data/330*

mysql -uroot -p -S /data/3307/mysql.sock
mysql -uroot -p -S /data/3308/mysql.sock


����ҵ�һ��my.cnf�����ļ�
root@kkk---kkk:/data/3307# cat my.cnf 
[client]
port = 3307
socket = /data/3307/mysql.sock
[mysqld]
port = 3307
socket = /data/3307/mysql.sock
basedir = /usr/local/mysql
datadir = /data/3307/data
skip-external-locking
key_buffer_size = 16M
max_allowed_packet = 1M
table_open_cache = 64
sort_buffer_size = 512K
net_buffer_length = 8K
read_buffer_size = 256K
read_rnd_buffer_size = 512K
myisam_sort_buffer_size = 8M
skip-name-resolve
log-bin=mysql-bin
binlog_format=mixed
max_binlog_size = 500M
server-id = 1
[mysqld_safe]
log-error=/data/3307/mysql3307.err
pid-file=/data/3307/mysql3307.pid
[mysqldump]
quick
max_allowed_packet = 16M
[mysql]
no-auto-rehash
[myisamchk]
key_buffer_size = 20M
sort_buffer_size = 20M
read_buffer = 2M
write_buffer = 2M
[mysqlhotcopy]
interactive-timeout