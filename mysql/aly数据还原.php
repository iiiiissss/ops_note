1,线上的数据库版本为5.6,将自建数据库改为5.6
apt-get install mysql-server-5.6
2,下载阿里云的脚本
hins1493109_xtra_20160708034636.tar.gz  rds_backup_extract.sh
3,解压数据文件
 ./rds_backup_extract.sh -f /root/hins1493109_xtra_20160708034636.tar.gz  -C /home/mysql/data
4,安装xtr
 apt-get install innoextract 
apt-get install xtrabackup 
5,关闭mysql
service mysql stop
6,将原有的数据文件备份其他地方
cd /var/lib/
mv mysql mysql_back
7,新建一个mysql数据文件夹
mkdir mysql
8,进行还原
 innobackupex --defaults-file=/etc/mysql/my.cnf --copy-back --rsync /home/mysql/data/
9,修改属主:属组
chown -R mysql:mysql /var/lib/mysql
10,重启mysql,进行验证
/etc/init.d/mysql restart
mysql -uroot