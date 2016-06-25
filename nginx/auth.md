htpasswd -cb /etc/nginx/passwd.db consul_aliyun 505gogogo.




server {
        listen 80;
        server_name consul.aliyun.mcyun.com;
        location / {
                proxy_pass_header Server;
                proxy_set_header Host $http_host;
                proxy_redirect off;
                proxy_set_header REMOTE_ADDR $remote_addr;
                proxy_set_header X-Scheme $scheme;
                proxy_pass http://127.0.0.1:8500;
                auth_basic "secret";
                auth_basic_user_file /etc/nginx/passwd.db;
        }

}