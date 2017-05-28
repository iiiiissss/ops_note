cat xx.log | awk '{print $1}' | sort | uniq -c | sort -nr | head -n 100


cat /var/log/nginx/access.log | awk '{print $1}' | awk -F ':' '{print $2}' | sort -nr | uniq -c | sort -nr  | head -n 100


清除空行和注释
cat www.conf |grep -v "^;"|grep -v '^ *$'

vi 替换:
:%s/mcyun/mcjingling/g

:%s/mcyun/mcjingling/