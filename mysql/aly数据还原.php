1,���ϵ����ݿ�汾Ϊ5.6,���Խ����ݿ��Ϊ5.6
apt-get install mysql-server-5.6
2,���ذ����ƵĽű�
hins1493109_xtra_20160708034636.tar.gz  rds_backup_extract.sh
3,��ѹ�����ļ�
 ./rds_backup_extract.sh -f /root/hins1493109_xtra_20160708034636.tar.gz  -C /home/mysql/data
4,��װxtr
 apt-get install innoextract 
apt-get install xtrabackup 
5,�ر�mysql
service mysql stop
6,��ԭ�е������ļ����������ط�
cd /var/lib/
mv mysql mysql_back
7,�½�һ��mysql�����ļ���
mkdir mysql
8,���л�ԭ
 innobackupex --defaults-file=/etc/mysql/my.cnf --copy-back --rsync /home/mysql/data/
9,�޸�����:����
chown -R mysql:mysql /var/lib/mysql
10,����mysql,������֤
/etc/init.d/mysql restart
mysql -uroot