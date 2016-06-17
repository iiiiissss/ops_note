登录后调用:
uc_user_synlogin

原uc_client: control/ data/ lib/ model/ client.php index.htm
原uc example: api/ code/ include/ config.inc.php ucexample.js ucexample_2.php
./data/cache/apps.php要同步

.net http://www.dozer.cc/2011/01/ucenter-api-in-depth-2nd.html
java https://code.google.com/archive/p/discuz-ucenter-api-for-java/


client.php
uc_user_synlogin
uc_user_login
uc_client/control/user.php:
uc_server/control/user.php://根据客户端的请求,返回js
onsynlogin





同步登录
<script type="text/javascript" src="http://bbs.mcelf.com/api/uc.php?time=1464706422&code=7d26i9tOJ85zBq2ATPRoqBN3rH6fD0%2BEm3zLsy7PqYvIi2C0fKsg%2BO5GzNkxhcPyZhKzf0CanYMzEtpO4w7seQaHKPod%2BPx08kKlAnjIbRVgaBRkWYBIakBODp1hJ7ZjWpTr7pbAvc%2B51lLDstBOD8L14P0j14WqI9bD" reload="1"></script>


api.php 定义

define('UC_CLIENT_VERSION', '1.5.0');	//note UCenter 版本标识
define('UC_CLIENT_RELEASE', '20081031');

define('API_DELETEUSER', 1);		//note 用户删除 API 接口开关
define('API_RENAMEUSER', 1);		//note 用户改名 API 接口开关
define('API_GETTAG', 1);		//note 获取标签 API 接口开关
define('API_SYNLOGIN', 1);		//note 同步登录 API 接口开关
define('API_SYNLOGOUT', 1);		//note 同步登出 API 接口开关
define('API_UPDATEPW', 1);		//note 更改用户密码 开关
define('API_UPDATEBADWORDS', 1);	//note 更新关键字列表 开关
define('API_UPDATEHOSTS', 1);		//note 更新域名解析缓存 开关
define('API_UPDATEAPPS', 1);		//note 更新应用列表 开关
define('API_UPDATECLIENT', 1);		//note 更新客户端缓存 开关
define('API_UPDATECREDIT', 1);		//note 更新用户积分 开关
define('API_GETCREDITSETTINGS', 1);	//note 向 UCenter 提供积分设置 开关
define('API_GETCREDIT', 1);		//note 获取用户的某项积分 开关
define('API_UPDATECREDITSETTINGS', 1);	//note 更新应用积分设置 开关

define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');







新增用户:
$init_arr = array(0,0,0,0,0,0,0,0,0);//用户相关杂项
$groupid = 10;//用户组ID
var_dump($UcUser);
C::t('common_member')->insert(3, 'ubuntu', md5(random(10)), '835150938@qq.com', $_G['clientip'], $groupid, $init_arr);




