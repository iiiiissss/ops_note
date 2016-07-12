#!/bin/bash
SHELL=/bin/sh
PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
rxpre=`/sbin/ifconfig em2 | grep "RX packets"| awk '{print $2}' | awk -F":" '{print $2}'`
#txpre=`/sbin/ifconfig em2 | grep "TX packets"| awk '{print $2}' | awk -F":" '{print $2}'`
sleep 1
rxnext=`/sbin/ifconfig em2 | grep "RX packets"| awk '{print $2}' | awk -F":" '{print $2}'`
#txnext=`/sbin/ifconfig em2 | grep "TX packets"| awk '{print $2}' | awk -F":" '{print $2}'`
echo "$((${rxnext}-${rxpre}))"













