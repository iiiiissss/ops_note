�鿴ʱ��: date -R

1.  ��װntp����
sudo apt-get install ntp
2.  ��������ʱ��ͬ��������
vim /etc/ntp.conf
server ntp.ubuntu.com
#��Ubuntu�ٷ�NTP������ͬ��ʱ��
3.  ����NTP����
/etc/init.d/ntp start

rdate
apt-get install rdate

rdate -s us.ntp.org.cn
ntpdate -u time.nist.gov


hwclock --systohc

date -s MM/DD/YY
date -s hh:mm:ss

ʱ������
/bin/cp /usr/share/zoneinfo/Asia/Seoul /etc/localtime
echo "Asia/Seoul" > /etc/timezone
tzselect




