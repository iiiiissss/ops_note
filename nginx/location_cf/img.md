location ~* \.(?:ico|css|js|gif|jpe?g|png)$ {
    expires 30d;
    add_header Pragma public;
    add_header Cache-Control "public";
}


location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
                        {
                                expires      30d;
                        }

                location ~ .*\.(js|css)?$
                        {
                                expires      12h;
                        }

                access_log  /home/wwwlogs/www.coofly.com.log  access;
				

location ~ .*\.(gif|jpg|jpeg|png|bmp|swf|js|css)$   {
                           expires      30d;
              }
						
						
						
						
						
location ~* \.(?:ico|css|js|gif|jpe?g|png)$ {
    expires 30d;
    add_header Pragma public;
    add_header Cache-Control "public";
}