http://wiki.ubuntu.org.cn/AdvancedOpenSSH


/etc/ssh/sshd_config�����ļ��е�UseDNS����Ϊyes���޸�Ϊno

scp  -P 9989  root@192.168.8.138:/home/ligh/index.php    root@192.168.8.139:/root

ls ~/.ssh/
ssh-rsa 
ssh-keygen -t rsa -P ''

cat id_rsa.pub >> .ssh/authorized_keys

/etc/ssh/ssh_config

vi /etc/ssh/sshd_config
RSAAuthentication yes # ���� RSA ��֤
 PubkeyAuthentication yes # ���ù�Կ˽Կ�����֤��ʽ
 AuthorizedKeysFile .ssh/authorized_keys # ��Կ�ļ�·��, �����ļ�������������ӽ���
 PermitEmptyPasswords yes
 ����SSH���� service ssh restart 
 /etc/init.d/ssh restart ?
 ��¼�Ļ��ӿ���˽Կ������¼�Ļ���Ҫ�е�¼���ӵĹ�Կ. ��Կ�͹�Կ�Ƕ�Ӧ��, ��һ����(Ҫ��ֹ����id_rsa)

$chmod 600 authorized_keys

$scp authorized_keys summer@10.0.5.198:/home/summer/.ssh   ------�Ѹող�����authorized_keys�ļ���һ�ݵ�����B��.����
$chmod 600 authorized_keys    
=>A $ssh-copy-id -i ubuntu@192.168.1.121(Bip)   ##�ӹ�Կ��Զ�̻�

���˽Կ
vi /home/ubuntu/.ssh/config
Host hdu-one
  IdentityFile ~/.ssh/privatekey/id_rsa.hdu-one
  User ubuntu
~                



/etc/ssh/sshd_config��sshd�������������ļ�

/etc/ssh/ssh_config��ssh�ͻ����������ļ�

/etc/ssh/ssh_host_key��SSH1�õ�RSA˽Կ

/etc/ssh/ssh_host_key.pub��SSH1�õ�RSA��Կ

/etc/ssh/ssh_host_rsa_key��SSH2�õ�RSA˽Կ

/etc/ssh/ssh_host_rsa_key.pub��SSH2�õ�RSA��Կ

/etc/ssh/ssh_host_dsa_key��SSH2�õ�DSA˽Կ

/etc/ssh/ssh_host_dsa_key.pub��SSH2�õ�DSA��Կ


������/etc/ssh/sshd_config������AllowUsers:username(���Զ��,�ո�ֿ�)����ͨ�û�����sshȨ��
Ҳ������������;ܾ�ssh���û�/�û��飺 
DenyUsers:username,DenyGroups:groupname
���ȼ����£� 
DenyUsers:username 
AllowUsers:username 
DenyGroups:groupname 
AllowGroups:groupname



����ģʽ:

ֱ�ӱ༭~/.ssh/config�ļ�������ProxyCommandѡ�������������
Host target.machine
    User          targetuser
    HostName      target.machine
    ProxyCommand  ssh proxyuser@proxy.machine nc %h %p 2> /dev/null
ע�⣺~/.ssh/config�ļ��кܶ�amazing��ѡ�������Բο����http://blog.tjll.net/ssh-kung-fu
���ڣ�ֻ��Ҫͨ�����������򵥵�����½Զ�̼������
ssh target.machine
������ֱ��SCP��ȥ���������ȫ͸����
scp ToCopy.txt target.machine:~


���ʺϱ༭~/.ssh/ssh_config�ļ�����Ҫ�ýű����з�װ����ˣ�������������ʹ��ProxyCommand��
ֱ������Զ�̼����
  ssh -o "ProxyCommand ssh -p 1098 lmx@proxy.machine nc -w 1 %h %p" -p 1098 lmx@target.machine
�����ļ���Զ�̼����
  scp -o "ProxyCommand ssh -p 1098 lmx@proxy.machine nc -w 1 %h %p" -P 1098 -r lmx@target.machine:~/rdsAgent .
��Զ�̼����ִ������
  ssh -o "ProxyCommand ssh -p 1098 lmx@proxy.machine nc -w 1 %h %p" -p 1098 lmx@target.machine 'ip a'