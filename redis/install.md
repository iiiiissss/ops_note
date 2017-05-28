sudo apt-get install redis-server
ps -aux|grep redis
netstat -nlt|grep 6379
检查Redis服务器状态:/etc/init.d/redis-server status
加上`&`号使redis以后台程序方式运行  
./redis-server & 

允许外网: /etc/redis/redis.conf #bind 127.0.0.1
max memory
设置主从:
客户端:
redis-cli -p 6379 -a password
查看信息info


/etc/init.d/redis-server 和 /usr/bin/redis-server 不一样
启动:/usr/bin/redis-server  /etc/redis/16381.conf

restart



故障:
rdb文件 Redis dump 文件进行监控 rdb_last_save_time

redis-cli -p 6379 -a test123
redis-cli -h 45.342.23.1 -p 6379 -a test123

先登陆后验证：
redis-cli -p 6379
redis 127.0.0.1:6379> auth test123