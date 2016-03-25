server {
        listen 80;
        server_name status.mcelf.com;
        location / {
                proxy_pass_header Server;
                proxy_set_header Host $http_host;
                proxy_redirect off;
                proxy_set_header REMOTE_ADDR $remote_addr;
                proxy_set_header X-Scheme $scheme;
                proxy_pass http://127.0.0.1:21001;
        }
}









upstream skin-status{
        server 127.0.0.1:21001;
}
server {

        listen 80;
        server_name status.mcelf.com;
        client_max_body_size 0;

        proxy_set_header X-Real-IP $remote_addr;

        location / {
                proxy_pass http://skin-status;
        }
}