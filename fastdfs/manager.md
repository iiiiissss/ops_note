启动 / 重启
sudo /usr/bin/fdfs_trackerd /etc/fdfs/tracker.conf restart
sudo /usr/bin/fdfs_storaged /etc/fdfs/storage.conf restart　#start
检查: ps -ef |grep fdfs
storage换ip:重启即可; tracker换ip, 要更改所有的 storge 配置, 再都重启


服务停止后的报错:
"No such file or directoryfastdfs init error"
