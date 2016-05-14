cat xx.log | awk '{print $1}' | sort | uniq -C | sort -nr | head -n 100

清除空行和注释
cat www.conf |grep -v "^;"|grep -v '^ *$'
