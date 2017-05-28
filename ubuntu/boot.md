mount cdrom/unbuntu...ios  /cdrom

sudo 无密码提示:
/etc/sudoers
%sudo   ALL=(ALL) NOPASSWD: NOPASSWD: ALL

pkexec chmod 0440 /etc/sudoers

/etc/init.d/rsyslog restart

mount -o remount, rw /

自动登录: 
vi /etc/init/tty1.conf
exec /bin/login -f USERNAME < /dev/tty1 > /dev/tty1 2>&1
 
 过grub引导:
/etc/default/grub
注释掉这行 GRUB_HIDDEN_TIMEOUT_QUIET=true
grub_timeout=10
sudo update-grub
grub2，那么你的grub.cfg也应该在/boot/grub2/grub.cfg，试试update-grub2

sudo su -l root
chomod 644 /boot/grub/grub.cfg
修改 timeout=3
sync
sync
init 6

/etc/rc.local
update-rc.d -f apache2 remove
update-rc.d apache2 defaults
update-rc.d 

rc2.drc2.d

0	关闭（或停止）系统
1	单用户模式；通常别称为 s 或 S
2	没有联网的多用户模式
3	联网的多用户模式
4   特殊定制
5	联网并且使用 X Window 系统的多用户模式
6	重启系统



直接登录:
一、写脚本autologin 
#!/bin/bash
/bin/login -f <username> #你的用户名
chmod +x autologin设置可执行权限，移动到/usr/bin/下。
二、把/etc/event.d/tty1中下面这一行：
exec /sbin/getty 38400 tty1
修改为
exec /sbin/getty -n -l /usr/bin/autologin 38400 tty1