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

https://api.ipify.org
curl 'https://api.ipify.org?format=json'

auto lo
iface lo inet loopback

# The primary network interface
auto em1
iface em1 inet static
        address 103.57.111.251
        netmask 255.255.255.248
        network 103.57.111.248
        broadcast 103.57.111.255
        gateway 103.57.111.254
auto em2
iface em2 inet static
        address 192.168.100.18
        netmask 255.255.255.0


sudo vi  /etc/resolvconf/resolv.conf.d/base
nameserver 8.8.8.8  
nameserver 8.8.4.4

sudo resolvconf -u

/etc/resolv.conf 是自动文件
sudo /etc/init.d/networking restart

sudo ifdown eth0 && sudo ifup eth0