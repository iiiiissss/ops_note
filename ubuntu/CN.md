locale -a
��zh-CN ��
sudo /usr/share/locales/install-language-pack zh_CN
sudo dpkg-reconfigure locales


vi /etc/profile 
export LANG=zh_CN.UTF-8




sudo locale-gen
�ؽ�locale��
��Ҫɾ��locale�����ǡ�/usr/share/locales����Ӧ�ġ�remove-language-pack����