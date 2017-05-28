允许ping:
netsh firewall set icmpsetting 8
禁止Ping：
netsh firewall set icmpsetting 8 disable

or

1. 进入控制面板——>管理工具——>找到 “高级安全 Windows防火墙”
2. 点击 入站规则
3. 找到 回显请求-ICMPv4-In （Echo Request – ICMPv4-In）
4. 右键 点击规则 点击“启用规则（Enable）”
