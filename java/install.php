export JAVA_HOME=/usr/local/java
PATH=$PATH:/usr/local/java/bin


# rpm
wget --no-cookies \
--no-check-certificate \
--header "Cookie: oraclelicense=accept-securebackup-cookie" \
"http://download.oracle.com/otn-pub/java/jdk/7u55-b13/jdk-7u55-linux-x64.rpm" \
-O jdk-7-linux-x64.rpm

# ubuntu
wget --no-cookies \
--no-check-certificate \
--header "Cookie: oraclelicense=accept-securebackup-cookie" \
"http://download.oracle.com/otn-pub/java/jdk/8u121-b13/e9e7ea248e2c4826b92b3f075a80e441/jdk-8u121-linux-x64.tar.gz?AuthParam=1486817298_ad2226bdd1bfbe7db1fb626a356efb87?AuthParam=1484816677_3dfaaa47fc6036535d89262c2a215fdc" \
-O jdk-8u121-linux-x64.tar.gz
# then
tar -xzvf jdk-8u121-linux-x64.tar.gz



wget --no-cookies \
--no-check-certificate \
--header "Cookie: oraclelicense=accept-securebackup-cookie" \
"http://download.oracle.com/otn-pub/java/jdk/8u91-b14/jdk-8u91-linux-x64.tar.gz" \
-O jdk-7-linux-x64.tar.gz