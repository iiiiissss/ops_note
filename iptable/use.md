iptables -L
iptables -nvL --line-number
iptables -L -n --line-number 

http://blog.51yip.com/linux/1404.html

curl -H "Host:www.mcelf.com" "http://112.74.207.116/robots.txt"


iptables -L

清除 -F -X -Z
# iptables -F
# iptables -P INPUT ACCEPT
# iptables -P OUTPUT ACCEPT
# iptables -P FORWARD ACCEPT
# iptables -A FORWARD -s 124.115.0.0/24 -j DROP
# iptables -I FORWARD -d 202.96.170.164 -j DROP
补充：：
单个IP的命令是
iptables -I INPUT -s 124.115.0.199 -j DROP
封IP段的命令是
iptables -I INPUT -s 124.115.0.0/16 -j DROP
iptables -I INPUT -s 124.115.3.0/16 -j DROP
iptables -I INPUT -s 124.115.4.0/16 -j DROP
封整个段的命令是
iptables -I INPUT -s 124.115.0.0/8 -j DROP
封几个段的命令是
iptables -I INPUT -s 61.37.80.0/24 -j DROP
iptables -I INPUT -s 61.37.81.0/24 -j DROP

 

用iptables禁止一个ＩＰ地址范围
iptables   -A   FORWARD   -s   10.0.0.1-255   -j   DROP
 
 
使iptables永久生效：
1、修改配置文件：
    配置文件是在/etc/iptables
2、使用命令：
    命令是/etc/rc.d/init.d/iptables save
	
删除:
iptables -D INPUT 3