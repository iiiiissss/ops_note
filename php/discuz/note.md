调试模式开启
config_global.php
 $_config['debug'] = 1;//1严重错误 2警告级别错误
 
 db要改三处:
 /config/config_global.php
 /config/config_ucenter.php
 /uc_server/data/config.inc.php
 
 
 
 cat uc_server/data/cache/apps.php
<?php
$_CACHE['apps'] = array (
  1 => 
  array (
    'appid' => '1',
    'type' => 'DISCUZX',
    'name' => 'Discuz! Board',
    'url' => 'http://192.168.1.198',
    'authkey' => '0852t1Qe13XeT2D121F2i3c1036dgf8fe8Rfk5YdW6P6m6v1D1O8u6I1efBaG1U1',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => '',
    'dbcharset' => '',
    'synlogin' => '1',
    'recvnote' => '1',
    'extra' => 
    array (
      'apppath' => '',
      'extraurl' => 
      array (
      ),
    ),
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
        <item id="template"><![CDATA[]]></item>
</root>',
    'allowips' => '',
  ),
);