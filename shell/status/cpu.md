#!/bin/bash
TIME=`date +"%Y-%m-%d %H:%M:%S"`
da=`date +"%s"`
db_name="ops_rw"
db_passwd="SCV3EE"
db_ip="112"
name=`cat /etc/hostname`
cpu=`mpstat 1 1 | grep Average | awk '{print $3}'`
load1=`uptime |awk '{print $(NF-2)}'`
load2=`uptime |awk '{print $(NF-1)}'`
load3=`uptime |awk '{print $NF}'`
mem=`free -m  | sed -n 3p | awk '{print $4}'`

disk=`df -h | grep  /dev/sda1 |awk '{print $5}' |cut -d % -f1`

netflow_rx=`/bin/bash /data/shell/crontab_shell/netflow_rx.sh`
netflow_tx=`/bin/bash /data/shell/crontab_shell/netflow_tx.sh`
op_time=$da

time1=$((${da}-${da}%300))
time2=`date -d @$da +"%Y-%m-%d %H:%M:%S"`
mysql -h $db_ip -u$db_name -p$db_passwd -D ops -e "insert into monitor (hostname,cpu,load_average1,load_average2,load_average3,mem,netflow_rx,netflow_tx,disk,time,op_time) values('$name','$cpu','$load1','$load2','$load3','$mem','$netflow_rx','$netflow_tx','$disk','$time1','$op_time')"

echo "$TIME"





#!/bin/bash
TIME=`date +"%Y-%m-%d-%H:%M:%S"`
host_name=`sudo cat /etc/hostname`
db_ip_1=""
db_name_1=""
db_passwd_1=""
#db_ip_2="192.168.1.231"
#db_name_2="mcyun"
#db_passwd_2="HbcP79UjEQta1z"
da=`date +"%s"`
#cpu=`top -bcn 1 | sed -n 3p | awk '{print $2}'`
#cpu=` top -bcn 1 | grep Cpu | grep -v grep | awk '{print $2}'`
cpu=`top -bcn 2 | grep Cpu | grep -v grep | awk '{print $2}' | sed -n 2p`
mem=`free -m | sed -n 3p | awk '{print $3}'`
mem_all=`free -m | sed -n 2p | awk '{print $2}'`
if [ $host_name == "c1" ]
        then
        host_ip="119.147.139.138"
elif [ $host_name == "c2" ]
        then
        host_ip="119.147.139.117"
elif [ $host_name == "c3" ]
        then
        host_ip="119.147.139.118"
elif [ $host_name == "c4" ]
        then
        host_ip="119.147.139.119"
elif [ $host_name == "d1" ]
        then
        host_ip="119.147.139.114"
elif [ $host_name == "d2" ]
        then
        host_ip="119.147.139.115"
fi
mysql -h $db_ip_1 -u$db_name_1 -p$db_passwd_1 -D mcyun -e "update controllers set cpu='$cpu',memory='$mem',memory_all='$mem_all',updated_at='$da' where ip='$host_ip';"
#mysql -h $db_ip_2 -u$db_name_2 -p$db_passwd_2 -D mcyun -e "update controllers set cpu=$cpu,memory=$mem,memory_all=$mem_all,updated_at=$da where ip='$host_ip';"
echo "$TIME"