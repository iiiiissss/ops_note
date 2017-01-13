if [ $UID -ge 500 ];then
exec /usr/bin/script -t 2>/tmp/$USER-$UID-$(date +%Y%m%d%H%M).date -a -f -q /tmp/$USER-$UID-$(date +%Y%m%d%H%M).log
fi
export PROMPT_COMMAND='{ date "+[ %Y%m%d %H:%M:%S `whoami` ] `history 1 | { read x cmd; echo "$cmd"; }`"; } >> /var/log/command.log'


scriptreplay /tmp/xxx-1002-201612201051.date /tmp/xxx-1002-201612201051.log