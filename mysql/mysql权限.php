环境:


CREATE DATABASE IF NOT EXISTS db_fenjie_dev default charset utf8 COLLATE utf8_general_ci;

CREATE USER fenjie_dev_rw IDENTIFIED BY '123'

grant all privileges on db_fenjie_dev.* to 'fenjie_dev_rw'@'%' identified  by 'abc123'; 


在test1上面的数据库,新建了库:test_kai,表:ttes
授予权限:
grant all privileges on test_kai.* to 'test_kai_rw'@'%' identified  by 'abc123'; 
测试登录情况:
mysql -h 112.74.207.116 -utest_kai_rw -pabc123
修改:
update user set host='112.74.90.180,112.74.194.132' where user='test_kai_rw' and host='%';
登录被拒绝:
再改:
update user set host='112.74.90.180' where user='test_kai_rw' and host='112.74.90.180,112.74.194.132';
ok了

FLUSH PRIVILEGES;


select user,host,password from user;