netstat -altnp|grep 9000
netstat -an|awk '/tcp/ {print $6}'|sort|uniq -c
netstat -ae |grep mysql
�鿴�˿�ռ��
sudo lsof -i tcp:8080         #mac

dns �������
sudo /etc/init.d/nscd restart
sudo aptitude install nscd
sudo /etc/init.d/nscd restart 
��ʵ����Ҳ����ֱ��
sudo /etc/init.d/dns-clean start
up

vi /etc/resolvconf/resolv.conf.d/base������ļ�Ĭ���ǿյģ�
��������룺
nameserver 8.8.8.8
nameserver 8.8.4.4
����ж��DNS��һ��һ��
�޸ĺñ��棬Ȼ��ִ��
sudo resolvconf -u
�ٿ�/etc/resolv.conf��������Ͷ���2�У�

SIOCSIFFLAGS: Cannot assign requested address

ifconfig em1:0 103.57.111.228/24
route add default gw 103.57.111.230 dev em1:0

curl 'https://api.ipify.org?format=json'

ifconfig em1 up

��ip:
auto lo
iface lo inet loopback

# The primary network interface
auto p2p1
#iface p2p1 inet dhcp
iface p2p1 inet static
address 192.168.1.201
netmask 255.255.255.0
#gateway 192.168.1.100
gateway 192.168.1.1

auto p2p1:0
iface p2p1:0 inet static
address 192.168.1.241
netmask 255.255.255.0

���������һ��IP:
sudo apt-get install ifenslave
vi /etc/modules   :   bonding mode=1 miimon=100           0����,1����


vi /etc/network/interfaces
�����������ݣ�
auto bond0
iface bond0 inet static
address 192.168.2.3
netmask 255.255.255.0
gateway 192.168.2.1
post-up ifenslave bond0 eth0 eth1
pre-down ifenslave -d bond0 eth0 eth1


2�����İ�/etc/modules �е����ݸ�Ϊ��
bonding mode=1 miimon=100 max_bonds=2

�޸���������:
/etc/udev/rules.d/70-persistent-net.rules
��������:
dmesg|grep eth

# The loopback networkinterface
auto lo
iface lo inet loopback
auto p1p1
iface p1p1 inet static
address 172.16.0.2
netmask 255.255.255.0
auto p1p2
iface p1p2 inet static
  address 172.16.1.2
  netmask 255.255.255.0
auto bond0
iface bond0 inet static
  address 14.17.64.2
  netmask 255.255.255.0
  gateway 14.17.64.1
  dns-nameservers 114.114.114.114
  up ifenslave bond0 p1p1 p1p2
  down ifenslave -d bond0 p1p1 p1p2



http://www.linuxdown.net/config/2016/0210/4629.html

�������ʵ��sun��cisco���Ѿ����ڣ��ֱ��ΪTrunking��etherchannel������
��linux�У����ּ�����Ϊbonding��
��Ϊbonding���ں�2.4.x���Ѿ������ˣ�
ֻ��Ҫ�ڱ����ʱ��������豸ѡ���е� Bonding driver supportѡ�оͿ����ˡ�
Ȼ�����±�����ģ������𶯼������ִ���������
 
����ismod bonding
����ifconfig eth0 down
����ifconfig eth1 down
����ifconfig bond0 ipaddress
����ifenslave bond0 eth0
����ifenslave bond0 eth1
 
�����������������Ѿ���һ��һ�������ˣ�����������߼�Ⱥ�ڵ������ݴ��䡣
��������ð��⼸��д��һ���ű�,����/etc/rc.d/rc.local���ã�
�Ա�һ��������Ч��
����bonding���ڷ��������Ǹ��ȽϺõ�ѡ����û��ǧ������ʱ��
��������100�������� bonding���ɴ����߷�������������֮��Ĵ���
������Ҫ�ڽ���������������bonding ��������������ӳ��Ϊͬһ������ӿڡ�




route��ͨ
sudo route add -net 10.6.0.0/24 gw 10.6.0.254 dev eth1
sudo route add -net 10.6.1.0/24 dev eth1
sudo route add -net 10.6.4.0/24 dev eth1
sudo route add -net 10.6.15.0/24 dev eth1


�鿴����:
apt-get install iftop

sudo ifup --no-act p2p1  #����﷨

sudo ifdown p2p1:1 && sudo ifup p2p1:1
��sudo����

linux�������󶨵�7��ģʽ��
mode=0 ��ʾ load balancing (round-robin)Ϊ���ؾ��ⷽʽ������������������ 
mode=1 ��ʾ fault-tolerance (active-backup)�ṩ���๦�ܣ�������ʽ���� �ӵĹ�����ʽ,Ҳ����˵Ĭ�������ֻ��һ����������,��һ�������ݡ�  
mode=2 ��ʾ XOR policy Ϊƽ����ԡ���ģʽ�ṩ����ƽ����ݴ�����  
mode=3 ��ʾ broadcast Ϊ�㲥���ԡ���ģʽ�ṩ���ݴ�����  
mode=4 ��ʾ IEEE 802.3ad Dynamic link aggregation Ϊ IEEE 802.3ad Ϊ ��̬���Ӿۺϡ��ò��Կ���ͨ�� xmit_hash_policy ѡ���ȱʡ�� XOR ���Ըı䵽�������ԡ�  
mode=5 ��ʾ Adaptive transmit load balancing Ϊ���������为�ؾ��⡣�� ģʽ�ı�Ҫ������ethtool ֧�ֻ�ȡÿ�� slave ������  
mode=6 ��ʾ Adaptive load balancing Ϊ��������Ӧ�Ը��ؾ��⡣��ģʽ���� �� balance-tlb ģʽ��ͬʱ������� IPV4 �����Ľ��ո��ؾ���(receive load   balance, rlb)�����Ҳ���Ҫ�κ� switch(������)��֧�֡� 



route add -p 61.156.0.0 mask255.255.0.0 192.168.1.1�����ָ��涨���Ǵ��䵽61.156.0.0�����ַ�ε����ݶ����͵�192.168.1.1�����ͨ����������