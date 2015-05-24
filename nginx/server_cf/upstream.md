#web1     | 192.168.70.34  | 192.168.30.34  | 112.175.106.164
#web2     | -               |  192.168.30.31	 | 112.175.106.168
#web3     | 192.168.70.24   |  192.168.30.24	 | 112.175.106.172
#file3    | 192.168.70.150  |  192.168.30.35  | 112.175.106.171 
#fulltext3| 192.168.70.51  |  192.168.200.51  | 112.175.106.177 

upstream web_proxy
{
        ip_hash;
        keepalive 32;
		#web1     | 192.168.70.34  | 192.168.30.34  | 112.175.106.164
        server 192.168.30.34:80 max_fails=2 fail_timeout=10s;
		
		#web2     | -               |  192.168.30.31	 | 112.175.106.168
        server 192.168.30.31:80 max_fails=2 fail_timeout=10s;
		
		#web3     | 192.168.70.24   |  192.168.30.24	 | 112.175.106.172
        server 192.168.30.24:80 max_fails=2 fail_timeout=10s;
		
		#file3    | 192.168.70.150  |  192.168.30.35  | 112.175.106.171 
		server 192.168.30.35:80 max_fails=2 fail_timeout=10s;
		 
		#fulltext3| 192.168.70.51  |  192.168.200.51  | 112.175.106.177 
		server 192.168.200.51:80 max_fails=2 fail_timeout=10s;
}



#
upstream gate_proxy
{
        ip_hash;
        keepalive 32;
        # 113.107.239.220
        server 10.20.81.161:80 max_fails=2 fail_timeout=10s;
        # 113.107.239.221
        server 10.20.81.162:80 max_fails=2 fail_timeout=10s;
}

upstream logical_proxy
{
        ip_hash;
        keepalive 32;
        # 113.107.239.220
        server 10.20.81.161:80 max_fails=2 fail_timeout=10s;
        # 113.107.239.221
        server 10.20.81.162:80 max_fails=2 fail_timeout=10s;
}


upstream fulltext_proxy
{
        ip_hash;
        keepalive 32;
        # 113.107.239.220
        server 10.20.81.161:80 max_fails=2 fail_timeout=10s;
        # 113.107.239.221
        server 10.20.81.162:80 max_fails=2 fail_timeout=10s;
}