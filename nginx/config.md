# 问问

location ~ \.php$ {
               include snippets/fastcgi-php.conf;
               fastcgi_pass unix:/run/php5-fpm.sock;
               fastcgi_index index.php;
               include fastcgi_params;
        }
location ~ \.php$ {
       include snippets/fastcgi-php.conf;
       fastcgi_pass unix:/run/php5-fpm.sock;
	   fastcgi_index index.php;
       include fastcgi_params;
}
		
403 该目录/文件无执行权限 (755)
php 空白:
无 include snippets/fastcgi-php.conf;
或 fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;