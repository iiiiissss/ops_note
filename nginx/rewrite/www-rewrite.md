# redirect http(s)://www.example.com to http(s)://example.com
server {
    server_name www.example.com;
    return 301 $scheme://example.com$request_uri;
}

# redirect http(s)://example.com to http(s)://www.example.com
server {
    server_name example.com;
    return 301 $scheme://www.$host$request_uri;
}



server {
    　　listen 80;
    　　server_name yuncode.com yuncode.cn;
}
server {
    　　listen 80;
    　　server_name yuncode.cn;
    　　rewrite ^ (.*)$ http://yuncode.com$1 permanent;
}

#无www跳转到有www
server {
    server_name www.yuncode.com yuncode.com ;
    if ($host != 'www.yuncode.com' ) {
        rewrite ^ / (.*)$ http: //www.yuncode.com/$1 permanent;
    }
}
