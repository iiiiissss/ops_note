http://blog.csdn.net/fdipzone/article/details/51793837
http://huoding.com/2015/09/14/463

PHPRedis 
$ok = $redis->set($key, $random, array('nx', 'ex' => $ttl));
if ($ok) {
    $cache->update();

    if ($redis->get($key) == $random) {
        $redis->del($key);
    }
}


GETSET key value
���ܣ�
������ key ��ֵ��Ϊ value �������� key �ľ�ֵ (old value)���� key ���ڵ������ַ�������ʱ������һ�����󣬵�key������ʱ������nil��