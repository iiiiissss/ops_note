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