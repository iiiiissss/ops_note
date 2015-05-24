http://www.cnblogs.com/CSGrandeur/p/3754126.html
sudo apt-get install vsftpd
配置vsftpd.conf
sudo nano /etc/vsftpd.conf
复制代码
#禁止匿名访问
anonymous_enable=NO
#接受本地用户
local_enable=YES
#允许上传
write_enable=YES
#用户只能访问限制的目录
chroot_local_user=YES
#设置固定目录，在结尾添加。如果不添加这一行，各用户对应自己的目录，当然这个文件夹自己建
local_root=/home/ftp
复制代码
看网上说加一行“pam_service_name=vsftpd”，我看我这个配置文件本来就有，就不管了。

添加ftp用户

sudo useradd -d /home/ftp -M ftpuser
sudo passwd ftpuser
调整文件夹权限

这个是避免“500 OOPS: vsftpd: refusing to run with writable root inside chroot()”

sudo chmod a-w /home/ftp
sudo mkdir /home/ftp/data
这样登录之后会看到data文件夹，虽然稍麻烦，原因不表了。。查资料这么辛酸已经不易。。

改pam.d/vsftpd

这时候直接用useradd的帐号登录ftp会530 login incorrect

sudo nano /etc/pam.d/vsftpd
注释掉 

#auth    required pam_shells.so
重启vsftpd

sudo service vsftpd restart
这时就可以用刚才建的ftpuser这个用户登录ftp了，看到的是local_root设置的/home/ftp，并且限制在该目录。

可以在浏览器用ftp://xxx.xxx.xxx.xxx访问，也可以用ftp软件比如flashFXP，密码就是ftpuser的密码。
关于用户访问文件夹限制

由chroot_local_user、chroot_list_enable、chroot_list_file这三个文件控制，转别人的一段话：

首先，chroot_list_enable好理解，就是：是否启用chroot_list_file配置的文件，如果为YES表示chroot_list_file配置的文件生效，否则不生效；
第二，chroot_list_file也简单，配置了一个文件路径，默认是/etc/vsftpd.chroot_list，该文件中会填入一些账户名称。但是这些账户的意义不是固定的，是跟配置项chroot_local_user有关的。后一条中说明；
第三，chroot_local_user为YES表示所有用户都*不能*切换到主目录之外其他目录，但是！除了chroot_list_file配置的文件列出的用户。chroot_local_user为NO表示所有用户都*能*切换到主目录之外其他目录，但是！除了chroot_list_file配置的文件列出的用户。也可以理解为，chroot_list_file列出的“例外情况”的用户。

 如果客户端登录时候提示“以pasv模式连接失败”

编辑/etc/vsftpd.conf
最后添加
pasv_promiscuous=YES
然后再重启vsftpd服务。