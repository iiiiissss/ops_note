HTTP核心模块支持一些内置变量，变量名与apache里的对应。比如 $http_user_agent，$http_cookie等表示HTTP请求信息的变量。
更多变量：
$args, 请求中的参数;

$content_length, HTTP请求信息里的"Content-Length";

$content_type, 请求信息里的"Content-Type";

$document_root, 针对当前请求的根路径设置值;

$document_uri, 与$uri相同;

$host, 请求信息中的"Host"，如果请求中没有Host行，则等于设置的服务器名;

$limit_rate, 对连接速率的限制;

$request_method, 请求的方法，比如"GET"、"POST"等;

$remote_addr, 客户端地址;

$remote_port, 客户端端口号;

$remote_user, 客户端用户名，认证用;

$request_filename, 当前请求的文件路径名

$request_body_file, ??

$request_uri, 请求的URI，带参数;

$query_string, 与$args相同;

$scheme, 所用的协议，比如http或者是https，比如rewrite  ^(.+)$  $scheme://example.com$1  redirect;

$server_protocol, 请求的协议版本，"HTTP/1.0"或"HTTP/1.1";

$server_addr, 服务器地址，如果没有用listen指明服务器地址，使用这个变量将发起一次系统调用以取得地址(造成资源浪费);

$server_name, 请求到达的服务器名;

$server_port, 请求到达的服务器端口号;

$uri, 请求的URI，可能和最初的值有不同，比如经过重定向之类的。