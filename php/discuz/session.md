浏览量巨大，session表频繁出现锁表问题,可以转换为redis:

http://www.discuz.net/thread-3457864-1-1.html


discuz 使用两张内存表分别存储后台用户和前台用户数据，在数据库中可以看到有两个 SESSION 表： 
一个是pre_common_adminsession，是管理员登录后台的 SESSION 表； 
另一个是pre_common_session 表，是所有用户在前台浏览页面时的 SESSION 表。 
这两个表都是内存表（内存表的读写速度远高于 MYISAM 表及文本文件）。

获取 session 的引用

在 discuz 的根目录下建立测试文件，test.php，添加内容：

<?php
    //由于没有使用 $_SESSION 变量，所以不需要 session_start() 函数。
    // init discuz x3
    require dirname(__FILE__). '/source/class/class_core.php';
    $discuz = C::app();
    $discuz->init();
    //var_dump($_G); // for debug
    var_dump($discuz->session); // for debug

    // discuz x2
    /*
    require dirname(__FILE__). '/source/class/class_core.php';
    $discuz = & discuz_core::instance();
    $discuz->init();
    */
获取cookie中的 session id

discuz 的 session id 是其自己控制的，所以这么获取

<?php
    require dirname(__FILE__). '/config/config_global.php'; //discuz 的配置文件
    $c_pre = $_config['cookie']['cookiepre'].substr(md5($_config['cookie']['cookiepath'].'|'.$_config['cookie']['cookiedomain']), 0, 4).'_';
    $sid = $_COOKIE[$c_pre.'sid'];
何时使用

整合其他系统
登陆状态同步。其他系统在登陆入口处检测 discuz 登陆状态，若已登陆则同步其登陆状态（通过把用户信息写到 cookie 和 session 或 数据库 里实现）