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
