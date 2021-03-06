#ln -s /data/deploy/process_compile/fenjie/ApiAdmin/wk-framework/src/main/java/cn/wizzer/framework /data/deploy/process_compile/fenjie/ApiAdmin/wk-app/wk-web/src/main/java/cn/wizzer/framework
#!/bin/bash

#java     lib/commons-net-3.3.jar
#

CTIME=$(date "+%Y%m%d%H%M")
project=fenji
CODE_DIR=/data/deploy/"$project"
# 临时代码目录，用来修改配置文件和编译打包代码
TMP_DIR=/data/deploy/process_compile/"$project"
# 用来存放war包
WAR_DIR=/data/deploy/process_war/"$project"
# 对应环境配置文件
deploy_conf=/data/deploy/process_conf/"$project"/*
# 代码中的配置文件路径
local_conf=$TMP_DIR/src/main/resources/config
# 远程主机名称 空格隔开
REMOTE_HOST="uj1 uj2"
# 远程主机代码目录
REMOTE_CODE_DIR=/data/deploy/"$project"
# 远程主机用户
REMOTE_USER=root
# 远程主机war包存放目录
REMOTE_WAR_DIR=/data/javaweb/
# 代码临时目录
CODE_TMP=/data/tmp/
# 上线日志
DEPKOY_LOG=/data/log/deploy_log.log
# 脚本使用帮助
usage(){
   echo $"Usage: $0 [deploy tag | rollback_list | rollback_pro ver]"
}
# 拉取代码
svn_pro(){
    cd $CODE_DIR && svn update
    # rsync -avz --delete --cvs-exclude /data/deploy/fenjie/ /data/deploy/process_compile/fenjie/ 
    rsync -avz --delete --cvs-exclude $CODE_DIR/ $TMP_DIR/
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
   cd $TMP_DIR && /usr/local/maven/bin/mvn clean compile war:war && cp target/"$project".war "$WAR_DIR"/"$project"_"$CTIME".war
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
   svn_pro; #git_pro $2;
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