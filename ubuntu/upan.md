sudo fdisk -l 将显示全部盘的信息
sudo mount -t ntfs-3g /dev/sdb1 /mnt/windows/u


另若使用的是FAT32格式的：
sudo mount -t vfat /dev/sdb1 /mnt/u                (事先需在mnt目录下建一个名为u的文件夹)
然后就可以通过 cd /mnt/u 对U盘上的内容进行访问了。
卸载时用：
sudo umount /mnt/u 
若卸载时报错：“device is busy”，则可以用
mount -l /mnt/u
来卸载设备。选项 –l 并不是马上umount，而是在该目录空闲后再umount。也可以先以 ps aux 查看占用设备的程序PID，然后kill PID，最后umount就非常放心了。


另使用cp拷贝文件夹需使用-r选项：

CP命令 
格式: CP [选项] 源文件或目录 目的文件或目录 
选项说明:-b 同名,备分原来的文件 
-f 强制覆盖同名文件 
-r 按递归方式保留原目录结构复制文件 

cp -r /tmp/a /root/a