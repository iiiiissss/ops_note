https://help.aliyun.com/knowledge_detail/41738.html

通过aly数据还原.php文档还原数据,
或者执行shell aly_mysql恢复.sh进行数据还原


二进制:
修改my.cnf文件(5.6版本的gtid原因,不开启会出现报错)
log-slave-updates=true #是否将从其他服务器读取的数据记录到二进制日志中
gtid-mode=on
enforce-gtid-consistency=true #开启强制GTID一致性
log-bin=master-bin
binlog_format = row  #修改日志的格式,默认的日志格式也出现报错

重启mysql

查看之前还原数据的二进制日志点:
cat /home/data/20160902142113/xtrabackup_binlog_info 
mysql-bin.000143	6066557	c5fe1b79-5545-11e6-bee7-6c92bf2c45fc:1-6951501

下载对应的binlog日志:


还原:
mysqlbinlog mysql-bin.000688 mysql-bin.000689 --start-position=531167  --stop-datetime="16-05-16 18:05:03" | mysql -uroot -pyour_password -P3306 -hyour_host_ip

