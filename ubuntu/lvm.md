fdisk -l  //��������
df -h     //ʹ�����
pvcreate  //��ʽ�� pvcreate /dev/sdb /dev/sdc


pvdisplay  /pvs �鿴�����
vgdisplay  /vgs  �鿴������Ϣ
lvdisplay  /lvs   �鿴�߼�����Ϣ(�û�������)

sudo parted /dev/sda print all   �鿴����/����Ϣ
����:
vgcreate vggroup /dev/sdb /dev/sdc  //VG(��������)
lvcreate -n �߼������� -L �߼����С ������  //�����߼���  lvcreate -n lv -L 30G vggroup
mkfs.ext4 /dev/vggroup/lv ��ʽ��
mount -t ext4 /dev/vggroup/lv /mnt
δ�����Ҫ�����߼���vgchange -ay /dev/VolGroup00

�����߼���:
lvextend -L +9.99G /dev/vggroup/lv    //����
resize2fs  /dev/vggroup/lv            //����

swap:
lvresize /dev/VolGrp02/lvswap01 -L 900M

�����߼���LG
ע�⣺���߼��������������֮ǰ������ж���߼�������С�ļ�ϵͳ����������С�߼������������Ĵ�СҲ���ܳ���ʣ��ռ��С��
1.ж���߼���unmount��
e2fsck -f /dev/vggroup/lv

resize2fs /dev/vggroup/lv 30G  ��СΪ30G

�������(VG,����Ӳ��):
1.��ʽ���´���(pvcreate)
pvcreate /dev/sdb
2.����ʽ����PV��ӵ�VG��ȥ��vgextend��
vgextend vggroup /dev/sdb
3.�鿴��ǰvg�Ĵ�С(vgdisplay)


fdisk  /dev/sda
mkfs -t ext4 /dev/h //��ʽ������

����Ӳ��: 1, fdisk -l ȷ��Ӳ�� 2,fdisk /dev/sda  ����  3, mkfs.ext4 /dev/sda1 //������ʽ��  4,mount 

PE(Physical Extend):�����С��λ��Ĭ��4M��С���������ǵ���������ҳ����ʽ�洢һ�����������PE����ʽ�洢��
PV(Physical Volume):�����  ʹ���߼����Ƚ����̸�ʽ����PV��PV�Ǳ���PE�ģ�PV��PE������ȡ���������̵�����/4M.
VG(Volume Group):���飬VG���ǽ��ܶ�PE�����һ������һ�����飬��Ȼ�����PE�ǿ��Կ���̵ģ�����һ���´��̶Ե�ǰϵͳ��������κ�Ӱ�졣
LV(Logical Volume):�߼����߼��������Ǹ��û�ʹ�õģ�ǰ�漸������Ϊ�����߼�������׼���������߼���Ĵ�СֻҪ������VGʣ��ռ�Ϳ��ԡ�

http://www.cnblogs.com/chenmh/p/5107901.html


sudo yum install xfsprogs.x86_64 --assumeyes
//then mount your filesystem
sudo mount -t xfs /dev/sdf /vol
//now you can extend the filesystem
sudo xfs_growfs /vol
df -h //should now show more available space
