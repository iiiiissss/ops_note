启动: /usr/bin/rsync --daemon

**不同模式**
本地:
rsync -av ./from ./to  #复制含目录
./from/ ./to  #(有/ ,复制目录下的文件)

远程shell:(只能用ssh模式的帐号密码)
rsync -av ./from root@192.168.1.149:/to


服务器模式:




查看远程/本地:
rsync -a 192.168.1.149/dir

/img1.kootv.com

-a 归档模式 递归传递
-v 输出详细
-u 更新
-z 压缩

sudo rsync -avuz --exclude-from=exclude.list $WORK_DIR test@web1::webapps/www.kootv.com

sudo rsync -avuz test.txt test@streamedge3::apps/go

[/etc/rsyncd.conf]
uid = root
gid = root
use chroot = no
max connections = 50
pid file = /var/run/rsyncd.pid
lock file = /var/run/rsync.lock
log file = /var/log/rsyncd.log
munge symlinks = no
[webapps]
path = /data/apps/webapps
comment = files
read only = no
hosts allow = 192.168.200.0/24,192.168.30.0/24,192.168.70.0/24

