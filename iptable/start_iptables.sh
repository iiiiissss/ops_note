#!/bin/bash
iptables -P INPUT ACCEPT
iptables -P OUTPUT ACCEPT
iptables -P FORWARD ACCEPT
iptables -F
iptables -X
iptables -Z
iptables-restore < /etc/iptables/iptables.rule