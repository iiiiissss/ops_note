https://help.aliyun.com/knowledge_detail/41738.html

ͨ��aly���ݻ�ԭ.php�ĵ���ԭ����,
����ִ��shell aly_mysql�ָ�.sh�������ݻ�ԭ


������:
�޸�my.cnf�ļ�(5.6�汾��gtidԭ��,����������ֱ���)
log-slave-updates=true #�Ƿ񽫴�������������ȡ�����ݼ�¼����������־��
gtid-mode=on
enforce-gtid-consistency=true #����ǿ��GTIDһ����
log-bin=master-bin
binlog_format = row  #�޸���־�ĸ�ʽ,Ĭ�ϵ���־��ʽҲ���ֱ���

����mysql

�鿴֮ǰ��ԭ���ݵĶ�������־��:
cat /home/data/20160902142113/xtrabackup_binlog_info 
mysql-bin.000143	6066557	c5fe1b79-5545-11e6-bee7-6c92bf2c45fc:1-6951501

���ض�Ӧ��binlog��־:


��ԭ:
mysqlbinlog mysql-bin.000688 mysql-bin.000689 --start-position=531167  --stop-datetime="16-05-16 18:05:03" | mysql -uroot -pyour_password -P3306 -hyour_host_ip

