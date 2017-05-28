

安装软件包：
sudo apt-get install subversion

之后选择SVN服务文件及配置文件的放置位置。我放在了/srv下的svn目录。

svn://guest@project-ddnas.openmobilefree.net/trunk  
--username 

cd /srv
sudo mkdir svn
我的svn版本仓库叫tone_src

cd /srv/svn

sudo mkdir tone_src

目录建好后　创建版本仓库

sudo svnadmin create /srv/svn/tone_src

执行之后 tone_src下文件结构如下：　　

tone@ubuntu:/srv/svn/tone_src$ ls -l
总用量 24
drwxr-xr-x 2 root root 4096  1月 15 10:52 conf
drwxr-sr-x 6 root root 4096  1月 15 14:52 db
-r--r--r-- 1 root root    2  1月 15 10:50 format
drwxr-xr-x 2 root root 4096  1月 15 10:50 hooks
drwxr-xr-x 2 root root 4096  1月 15 10:50 locks
-rw-r--r-- 1 root root  246  1月 15 10:50 README.txt

下面进行配置：

我们需要修改conf目录下的三个文件，authz;passwd;svnserve.conf

编辑svnserve.conf

[general]
#匿名用户不可读
anon-access = none
#权限用户可写
auth-access = write
#密码文件为passwd
password-db = passwd
#权限文件为authz
authz-db = authz

编辑authz 制定管理员组 即admin组的用户为tone admin组有rw（读写权限） 所有人有r（读权限）

[groups]
admin= tone

[/]
@admin =rw
*=r

这里组的名字 不一定叫admin 你的管理员组名 可以叫做任意的名字，另外比如admin组还有其他用户，可以这样制定 admin=tone，tone1,tone2 类似这样的写法

编制passwd 文件 设定用户密码

[users]
# harry = harryssecret
# sally = sallyssecret
tone=www

tone的密码为www 对 没看错 明文的。

以上都做完之后，就可以开启你的svn服务器了。

sudo svnserve -d -r /erv/svn/

-d 已守护模式启动

-r 制定svn版本库根目录 这样是便于客户端不用输入全路径 就可以访问版本库了

例如：svn：//127.0.0.1/tone_src

值得注意的是 我这里是用sudo 启动的  因为之前的svn目录 及tone_src目录 我都是在sudo下创建的。目录的所属权限都是root

如果我以 下面的方式启动 是可以的 但是当客户段提交文件的时候 会出问题，因为此时的svnserve 服务对svn版本库目录没有写的权限
svnserve -d -r /erv/svn/

强制恢复为线上版本
svn revert  xxx.txt   