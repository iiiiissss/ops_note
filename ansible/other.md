通配符:
*  one*.com:dbservers
group1[0:3]  组内排序 和host的表示不一样
webservers:dbservers  (两个组都执行)
webservers:!phoenix  不在后者的组
webservers:&staging 同时存在的组
webservers:dbservers:&staging:!phoenix 在webservers或dbservers 组中，必须还存在于 staging 组中，但是不在phoenix组中(左往右)
~(web|db).*\.example\.com  ~表正则
排除特定的主机:(--limit @retry_hosts.txt)
ansible-playbook site.yml --limit datacenter2
