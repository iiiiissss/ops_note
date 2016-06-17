locale -a

无zh-CN 则
cd /usr/share/locales 
sudo ./install-language-pack zh_CN

vi /etc/profile 
export LANG=zh_CN.UTF-8
sudo dpkg-reconfigure locales


sudo locale-gen
重建locale。
而要删除locale，则是“/usr/share/locales”对应的“remove-language-pack”。