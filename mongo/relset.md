 /data/services/mongodb/mongodb-3.0.3/bin/mongod -dbpath=/data/apps/webdata/mongodb/ -logpath=/data/logs/mongodb/logfile.log -port=7301 -logappend --replSet repset &
 
 
config = { _id:"repset", members:[
... {_id:0,host:"192.168.1.222:7301"},
... {_id:1,host:"192.168.1.223:7301"},
... {_id:2,host:"192.168.1.224:7301"}]
... }

rs.initiate(config,fore);
rs.status();



#输出
use admin

