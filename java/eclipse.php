JD-GUI  解jar包工具
jar -cvfM0 game.war ./
-c   创建war包
-v   显示过程信息
-f    
-M
-0   这个是阿拉伯数字，只打包不压缩的意思
解压game.war
jar -xvf game.war


[2016/12/12 上午2:57:10] 必赢科技TTP @  TTPS ENTERPRISE: 语音一下啊
[2016/12/12 上午2:57:32] gavin: 呼叫 - 正在通话
[2016/12/12 上午2:57:40] 必赢科技TTP @  TTPS ENTERPRISE: ？？
[2016/12/12 上午2:57:45] 必赢科技TTP @  TTPS ENTERPRISE: 语音一下


eclipse.php 

settings
.project
.classpath
.class
target
.DS_Store
*.iml
.idea





全局搜索  ^H
 
The superclass "javax.servlet.http.HttpServlet" was not found on the Java Build Path
1、右击web工程-》属性或Build Path-》Java Build Path->Libraries-> Add Libray...->Server Runtime -》Tomcat Server
2、切换到Java Build Path界面中的Orader and Export，选择Tomcat。