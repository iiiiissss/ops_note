#!/bin/bash
#iptables -L 查看
#iptables -t nat -L 端口转发没能清除   要重新改iptable.rule 执行start
#iptables -t nat -D POSTROUTING 1
iptables -P INPUT ACCEPT
iptables -P OUTPUT ACCEPT
iptables -P FORWARD ACCEPT
iptables -F
iptables -X
iptables -Z