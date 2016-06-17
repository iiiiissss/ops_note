net.ipv4.ip_forward = 1
net.ipv4.ip_nonlocal_bind = 1

sysctl -p
vi /etc/sysctl.conf

net.ipv4.tcp_max_syn_backlog = 8192
net.core.netdev_max_backlog = 32768
net.core.somaxconn = 32768
net.core.wmem_default = 8388608
net.core.rmem_default = 8388608
net.core.wmem_max = 16777216
net.core.rmem_max = 16777216
net.ipv4.tcp_synack_retries = 2
net.ipv4.tcp_syn_retries = 2
net.ipv4.tcp_timestamps = 0
net.ipv4.tcp_tw_recycle = 1
net.ipv4.tcp_tw_reuse = 1
net.ipv4.tcp_mem = 94500000 915000000 927000000
net.ipv4.tcp_max_orphans = 3276800
net.ipv4.ip_local_port_range = 1024 65535
net.ipv4.tcp_fin_timeout = 30
net.ipv4.tcp_keepalive_time = 120
net.ipv4.ip_forward = 1
net.ipv4.ip_nonlocal_bind = 1



root@c2:~/lvs# route -n
Kernel IP routing table
Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
0.0.0.0         119.147.139.1   0.0.0.0         UG    0      0        0 em2
27.36.119.0     0.0.0.0         255.255.255.0   U     0      0        0 em2
119.147.139.0   0.0.0.0         255.255.255.0   U     0      0        0 em2
192.168.1.0     0.0.0.0         255.255.255.0   U     0      0        0 em1



root@c2:~/lvs# ifconfig 
em1       Link encap:Ethernet  HWaddr 00:1e:67:fb:a6:9c  
          inet addr:192.168.1.212  Bcast:192.168.1.255  Mask:255.255.255.0
          inet6 addr: fe80::21e:67ff:fefb:a69c/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:663098 errors:0 dropped:0 overruns:0 frame:0
          TX packets:351863 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000 
          RX bytes:100789579 (100.7 MB)  TX bytes:36675362 (36.6 MB)
          Memory:91920000-91940000 

em2       Link encap:Ethernet  HWaddr 00:1e:67:fb:a6:9d  
          inet addr:119.147.139.117  Bcast:119.147.139.255  Mask:255.255.255.0
          inet6 addr: fe80::21e:67ff:fefb:a69d/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:215731 errors:0 dropped:0 overruns:0 frame:0
          TX packets:80281 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000 
          RX bytes:16509846 (16.5 MB)  TX bytes:11400434 (11.4 MB)
          Memory:91900000-91920000 

em2:1     Link encap:Ethernet  HWaddr 00:1e:67:fb:a6:9d  
          inet addr:27.36.119.117  Bcast:27.36.119.255  Mask:255.255.255.0
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          Memory:91900000-91920000 

lo        Link encap:Local Loopback  
          inet addr:127.0.0.1  Mask:255.0.0.0
          inet6 addr: ::1/128 Scope:Host
          UP LOOPBACK RUNNING  MTU:65536  Metric:1
          RX packets:299 errors:0 dropped:0 overruns:0 frame:0
          TX packets:299 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:0 
          RX bytes:33310 (33.3 KB)  TX bytes:33310 (33.3 KB)

