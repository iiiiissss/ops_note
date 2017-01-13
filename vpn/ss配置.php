supervisor:

[program:sss]
command=ssserver -c /etc/shadowsocks.json start
process_name=sss
autorestart=true
redirect_stderr=true
stderr_logfile=/data/logs/sss.err.log
stdout_logfile=/data/logs/sss.out.log
directory=/data
user=root





root@hk1:~# cat /etc/shadowsocks.json 
{
    "server":"47.90.39.1",
    "server_port":8888,
    "local_address": "127.0.0.1",
    "local_port":1080,
    "password":"..",
    "timeout":300,
    "method":"aes-256-cfb",
    "fast_open": false
}




多用户:
root@hk1:~# cat /etc/shadowsocks.json 
{
    "server":"47.90.39.1",
    "port_password":{
        "8888":"..",
        "58888":""
    },
    "timeout":300,
    "method":"aes-256-cfb"
}

python的:多端口,不能多进程
c的:多进程,不能多端口



