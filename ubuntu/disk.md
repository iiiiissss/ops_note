disk

fdisk -l


普通硬盘挂载:
sudo fdisk -l
sudo fdisk /dev/sdc      //n 然后一直回车 w保存退出
sudo mkfs.ext4 /dev/sdc1
sudo mount /dev/sdc1 /data_disk1

fusermount -uz /mnt/xxx
mount /dev/vdb1 /data_disk1


开机启动:
vim /etc/fstab

/dev/sdb1 /data/gluster/cc1_1/ ext4 defaults 0 0

mount -a  

大于2T的硬盘

# parted /dev/sdb
(parted) mklabel gpt
(parted) unit TB
(parted) mkpart primary 0.00TB 3.00TB
(parted) print
(parted) quit

 mkfs.ext4 /dev/sdb1
 mount 
 
