groupadd tomcat
useradd -s /bin/false -g tomcat -d /home/tomcat tomcat

apt-get install tomcat7 ant

配置文件:
 /etc/default/tomcat7
 /usr/share/tomcat7
 /var/lib/tomcat7/webapps
 server.xml 
 service tomcat7 restart
 
改端口: 3处
conf/server.xml （Server port，Connector port ,AJP port）



<Context docBase="wk-web" path="/" reloadable="true" source="org.eclipse.jst.jee.server:wk-web"/>

tomcat/conf/logging.properties for the jars scanned by Tomcat to show up in the logs:
org.apache.jasper.servlet.TldScanner.level = FINE


maven
https://maven.apache.org/download.cgi
/etc/profile
export M2_HOME=/usr/local/maven
export PATH=$M2_HOME/bin:$PATH
 
 手动加jar包
 mvn install:install-file -DgroupId=org.apache.maven.plugins -DartifactId=maven-compiler-plugin -Dversion=3.6.1 -Dpackaging=jar -Dfile=/data/services/javalib/org.apache.maven.plugins-3.6.1.jar

 mvn install:install-file -DgroupId=cn.wizzer.framework -DartifactId=maven-compiler-plugin -Dversion=3.6.1 -Dpackaging=jar -Dfile=/data/services/javalib/org.apache.maven.plugins-3.6.1.jar

 Installing /data/services/javalib/org.apache.maven.plugins-3.6.1.jar to /root/.m2/repository/org/apache/maven/plugins/maven-compiler-plugin/3.6.1/maven-compiler-plugin-3.6.1.jar

 <dependency>
        <groupId>com.mysubpro</groupId>
        <artifactId>myproject</artifactId>
        <version>1.0-SNAPSHOT</version>
</dependency>
<modules>
    <module>myproject</module>
</modules>
 
 
cd /data/services
wget http://mirrors.tuna.tsinghua.edu.cn/apache/tomcat/tomcat-8/v8.5.5/bin/apache-tomcat-8.5.5.tar.gz
tar -xvf apache-tomcat-8.5.5.tar.gz
cd apache-tomcat-8.5.5
chgrp -R tomcat:tomcat conf && chmod g+rwx conf && chmod g+r conf/*

chown -R tomcat:tomcat work/ temp/ logs/


