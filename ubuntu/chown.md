/mnt/caima-data �½��ļ�/Ŀ¼����������Ϊwww-data:
1, ֮ǰ������chmod u+s g+s��ʽsetuid setgidʵ��, ��������а汾���ں��Ѿ�ȡ���������.
2, Ȼ������crontab,����ִ��һ��chownҪ�����ӵ�ʮ������, ������.
3, ����incrontab,Ч�ʿ���,��Ŀ¼����.���ǵݹ�Ŀ¼����.
4,�������һ����������Watcher(https://github.com/splitbrain/Watcher)

sudo apt-get install python python-pyinotify

/etc/watcher.ini
./watcher.py start

��ʵ����ֱ�Ӹ�umask �������½����ļ�/Ŀ¼����777/666����; ��������̫����ȫ��. ����û����. 
