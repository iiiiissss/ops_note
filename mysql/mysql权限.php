����:


CREATE DATABASE IF NOT EXISTS db_fenjie_dev default charset utf8 COLLATE utf8_general_ci;

CREATE USER fenjie_dev_rw IDENTIFIED BY '123'

grant all privileges on db_fenjie_dev.* to 'fenjie_dev_rw'@'%' identified  by 'abc123'; 


��test1��������ݿ�,�½��˿�:test_kai,��:ttes
����Ȩ��:
grant all privileges on test_kai.* to 'test_kai_rw'@'%' identified  by 'abc123'; 
���Ե�¼���:
mysql -h 112.74.207.116 -utest_kai_rw -pabc123
�޸�:
update user set host='112.74.90.180,112.74.194.132' where user='test_kai_rw' and host='%';
��¼���ܾ�:
�ٸ�:
update user set host='112.74.90.180' where user='test_kai_rw' and host='112.74.90.180,112.74.194.132';
ok��

FLUSH PRIVILEGES;


select user,host,password from user;