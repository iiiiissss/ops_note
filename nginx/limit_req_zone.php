limit_req_zone 和limit_req

首先来看一下limit_req_zone的配置：
limit_req_zone

Syntax:	limit_req_zone $variable zone = name : size rate = rate
Default:	

Context:	http
该指令必须放置在http的范围内配置； 
 示例： limit_req_zone  $binary_remote_addr  zone=one:10m   rate=1r/s;
如上配置，
第一个参数：$binary_remote_addr 表示通过remote_addr这个标识来做限制，“binary_”的目的是缩写内存占用量；
第二个参数：zone=one:10m表示生成一个大小为10M，名字为one的内存区域，用来存储访问的频次信息
第三个参数：rate=1r/s表示允许相同标识的客户端的访问频次，这里限制的是每秒1次，还可以有比如30r/m的写法

这个指令只是做配置使用，具体执行的时候需要介绍到另一个指令limit_req
先来看一下limit_req的配置
limit_req

Syntax:	limit_req zone = name [ burst = number ] [ nodelay ]
Default:	

Context:	http
server
location
该指令可以放置在http，server或者location的上下文里面，很灵活
示例：limit_req   zone=one  burst=5  nodelay;
如上配置，
第一个参数：zone=one 设置使用哪个配置区域来做限制，与上面limit_req_zone 里的name对应
第二个参数：burst=5，重点说明一下这个配置，burst爆发的意思，这个配置的意思是设置一个大小为5的缓冲区
当有大量请求（爆发）过来时，超过了访问频次限制的请求可以先放到这个缓冲区内
第三个参数：nodelay，如果设置，超过访问频次而且缓冲区也满了的时候就会直接返回503，如果没有设置，则所有请求会等待排队

下面这个配置可以限制特定UA（比如搜索引擎）的访问
limit_req_zone  $anti_spider  zone=one:10m   rate=10r/s;
limit_req zone=one burst=100 nodelay;
if ($http_user_agent ~* "googlebot|bingbot|Feedfetcher-Google") {
    set $anti_spider $http_user_agent;
} 




nginx.conf:
limit_req_zone $binary_remote_addr zone=mcelf:10m rate=10r/s;

location:
limit_req zone=mcelf burst=15 nodelay;