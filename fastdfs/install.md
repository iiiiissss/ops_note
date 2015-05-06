#

Tracker server : m1
Storage server
group1: s1 s2
group2: s3
all: libevent + fastdfs   storage: nginx+fastdfs-nginx-module


fastdfs:
tracker.conf   //负责均衡调度服务器配置文件
client.conf      //客户端上传配置文件
http.conf     //http服务器配置文件
storage.conf//文件存储服务器配置文件
mime.types   //文件类型配置文件

**all ()**
安装libfastcommon类库
wget https://github.com/happyfish100/libfastcommon/archive/master.zip
unzip master.zip
cd libfastcommon-master
./make.sh
./make.sh install

wget  https://github.com/happyfish100/fastdfs/archive/V5.05.tar.gz
tar -zxvf V5.05.tar.gz 
cd fastdfs-5.05/
./make.sh
./make.sh install

#ubuntu bug: from 有 to 无
ln -s /usr/lib64/libfastcommon.so /usr/lib/libfastcommon.so
ln -s /usr/lib64/libfdfsclient.so /usr/lib/libfdfsclient.so


**tracker**
/etc/fdfs/tracker.conf
base_path=/data/service/fastdfs
启动:/usr/bin/fdfs_trackerd /etc/fdfs/tracker.conf start

**storage**
sudo vi /etc/fdfs/storage.conf
base_path=/data/service/fastdfs
tracker_server=192.168.1.36:22122
store_path0=/data/service/fastdfs

client.conf 中同样要修改
base_path=/usr/fastdfs #用于存放日志。
tracker_server=192.168.1.36:22122 #指定tracker服务器地址

ln -s /data/service/fastdfs/data /data/service/fastdfs/data/M00
启动 / 重启
/usr/bin/fdfs_storaged /etc/fdfs/storage.conf start　#restart

检查: ps -ef |grep fdfs
"sudo /usr/bin/fdfs_trackerd /etc/fdfs/tracker.conf"
"sudo /usr/bin/fdfs_storaged /etc/fdfs/storage.conf"

storage换ip:重启即可; tracker换ip, 要更改所有的 storge 配置, 再都重启
测试上传:
fdfs_test /etc/fdfs/client.conf upload ~/01.jpg



**php client**
#phpize 在 php5-dev
phpize
./configure  # --with-php-config=/etc/php5/fpm
make
make install
cp modules/fastdfs_client.so  /usr/lib/php/201...
cp fastdfs_client.ini /etc/php5/php-fpm

**nginx**


