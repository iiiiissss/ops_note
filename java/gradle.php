gradle替代maven
https://my.oschina.net/enyo/blog/369843



// 布署至远程服务器，上传的war名为app.war
task deploy(dependsOn: war) << {
  ssh.run {
    session(remotes.server) {
        put "$war.archivePath.path", "$tomcatPath/webapps/app.war"
        execute "$tomcatPath/bin/shutdown.sh"
        execute "rm -rf $tomcatPath/webapps/ROOT/*"
        execute "unzip -oq $tomcatPath/webapps/app.war -d $tomcatPath/webapps/ROOT"
        execute "rm -f $tomcatPath/webapps/app.war"
        execute "$tomcatPath/bin/startup.sh"
    }
  }
}
deploy只是简单的执行shell命令，上传war包，关闭tomcat，解压war，删除war，启动tomcat。 布署命令：gradle clean app:deploy