deploy.php


maven + tomcat





http://www.fblinux.com/?p=489

#!/bin/bash
# 设置时间变量
CTIME=$(date "+%Y-%m-%d-%H-%M")
# 项目名称，建议和gitlab仓库名称一致
project=
# 本地代码目录（gitlab拉取代码后存放目录）
CODE_DIR=/data/gitlab/"$project"
# 临时代码目录，用来修改配置文件和编译打包代码
TMP_DIR=/data/tmp/"$project"
# 用来存放war包
WAR_DIR=/data/war/"$project"
# 对应环境配置文件
deploy_conf=/data/conf/pro/"$project"/*
# 代码中的配置文件路径
local_conf=$TMP_DIR/src/main/resources/config
# 远程主机名称
REMOTE_HOST="tomcat-01 tomcat-02"
# 远程主机代码目录
REMOTE_CODE_DIR=/data/webapps/"$project"
# 远程主机用户
REMOTE_USER=root
# 远程主机war包存放目录
REMOTE_WAR_DIR=/data/war/
# 代码临时目录
CODE_TMP=/data/code_tmp/
# 上线日志
DEPKOY_LOG=/data/log/pro_log.log
  
# 脚本使用帮助
usage(){
   echo $"Usage: $0 [deploy tag | rollback_list | rollback_pro ver]"
}
  
# 拉取代码
git_pro(){
   if [ $# -lt 1 ];then
        echo "请传入tag"
        exit 1
   fi
   tag=$1
   cd $CODE_DIR && git checkout master && git pull && git checkout $1
   if [ $? != 0 ];then
    echo "拉取代码失败"
    exit 10
   fi
   cd $CODE_DIR && git pull 2>/dev/null >/dev/null
   # 推送代码到临时目录
   rsync -avz --delete $CODE_DIR/ $TMP_DIR/ 2>/dev/null >/dev/null
}
  
# 设置代码的配置文件
config_pro(){
   echo "设置代码配置文件"
   rm -f $local_conf/config.properties
   rm -f $local_conf/alipay.properties
   rm -f $local_conf/jdbc.properties
   rm -f $local_conf/log4j.properties
   cp $deploy_conf $local_conf/
}
  
# 打包代码
tar_pro(){
   echo "本地打包代码"
   cd $TMP_DIR && /usr/local/maven/bin/mvn clean compile war:war && cp target/"$project".war "$WAR_DIR"/"$project"_"$tag"_"$CTIME".war
}
  
# 推送war包到远端服务器
rsync_pro(){
   echo "推送war包到远端服务器"
   for host in $REMOTE_HOST;do
    scp "$WAR_DIR"/"$project"_"$tag"_"$CTIME".war $REMOTE_USER@$host:$REMOTE_WAR_DIR
   done
}
  
# 解压代码包
solution_pro(){
   echo "解压代码包"
   for host in $REMOTE_HOST;do
    ssh $REMOTE_USER@$host "unzip "$REMOTE_WAR_DIR""$project"_"$tag"_"$CTIME".war -d "$CODE_TMP""$project"_"$tag"_"$CTIME"" 2>/dev/null >/dev/null
   done
}
 
# api测试
test_pro(){
   # 运行api测试脚本，如果api测试有问题，则退出部署
   if [ $? != 0 ];then
    echo "API测试存在问题，退出部署"
    exit 10
   fi
}
 
 
# 部署代码
deploy_pro(){
   echo "部署代码"
   for host in $REMOTE_HOST;do
    ssh haproxy "echo "disable server $project/$host" | /usr/bin/socat /var/lib/haproxy/stats stdio"
    ssh $REMOTE_USER@$host "rm -r $REMOTE_CODE_DIR"
    ssh $REMOTE_USER@$host "ln -s "$CODE_TMP""$project"_"$tag"_"$CTIME"/ $REMOTE_CODE_DIR"
    echo "重启$host"
    ssh $REMOTE_USER@$host "/etc/init.d/tomcat restart"
    sleep 3
    # 执行api测试
    test_pro
    ssh haproxy "echo "enable server $project/$host" | /usr/bin/socat /var/lib/haproxy/stats stdio"
   done
}
# 列出可以回滚的版本
rollback_list(){
  echo "------------可回滚版本-------------"
  ssh $REMOTE_USER@$REMOTE_HOST "ls -r "$CODE_TMP" | grep -o $project.*"
}
  
# 回滚代码
rollback_pro(){
  echo "回滚中"
  for host in $REMOTE_HOST;do
    ssh haproxy "echo "disable server $project/$host" | /usr/bin/socat /var/lib/haproxy/stats stdio"
    ssh $REMOTE_USER@$host "rm -rf $REMOTE_CODE_DIR"
    ssh $REMOTE_USER@$host "ln -s "$CODE_TMP"$1/ $REMOTE_CODE_DIR"
    ssh $REMOTE_USER@$host "/etc/init.d/tomcat restart"
    sleep 3
    ssh haproxy "echo "enable server $project/$host" | /usr/bin/socat /var/lib/haproxy/stats stdio"
  done
}
  
# 记录日志
record_log(){
  echo "$CTIME 主机:$REMOTE_HOST 项目:$project tag:$1" >> $DEPKOY_LOG
}
  
# 代码执行选项设置
main(){
  case $1 in
   deploy)
   git_pro $2;
   config_pro;
   tar_pro;
   rsync_pro;
   solution_pro;
   deploy_pro;
   record_log $2;
   ;;
   rollback_list)
   rollback_list;
   ;;
   rollback_pro)
   rollback_pro $2;
   record_log;
   ;;
   *)
   usage;
   esac
}
main $1 $2





http://outofmemory.cn/code-snippet/34504/java-web-project-publish-script-Tomcat-release
需要在 Tomcat 中的 bin/catalina.sh 指定 Tomcat 的 PID 文件路径（如：CATALINA_PID=$CATALINA_HOME"/logs/tomcat.pid"）

#!/bin/bash
PROJECT_NAME=project-name
DOMAIN=www.domain.com
HOME_ROOT="/home/htdocs/"
SOURCE_DIR=$HOME_ROOT"source"
WEB_ROOT=$HOME_ROOT""$DOMAIN"/"
TOMCAT_HOME="/usr/local/Tomcat-"$DOMAIN"/"
UPDATE_FILE_LOG=$HOME_ROOT"release/logs/"$PROJECT_NAME".log"

update_code(){
        rm -f $UPDATE_FILE_LOG
        git pull >> $UPDATE_FILE_LOG
}

install(){
        cd $PROJECT_NAME
        /usr/local/apache-maven/bin/mvn clean 2>> $UPDATE_FILE_LOG
        /usr/local/apache-maven/bin/mvn -P release install 2>> $UPDATE_FILE_LOG
}

backup(){
        TIME=`date +"%Y-%m-%d-%H"`
        BACKUP_FILE=$HOME_ROOT"backup/"$PROJECT_NAME"_"$TIME".tar.gz"
        cd $HOME_ROOT
        tar -zcf $BACKUP_FILE $DOMAIN
}

deploy(){
        TEMP=$WEB_ROOT"*"
        rm -fR $TEMP
        TEMP=$TOMCAT_HOME"work/Catalina/"$DOMAIN
        sudo rm -fR $TEMP
        TEMP=$SOURCE_DIR"/"$PROJECT_NAME"/target/"$PROJECT_NAME"/*"
        sudo cp -fR $TEMP $WEB_ROOT
}

restart(){
        bash $TOMCAT_HOME"bin/catalina.sh" stop -force
        sleep 5
        bash $TOMCAT_HOME"bin/catalina.sh" start
}

help(){
        echo $"Usage: $0 {update_code|install|backup|deploy|restart}"
}

cd $SOURCE_DIR

case "$1" in
update_code)
        update_code
;;
install)
        install
;;
backup)
        backup
;;
deploy)
        deploy
;;
restart)
        restart
;;
-h)
        help
;;
--help)
        help
;;
*)
        update_code
        install
        backup
        deploy
        restart
;;

esac

exit 0




