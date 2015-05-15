server {
	listen 443;
	server_name www.kootv.com;
	root /data/webapp/www.kootv.com;
	index index.php index.html index.htm index.nginx-debian.html;
  
ssl on;
ssl_certificate /root/ssl/server.crt;
ssl_certificate_key /root/ssl/server.key;

ssl_session_timeout 5m;

ssl_protocols SSLv3 TLSv1 TLSv1.1 TLSv1.2;
ssl_ciphers "HIGH:!aNULL:!MD5 or HIGH:!aNULL:!MD5:!3DES";
ssl_prefer_server_ciphers on;
      
        location ~ [^/]\.php(/|$) {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php5-fpm.sock;
        }
        

	location / {
		# First attempt to serve request as file, then
		# as directory, then fall back to displaying a 404.
		try_files $uri $uri/ =404;
	}

}
server {
	listen 443;
	server_name kootv.com;
	rewrite ^(.*)$  https://www.kootv.com$1 permanent;
}
