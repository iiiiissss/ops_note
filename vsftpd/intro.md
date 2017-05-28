sudo apt-get install vsftpd

restart vsftpd 
/etc/vsftpd.conf    vsftpd服务器的配置文件
/usr/sbin/vsftpd    vsftpd服务器的进程文件
/etc/pam.d/vsftpd   vsftpd服务器的PAM接口配置文件
/var/ftp            vsftpd服务器匿名用户的工作目录

http://wiki.ubuntu.org.cn/Vsftpd%E5%AE%9E%E4%BE%8B
http://www.blogjava.net/stonestyle/articles/369104.html
vsftpd中的用户有3种。匿名用户，本地用户。还有一种就是接下来介绍的虚拟用户，该用户无法登录你的操作系统，但是能够登录FTP服务器，而且当存在很多虚拟用户，您并不需要在操作系统上为每个虚拟用户新建一个不可登录的本地用户，只需要一个。而且还有一个更强大的用法，我们可以通过为每个虚拟帐号创建一个配置文件来不同虚拟帐号不同的权限，目录，这将对我们管理FTP用户有很大的方便。

1 新建user.txt，输入以下内容，表示有2个虚拟用户，分别为xuni1（密码pass1），xuni2（密码pass2）
xuni1
pass1
xuni2
pass2

2 接下来我们需要生成虚拟帐号数据库，先安装DB库工具
sudo apt-get install db4.8-util

在/etc下新建目录/etc/vsftpd
sudo mkdir /etc/vsftpd

将数据库文件导入到刚刚产生的目录
sudo db4.8_load -T -t hash -f /home/stone/user.txt /etc/vsftpd/vsftpd_login.db

db_load -T -t hash -f /etc/vsftpd/user.txt /etc/vsftpd/user.db

将数据库文件设置权限为600,并不需要被其他用户读，修改
sudo chmod 600 /etc/vsftpd/vsftpd_login.db

3 新建/etc/pam.d/vsftpd_login文件，输入以下内容
vsftpd_login
auth required /lib/i386-linux-gnu/security/pam_userdb.so db=/etc/vsftpd/vsftp_login
account required /lib/i386-linux-gnu/security/pam_userdb.so db=/etc/vsftpd/vsftp_login

/lib/x86_64-linux-gnu/security/pam_userdb.so

所有支持PAM的程序都有一个与PAM进行对接的配置文件，它们存放在/etc/pam.d目录，vsftpd与PAM的对接配置文件名可以由vsftpd.conf文件中的pam_service_name选项指定，默认是pam_service_name=vsftpd，当以后认证本地用户时，会根据/etc/pam.d/vsftpd文件的配置内容进行认证。

4 建立所有FTP虚拟用户帐号使用的操作系统帐号，需要我们自己新建目录，并设置该帐号工作目录的权限，所有者（貌似可以修改使之自动新建目录）
sudo useradd -d /home/ftpsite -s /sbin/nologin ftp_virt
sudo mkdir /home/ftpsite
sudo chown ftp_virt /home/ftpsite
sudo chgrp ftp_virt /home/ftpsite
sudo chmod 700 /home/ftpsite

5 在vsftpd.conf配置文件中添加有关虚拟帐号用户的配置内容
guest_enable=YES
guest_username=ftp_virt
pam_service_name=vsftpd_login

最后一项将于原来的默认值冲突，可以注释掉原来的项，重启vsftpd之后，你将发现本地用户无法登录vsftpd了

6 设置虚拟用户的权限，我们可以通过添加下面这一行，来指定放置用户配置文件的目录位置是/etc/vsftpd
user_config_dir=/etc/vsftpd

解释下这一项的作用，添加这一项之后，当我们以虚拟用户登录vsftpd时，服务器将会寻找/etc/vsftpd目录下于虚拟用户名相同的配置文件，从而确定该虚拟用户的权限等属性。这方便了我们管理FTP虚拟用户。

7 配置虚拟用户配置文件
在/etc/vsftpd下，我们新建文件xuni1，输入以下内容
xuni1
local_root=/home/ftpsite
新建文件xuni2，输入以下内容
xuni2
local_root=/home/ftpsite
anon_mkdir_write_enable=YES
anon_other_write_enable=YES
anon_upload_enable=YES
anon_world_readable_only=YES
write_enable=YES

