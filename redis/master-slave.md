redis 端口分配:
聊天 6379 8G
web 6380  8G
排行 6381 4G
帐号 6382 4G
搜索 6383 4G
备用 6384 2G

sudo /etc/init.d/redis 6379 stop
sudo /usr/local/redis/bin/redis-cli -p 6379
ps -ef |grep redis

配置:
aemonize yes #都要
slaveof 192.168.200.21 6379 #从
两者重启即可

切换:
主停,从: /usr/local/redis/bin/redis-cli -p 6379 slaveof NO ONE
重新切回: 
1)从: save
2）将现在的主redis根目录下dump.rdb文件拷贝覆盖到原来主redis的根目录
3）启动原来的主, 设置从: /usr/local/redis/bin/redis-cli -p 6379 slaveof 192.168.200.21 6379

全部停止

//删除当前数据库中的所有Key
flushdb
//删除所有数据库中的key
flushall
