/data/services/mongodb/mongodb-3.0.3/bin/mongod -dbpath=/data/apps/webdata/mongodb/tmp -logpath=/data/logs/mongodb/logfile.log -port=7303 -logappend

/data/services/mongodb/mongodb-3.0.3/bin/mongod -dbpath=/data/apps/webdata/mongodb -logpath=/data/logs/mongodb/logfile.log -port=7301 -logappend --replSet repset &

mongos:7302  mongo 192.168.1.222:7302
/data/services/mongodb/mongodb-3.0.3/bin/mongos  -dbpath=/data/apps/webdata/mongodbs --configdb 192.168.1.222:7301,192.168.1.223:7301,192.168.1.224:7301 -logpath=/data/logs/mongodb/mongos.log -port=7302 --chunkSize 1 &


/data/services/mongodb/mongodb-3.0.3/bin/mongos  --configdb 192.168.1.222:7301,192.168.1.223:7301,192.168.1.224:7301 --chunkSize 1 &

mongo 192.168.1.222:27017/admin