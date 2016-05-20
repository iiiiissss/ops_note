确保 NFS 服务器和 NFS 客户机 (Linux) 的非 root 用户共享同一个 UID 或 GID。否则，必须使用 adduser -u user-id user-name 命令来添加共享同一个用户标识或组标识的用户。



adduser -u user-id mc-r5mNzND465FY86wRwnx38m


有交互
adduser -u 1005 mc-r5mNzND465FY86wRwnx38m --force-badname

无交互
useradd mc-r5mNzND465FY86wRwnx38m -u 1005




方法一：使用 id 命令
使用 id 命令可以很轻松的通过用户名查看UID、GID，下面来讲解一下这个命令的用法。

命令格式

id [选项]... [用户名]
命令选项

-a 忽略，兼容其它版本
-Z, –context 只输出当前用户的安全上下文
-g, –group 只输出有效的GID
-G, –groups 输出所有的GID
-n, –name 对于 -ugG 输出名字而不是数值
-r, –real 对于 -ugG 输出真实ID而不是有效ID
-u, –user 只输出有效UID
–help 输出帮助后退出
–version 输出版本信息后退出
使用案例

heihaier@heihaier-desktop:~$ id root
uid=0(root) gid=0(root) groups=0(root)
方法二：查看 /etc/password 文件
/etc/password 文件格式

root:x:0:0:root:/root:/bin/bash