ping:
ansible all -m ping
ansible group1 -m ping -u ubuntu --sudo --ask-sudo-pass

普通命令(-m 默认command):
ansible all -a "/bin/echo hello"
ansible all -a "ls /root" -u ubuntu --sudo --ask-sudo-pass
重启web服务(service) 启动started  关闭stopped
ansible webservers -m service -a "name=httpd state=restarted"
复制文件(copy)
ansible webserver -m copy -a "src=/home/bot/code/pypops/pops_asyncore.py dest=/usr/local/bin/pops_asyncore.py" --sudo --ask-sudo-pass
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

ansible-playbook playbook.yml -f 10

-f : 每次执行多少台.
-K --ask-sudo-pass 要sudo密码
-u --user

palybook:
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