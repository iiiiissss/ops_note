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
192.168.1.*



ansible 10.10.1.11 -m copy -a  'src=/root/installnew.tar dest=/root/'
10.10.1.11 | FAILED! => {
    "changed": false, 

    "checksum": "2b0418a6dd486c1321df7125bc0c95631d27b795", 

    "failed": true, 

    "msg": "Ambiguous output redirect.\r\n", 

    "parsed": false

解决方法：

将对端主机10.10.1.11的用户shell修改为bash或者sh，vi /etc/passwd 将/bin/csh修改为/bin/sh

问题2：


2015-11-24 17:44:58,813 p=128823 u=root |  10.10.1.11 | FAILED! => {

    "changed": false,

    "checksum": "2b0418a6dd486c1321df7125bc0c95631d27b795",

    "failed": true,

    "msg": "Aborting, target uses selinux but python bindings (libselinux-python) aren't installed!"

}

解决办法：

在对端主机安装libselinux-python，可以使用yum安装yum install libselinux -y

问题3：

 #ansible 10.10.3.112 -m ping 

10.10.3.112 | UNREACHABLE! => {

    "changed": false, 

    "msg": "ERROR! SSH Error: data could not be sent to the remote host. Make sure this host can be reached over ssh", 

    "unreachable": true

解决办法：

"手工测试ssh无问题，感觉特别奇怪，包括重启sshd等均不好使，将debug打开   # ansible 10.10.3.112 -m ping -vvvvv 发现执行  SSH: EXEC sshpass -d15 sftp -b - -C -vvv -o ControlMaster=auto -o ControlPersist=60s -o StrictHostKeyChecking=no -o User=root -o ConnectTimeout=10 -o ControlPath=/root/.ansible/cp/ansible-ssh-%h-%p-%r这个的时候报错，检查sftp服务，进行手工测试sftp显示closed，查询此类问题解决办法后需要修改

改/etc/ssh/sshd_config中
Subsystem sftp /usr/libexec/openssh/sftp-server
改为
Subsystem       sftp    internal-sftp 
重启sshd后，sftp服务ok,ansible的问题也ok,开心一下。"



也可以用all或*表示全部：

all
*
192.168.1.*
用!表示非：

v1:!v2   #表示在v1分组中，但是不在v2中的hosts
用&表示交集部分：

webservers:&dbservers  #表示在webservers分组中，同时也在dbservers分组中的hosts:w
可以指定分组的下标或切片(超过范围则无法匹配)：

v1[0]
v1[0:100]