sudo apt-get install dpkg-dev
sudo add-apt-repository ppa:nginx/stable
apt-get update
apt-get install nginx=1.6.3

查看可安装版本:
sudo apt-cache policy nginx


ppa:nginx/stable
apt-get install package=version