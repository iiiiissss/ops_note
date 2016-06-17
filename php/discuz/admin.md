核心: discuz_admincp.php
check_cpaccess
check_admin_login 设置

模版在程序中:

$menu['forum'] = array(
        array('menu_forums', 'forums'),
复制代码
回车新加一行, 注册逗号之类的. 按上下规则来增加
  array('信息管理', 'threadlist'),     'threadlist'表示调用的php文件, 完整路径为 source/admincp/admincp_threadlist.php