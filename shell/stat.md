cat xx.log | awk '{print $1}' | sort | uniq -C | sort -nr | head -n 100

查找字符串出现次数
grep -o 'string' xxx.txt |wc -l   