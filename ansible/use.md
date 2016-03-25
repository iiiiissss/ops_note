ping:
ansible all -m ping
ansible -i ～/hosts all -m command -a ‘who’ -u root
主要参数如下：
-u username          指定ssh连接的用户名，即执行后面命令的用户
-i inventory_file    指定所使用的inventory文件的位置，默认为/etc/ansible/hosts
-m module            指定使用的模块，默认为command
-f 10                指定并发数，并发量大的时候，提高该值
--sudo [-k]          当需要root权限执行的化，-k参数用来输入root密码

普通命令(-m 默认command):
ansible all -a "/bin/echo hello"
ansible all -a "ls /root" -u ubuntu --sudo --ask-sudo-pass
重启web服务(service) 启动started  关闭stopped
ansible webservers -m service -a "name=httpd state=restarted"
复制文件(copy)

 --sudo --ask-sudo-pass
文件权限 改/增/删(file)
ansible webservers -m file -a "dest=/srv/foo/b.txt mode=600 owner=mdehaan group=mdehaan"
ansible webservers -m file -a "dest=/path/to/c mode=755 owner=mdehaan group=mdehaan state=directory"
ansible webservers -m file -a "dest=/path/to/c state=absent"
包管理(apt)
ansible webservers -m apt -a "name=acme state=present" #安装 不更新
ansible webservers -m apt -a "name=acme-1.5 state=present" #安装到特定版本
ansible webservers -m apt -a "name=acme state=latest" 
ansible webservers -m apt -a "name=acme state=absent" #删除
新建/删除用户(user)
ansible all -m user -a "name=foo password=<crypted password here>"
ansible all -m user -a "name=foo state=absent"
-B 表示后台执行的时间
ansible all -B 3600 -a "/usr/bin/long_running_operation --do-stuff"
ansible all -m async_status -a "jid=123456789"  #检查任务的状态
搜集系统信息(setup) 并以主机名为文件名分别保存在/tmp/facts 目录
ansible all -m setup --tree /tmp/facts
搜集和内存/网卡相关的信息
ansible all -m setup -a 'filter=ansible_*_mb'
ansible all -m setup -a 'filter=ansible_eth[0-2]'
服务类(service)
ansible all -m service -a "name=network state=restarted args=eth0" --sudo --ask-sudo-pass
shell 
ansible web3 -m shell -a "cd /root;ls"


ansible-playbook playbook.yml -f 10

-f : 每次执行多少台.
-K --ask-sudo-pass 要sudo密码
-u --user

看系统变量
ansible -m setup hostname
https://api.ipify.org/
https://api.ipify.org?format=jsonp
http://ipecho.net/plain

palybook:

https://github.com/ansible/ansible-examples

ansible-playbook playbook.yml -i inventory.ini --user=ubuntu --ask-sudo-pass

---
- hosts: all
  remote_user: ubuntu
  sudo: yes
  tasks:
    - command: ping
       sudo: yes
	   
	   
	   
yml:
hosts: all
accelerate: true
tasks:
	name: some task
	command: echo {{ item }}
	with_items:
		foo
		bar
		baz