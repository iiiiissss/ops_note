http://michaelkang.blog.51cto.com/1553154/1257476

http{
	limit_req_zone $binary_remote_addr zone=mcelf:10m rate=10r/s; #放在include等的前面
}

location /login {
                limit_req zone=mcelf burst=15 nodelay;
}