use
show collections 
增:
db.c1.insert({name:"user1"});
db.c1.save({_id:1, name:"user1"}); //save()如果已经存在就不会插入，如果不存在就插入

删:
db.c1.remove();
db.c1.remove({name:"user1"});

查:
db.c1.find({name:"user1"},{name:1, age:1, _id:0});
条件表达式
< <= > >= !=
$gt: 大于
$lt: 小于
$gte: 大于等于
$lte: 小于等于
$ne: 不等于

统计: 
db.c1.count();
db.c1.find().count();

排序:
db.c1.find().sort(age:1); //1是升序 0是降序
db.c1.find().limit(4);

跳过几个
db.c1.skip(1);
db.c1.skip(0).limit(10).sort({age:-1});

$all
操作类似于$in操作，但是不同的是，$all操作要求数组里面的值全部是包含在返回的记录里面
db.c2.find({post:{$all:[1,2,3]}});

$exists
操作检查一个字段是否存在
db.c2.find({age:{$exists:1}}); 测试一个字段是否存在

$mod
操作可以让我们简单的进行取模操作，而不需要用到where子句
//这里的是字段值的取余操作
db.c1.find({age:{$mod:[2]}});
$in 操作类似于传统关系数据库中的IN
db.c1.find({age:{$in:[1,2,3]}})
$nin 与$in相反
db.c1.find({age:{$nin:[2,3,4]}});


$or 查看指定多个条件的记录，跟sql的or差不多
db.c1.find({$or:[{name:"user1"},{name:"user2"},{age:10}]});

$nor 与$or相反过滤指定的条件
db.c1.find({$nor:[{name:"user1"},{name:"user2"},{age:10}]});



db.help()
DB methods:
        db.adminCommand(nameOrDocument) - switches to 'admin' db, and runs command [ just calls db.runCommand(...) ]
        db.auth(username, password)
        db.cloneDatabase(fromhost)
        db.commandHelp(name) returns the help for the command
        db.copyDatabase(fromdb, todb, fromhost)
        db.createCollection(name, { size : ..., capped : ..., max : ... } )
        db.createUser(userDocument)
        db.currentOp() displays currently executing operations in the db
        db.dropDatabase()
        db.eval() - deprecated
        db.fsyncLock() flush data to disk and lock server for backups
        db.fsyncUnlock() unlocks server following a db.fsyncLock()
        db.getCollection(cname) same as db['cname'] or db.cname
        db.getCollectionInfos()
        db.getCollectionNames()
        db.getLastError() - just returns the err msg string
        db.getLastErrorObj() - return full status object
        db.getLogComponents()
        db.getMongo() get the server connection object
        db.getMongo().setSlaveOk() allow queries on a replication slave server
        db.getName()
        db.getPrevError()
        db.getProfilingLevel() - deprecated
        db.getProfilingStatus() - returns if profiling is on and slow threshold
        db.getReplicationInfo()
        db.getSiblingDB(name) get the db at the same server as this one
        db.getWriteConcern() - returns the write concern used for any operations on this db, inherited from server object if set
        db.hostInfo() get details about the server's host
        db.isMaster() check replica primary status
        db.killOp(opid) kills the current operation in the db
        db.listCommands() lists all the db commands
        db.loadServerScripts() loads all the scripts in db.system.js
        db.logout()
        db.printCollectionStats()
        db.printReplicationInfo()
        db.printShardingStatus()
        db.printSlaveReplicationInfo()
        db.dropUser(username)
        db.repairDatabase()
        db.resetError()
        db.runCommand(cmdObj) run a database command.  if cmdObj is a string, turns it into { cmdObj : 1 }
        db.serverStatus()
        db.setLogLevel(level,<component>)
        db.setProfilingLevel(level,<slowms>) 0=off 1=slow 2=all
        db.setWriteConcern( <write concern doc> ) - sets the write concern for writes to the db
        db.unsetWriteConcern( <write concern doc> ) - unsets the write concern for writes to the db
        db.setVerboseShell(flag) display extra information in shell output
        db.shutdownServer()
        db.stats()
        db.version() current version of the server
		
		
db.tags.help()
DBCollection help
        db.tags.find().help() - show DBCursor help
        db.tags.count()
        db.tags.copyTo(newColl) - duplicates collection by copying all documents to newColl; no indexes are copied.
        db.tags.convertToCapped(maxBytes) - calls {convertToCapped:'tags', size:maxBytes}} command
        db.tags.dataSize()
        db.tags.distinct( key ) - e.g. db.tags.distinct( 'x' )
        db.tags.drop() drop the collection
        db.tags.dropIndex(index) - e.g. db.tags.dropIndex( "indexName" ) or db.tags.dropIndex( { "indexKey" : 1 } )
        db.tags.dropIndexes()
        db.tags.ensureIndex(keypattern[,options])
        db.tags.explain().help() - show explain help
        db.tags.reIndex()
        db.tags.find([query],[fields]) - query is an optional query filter. fields is optional set of fields to return.
                                                      e.g. db.tags.find( {x:77} , {name:1, x:1} )
        db.tags.find(...).count()
        db.tags.find(...).limit(n)
        db.tags.find(...).skip(n)
        db.tags.find(...).sort(...)
        db.tags.findOne([query])
        db.tags.findAndModify( { update : ... , remove : bool [, query: {}, sort: {}, 'new': false] } )
        db.tags.getDB() get DB object associated with collection
        db.tags.getPlanCache() get query plan cache associated with collection
        db.tags.getIndexes()
        db.tags.group( { key : ..., initial: ..., reduce : ...[, cond: ...] } )
        db.tags.insert(obj)
        db.tags.mapReduce( mapFunction , reduceFunction , <optional params> )
        db.tags.aggregate( [pipeline], <optional params> ) - performs an aggregation on a collection; returns a cursor
        db.tags.remove(query)
        db.tags.renameCollection( newName , <dropTarget> ) renames the collection.
        db.tags.runCommand( name , <options> ) runs a db command with the given name where the first param is the collection name
        db.tags.save(obj)
        db.tags.stats({scale: N, indexDetails: true/false, indexDetailsKey: <index key>, indexDetailsName: <index name>})
        db.tags.storageSize() - includes free space allocated to this collection
        db.tags.totalIndexSize() - size in bytes of all the indexes
        db.tags.totalSize() - storage allocated for all data and indexes
        db.tags.update(query, object[, upsert_bool, multi_bool]) - instead of two flags, you can pass an object with fields: upsert, multi
        db.tags.validate( <full> ) - SLOW
        db.tags.getShardVersion() - only for use with sharding
        db.tags.getShardDistribution() - prints statistics about data distribution in the cluster
        db.tags.getSplitKeysForChunks( <maxChunkSize> ) - calculates split points over all chunks and returns splitter function
        db.tags.getWriteConcern() - returns the write concern used for any operations on this collection, inherited from server/db if set
        db.tags.setWriteConcern( <write concern doc> ) - sets the write concern for writes to the collection
        db.tags.unsetWriteConcern( <write concern doc> ) - unsets the write concern for writes to the collection
