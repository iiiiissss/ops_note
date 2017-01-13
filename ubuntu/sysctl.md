sysctl -p
报错:
sysctl: cannot stat /proc/sys/net/nf_conntrack_max: No such file or directory

lsmod | grep nf_conntrack_ipv4
root@c3:/proc/sys/net# modprobe nf_conntrack_ipv4
root@c3:/proc/sys/net# lsmod | grep nf_conntrack_ipv4
nf_conntrack_ipv4      15012  0 
nf_defrag_ipv4         12758  1 nf_conntrack_ipv4
nf_conntrack           96976  1 nf_conntrack_ipv4
是没有安装nf_conntrack_ipv4这个模块

watch 'netstat -nat|grep ES|wc -l'

 dmesg something like:
[1824447.285257] nf_conntrack: table full, dropping packet.

sysctl net.nf_conntrack_max
net.nf_conntrack_max = 65536
and current conntrack count in:
sysctl net.netfilter.nf_conntrack_count
net.netfilter.nf_conntrack_count = 157