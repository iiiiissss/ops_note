多远程管理, 支持rdp,ssh   mRemoteNG 

MAC 下RDC 连接windows7提示“远程桌面连接无法验证您希望连接的计算机的身份” 
解决方法：
开启组策略中远程桌面链接安全层。
1、开始-运行-gpedit.msc，进入组策略编辑器；
2、找到左侧边栏计算机配置-管理模板-Windows组件-远程桌面服务-远程桌面会话主机-安全项；
3、修改以下两项：
    A,远程（RDP）连接要求使用指定的安全层，改为启用，安全层选择RDP
    B,要求使用网络级别的身份验证对远程连接的用户进行身份验证，改为禁用；
4、关闭组策略编辑器，重启计算机。


允许多人登录
administrator
管理工具->远程桌面服务->远程桌面会话主
	右键RDP-Tcp，属性，网络适配器.  可设置最大连接数机配置
限制每个用户只能进行一个回话，如果勾选（如administrator用户登陆，一个登录后另一个就被踢掉）

远程桌面改端口:
打开Windows 2008注册表： 运行regedit。
　　找到：[HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Control\Terminal Server\Wds\rdpwd\Tds\tcp] 双击右边 PortNumber——点十进制——更改值为：25608 —— 点确定。
　　然后找到： [HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Control\Terminal Server\WinStations\RDP-Tcp] 双击右边 PortNumber——点十进制——更改值为：25608 —— 点确定。

　　到些就改好了，然后记得要在Windows 2008防火墙设置一下开放刚刚改好的端口。
