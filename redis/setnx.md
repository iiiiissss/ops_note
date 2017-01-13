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
功能：
将给定 key 的值设为 value ，并返回 key 的旧值 (old value)，当 key 存在但不是字符串类型时，返回一个错误，当key不存在时，返回nil。