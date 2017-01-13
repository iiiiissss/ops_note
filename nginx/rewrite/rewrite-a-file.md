server {
        listen 80;

        server_name passport.mcelf.com;

        location / {
                proxy_pass_header Server;
                proxy_set_header Host $http_host;
                proxy_redirect off;
                proxy_set_header REMOTE_ADDR $remote_addr;
                proxy_set_header X-Scheme $scheme;
                proxy_pass http://127.0.0.1:20001;
        }
        location = /crossdomain.xml {
                root /data/goapp/resources/passport-web;
                try_files  $uri $uri/ /crossdomain.xml ;          
        }

}