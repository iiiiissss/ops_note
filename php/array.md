$data = [['name'=>'lilei','score'=>80],['name'=>'lili','score'=>70],['name'=>'liwei','score'=>90]];
在二维数组中, 根据指定的字段排序: 降序
uasort($data, function($a, $b) {
$key = 'score';
if ($a[$key] == $b[$key]) {
return 0;
}
return ($a[$key] < $b[$key]) ? 1 : -1;
}
);
var_dump($data);