/mnt/caima-data 新建文件/目录都设置属主为www-data:
1, 之前是想用chmod u+s g+s方式setuid setgid实现, 最后发现现有版本的内核已经取消这个特性.
2, 然后想用crontab,发现执行一次chown要几分钟到十几分钟, 不可行.
3, 换了incrontab,效率可以,主目录可以.但是递归目录不行.
4,最后用了一个第三方的Watcher(https://github.com/splitbrain/Watcher)

sudo apt-get install python python-pyinotify

/etc/watcher.ini
./watcher.py start

其实可以直接改umask 让所有新建的文件/目录都是777/666这种; 但是这种太不安全了. 所以没采用. 
