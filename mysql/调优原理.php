mysql数据库上线后，可以等其稳定运行一段时间后再根据服务器的status状态进行适当优化，我们可以用如下命令列出mysql服务器运行的各种状态值：
mysql>show global status;
或者用：mysql>show status like '查询值%';

1.慢查询
有时候我们为了定位系统中效率比较低下的query语句，需要打开慢查询日志，也就是slow query log，查询慢查询日志的相关命令如下：
mysql> show variables like '%slow%';
mysql>show global status like '%slow%';
打开慢查询日志可能会对系统性能有点影响，如果你的mysql是主-从结构，可以考虑打开其中一台从服务器的慢查询日志，这样既可以监控慢查询，对系统性能影响也会很小

2.连接数
如果经常遇见“mysql：error 1040：too manyconnections“的情况，一种情况是访问量确实很高，mysql服务器扛不住了，这个时候需要考虑增加从服务器分散读压力，另外一种情况是mysql配置文件中max_connections的值过小
查询服务器的最大连接数：
mysql>show variables like 'max_connections';

查询服务器当前的最大连接数：
mysql>show global status like 'max_used_connections';

max_used_connections/max_connections *100%
如果发现比例在10%以下，则说明mysql服务器连接数设置的过高了

3.key_buffer_size
key_buffer_size是设置myisam表索引引擎缓存空间的大小，此参数对myisam表性能影响最大，下面是一台以myisam为主要存储引擎服务器的配置：
查看key_buffer_size：
mysql>show variables like 'key_buffer_size';

查看key_buffer_size的使用情况（key_read使用key_buffer_size）
mysql>show global status like 'key_read%';

可以看到索引读请求的个数，和没有在内存中找到的个数（直接从硬盘读取索引），计算索引未命中缓存的概率：
key_cache_miss_rate=key_reads/key_read_requests*100%
上面的数据是为0.0244%，key_cache_miss_rate在0.1%以下都是很好的，如果在0.01%以下，则说明key_buffer_size分配过多了，可以适当减少
mysql服务器还提供了key_blocks_*参数，
mysql>show global status like 'key_blocks_u%';

key_blocks_unused表示未使用的缓存簇（blocks）数，key_blocks_used表示曾经用到的最大的blocks数。比如这台 服务器，所有的缓存都用到了，要么增加key_buffer_size，要么就是过度索引，把缓存占满了，比较理想的设置是：
key_blocks_used/(key_blocks_unused+key_blocks_used)*100% = 80%

4.临时表
当执行语句时，关于已经被创造了的隐含临时表的数量，我们可以用如下命令查知其具体情况：
msyql>show global status like 'created_tmp%';

每次创建临时表，created_tmp_tables都会增加，如果是在磁盘上创建临时表，created_tmp_disk_tables也会增加，created_tmp_files表示mysql创建的临时文件数，比较理想的配置是：
created_tmp_disk_tables/created_tmp_tables*100%<=25%比如上面的服务器，值为1.20%，应该说是相当好了，
我们再看下mysql服务器对临时表的配置
mysql>show variables where variable_name in('tmp_table_size','max_heap_table_size');

只有256MB以下的临时表才能全部放在内存中，超过了就会用到硬盘临时表

5.open table的情况
open_tables表示打开表的数量，opened_tables表示打开过的表的数量，我们可以用如下命令查看具体情况：
msyql>show global status like 'open% tables%';

如果opened_tables数量过大，说明配置中table_cache（mysql5.1.3之后这个值叫做table_open_cache）的值可能太小，我们查询以下服务器table_cache值：
mysql>show variables like 'table_cache';

比较合适的值为：
open_tables/opened_tables *100% >=85%
open_tables/table_cache*100%<=95%

6.进程使用情况
如果我们在mysql服务器的配置文件中设置了thread_cache_size，当客户端断开时，服务器处理此客户请求的线程将会缓存起来以响应下一个客户而不是销毁（前提是缓存数未达上限）
msyql>show global status like 'thread%';

如果发现threads_created的值过大，表明mysql服务器一直在创建线程，这是比较耗资源的，可以适当增大配置文件中thread_cache_size的值，查询服务器thread_cache_size配置，
mysql>show variables like 'thread_cache_size';

实例中的mysql服务器还是挺健康的

7.查询缓存
它主要设计两个参数，query_cache_size用于设置mysql的查询缓存（query cache）大小，query_cache_type用于设置使用查询缓存的类型，可以用如下命令查看其具体情况：
mysql>show global status like 'qcache%';

