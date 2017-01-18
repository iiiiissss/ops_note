mysql���ݿ����ߺ󣬿��Ե����ȶ�����һ��ʱ����ٸ��ݷ�������status״̬�����ʵ��Ż������ǿ��������������г�mysql���������еĸ���״ֵ̬��
mysql>show global status;
�����ã�mysql>show status like '��ѯֵ%';

1.����ѯ
��ʱ������Ϊ�˶�λϵͳ��Ч�ʱȽϵ��µ�query��䣬��Ҫ������ѯ��־��Ҳ����slow query log����ѯ����ѯ��־������������£�
mysql> show variables like '%slow%';
mysql>show global status like '%slow%';
������ѯ��־���ܻ��ϵͳ�����е�Ӱ�죬������mysql����-�ӽṹ�����Կ��Ǵ�����һ̨�ӷ�����������ѯ��־�������ȿ��Լ������ѯ����ϵͳ����Ӱ��Ҳ���С

2.������
�������������mysql��error 1040��too manyconnections���������һ������Ƿ�����ȷʵ�ܸߣ�mysql����������ס�ˣ����ʱ����Ҫ�������Ӵӷ�������ɢ��ѹ��������һ�������mysql�����ļ���max_connections��ֵ��С
��ѯ�������������������
mysql>show variables like 'max_connections';

��ѯ��������ǰ�������������
mysql>show global status like 'max_used_connections';

max_used_connections/max_connections *100%
������ֱ�����10%���£���˵��mysql���������������õĹ�����

3.key_buffer_size
key_buffer_size������myisam���������滺��ռ�Ĵ�С���˲�����myisam������Ӱ�����������һ̨��myisamΪ��Ҫ�洢��������������ã�
�鿴key_buffer_size��
mysql>show variables like 'key_buffer_size';

�鿴key_buffer_size��ʹ�������key_readʹ��key_buffer_size��
mysql>show global status like 'key_read%';

���Կ�������������ĸ�������û�����ڴ����ҵ��ĸ�����ֱ�Ӵ�Ӳ�̶�ȡ����������������δ���л���ĸ��ʣ�
key_cache_miss_rate=key_reads/key_read_requests*100%
�����������Ϊ0.0244%��key_cache_miss_rate��0.1%���¶��Ǻܺõģ������0.01%���£���˵��key_buffer_size��������ˣ������ʵ�����
mysql���������ṩ��key_blocks_*������
mysql>show global status like 'key_blocks_u%';

key_blocks_unused��ʾδʹ�õĻ���أ�blocks������key_blocks_used��ʾ�����õ�������blocks����������̨ �����������еĻ��涼�õ��ˣ�Ҫô����key_buffer_size��Ҫô���ǹ����������ѻ���ռ���ˣ��Ƚ�����������ǣ�
key_blocks_used/(key_blocks_unused+key_blocks_used)*100% = 80%

4.��ʱ��
��ִ�����ʱ�������Ѿ��������˵�������ʱ������������ǿ��������������֪����������
msyql>show global status like 'created_tmp%';

ÿ�δ�����ʱ��created_tmp_tables�������ӣ�������ڴ����ϴ�����ʱ��created_tmp_disk_tablesҲ�����ӣ�created_tmp_files��ʾmysql��������ʱ�ļ������Ƚ�����������ǣ�
created_tmp_disk_tables/created_tmp_tables*100%<=25%��������ķ�������ֵΪ1.20%��Ӧ��˵���൱���ˣ�
�����ٿ���mysql����������ʱ�������
mysql>show variables where variable_name in('tmp_table_size','max_heap_table_size');

ֻ��256MB���µ���ʱ�����ȫ�������ڴ��У������˾ͻ��õ�Ӳ����ʱ��

5.open table�����
open_tables��ʾ�򿪱��������opened_tables��ʾ�򿪹��ı�����������ǿ�������������鿴���������
msyql>show global status like 'open% tables%';

���opened_tables��������˵��������table_cache��mysql5.1.3֮�����ֵ����table_open_cache����ֵ����̫С�����ǲ�ѯ���·�����table_cacheֵ��
mysql>show variables like 'table_cache';

�ȽϺ��ʵ�ֵΪ��
open_tables/opened_tables *100% >=85%
open_tables/table_cache*100%<=95%

6.����ʹ�����
���������mysql�������������ļ���������thread_cache_size�����ͻ��˶Ͽ�ʱ������������˿ͻ�������߳̽��Ỻ����������Ӧ��һ���ͻ����������٣�ǰ���ǻ�����δ�����ޣ�
msyql>show global status like 'thread%';

�������threads_created��ֵ���󣬱���mysql������һֱ�ڴ����̣߳����ǱȽϺ���Դ�ģ������ʵ����������ļ���thread_cache_size��ֵ����ѯ������thread_cache_size���ã�
mysql>show variables like 'thread_cache_size';

ʵ���е�mysql����������ͦ������

7.��ѯ����
����Ҫ�������������query_cache_size��������mysql�Ĳ�ѯ���棨query cache����С��query_cache_type��������ʹ�ò�ѯ��������ͣ���������������鿴����������
mysql>show global status like 'qcache%';

