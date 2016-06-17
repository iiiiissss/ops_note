http://wiki.ubuntu.org.cn/AdvancedOpenSSH


/etc/ssh/sshd_config配置文件中的UseDNS设置为yes，修改为no

scp  -P 9989  root@192.168.8.138:/home/ligh/index.php    root@192.168.8.139:/root

ls ~/.ssh/
ssh-rsa 
ssh-keygen -t rsa -P ''

cat id_rsa.pub >> .ssh/authorized_keys

/etc/ssh/ssh_config

vi /etc/ssh/sshd_config
RSAAuthentication yes # 启用 RSA 认证
 PubkeyAuthentication yes # 启用公钥私钥配对认证方式
 AuthorizedKeysFile .ssh/authorized_keys # 公钥文件路径, 允许文件里面的主机连接进来
 PermitEmptyPasswords yes
 重启SSH服务： service ssh restart 
 /etc/init.d/ssh restart ?
 登录的机子可有私钥，被登录的机子要有登录机子的公钥. 密钥和公钥是对应的, 改一不可(要防止覆盖id_rsa)

$chmod 600 authorized_keys

$scp authorized_keys summer@10.0.5.198:/home/summer/.ssh   ------把刚刚产生的authorized_keys文件拷一份到主机B上.　　
$chmod 600 authorized_keys    
=>A $ssh-copy-id -i ubuntu@192.168.1.121(Bip)   ##加公钥到远程机

多个私钥
vi /home/ubuntu/.ssh/config
Host hdu-one
  IdentityFile ~/.ssh/privatekey/id_rsa.hdu-one
  User ubuntu
~                



/etc/ssh/sshd_config：sshd服务器的设置文件

/etc/ssh/ssh_config：ssh客户机的设置文件

/etc/ssh/ssh_host_key：SSH1用的RSA私钥

/etc/ssh/ssh_host_key.pub：SSH1用的RSA公钥

/etc/ssh/ssh_host_rsa_key：SSH2用的RSA私钥

/etc/ssh/ssh_host_rsa_key.pub：SSH2用的RSA公钥

/etc/ssh/ssh_host_dsa_key：SSH2用的DSA私钥

/etc/ssh/ssh_host_dsa_key.pub：SSH2用的DSA公钥


可以在/etc/ssh/sshd_config中增加AllowUsers:username(可以多个,空格分开)给普通用户增加ssh权限
也可以设置允许和拒绝ssh的用户/用户组： 
DenyUsers:username,DenyGroups:groupname
优先级如下： 
DenyUsers:username 
AllowUsers:username 
DenyGroups:groupname 
AllowGroups:groupname



代理模式:

直接编辑~/.ssh/config文件，增加ProxyCommand选项，像下面这样：
Host target.machine
    User          targetuser
    HostName      target.machine
    ProxyCommand  ssh proxyuser@proxy.machine nc %h %p 2> /dev/null
注意：~/.ssh/config文件有很多amazing的选项，具体可以参考这里：http://blog.tjll.net/ssh-kung-fu
现在，只需要通过下面这样简单的语句登陆远程计算机：
ssh target.machine
还可以直接SCP过去，跳板机完全透明：
scp ToCopy.txt target.machine:~


不适合编辑~/.ssh/ssh_config文件，需要用脚本进行封装，因此，我像下面这样使用ProxyCommand：
直接跳到远程计算机
  ssh -o "ProxyCommand ssh -p 1098 lmx@proxy.machine nc -w 1 %h %p" -p 1098 lmx@target.machine
拷贝文件到远程计算机
  scp -o "ProxyCommand ssh -p 1098 lmx@proxy.machine nc -w 1 %h %p" -P 1098 -r lmx@target.machine:~/rdsAgent .
在远程计算机执行命令
  ssh -o "ProxyCommand ssh -p 1098 lmx@proxy.machine nc -w 1 %h %p" -p 1098 lmx@target.machine 'ip a'