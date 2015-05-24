取第一个.php为准, 支持一般框架:/index.php/foo/bar.php?v=1
1.8.0 up:
location ~ [^/]\.php(/|$) {
               include snippets/fastcgi-php.conf;
               fastcgi_pass unix:/run/php5-fpm.sock;
        }


old:

location ~ [^/]\.php(/|$) {
                fastcgi_split_path_info ^(.+?\.php)(/.*)$;
                if (!-f $document_root$fastcgi_script_name) {
                        return 404;
                }
 
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_index index.php;
                include fastcgi_params;
        }
		
fastcgi_pass unix:/var/run/php5-fpm.sock;

location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ [^/]\.php(/|$) {
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;
        }
