配置只有两个文件: ansible.cfg  hosts (一般在/etc/ansible 下)
基本:
hosts:
[group1]
192.168.1.108
[group2]
192.168.1.107
192.168.1.113
#端口是ssh连接端口 
some[01:12].example.com:5396
some[a:f].example.com
other1.example.com ansible_connection=ssh ansible_ssh_user=mpdehaan
jumper ansible_ssh_port=5555 ansible_ssh_host=192.168.1.50
[atlanta]
#指定变量/组变量 在playbooks中使用
host1 http_port=80 maxRequestsPerChild=808
[atlanta:vars]
ntp_server=ntp.atlanta.example.com
#组中包含其他组
[atlanta2]
host1
host2
[raleigh]
host2
host3
[southeast:children]
atlanta2
raleigh

#可以用文件存变量
/etc/ansible/host_vars/host1
/etc/ansible/group_vars/raleigh 

ansible.cfg

hostfile       = /etc/ansible/hosts
library        = /usr/share/ansible
remote_tmp     = $HOME/.ansible/tmp
pattern        = *
forks          = 5
poll_interval  = 15
sudo_user      = ubuntu
#ask_sudo_pass = True
#ask_pass      = True
transport      = smart
remote_port    = 22
host_key_checking = False

#
去除首次连接提示:
host_key_checking = False 
export ANSIBLE_HOST_KEY_CHECKING=False
paramiko 模式时，主机 keys 的检查会很慢
设置了 no_log: True 会不记录日志
/etc/ansible 目录使用 git/svn 来进行版本控制

分组语法:
