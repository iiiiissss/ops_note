sudo apt-get install ipvsadm
sudo ipvsadm 查看是否安装成功。


ifconfig lo:1 192.168.1.169 netmask 255.255.255.255 别忘了加到rc.local里面
route add defaule gw 192.168.1.1

ifconfig lo:1 27.36.119.114 netmask 255.255.255.0


27.36.119.114
route add gw

ifconfig lo:1 192.168.1.169 netmask 255.255.255.255

ifconfig lo:1 119.147.139.126 netmask 255.255.255.0

ifconfig lo:1 119.147.139.127 netmask 255.255.255.0

route add default gw 119.147.139.1

ifconfig lo:1 27.36.119.114 netmask 255.255.255.0

切换成VIP的地址时有没有向交换机做arp 广播，无广播交换机是没有arp 认证的也就是说你的VIP在交换机里是不合法的?

vip:
ifconfig eth0:0 192.168.57.200 netmask 255.255.255.255 broadcast 192.168.57.255 up

ifconfig em2:2 119.147.139.126 netmask 255.255.255.0 broadcast 119.147.139.255 up

ifconfig lo:1 119.147.139.127 netmask 255.255.255.0 broadcast 119.147.139.255 up
route add gw 119.147.139.1

ifconfig em2:2 27.36.119.114 netmask 255.255.255.0 broadcast 27.36.119.255 up
ifconfig em2:2 119.147.139.127 netmask 255.255.255.0 broadcast 27.36.119.255 up

route add -net 119.147.139.0  netmask 255.255.255.0 dev em2

route add -net 192.168.224.0 netmask 255.255.255.0 dev em2

192.168.57.200


ipvsadm 配置
可通过下面语句配置ipvsadm是否随机启动，以none/master/backup/both四种的哪一种方式
sudo dpkg-reconfigure ipvsadm
edit /etc/default/ipvsadm


keepalived
apt-get install libssl-dev
apt-get install openssl
apt-get install libpopt-dev

apt-get install keepalived
apt-get install daemon

vim /etc/keepalived/keepalived.conf
vrrp_instance VI_1 {
    state MASTER
    interface eth0
    virtual_router_id 51
    priority 150
    advert_int 1
    authentication {
        auth_type PASS
        auth_pass $ place secure password here.
    }
    virtual_ipaddress {
        10.32.75.200
    }
}

查看:tail /var/log/syslog



https://raymii.org/s/tutorials/Keepalived-Simple-IP-failover-on-Ubuntu.html
允许绑定vip
echo 1 > /proc/sys/net/ipv4/ip_nonlocal_bind
Permanent:Add this to /etc/sysctl.conf:
net.ipv4.ip_forward = 1
net.ipv4.ip_nonlocal_bind = 1

sysctl -p





#
/sbin/sysctl -q -w net.ipv4.conf.all.arp_announce=2
/sbin/sysctl -q -w net.ipv4.conf.all.arp_filter=2

#set lvs
/sbin/ipvsadm -A -t $VIP:7003 -s rr
/sbin/ipvsadm -a -t $VIP:7003 -r $RIP1:7003 -g

/sbin/ipvsadm -A -t 119.147.139.126:80 -s rr
/sbin/ipvsadm -a -t 119.147.139.126:80 -r 119.147.139.138:80 -g



vip
Director server
Real server


1）VS/NAT模式（Network address translation）
2）VS/TUN模式（tunneling） 异地
http://blief.blog.51cto.com/6170059/1747656
3）DR模式（Direct routing）



ipvsadm可以定义一个集群服务,定义realserver，同时对集群进行查看。
a.定义集群服务
添加或修改集群服务：ipvsadm -A|E -t|u|f VIP:port -s 调度算法
    -A 添加一个新的集群服务
    -E 修改一个服务
    -t 基于tcp的集群服务
    -u 基于udp的集群服务
    -f 基于防火墙标记的集群服务
    -s 指定调度算法 
    -p 设定持久连接时间
    -C 清空规则
    -R 重新载入规则
    -S 保存规则
    
删除一个集群服务：  ipvsadm -D -t|u|f VIP:port

b.定义realserver
添加或者修改REALSERVER:ipvsadm -a|e -t|u|f VIP:port -r REALSERVER[:port] -g|-i|-m [-w 权重]
    -g LVS-DR直接路由模型
    -i LVS-TUN隧道模型
    -m LVS-NAT模型
删除一个REALSERVER:    ipvsadm -d -t|u|f VIP:port -r REALSERVER[:port]

c.集群查看

ipvsadm -L/l -n 查看
ipvsadm -lcn 查看持久连接状态

添加/删除默认网关sudo route add/delete default gw 192.168.1.XXX
增加/删除网关sudo route add/del 192.168.1.XXX
增加子网 route add -net 192.168.1.0 netmask 255.255.255.0 dev eth0
增加子网 route delete -net 192.168.1.0 netmask 255.255.255.0  eth0
查看路由 sudo route -n
查看所有ip  sudo ip a
解除绑定sudo ip -f inet addr delete 192.168.1.200/32 dev eth0
跟踪访问 sudo traceroute
8099端口监控 sudo tcpdum port 8099


算法
说明
rr
轮询算法，它将请求依次分配给不同的rs节点，也就是RS节点中均摊分配。这种算法简单，但只适合于RS节点处理性能差不多的情况
wrr
加权轮训调度，它将依据不同RS的权值分配任务。权值较高的RS将优先获得任务，并且分配到的连接数将比权值低的RS更多。相同权值的RS得到相同数目的连接数。
Wlc
加权最小连接数调度，假设各台RS的全职依次为Wi，当前tcp连接数依次为Ti，依次去Ti/Wi为最小的RS作为下一个分配的RS
Dh
目的地址哈希调度（destination hashing）以目的地址为关键字查找一个静态hash表来获得需要的RS
SH
源地址哈希调度（source hashing）以源地址为关键字查找一个静态hash表来获得需要的RS
Lc
最小连接数调度（least-connection）,IPVS表存储了所有活动的连接。LB会比较将连接请求发送到当前连接最少的RS.
Lblc
基于地址的最小连接数调度（locality-based least-connection）：将来自同一个目的地址的请求分配给同一台RS，此时这台服务器是尚未满负荷的。否则就将这个请求分配给连接数最小的RS，并以它作为下一次分配的首先考虑。
