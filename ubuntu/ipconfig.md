sudo vi /etc/network/interfaces
# The loopback network interface
auto lo
iface lo inet loopback
# The primary network interface
#auto eth0
#iface eth0 inet dhcp
#myedit
auto eth0
iface eth0 inet static
address 192.168.1.112
netmask 255.255.255.0
gateway 192.168.1.1


sudo vi  /etc/resolvconf/resolv.conf.d/base
nameserver 8.8.8.8  
nameserver 8.8.4.4

/etc/resolv.conf 是自动文件
sudo /etc/init.d/networking restart

sudo ifdown eth0 && sudo ifup eth0