mysql��ѯ�����������ؽ���������ʾ��
qcache_free_blocks�������������ڴ��ĸ�������Ŀ��˵����������Ƭ��flush query cache��Ի����е���Ƭ���������Ӷ��õ�һ�����п�
qcache_free_memory�������еĿ����ڴ�
qcache_hits�����ٴ����У�ͨ������������Բ鿴��query cache�Ļ���Ч��
qcache_inserts��ÿ�β���һ����ѯʱ������
qcache_lowmem_prunes��������query��Ϊ�ڴ治����������query cache��ͨ��qcache_lowmem_prunes��qcache_free_memory�໥��ϣ��ܹ���������˽⵽ϵͳ��query cache���ڴ��С�Ƿ�����㹻���Ƿ�ǳ�Ƶ���س�����Ϊ�ڴ治�����query�����������
qcache_not_cache�����ʺϽ��л���Ĳ�ѯ������ͨ����������Щ��ѯ����select��������now()֮��ĺ���
qcache_queries_in_cache����ǰ����Ĳ�ѯ������Ӧ������
qcache_total_blocks�������п������
�����ٲ�ѯ���·������Ϲ���query_cache�����ã�
mysql>show variables like 'query_cache%';

���ԶεĽ���������ʾ��
query_cache_limit�������˴�С�Ĳ�ѯ��������
query_cache_min_res_unit����������Сֵ
query_cache_size����ѯ�����С
query_cache_type���������ͣ���������ʲô���Ĳ�ѯ��ʾ���б�ʾ������select sql_no_cache��ѯ
query_cache_wlock_invalidate����ʾ���������ͻ������ڶ�myisam�����д����ʱ����������Ҫ��write lock�ͷ���Դ���ٲ�ѯ��������ֱ�Ӵ�query cache�ж�ȡ�����Ĭ��Ϊfalse������ֱ�Ӵ�query cache��ȡ�ý����
query_cache_min_res_unit��������һ����˫�н�����Ĭ����4KB������ֵ��Դ����ݲ�ѯ�кô������������Ĳ�ѯ����С���ݲ�ѯ������������ڴ���Ƭ���˷�
��ѯ������Ƭ��=qcache_free_blocks/qcache_total_blocks*100%
�����ѯ������Ƭ�ʳ���20%������ʹ��flush query cache��������Ƭ���������Լ���query_cache_min_res_unit�������Ĳ�ѯ����С������
��ѯ����������=(query_cache_size-query_free_memonry)/query_cache_size*100%
��ѯ������������25%���£�˵��query_cache_size���õĹ��󣬿����ʵ����٣���ѯ������������80%���ϣ���˵��query_cache_size�����е�С����Ȼ������Ƭ̫��
��ѯ����������=Qcache_hits/(Qcache_hits + Com_select)*100%   ------------------mysql> show status like '%Com_select%';
ʾ���������еĲ�ѯ������Ƭ�ʵ���20.46%����ѯ���������ʵ���62.26%����ѯ���������ʵ���1.94%��˵�������ʺܲ����д�����Ƚ�Ƶ�������ҿ�����Щ��Ƭ

8.����ʹ�����
����ʾϵͳ�ж����ݽ�������ʱ��ʹ�õ�buffer����������������鿴��
mysql>show global status like 'sort%';

sort_merge_passes�������²��裺mysql���Ȼ᳢�����ڴ�������ʹ�õ��ڴ��С��ϵͳ����sort_buffer_size���������������������еļ�¼�����ڴ��У���mysql����ÿ�����ڴ�������Ľ�����浽��ʱ�ļ��У���mysql�ҵ����м�¼֮���ٰ���ʱ�ļ��еļ�¼��һ�������������ͻ�����sort_merge_passes��ʵ���ϣ�mysql������һ����ʱ�ļ����洢�ٴ�����Ľ�����������ǻῴ��sort_merge_passes���ӵ���ֵ�ǽ���ʱ�ļ�������������Ϊ�õ�����ʱ�ļ��������ٶȿ��ܻ�Ƚ���������sort_buffer_size�����sort_merge_passes�ʹ�����ʱ�ļ��Ĵ�������äĿ������sort_buffer_size����һ��������ٶ�

9.�ļ�����
�����ڴ���mysql����ʱ�������ļ�������open_files������open_files_limitֵʱ��mysql���ݿ�ͻ������ס�����󣬵���apache������Ҳ�򲻿���Ӧҳ�棬�������Ӧ���� ������ע�⣬���ǿ�������������鿴����������
mysql>show global status like 'open_files';

mysql>show variables like 'open_files_limit';

�ȽϺ��ʵ������ǣ�
open_files/open_files_limit*100%<=75%


10.innodb_buffer_pool_size�ĺ�������
innodb�洢����Ļ�����ƺ�myisam�������������ڣ�innodb������ ����������ͬʱ���Ỻ��ʵ�����ݡ��˲�����������innodb����Ҫ��buffer��innodb buffer pool���Ĵ�С��Ҳ���ǻ����û����������ݵ�����Ҫ�Ļ���ռ䣬��innodb��������Ӱ��Ҳ���
��������ֵΪ�����ڴ��50%~80%.
ͨ������۲죺
mysql>show status like 'innodb_buffer_pool_%';


ͨ��������ó��Ľ�����Լ����innodb buffer pool�Ķ�������Ϊ��
   1-��innodb_buffer_pool_reads/innodb_buffer_pool_reead_request��*100%
һ��������������ʲ������99%������������ֵ�Ļ���Ҫ���ǼӴ�innodb buffer pool��


д�����ʴ�ԼΪ��
innodb_buffer_pool_pages_data/innodb_buffer_pool_pages_total*100%




��mysql�����ȶ�������һ��ʱ��󣬿��Ե���mysql���Žű�tuning-primer.sh��������õĲ����Ƿ����
���ص�ַ��wget --no-check-certificate  https://launchpad.net/mysql-tuning-primer/trunk/1.6-r1/+download/tuning-primer.sh


