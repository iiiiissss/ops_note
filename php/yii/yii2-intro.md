获取config目录下的params.php的配置值
\Yii::$app->params['key']

vendor/yiisoft/yii2/web/Request.php
 873 public function getUserIP()

 Yii::$app->getRequest()->getUserIP();


查询：
$rows = (new \yii\db\Query())
    ->select(['id', 'email'])
    ->from('user')
    ->where(['last_name' => 'Smith'])
    ->limit(10)
    ->all();


select  默认是*
  $query->select(["CONCAT(first_name, ' ', last_name) AS full_name", 'email']); 
  $query->where('status=:status')
    ->addParams([':status' => $status]);
  $query->andWhere(['like', 'title', $search]);
Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id AND status=:status')
           ->bindValue(':id', $_GET['id'])


bindValue(':id', 1)
bindValues((array)$params) 

$query->orderBy([
    'id' => SORT_ASC,
    'name' => SORT_DESC,
]);
$query->orderBy('id ASC, name DESC');
$query->orderBy('id ASC')->addOrderBy('name DESC');

INNER JOIN, LEFT JOIN 和 RIGHT JOIN
$query->join('LEFT JOIN', 'post', 'post.user_id = user.id');


all()
->count()

foreach ($query->batch() as $users) {
    // $users 是一个包含100条或小于100条用户表数据的数组
}
// or if you want to iterate the row one by one
foreach ($query->each() as $user) {
    // $user 指代的是用户表当中的其中一行数据
}