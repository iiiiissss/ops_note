log_format  main  'realip:$http_x_forwarded_for slbip:$remote_addr - $remote_user [$time_local] "$request" '
                '$status $body_bytes_sent "$http_referer" '
                '"$http_user_agent"';
        access_log /var/log/nginx/access.log main;
		
		
log_format main '$remote_addr - $remote_user [$time_local] "$request" $status $body_bytes_sent "$http_referer" "$http_user_agent" "$request_time" "$upstream_response_time"';
	access_log logs/${server_name}.access.log main;