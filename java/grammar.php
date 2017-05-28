grammar.php

import sun.misc.BASE64Encoder;
    BASE64Encoder encode = new BASE64Encoder();
    String base64 = encode.encode(userName.getBytes());





try{
	buId = Integer.valueOf(StringUtil.getBuId());//
}catch(Exception e){
 	//System.out.println("字符串转换为整型失败");
	buId = 0;
}


List<String> list = new ArrayList<String>();
list.add("aaa");
list.add("bbb");
list.add("ccc");
方法一：
超级for循环遍历
for(String attribute : list) {
  System.out.println(attribute);
}
方法二：
对于ArrayList来说速度比较快, 用for循环, 以size为条件遍历:
for(int i = 0 ; i < list.size() ; i++) {
  system.out.println(list.get(i));
}
方法三：
集合类的通用遍历方式, 从很早的版本就有, 用迭代器迭代
Iterator it = list.iterator();
while(it.hasNext()) {
  System.ou.println(it.next);
}