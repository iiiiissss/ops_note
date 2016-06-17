sysctl -p
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
root@c1:~/lvs# 
root@c1:~/lvs# route -n
Kernel IP routing table
Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
0.0.0.0         119.147.139.1   0.0.0.0         UG    0      0        0 em2
27.36.119.0     0.0.0.0         255.255.255.0   U     0      0        0 em2
119.147.139.0   0.0.0.0         255.255.255.0   U     0      0        0 em2
119.147.139.127 0.0.0.0         255.255.255.255 UH    0      0        0 lo
192.168.1.0     0.0.0.0         255.255.255.0   U     0      0        0 em1




