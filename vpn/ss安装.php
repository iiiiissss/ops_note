apt-get update
apt-get install python-pip
pip install shadowsocks



写一个配置文件保存为s，文件内容如下：

{
    "server":"my_server_ip",
    "server_port":8388,
    "local_address": "127.0.0.1",
    "local_port":1080,
    "password":"mypassword",
    "timeout":300,
    "method":"aes-256-cfb",
    "fast_open": false
}

or:

{
    "server":"103.57.111.225",
    "port_password":{
        "8388":"123321abccba",
        "58888":"zijiangogogo"
    },
    "timeout":300,
    "method":"aes-256-cfb"
}
server, server_port, password 需要自行根据自己的实际情况修改。

ssserver -c /etc/shadowsocks.json -d start

server:服务器IP
server_port:自己定义
password:自己定义