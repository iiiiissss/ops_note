# elk
server {
    listen 80;
    server_name elk.chenjiehua.me;

    #auth_basic "Restricted Access";
    #auth_basic_user_file /home/ubuntu/htpasswd.users;

    location / {
        proxy_pass http://localhost:5601;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}




$sudo apt-get install&amp;nbsp;apache2-utils
# 新建一个kibana认证用户
$sudo htpasswd -c /home/ubuntu/htpasswd.users kibana
# 然后按提示设置kibana密码
 
$sudo nginx -t
$sudo nginx -s reload