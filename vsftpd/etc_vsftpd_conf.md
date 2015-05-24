
userlist_deny=NO
userlist_enable=YES
userlist_file=/etc/allowed_users
seccomp_sandbox=NO

local_enable=YES
write_enable=YES
local_umask=022

listen=YES  #
listen_ipv6=YES    # listen=YES和listen_ipv6=YES 设为YES表示将以独立的方式运行（可自行单独启动的daemon），前者监听ipv4，后者监听ipv6,但两者不能同时在一个配置文件中设置

anonymous_enable=YES        # 表示允许匿名用户登录FTP服务器
anon_world_readable_only=NO    # 只要ftp用户在操作系统中有读权限，就可以下载文件
anon_root=/var/ftp/anonymous    # 匿名用户登录后进入到/var/ftp/anonymous目录中，可以下载该目录中的文件
anon_uploads_enable=YES        # 匿名用户可以上传文件
anon_mkdir_write_enable=YES    # 匿名用户可以在服务器上创建目录
anon_other_write_enable=YES     # 匿名用户可以在服务器上进行命名，删除等写操作

local_enable=YES        # 表示允许本地用户帐号登录
local_umask=022            # 表示本地用户创建新的文件时，该文件初始的权限值。022表示初始的权限值是创建者有全部的权限，其他用户（包括组用户，其他用户）只有读和执行权限，077表示初始创建者具有全部权限，其他用户没有权限

write_enable=YES        # 表示服务器接收与写有关的控制命令

dirmessage_enable=YES        # 表示用户第一次进入一个新目录时，会给用户一些提示信息
use_localtime=YES        # 表示服务器显示本地时区时间，默认是显示GMT时间


xferlog_enable=YES        # 允许产生日志
xferlog_std_format=YES        # 日志采用标准的xferlog格式
xferlog_file=/var/log/vsftpd.log# 日志文件以及所在目录

connect_from_port_20=YES    # 使用20端口作为建立数据连接时的源端口

pam_service_name=vsftpd        # 指定PAM服务配置文件的名字，在/etc/pam.d

chown_uploads=YES        # 这两个选项是一对相关的配置，表示匿名用户上传的文件所以者将变为whoever，这个配置是为了安全目的
chown_username=whoever        # 文件所有者变为其他用户后，匿名用户将不能再对文件进行删除，甚至读操作，例如作业上交FTP

idle_session_timeout=600    # 表示控制连接的超时值为600秒
data_connection_timeout=120    # 表示数据连接的超时值为120秒

nopriv_user=ftpsecure        # 表示当vsftpd进程处于非特权运行状态时，所使用的用户身份是ftpsecure

async_abor_enable=NO        # 表示vsftpd支持”async ABOR“的FTP命令，这条命令会影响vsftpd的安全，一般使用默认的NO设置

ascii_upload_enable=YES
ascii_download_enable=YES    # 表示上传下载文件时真正允许ASCII模式。有些FTP服务器在实现ACSII传输模式时，容易遭受DoS攻击。为了避免这种情况的发送，vsftpd给客户端回应时可以假装允AXSCII模式，但实际上使用的是binary模式，通过把这两个值设置为NO来达到。

ftpd_banner=Welcome to stone FTP service.    # 表示用户登录时，将显示Welcome to stone FTP service信息，没有这个选项时，将显示vsftpd服务器的名称和版本信息，存在安全问题，因而这样做的目的是为了隐藏这些信息

deny_email_enable=YES                # 匿名用户如果输入aaa@做为登录密码，将被拒绝，主要目的是为了防止一些自动登录工具进行登录。
banned_email_file=/etc/vsftpd.banned_emails    # 指定的deny_mail的文件

chroot_list_enable=YES                # 这两个选项制定了一个用户列表，这个列表放在/etc/vsftpd/chroot_list文件中。当 chroot_local_user
chroot_list_file=/etc/vsftpd/chroot_list    # 设为NO后，这些用户登录FTP服务器后，他们看到的根目录是他们自己的个人目录，也就是说虽然在实际的文件系统中，这些用户个人目录的上级还有目录，但是不能切换到这些上级目录

chroot_local_user=YES                # 当chroot_local_user被设置为YES时，上述用户列表将不会被限制在个人目录中，可以进一步转到其他目录

ls_recurse_enable=YES        # 表示客户端在使用ls命令时可以加-R参数，-R参数表示ls命令可以列出整个目录树的内容，需要一些处理时间，特别存在恶意用户时，情况会更严重

anon_max_rate=0        # 用于设置匿名用户客户端能够达到的最大速率，其值是一个数值，单位为b/s，0表示无限制
local_max_rate=0    # 该选项限制的是本地用户的速率
max_clients=0        # vsftpd能接收的最大客户端连接数
max_per_ip=5        # 限制每一台主机可以连入的客户端数，用户为了加快下载速度，可能会打开很多的客户端连接，影响其他用户的正常使用
