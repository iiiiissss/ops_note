ϵͳ�汾:
cat /etc/issue
sudo lsb_release -a
�鿴�ں˰汾��
uname -r
cpu����
grep processor /proc/cpuinfo|wc -l

�鿴�����������ٶ�
lspci | grep Ethernet

�鿴�ڴ�Ĳ���� �Ѿ�ʹ�ö��ٲ��
sudo dmidecode|grep -P -A5 "Memory\s+Device"|grep Size|grep -v Range

�鿴�ڴ�֧�ֵ�����ڴ�����
sudo dmidecode|grep -P 'Maximum\s+Capacity'

�ڴ�Ƶ��
sudo dmidecode | grep -A16 "Memory Device"|grep 'Speed'


du -h --max-depth=1 ./

io

sudo apt-get install lm-sensors 
sudo apt-get install sensors-applet
After installation type the following in terminal

sudo sensors-detect
You may also need to run

sudo service kmod start
It will ask you few questions. Answer Yes for all of them. Finally to get your CPU temperature type sensors in your terminal.

sensors


