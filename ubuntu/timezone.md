查看时区: date -R

1.  安装ntp工具
sudo apt-get install ntp
2.  设置网络时间同步服务器
vim /etc/ntp.conf
server ntp.ubuntu.com
#从Ubuntu官方NTP服务器同步时间
3.  启动NTP服务
/etc/init.d/ntp start

rdate
apt-get install rdate

rdate -s us.ntp.org.cn
ntpdate -u time.nist.gov


hwclock --systohc

date -s MM/DD/YY
date -s hh:mm:ss

时区配置
/bin/cp /usr/share/zoneinfo/Asia/Seoul /etc/localtime
echo "Asia/Seoul" > /etc/timezone
tzselect




