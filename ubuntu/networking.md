netstat -altnp|grep 9000
netstat -an|awk '/tcp/ {print $6}'|sort|uniq -c
netstat -ae |grep mysql
查看端口占用
sudo lsof -i tcp:8080         #mac

dns 清除缓存
sudo /etc/init.d/nscd restart
sudo aptitude install nscd
sudo /etc/init.d/nscd restart 
其实我们也可以直接
sudo /etc/init.d/dns-clean start
up

vi /etc/resolvconf/resolv.conf.d/base（这个文件默认是空的）
在里面插入：
nameserver 8.8.8.8
nameserver 8.8.4.4
如果有多个DNS就一行一个
修改好保存，然后执行
sudo resolvconf -u
再看/etc/resolv.conf，最下面就多了2行：

SIOCSIFFLAGS: Cannot assign requested address

ifconfig em1:0 103.57.111.228/24
route add default gw 103.57.111.230 dev em1:0

curl 'https://api.ipify.org?format=json'

ifconfig em1 up

多ip:
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

多个网卡绑定一个IP:
sudo apt-get install ifenslave
vi /etc/modules   :   bonding mode=1 miimon=100           0均衡,1主备


vi /etc/network/interfaces
加入以下内容：
auto bond0
iface bond0 inet static
address 192.168.2.3
netmask 255.255.255.0
gateway 192.168.2.1
post-up ifenslave bond0 eth0 eth1
pre-down ifenslave -d bond0 eth0 eth1


2个类别的绑定/etc/modules 中的内容改为：
bonding mode=1 miimon=100 max_bonds=2

修改网卡名称:
/etc/udev/rules.d/70-persistent-net.rules
增加网卡:
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

这项技术其实在sun和cisco中已经存在，分别称为Trunking和etherchannel技术，
在linux中，这种技术称为bonding。
因为bonding在内核2.4.x中已经包含了，
只需要在编译的时候把网络设备选项中的 Bonding driver support选中就可以了。
然后，重新编译核心，重新起动计算机，执行如下命令：
 
　　ismod bonding
　　ifconfig eth0 down
　　ifconfig eth1 down
　　ifconfig bond0 ipaddress
　　ifenslave bond0 eth0
　　ifenslave bond0 eth1
 
　　现在两块网卡已经象一块一样工作了，这样可以提高集群节点间的数据传输。
　　你最好把这几句写成一个脚本,再由/etc/rc.d/rc.local调用，
以便一开机就生效。
　　bonding对于服务器来是个比较好的选择，在没有千兆网卡时，
用两三块100兆网卡作 bonding，可大大提高服务器到交换机之间的带宽。
但是需要在交换机上设置连接bonding 网卡的两个口子映射为同一个虚拟接口。




route互通
sudo route add -net 10.6.0.0/24 gw 10.6.0.254 dev eth1
sudo route add -net 10.6.1.0/24 dev eth1
sudo route add -net 10.6.4.0/24 dev eth1
sudo route add -net 10.6.15.0/24 dev eth1


查看流量:
apt-get install iftop

sudo ifup --no-act p2p1  #检查语法

sudo ifdown p2p1:1 && sudo ifup p2p1:1
无sudo不行

linux下网卡绑定的7种模式：
mode=0 表示 load balancing (round-robin)为负载均衡方式，两块网卡都工作。 
mode=1 表示 fault-tolerance (active-backup)提供冗余功能，工作方式是主 从的工作方式,也就是说默认情况下只有一块网卡工作,另一块做备份。  
mode=2 表示 XOR policy 为平衡策略。此模式提供负载平衡和容错能力  
mode=3 表示 broadcast 为广播策略。此模式提供了容错能力  
mode=4 表示 IEEE 802.3ad Dynamic link aggregation 为 IEEE 802.3ad 为 动态链接聚合。该策略可以通过 xmit_hash_policy 选项从缺省的 XOR 策略改变到其他策略。  
mode=5 表示 Adaptive transmit load balancing 为适配器传输负载均衡。该 模式的必要条件：ethtool 支持获取每个 slave 的速率  
mode=6 表示 Adaptive load balancing 为适配器适应性负载均衡。该模式包含 了 balance-tlb 模式，同时加上针对 IPV4 流量的接收负载均衡(receive load   balance, rlb)，而且不需要任何 switch(交换机)的支持。 



route add -p 61.156.0.0 mask255.255.0.0 192.168.1.1，这句指令将规定凡是传输到61.156.0.0这个地址段的数据都发送到192.168.1.1这个网通出口网卡。