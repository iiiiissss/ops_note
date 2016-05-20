系统版本:
cat /etc/issue
sudo lsb_release -a
查看内核版本号
uname -r
cpu核数
grep processor /proc/cpuinfo|wc -l

查看网卡个数及速度
lspci | grep Ethernet

查看内存的插槽数 已经使用多少插槽
sudo dmidecode|grep -P -A5 "Memory\s+Device"|grep Size|grep -v Range

查看内存支持的最大内存容量
sudo dmidecode|grep -P 'Maximum\s+Capacity'

内存频率
sudo dmidecode | grep -A16 "Memory Device"|grep 'Speed'