global_defs {  
     notification_email {
            835150938@qq.com  
     }
     notification_email_from localhost #  
     smtp_server 127.0.0.1  
     smtp_connect_timeout 30  
     #router_id LVS_DEVEL  
     router_id LVS_MASTER //麓痈潞脭禄煤要脨赂牡牡胤陆拢卢脦赂某脡VS_BACKUP  
}  
vrrp_instance VI_1 {  
        state MASTER //麓痈潞脭禄煤要脨赂牡牡胤陆拢卢脦赂某脡ACKUP  
        interface eth0  
        virtual_router_id 51  
        priority 100 //麓臃镁脦脝脨要脨赂牡牡胤陆赂某杀脠00小碌脛媒某脡9  
        advert_int 1  
        authentication {  
                auth_type PASS  
                auth_pass 1111  
        }  
        virtual_ipaddress {  
                #192.168.200.16  
                #192.168.200.17  
                #192.168.200.18  
                192.168.1.241  
        }  
}  
#virtual_server 192.168.200.100 443 {  
virtual_server 192.168.1.241 80 {  
        delay_loop 6  
        lb_algo rr  
        #lb_kind NAT  
        lb_kind DR  
        nat_mask 255.255.255.0  
        persistence_timeout 0 #50  
        protocol TCP
        real_server 192.168.1.202 80 {  
                weight 1  
                TCP_CHECK {  
                connect_timeout 10 #10 
                nb_get_retry 3  
                delay_before_retry 3  
                connect_port 80  
                }
                }  
        real_server 192.168.1.205 80 {  
                 weight 1  
                 TCP_CHECK {  
                    connect_timeout 10 #10
                    nb_get_retry 3  
                    delay_before_retry 3  
                    connect_port 80  
                                }                     
                }  
}  