8 然后重启vsftpd
先关闭
sudo killall vsftpd
启动
sudo /usr/sbin/vsftpd /etc/vsftpd.conf &

/etc/ftpusers 禁止访问的用户列表
touch /etc/vsftpd.chroot_list  # 加入ftp用户ftp_virt

https://my.oschina.net/gllfeixiang/blog/298025



/etc/vsftpd.user_list   /etc/vsftpd/ftpusers 限制



=============
apt-get install vsftpd db5.3-util 
创建一个文本,在/etc/vsftpd/下
touch loguser.txt
内容:
 vim loguser.txt 
mcyun-plugin-manager
111111
生成数据文件:
 db5.3_load -T -t hash -f /etc/vsftpd/loguser.txt /etc/vsftpd/vsftpd_login.db
修改权限:
chmod 600 /etc/vsftpd/vsftpd_login.db
配置pam文件:
vim /etc/pam.d/vsftpd
将原有的全都注释掉,并添加以下两行,(坑来了,)
auth sufficient /etc/vsftpd/pam_userdb.so db=/etc/vsftpd/vsftpd_login
account sufficient /etc/vsftpd/pam_userdb.so db=/etc/vsftpd/vsftpd_login

通过locate pam_userdb.so,查找pam_userdb.so
并做一个ln连接
locate pam_userdb.so
cd /etc/vsftpd/ 
ln -s /lib/x86_64-linux-gnu/security/pam_userdb.so pam_userdb.so

创建虚拟用户/本地用户:(在坑)
adduser vsftpd --home /mnt/gluster/mcyun_vo_1/ --shell /bin/false
添加下面两行到/etc/shells
/bin/false

修改配置文件:
listen=YES
anonymous_enable=NO 
dirmessage_enable=YES 
xferlog_enable=YES 
xferlog_file=/var/log/vsftpd.log 
xferlog_std_format=YES 
chroot_local_user=YES 
guest_enable=YES 
guest_username=vsftpd
user_config_dir=/etc/vsftpd_user_conf 
pam_service_name=vsftpd
local_enable=YES 
secure_chroot_dir=/var/run/vsftpd

创建目录/文件:
mkdir /etc/vsftpd_user_conf && cd /etc/vsftpd_user_conf
touch mcyun-plugin-manager
vim mcyun-plugin-manager
local_root=/mnt/gluster/mcyun_vo_1/resources
anon_world_readable_only=NO(下载权限)
anon_umask=022 （修改文件内容权限）
write_enable=YES （写权限）
anon_mkdir_write_enable=YES (新建目录权限)
anon_upload_enable=YES（上传权限）
anon_other_write_enable=YES（删除/重命名的权限）

chmod o+w plugins/

500 OOPS: vsftpd: refusing to run with writable root inside chroot()
如果出现该错误，说明你ftp主文件夹的权限太大了，要去掉root，如下： chmod -x /home/vsftpd 就OK了！ 
为了避免一个安全漏洞，从 vsftpd 2.3.5 开始，chroot 目录必须不可写。使用命令：
chmod a-w /home/vsftpd
chmod a-w /home/vsftpd/dbzh1
chmod a-w /home/vsftpd/dbzh2
chmod a-w /home/vsftpd/dbzh3
或者添加allow_writeable_chroot=YES到配置文件中

500 OOPS: bad bool value in config file for: anon_upload_enable
检查配置文件,应该是多了一个空格

当配置文件里面多了一个空格的时候,会发现vsftpd起不来,
netstatat -alntp | grep 21
发现根本没有那个服务



新增用户:
//用户账号密码 /etc/vsftpd/user.txt 追加方式
建目录: /data/ftpdata/
//用户权限配置 /etc/vsftpd/user_conf/$ftp_name
anon_world_readable_only=NO
local_root=/data/ftpdata/ttps_ftp_3

anon_mkdir_write_enable=YES
anon_other_write_enable=YES
anon_upload_enable=YES
anon_world_readable_only=YES
write_enable=YES

///etc/vsftpd.user_list 加用户名
//db_load -T -t hash -f /etc/vsftpd/user.txt /etc/vsftpd/user.db
//重启vsftp   service vsftpd restart

