sudo apt-get install redis-server
ps -aux|grep redis
netstat -nlt|grep 6379
���Redis������״̬:/etc/init.d/redis-server status
����`&`��ʹredis�Ժ�̨����ʽ����  
./redis-server & 

��������: /etc/redis/redis.conf #bind 127.0.0.1
max memory
��������:
�ͻ���:
redis-cli -p 6379 -a password
�鿴��Ϣinfo


/etc/init.d/redis-server �� /usr/bin/redis-server ��һ��
����:/usr/bin/redis-server  /etc/redis/16381.conf

restart



����:
rdb�ļ� Redis dump �ļ����м�� rdb_last_save_time

redis-cli -p 6379 -a test123
redis-cli -h 45.342.23.1 -p 6379 -a test123

�ȵ�½����֤��
redis-cli -p 6379
redis 127.0.0.1:6379> auth test123