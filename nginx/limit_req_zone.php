limit_req_zone ��limit_req

��������һ��limit_req_zone�����ã�
limit_req_zone

Syntax:	limit_req_zone $variable zone = name : size rate = rate
Default:	

Context:	http
��ָ����������http�ķ�Χ�����ã� 
 ʾ���� limit_req_zone  $binary_remote_addr  zone=one:10m   rate=1r/s;
�������ã�
��һ��������$binary_remote_addr ��ʾͨ��remote_addr�����ʶ�������ƣ���binary_����Ŀ������д�ڴ�ռ������
�ڶ���������zone=one:10m��ʾ����һ����СΪ10M������Ϊone���ڴ����������洢���ʵ�Ƶ����Ϣ
������������rate=1r/s��ʾ������ͬ��ʶ�Ŀͻ��˵ķ���Ƶ�Σ��������Ƶ���ÿ��1�Σ��������б���30r/m��д��

���ָ��ֻ��������ʹ�ã�����ִ�е�ʱ����Ҫ���ܵ���һ��ָ��limit_req
������һ��limit_req������
limit_req

Syntax:	limit_req zone = name [ burst = number ] [ nodelay ]
Default:	

Context:	http
server
location
��ָ����Է�����http��server����location�����������棬�����
ʾ����limit_req   zone=one  burst=5  nodelay;
�������ã�
��һ��������zone=one ����ʹ���ĸ����������������ƣ�������limit_req_zone ���name��Ӧ
�ڶ���������burst=5���ص�˵��һ��������ã�burst��������˼��������õ���˼������һ����СΪ5�Ļ�����
���д������󣨱���������ʱ�������˷���Ƶ�����Ƶ���������ȷŵ������������
������������nodelay��������ã���������Ƶ�ζ��һ�����Ҳ���˵�ʱ��ͻ�ֱ�ӷ���503�����û�����ã������������ȴ��Ŷ�

����������ÿ��������ض�UA�������������棩�ķ���
limit_req_zone  $anti_spider  zone=one:10m   rate=10r/s;
limit_req zone=one burst=100 nodelay;
if ($http_user_agent ~* "googlebot|bingbot|Feedfetcher-Google") {
    set $anti_spider $http_user_agent;
} 




nginx.conf:
limit_req_zone $binary_remote_addr zone=mcelf:10m rate=10r/s;

location:
limit_req zone=mcelf burst=15 nodelay;