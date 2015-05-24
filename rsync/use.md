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



-a 归档模式 递归传递
-v 输出详细

