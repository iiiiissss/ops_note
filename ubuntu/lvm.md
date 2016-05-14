fdisk -l  //分区工具
df -h     //使用情况
pvcreate  //格式化 pvcreate /dev/sdb /dev/sdc


pvdisplay  /pvs 查看物理卷
vgdisplay  /vgs  查看卷组信息
lvdisplay  /lvs   查看逻辑卷信息(用户看到的)

sudo parted /dev/sda print all   查看分区/卷信息
新增:
vgcreate vggroup /dev/sdb /dev/sdc  //VG(创建卷组)
lvcreate -n 逻辑卷名称 -L 逻辑卷大小 卷组名  //创建逻辑卷  lvcreate -n lv -L 30G vggroup
mkfs.ext4 /dev/vggroup/lv 格式化
mount -t ext4 /dev/vggroup/lv /mnt
未激活，需要激活逻辑卷：vgchange -ay /dev/VolGroup00

扩充逻辑卷:
lvextend -L +9.99G /dev/vggroup/lv    //扩充
resize2fs  /dev/vggroup/lv            //更新

swap:
lvresize /dev/VolGrp02/lvswap01 -L 900M

收缩逻辑卷LG
注意：对逻辑卷进行收缩操作之前必须先卸载逻辑卷，再缩小文件系统，最后才是缩小逻辑卷，而且收缩的大小也不能超过剩余空间大小。
1.卸载逻辑卷（unmount）
e2fsck -f /dev/vggroup/lv

resize2fs /dev/vggroup/lv 30G  缩小为30G

扩充卷组(VG,新增硬盘):
1.格式化新磁盘(pvcreate)
pvcreate /dev/sdb
2.将格式化的PV添加到VG中去（vgextend）
vgextend vggroup /dev/sdb
3.查看当前vg的大小(vgdisplay)


fdisk  /dev/sda
mkfs -t ext4 /dev/h //格式化分区

新增硬盘: 1, fdisk -l 确定硬盘 2,fdisk /dev/sda  分区  3, mkfs.ext4 /dev/sda1 //分区格式化  4,mount 

PE(Physical Extend):卷的最小单位，默认4M大小，就像我们的数据是以页的形式存储一样，卷就是以PE的形式存储。
PV(Physical Volume):物理卷  使用逻辑卷先将磁盘格式化成PV，PV是保护PE的，PV内PE的数量取决于这块磁盘的容量/4M.
VG(Volume Group):卷组，VG就是将很多PE组合在一起生成一个卷组，当然这里的PE是可以跨磁盘的，增加一个新磁盘对当前系统不会产生任何影响。
LV(Logical Volume):逻辑卷，逻辑卷最终是给用户使用的，前面几个都是为创建逻辑卷做的准备，创建逻辑卷的大小只要不超过VG剩余空间就可以。

http://www.cnblogs.com/chenmh/p/5107901.html


sudo yum install xfsprogs.x86_64 --assumeyes
//then mount your filesystem
sudo mount -t xfs /dev/sdf /vol
//now you can extend the filesystem
sudo xfs_growfs /vol
df -h //should now show more available space
