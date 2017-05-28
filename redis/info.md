redis-trib.rb
http://redisdoc.com/


redis-cli KEYS "pattern" | xargs redis-cli DEL
redis-cli -a password keys "*" | xargs redis-cli -a password del

//下面的命令指定数据序号为0，即默认数据库
redis-cli -n 0 keys "*" | xargs redis-cli -n 0 del

//删除当前数据库中的所有Key
flushdb
//删除所有数据库中的key
flushall