mysql查询缓存变量的相关解释如下所示：
qcache_free_blocks：缓存中相邻内存快的个数。数目大说明可能有碎片。flush query cache会对缓存中的碎片进行整理，从而得到一个空闲块
qcache_free_memory：缓存中的空闲内存
qcache_hits：多少次命中，通过这个参数可以查看到query cache的基本效果
qcache_inserts：每次插入一个查询时就增大
qcache_lowmem_prunes：多少条query因为内存不足而被清除出query cache，通过qcache_lowmem_prunes和qcache_free_memory相互结合，能够更清楚的了解到系统中query cache的内存大小是否真的足够，是否非常频繁地出现因为内存不足而有query被换出的情况
qcache_not_cache：不适合进行缓存的查询数量，通常是由于这些查询不是select语句或用了now()之类的函数
qcache_queries_in_cache：当前缓存的查询（和响应）数量
qcache_total_blocks：缓存中块的数量
我们再查询以下服务器上关于query_cache的配置：
mysql>show variables like 'query_cache%';

各自段的解释如下所示：
query_cache_limit：超过此大小的查询将不缓存
query_cache_min_res_unit：缓存块的最小值
query_cache_size：查询缓存大小
query_cache_type：缓存类型，决定缓存什么样的查询，示例中表示不缓存select sql_no_cache查询
query_cache_wlock_invalidate：表示当有其他客户端正在对myisam表进行写操作时，读请求是要等write lock释放资源后再查询还是允许直接从query cache中读取结果，默认为false（可以直接从query cache中取得结果）
query_cache_min_res_unit的配置是一柄“双刃剑”，默认是4KB，设置值大对大数据查询有好处，但是如果你的查询都是小数据查询，就容易造成内存碎片和浪费
查询缓存碎片率=qcache_free_blocks/qcache_total_blocks*100%
如果查询缓存碎片率超过20%，可以使用flush query cache整理缓存碎片，或者试试减少query_cache_min_res_unit，如果你的查询都是小数据量
查询缓存利用率=(query_cache_size-query_free_memonry)/query_cache_size*100%
查询缓存利用率在25%以下，说明query_cache_size设置的过大，可以适当减少，查询缓存利用率在80%以上，则说明query_cache_size可能有点小，不然就是碎片太多
查询缓存命中率=Qcache_hits/(Qcache_hits + Com_select)*100%   ------------------mysql> show status like '%Com_select%';
示例服务器中的查询缓存碎片率等于20.46%，查询缓存利用率等于62.26%，查询缓存命中率等于1.94%，说明命中率很差，可能写操作比较频繁，而且可能有些碎片

8.排序使用情况
它表示系统中对数据进行排序时所使用的buffer，可以用如下命令查看：
mysql>show global status like 'sort%';

sort_merge_passes包括如下步骤：mysql首先会尝试在内存中排序，使用的内存大小由系统变量sort_buffer_size来决定，如果不够则把所有的记录读到内存中，而mysql则会把每次在内存中排序的结果保存到临时文件中，等mysql找到所有记录之后，再把临时文件中的记录做一次排序，这次排序就会增加sort_merge_passes。实际上，mysql会用另一个临时文件来存储再次排序的结果，所以我们会看到sort_merge_passes增加的数值是建临时文件数的两倍。因为用到了临时文件，所以速度可能会比较慢，增大sort_buffer_size会减少sort_merge_passes和创建临时文件的次数，但盲目的增大sort_buffer_size并不一定能提高速度

9.文件打开数
我们在处理mysql故障时，发现文件打开数（open_files）大于open_files_limit值时，mysql数据库就会产生卡住的现象，导致apache服务器也打不开相应页面，这个问题应该在 工作中注意，我们可以用如下命令查看其具体情况，
mysql>show global status like 'open_files';

mysql>show variables like 'open_files_limit';

比较合适的设置是：
open_files/open_files_limit*100%<=75%


10.innodb_buffer_pool_size的合理设置
innodb存储引擎的缓存机制和myisam的最大区别就在于，innodb不仅仅 缓存索引，同时还会缓存实际数据。此参数用来设置innodb最主要的buffer（innodb buffer pool）的大小，也就是缓存用户表及索引数据的最主要的缓存空间，对innodb整体性能影响也最大。
建议分配的值为物理内存的50%~80%.
通过命令观察：
mysql>show status like 'innodb_buffer_pool_%';


通过此命令得出的结果可以计算出innodb buffer pool的读命中率为：
   1-（innodb_buffer_pool_reads/innodb_buffer_pool_reead_request）*100%
一般来讲这个命中率不会低于99%，如果低于这个值的话就要考虑加大innodb buffer pool。


写命中率大约为：
innodb_buffer_pool_pages_data/innodb_buffer_pool_pages_total*100%




在mysql上线稳定运行了一段时间后，可以调用mysql调优脚本tuning-primer.sh来检查配置的参数是否合理
下载地址：wget --no-check-certificate  https://launchpad.net/mysql-tuning-primer/trunk/1.6-r1/+download/tuning-primer.sh


