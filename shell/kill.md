ps -ef|grep php-fpm|grep -v grep|cut -c 9-15|xargs kill -9

kill -USR2  pid

 ps aux | grep defunct|wc -l
 
 
 
 
杀死僵尸子进程  父进程用ppid
ps -A -o stat,pid,cmd | grep -e '^[Zz]' | awk '{print $2}' |xargs kill -9
ps -ef | grep defunct | grep -v grep | awk '{print "kill -9" $2}'
ps -ef|grep defunct|grep -v grep|cut -c 9-15|xargs kill -9