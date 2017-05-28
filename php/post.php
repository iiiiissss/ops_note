post


CURLOPT_POSTFIELDS 这个参数字段数据为一个数组时，Content-Type头将会被设置成multipart/form-data(数据格式)；
而这个参数字符串类似’para1=val1&para2=val2&…’时，Content-Type头将会被设置成application/x-www-form-urlencoded(表单格式)，就像表单提交的一样


 $url = "http://localhost/web_services.php";
　　$post_data = array ("username" => "bob","key" => "12345");

　　$ch = curl_init();

　　curl_setopt($ch, CURLOPT_URL, $url);
　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
　　// post数据
　　curl_setopt($ch, CURLOPT_POST, 1);
　　// post的变量
　　curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

　　$output = curl_exec($ch);
　　curl_close($ch);


$ch = curl_init();

　　//设置选项，包括URL
　　curl_setopt($ch, CURLOPT_URL, "http://www.nettuts.com");
　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
　　curl_setopt($ch, CURLOPT_HEADER, 0);

　　//执行并获取HTML文档内容
　　$output = curl_exec($ch);

　　//释放curl句柄
　　curl_close($ch);

　　//打印获得的数据
　　print_r($output);
