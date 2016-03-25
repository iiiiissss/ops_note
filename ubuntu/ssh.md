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
