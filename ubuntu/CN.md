locale -a

��zh-CN ��
cd /usr/share/locales 
sudo ./install-language-pack zh_CN

vi /etc/profile 
export LANG=zh_CN.UTF-8
sudo dpkg-reconfigure locales


sudo locale-gen
�ؽ�locale��
��Ҫɾ��locale�����ǡ�/usr/share/locales����Ӧ�ġ�remove-language-pack����