#!/bin/bash  
#VIP=119.147.139.126
VIP=119.147.139.127
case "$1" in
start)
     ifconfig lo:0 $VIP broadcast $VIP netmask 255.255.255.255 up
     /sbin/route add -host $VIP dev lo:0
     echo "1">/proc/sys/net/ipv4/conf/lo/arp_ignore
     echo "2">/proc/sys/net/ipv4/conf/lo/arp_announce
     echo "1">/proc/sys/net/ipv4/conf/all/arp_ignore
     echo "2">/proc/sys/net/ipv4/conf/all/arp_announce
     echo "2">/proc/sys/net/ipv4/conf/all/arp_filter
     sysctl -p >/dev/null 2>&1
     echo "realServer Start ok"  
     ;;
stop)
     ifconfig lo:0 down
     route del $VIP >/dev/null 2>&1
     echo "0">/proc/sys/net/ipv4/conf/lo/arp_ignore
     echo "0">/proc/sys/net/ipv4/conf/lo/arp_announce
     echo "0">/proc/sys/net/ipv4/conf/all/arp_ignore
     echo "0">/proc/sys/net/ipv4/conf/all/arp_announce
     echo "0">/proc/sys/net/ipv4/conf/all/arp_filter
     echo "realServer Stoped"  
     ;;
*)
    echo "Usage:$0{start|stop}"  
    exit 1
esac
exit 0