/usr/bin/python /usr/bin/supervisorctl
/usr/bin/python /usr/bin/supervisord -c /etc/supervisor/supervisord.conf

service supervisor restart   #可能不成功 要多次/查看 ps -ef |grep super 
 
normal:
[program:skin-service]
command=/data/goapp/bin/skin-service
process_name=skin-service
redirect_stderr=true
stderr_logfile=/data/logs/skin-service.err.log
stdout_logfile=/data/logs/skin-service.out.log
directory=/data/goapp/
user=root



with daemon


#! /usr/bin/env bash
set -eu

pidfile="/var/run/your-daemon.pid"
command=/usr/sbin/your-daemon

# Proxy signals
function kill_app(){
    kill $(cat $pidfile)
    exit 0 # exit okay
}
trap "kill_app" SIGINT SIGTERM

# Launch daemon
$command
sleep 2

# Loop while the pidfile and the process exist
while [ -f $pidfile ] && kill -0 $(cat $pidfile) ; do
    sleep 0.5
done
exit 1000 # exit unexpected