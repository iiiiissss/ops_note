server 
{
	listen 80;
	server_name *.mcyun.com mcyun.com;
	location / {
		proxy_redirect off;
       		proxy_set_header Host $host;
	       	proxy_set_header X-Real-IP $remote_addr;
	        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
		proxy_connect_timeout      600;
		proxy_send_timeout         600;
		proxy_read_timeout         600;
		proxy_buffer_size          4k;
		proxy_ignore_client_abort on;
		proxy_buffers              4 32k;
		proxy_busy_buffers_size    64k;
		proxy_temp_file_write_size 64k;
	        proxy_pass http://120.25.129.9:80;
	}
}
