只要web.config文件有变动，那么Application就会重新启动
 web.config里面有个 dbuge 调式改为 false  这样的话运行的会更快
在唯一密钥属性“value”设置为“index.php”时，无法添加类型为“add”的重复集合项
<clear />
<add value="index.php" />    
<add value="Default.htm" />

File.SetLastWriteTime(Server.MapPath("~/web.config"), DateTime.Now);
iisreset
1,Razor C# 语法规则  @DateTime.Now
Razor 代码块包含在 @{ ... } 中
内联表达式（变量和函数）以 @ 开头
代码语句用分号结束
变量使用 var 关键字声明
字符串用引号括起来
C# 代码区分大小写
C# 文件的扩展名是 .cshtml

布局:
@RenderPage("footer.cshtml")
@RenderBody()
@{Layout="Layout.cshtml";
下划线开头，可以防止这些文件在网上被浏览。_AppStart.cshtml写账号密码

"Account" 文件夹包含登录和安全文件
"App_Data" 文件夹包含数据库和数据文件
"Images" 文件夹包含图片
"Scripts" 文件夹包含浏览器脚本
"Shared" 文件夹包含公共的文件（比如布局和样式文件）
Properties
References
应用程序文件夹
App_Data 文件夹
Content 文件夹
Controllers 文件夹
Models 文件夹
Scripts 文件夹
Views 文件夹
配置文件
Global.asax
packages.config
Web.config



~ 运算符，在编程代码中规定虚拟路径。
var fileName = Server.MapPath(pathName);
@{var myStyleSheet = "~/Shared/Site.css";} href="@Href(myStyleSheet)"

_AppStart
_PageStart

@for(var i = 10; i < 21; i++)
{<p>Line @i</p>}