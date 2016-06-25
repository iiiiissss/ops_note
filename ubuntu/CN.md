locale -a
无zh-CN 则
sudo /usr/share/locales/install-language-pack zh_CN
sudo dpkg-reconfigure locales


vi /etc/profile 
export LANG=zh_CN.UTF-8




sudo locale-gen
重建locale。
而要删除locale，则是“/usr/share/locales”对应的“remove-language-pack”。