redis �˿ڷ���:
���� 6379 8G
web 6380  8G
���� 6381 4G
�ʺ� 6382 4G
���� 6383 4G
���� 6384 2G

sudo /etc/init.d/redis 6379 stop
sudo /usr/local/redis/bin/redis-cli -p 6379
ps -ef |grep redis

����:
aemonize yes #��Ҫ
slaveof 192.168.200.21 6379 #��
������������

�л�:
��ͣ,��: /usr/local/redis/bin/redis-cli -p 6379 slaveof NO ONE
�����л�: 
1)��: save
2�������ڵ���redis��Ŀ¼��dump.rdb�ļ��������ǵ�ԭ����redis�ĸ�Ŀ¼
3������ԭ������, ���ô�: /usr/local/redis/bin/redis-cli -p 6379 slaveof 192.168.200.21 6379

ȫ��ֹͣ

//ɾ����ǰ���ݿ��е�����Key
flushdb
//ɾ���������ݿ��е�key
flushall
