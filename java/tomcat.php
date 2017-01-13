groupadd tomcat
useradd -s /bin/false -g tomcat -d /home/tomcat tomcat

apt-get install tomcat7 ant

配置文件:
 /etc/default/tomcat7
 /usr/share/tomcat7
 /var/lib/tomcat7/webapps
 
 server.xml
 
 
 service tomcat7 restart
 
 
 
 
 
 
 
cd /data/services
wget http://mirrors.tuna.tsinghua.edu.cn/apache/tomcat/tomcat-8/v8.5.5/bin/apache-tomcat-8.5.5.tar.gz
tar -xvf apache-tomcat-8.5.5.tar.gz
cd apache-tomcat-8.5.5
chgrp -R tomcat:tomcat conf && chmod g+rwx conf && chmod g+r conf/*

chown -R tomcat:tomcat work/ temp/ logs/


