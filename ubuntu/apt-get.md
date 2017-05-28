sudo apt-get remove apache2
sudo apt-get autoremove



sudo apt-get remove x11-common
sudo apt-get autoremove

Building dependency tree using apt-get is slow
Open terminal and first install bleachbit
sudo apt-get install bleachbit
Then run bleachbit as sudo:
sudo bleachbit


sudo http_proxy='http://user:pass@proxy.example.com:8080/' apt-get update
https://askubuntu.com/questions/89437/how-to-install-packages-with-apt-get-on-a-system-connected-via-proxy

Change the APT download server.

ubuntu各种软件代理的指定方法
http://lihaitao.cn/?p=40

First run polipo with parent proxy set to Shadowsocks:

apt-get install polipo
service polipo stop
polipo socksParentProxy=localhost:1080
Then you can play with the HTTP proxy:

http_proxy=http://localhost:8123 apt-get update

http_proxy=http://localhost:8123 curl www.google.com

http_proxy=http://localhost:8123 wget www.google.com

git config --global http.proxy 127.0.0.1:8123
git clone https://github.com/xxx/xxx.git
git xxx
git xxx
git config --global --unset-all http.proxy