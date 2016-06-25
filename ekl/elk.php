https://www.gitbook.com/book/chenryn/kibana-guide-cn/details
http://kibana.logstash.es/content/logstash/

cluster_name一致， node_name不一致就好了，
可以在同一个网段自动发现新节点，也可以在配置文件的discovery.zen.ping.unicast.hosts属性中指定集群的节点IP
 egrep -v "^$|^#" elasticsearch.yml

$ bin/elasticsearch
On *nix systems, the command will start the process in the foreground.
Running as a daemonedit
To run it in the background, add the -d switch to it:
$ bin/elasticsearch -d
PIDedit
The Elasticsearch process can write its PID to a specified file on startup, making it easy to shut down the process later on:
$ bin/elasticsearch -d -p pid 
$ kill `cat pid` 

启动管理:
superior  
command=/data/services/elk/elasticsearch-2.3.3/bin/elasticsearch
注意修改: config/elasticsearch.yml  的network.host

# 查看elasticsearch健康状态
curl localhost:9200/_cat/health?v

curl 192.168.1.205:9200/_cat/health?v

# 查看elasticsearch indices
curl localhost:9200/_cat/indices?v
curl 192.168.1.205:9200/_cat/indices?v
# 删除指定的indices，这里删除了logstash-2015.09.26的indices
curl -XDELETE localhost:9200/logstash-2015.09.26
curl -XDELETE 192.168.1.205:9200/logstash-2015.09.26


logstash:

1,down tar 
2,Prepare a logstash.conf config file
3,Run bin/logstash agent -f logstash.conf

mkdir etc logs两个文件夹，etc用于存放配置文件，logs用于存放日志文件
/usr/local/logstash  agent –verbose --config /usr/local/logstash/etc/central.conf –log /usr/local/logstash/logs/stdou.log 

中心:
/data/services/elk/logstash-2.3.2/bin/logstash  agent –verbose --config /data/services/elk/logstash-2.3.2/etc/central.conf –log /data/services/elk/logstash-2.3.2/logs/stdou.log 
(205: 
/data/service/elk/logstash-2.3.2/bin/logstash  agent –verbose --config /data/service/elk/logstash-2.3.2/etc/central.conf –log /data/service/elk/logstash-2.3.2/logs/stdou.log 
客户端:
/data/services/elk/logstash-2.3.2/bin/logstash -f /data/services/elk/logstash-2.3.2/etc/logstash_agent.conf

用supervisor跑client, 由于没有$HOME变量, 必须设置: sincedb_path => "/dev/null"

?supervisor
/data/services/elk/logstash-2.3.2/bin/logstash --config /data/services/elk/logstash-2.3.2/etc/logstash_agent.conf

/data/services/elk/logstash-2.3.2/bin/logstash  agent –verbose --config /data/services/elk/logstash-2.3.2/etc/logstash_agent.conf –log /data/services/elk/logstash-2.3.2/logs/stdou.log 

中心:
 cat central.conf 
input {
  redis {
    host => "112.74.207.116"
    port => 16400
    type => "redis-input"
    data_type => "list"
    key => "logstash:redis"
  }
}

output {
  stdout {}
  elasticsearch {
    cluster => "elasticsearch"
    codec => "json"
    protocol => "http"
  }
}



客户端:
cat logstash_agent.conf 
input {
  file {
    type => "nginx_agent.conf"
    path => ["/var/log/nginx/access.log"]
	sincedb_path => "/dev/null"
  }
}
output {
  redis {
    host => "112.74.207.116"
    port => 16400
    data_type => "list"
    key => "logstash:redis"    
  }
}
多redis/输入流设置
http://my.oschina.net/u/2242064/blog/501402


kibana:
cd /usr/local/kibana/bin/
#./kibana程序即可。
设置config/kibana.yml
elasticsearch.url: "http://192.168.1.205:9200"

/data/services/elk/kibana-4.5.1/bin/kibana -c /data/services/elk/kibana-4.5.1/config/kibana.yml



ok：
中心:   
input {
   redis {
    host => '112.74.207.116'
    data_type => 'list'
    port => "16400"
    key => 'logstash:redis'
    type => 'redis-input'
    }
}
output {
    elasticsearch {
        hosts => ["192.168.1.201:9200"]
 }
}
///////// cat conf/client.conf 
input {
    file {
    add_field => {"Local_Host" => "nginx2"}
    type => "nginx_access"
    path => ["/var/log/nginx/access.log"]
    codec => json {
    charset => "UTF-8"
}
    }
  }
output {
        redis {
                host => "112.74.207.116"
                port => "16400"
                data_type => "list"
                key => "logstash:redis"
        }
}		






no ok:
input {
  redis {
    host => "112.74.207.116"
    port => 16400
    type => "redis-input"
#    type => "nginx_access"
    data_type => "list"
    key => "logstash:redis"
  }

}

output {
#  stdout {}
  elasticsearch {
#    cluster => "elasticsearch"
    hosts => ["192.168.1.205:9200"]
#    codec => "json"
#    protocol => "http"
#    index => "elk_test-%{+YYYY.MM.dd}"
  }
}
~      



安装插件 
head插件: (以查看集群几乎所有信息，还能进行简单的搜索查询，观察自动恢复的情况等等。)
[root@dev-vhost031 elasticsearch]#/usr/share/elasticsearch/bin/plugin -install mobz/elasticsearch-head
kopf插件:(它提供了一个简单的方法，一个elasticsearch集群上执行常见的任务。)

[root@dev-vhost031 elasticsearch]#/usr/share/elasticsearch/bin/plugin install lmenezes/elasticsearch-kopf/1.6
bigdesk插件: (集群监控插件，通过该插件可以查看整个集群的资源消耗情况，cpu、内存、http链接等等。)
[root@dev-vhost031 elasticsearch]#/usr/share/elasticsearch/bin/plugin -install lukas-vlcek/bigdesk

优化:
input threads => 10
output workers => 10



input {
  redis {
    host => '127.0.0.1'
    data_type => 'list'
    key => 'logstash:redis'
    threads => 10
    #batch_count => 1000
  }
}


output {
  elasticsearch {
    #embedded => true
    host => localhost
    workers => 10
  }
}




//多输入流设置 
input { 
redis { 
host => "127.0.0.1"
type => "redis-data-A"
data_type => "list"
key => "listA"
} 

redis { 
host => "127.0.0.1"
type => "redis-data-B"
data_type => "list"
key => "listB"
} 
}



output {
if [type] == "redis-data-A"{
elasticsearch { 
host => localhost 
index => "logstash_event_a-%{+YYYY.MM.dd}"
}
else if [type] == "redis-data-B"{
elasticsearch { 
host => localhost 
index => "logstash_event_b-%{+YYYY.MM.dd}"
}
stdout { codec => rubydebug }
}
}


//多文件
input {
file {
path => "c:\logs*.*"
start_position => "beginning"
}
}
filter {
if [path] =~ "access" {
mutate { replace => { type => "apache_access" } }
grok {
match => { "message" => "%{COMBINEDAPACHELOG}" }
}
date {
locale => "en"
match => [ "timestamp" , "dd/MMM/yyyy:HH:mm:ss Z" ]
}
} else if [path] =~ "error" {
mutate { replace => { type => "apache_error" } }
} else {
mutate { replace => { type => "random_logs" } }
}
}

output {
elasticsearch {
host => "localhost"
protocol => "http"
cluster => "bauer"
index => "test"
}
stdout {
codec => rubydebug
}
}

  

