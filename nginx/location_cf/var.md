HTTP����ģ��֧��һЩ���ñ�������������apache��Ķ�Ӧ������ $http_user_agent��$http_cookie�ȱ�ʾHTTP������Ϣ�ı�����
���������
$args, �����еĲ���;

$content_length, HTTP������Ϣ���"Content-Length";

$content_type, ������Ϣ���"Content-Type";

$document_root, ��Ե�ǰ����ĸ�·������ֵ;

$document_uri, ��$uri��ͬ;

$host, ������Ϣ�е�"Host"�����������û��Host�У���������õķ�������;

$limit_rate, ���������ʵ�����;

$request_method, ����ķ���������"GET"��"POST"��;

$remote_addr, �ͻ��˵�ַ;

$remote_port, �ͻ��˶˿ں�;

$remote_user, �ͻ����û�������֤��;

$request_filename, ��ǰ������ļ�·����

$request_body_file, ??

$request_uri, �����URI��������;

$query_string, ��$args��ͬ;

$scheme, ���õ�Э�飬����http������https������rewrite  ^(.+)$  $scheme://example.com$1  redirect;

$server_protocol, �����Э��汾��"HTTP/1.0"��"HTTP/1.1";

$server_addr, ��������ַ�����û����listenָ����������ַ��ʹ���������������һ��ϵͳ������ȡ�õ�ַ(�����Դ�˷�);

$server_name, ���󵽴�ķ�������;

$server_port, ���󵽴�ķ������˿ں�;

$uri, �����URI�����ܺ������ֵ�в�ͬ�����羭���ض���֮��ġ