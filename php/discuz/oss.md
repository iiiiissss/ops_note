Discuz实现oss云存储
https://bbs.aliyun.com/read/120199.html?pos=3  =>
https://bbs.aliyun.com/read/120631.html?spm=5176.bbsr120631.0.0.4jhBLp


https://bbs.aliyun.com/read/271101.html?pos=1
https://bbs.aliyun.com/read/239257.html

安装Discuz!程序的扩展框架,七牛云|阿里云|又拍云: 
http://www.discuz.net/thread-3334048-1-1.html
http://www.discuz.net/thread-3608717-1-1.html

/extend/vendor/storage/aliyun/sdk.class.php 第72行，默认用了杭州的OSS了！ 
const DEFAULT_OSS_HOST = 'oss.aliyuncs.com'; 
改成青岛的const DEFAULT_OSS_HOST = 'oss-cn-qingdao.aliyuncs.com'; 

只能涌入上传帖子图片，但是如果要进行推送，那么生成的缩略图回存在很大问题，在多种设置条件下，要么设置后图片会自动消失，要么是权限不足，总之就是不能用于推送的裁剪的缩略图，，，，只能是普通的帖子标题类型


1.推送模块数据不能剪裁图片，需要自己修改DZ文件。 
2.扩展里缺少ftp_size方法  
导致DIY数据模块更新时候无限覆盖OSS上的缩率图， 


缩率图问题很好解决的哈， http://bbs.aliyun.com/attachment/Fid_211/211_1996005929542064_e9dd6f61c5d3298.jpg?18 
在插件的discuz_ftp_ext.php里加一段这个，就不会无限覆盖缩率图


DZ 文件下 /source/module/misc/misc_imgcropper.php 
http://bbs.aliyun.com/attachment/Fid_211/211_1996005929542064_2f1b235e3326fc2.jpg?19
增加一段这个，就可以成功剪裁图片 并且发送到OSS上 




2.完成步骤1操作后需要转换数据库的本地附件的数据为远程附件数据 
 
涉及到的数据库表： 
 
引用
pre_forum_attachment 
pre_home_pic 
pre_portal_article_title 
pre_portal_attachment 
pre_portal_topic_pic
 
 
 
在后台--站长--数据库--升级--分别执行如下代码 
 
1、pre_forum_attachment 
 
引用
update pre_forum_attachment_0 set remote = '1'; 
update pre_forum_attachment_1 set remote = '1'; 
update pre_forum_attachment_2 set remote = '1'; 
update pre_forum_attachment_3 set remote = '1'; 
update pre_forum_attachment_4 set remote = '1'; 
update pre_forum_attachment_5 set remote = '1'; 
update pre_forum_attachment_6 set remote = '1'; 
update pre_forum_attachment_7 set remote = '1'; 
update pre_forum_attachment_8 set remote = '1'; 
update pre_forum_attachment_9 set remote = '1';
 
 
2、pre_portal_article_title，pre_portal_attachment，pre_portal_topic_pic 
 
引用
update pre_portal_article_title set remote=1; 
update pre_portal_attachment set remote=1; 
update pre_portal_topic_pic set remote=1;
 
 
3、由于相册表中的remote取值还有一种情况为remote=2(论坛附件图片保存到相册)pre_home_pic，执行语句： 
 
引用
update pre_home_pic set remote=remote+1;
 
 
 
按照以上操作后，打开网站附件--属性看看是否已经在远程地址上了，大功告成。 
 
PS：由于某些原因我们帖子和门户文章图片路径是写死的，诸如采集的时候很多人图方便都是直接写死img src的，接下来介绍如何修改论坛帖子和门户文章里面的img url路径为我们的云存储 
1.修改修改论坛帖子img url（将字段帖子表内容字段message中的data/attachment替换为http://img.bcxue.com/data/attachment）这种格式的 
引用
UPDATE `pre_forum_post` SET `message` = replace(message, 'data/attachment', 'http://img.bcxue.com/data/attachment')  WHERE  `message` LIKE '%data/attachment/%';
 
 
[font=Verdana, 'Microsoft YaHei', Tahoma, Simsun, sans-serif]意思是把discuz论坛帖子内容表中存贮内容的字段message中包含data/attachment替换为我们的http://img.bcxue.com/data/attachment云存储路径，用到了mysql的replace 字符替换函数 
 
2.[font=Verdana, 'Microsoft YaHei', Tahoma, Simsun, sans-serif]修改门户文章帖子img url 
 
 
引用
UPDATE `pre_portal_article_content` SET `content` = replace(content, 'data/attachment', 'http://img.it-home.org') WHERE `content` LIKE '%data/attachment/%';
 
 
好了，通过以上几点就完成了discuz 图片附件迁移阿里云oss的全部过程了。 
 
具体可以去http://bbs.it-home.org/ 随便打开一张图片，看效果，有不懂的可以继续跟帖 
 