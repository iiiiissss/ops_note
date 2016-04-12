vi /etc/apparmor.d/usr.sbin.mysqld


/etc/init.d/apparmor reload

apparmor_status

/etc/apparmor.d/disable


sudo apt-get install apparmor-profiles 

sudo service apparmor stop
sudo update-rc.d -f apparmor remove

  /etc/rcS.d/S37apparmor
  
禁止:
sudo ln -s /etc/apparmor.d/bin.ping /etc/apparmor.d/disable/
sudo apparmor_parser -R /etc/apparmor.d/bin.ping
  
  
https://help.ubuntu.com/community/AppArmor
