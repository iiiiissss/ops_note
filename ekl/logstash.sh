ÖÐÐÄ:
/etc/logstash/conf.d/central.conf
input {
    redis {
        host => "127.0.0.1"
        port => 6379
        type => "redis-input"
        data_type => "list"
        key => "key_count"
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


Ô¶³Ìlogstash£¨shipper£©ÅäÖÃ£¬/etc/logstash/conf.d/shipper.conf
input {
    file {
        type => "type_count"
        path => ["/data/logs/count/stdout.log", "/data/logs/count/stderr.log"]
        exclude => ["*.gz", "access.log"]
    }
}
output {
    stdout {}
    redis {
        host => "20.8.40.49"
        port => 6379
        data_type => "list"
        key => "key_count"
    }
}


log_format main '$remote_addr - $remote_user [$time_local]'
'"$request" $status $bytes_sent '
'"$http_referer" "$http_user_agent" $request_time'; 
access_log /var/log/nginx/access.log main;

filter {
    grok {
        match => { 'message' => '%{IP:remote_addr} - - \[%{HTTPDATE:time_local}\]"%{WORD:http_method} %{URIPATHPARAM:request} HTTP/%{NUMBER:httpversion}" %{NUMBER:status} %{NUMBER:body_bytes_sent} (?:\"(?:%{URI:http_referer}|-)\"|%{QS:http_referer}) %{QS:http_user_agent} %{NUMBER:request_time}' }
        remove_field => ["message"]
    }
    date {
        match => ["time_local", "dd/MMM/YYYY:HH:mm:ss Z"]
    }
}

http://grokdebug.herokuapp.com/



input {
    file {
        path => [ "/home/work/log/nginx/access.*" ]
        type => "nginx_access"
        sincedb_path => "/home/work/logstash-2.1.1/sincedb"
    }
    file {
        path => [ "/home/work/log/nginx/error.*" ]
        type => "nginx_error"
        sincedb_path => "/home/work/logstash-2.1.1/sincedb"
    }
}

filter {
    if [type] == "nginx_access" {
        grok {
            match => { "message" => "%{NGINXACCESS}" }
        }
        date {
            match => [ "timestamp" , "dd/MMM/YYYY:HH:mm:ss Z" ]
        }
        geoip {
            source => "clientip"
        }
    }
    if [type] =="nginx_error" {
        grok {
            match => {
                "message" => "(?<timestamp>%{YEAR}[./-]%{MONTHNUM}[./-]%{MONTHDAY}[- ]%{TIME}) \[%{LOGLEVEL:severity}\] %{POSINT:pid}#%{NUMBER}: %{GREEDYDATA:errormessage}(?:, client: (?<client>%{IP}|%{HOSTNAME}))(?:, server: %{IPORHOST:server})(?:, request: %{QS:request})?(?:, upstream: \"%{URI:upstream}\")?(?:, host: %{QS:host})?(?:, referrer: \"%{URI:referrer}\")"
            }
        }
    }
}

output {
    elasticsearch { hosts => "127.0.0.1:9200" index => "logstash-nobsu-access-%{+YYYY.MM.dd}" }
}




