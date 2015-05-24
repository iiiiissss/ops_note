sudo apt-get install vsftpd

restart vsftpd 
/etc/vsftpd.conf    vsftpd服务器的配置文件
/usr/sbin/vsftpd    vsftpd服务器的进程文件
/etc/pam.d/vsftpd   vsftpd服务器的PAM接口配置文件
/var/ftp            vsftpd服务器匿名用户的工作目录

http://www.blogjava.net/stonestyle/articles/369104.html
vsftpd中的用户有3种。匿名用户，本地用户。还有一种就是接下来介绍的虚拟用户，该用户无法登录你的操作系统，但是能够登录FTP服务器，而且当存在很多虚拟用户，您并不需要在操作系统上为每个虚拟用户新建一个不可登录的本地用户，只需要一个。而且还有一个更强大的用法，我们可以通过为每个虚拟帐号创建一个配置文件来不同虚拟帐号不同的权限，目录，这将对我们管理FTP用户有很大的方便。

1 新建user.txt，输入以下内容，表示有2个虚拟用户，分别为xuni1（密码pass1），xuni2（密码pass2）
user.txt
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

将数据库文件设置权限为600,并不需要被其他用户读，修改
sudo chmod 600 /etc/vsftpd/vsftpd_login.db

3 新建/etc/pam.d/vsftpd_login文件，输入以下内容
vsftpd_login
auth required /lib/i386-linux-gnu/security/pam_userdb.so db=/etc/vsftpd/vsftp_login
account required /lib/i386-linux-gnu/security/pam_userdb.so db=/etc/vsftpd/vsftp_login

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