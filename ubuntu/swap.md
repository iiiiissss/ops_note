新建swap分区:
1,swapoff -a
2,fdisk /dev/sdb 剔除swap分区，输入d删除swap分区，然后再n添加分区（添加时硬盘必须要有可用空间，然后再用t将新添的分区id改为82（linux swap类型），最后用w将操作实际写入硬盘（没用w之前的操作是无效的）。
3.mkswap /dev/sdb2   #格式化swap分区
4.swapon /dev/sdb2   #启动新的swap分区
5,/etc/fstab:   /dev/sdb2       swap        swap        defaults        0 0

增加Swap分区
1,增加1G大小的交换分区，则命令写法如下，其中的 count 等于想要的块大小。
# dd if=/dev/zero of=/home/swapfile bs=1M count=1024
2,mkswap /home/swapfile  #建立swap的文件系统
3,swapon /home/swapfile   #启用swap文件
4,/etc/fstab:   /home/swapfile swap swap defaults 0 0

LVM下:

lvcreate VolGrp02 -n   -L 1000M
lvreduce /dev/VolGrp02/lvswap01 -L -400M

swapoff -v /dev/VolGrp02/lvswap01

cat /proc/swaps
cat /proc/sys/vm/swappiness
/etc/sysctl.conf 
/mnt/swap
/etc/swapfile
swapon -s

sudo apt-get install htop 

mkswap /dev/sdb2
swapon /dev/sdb2    

http://hancj.blog.51cto.com/89070/197915