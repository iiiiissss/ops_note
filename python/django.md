:lvim /\<\(name\)\>/gj *.txt
:lw

http://www.ziqiangxuetang.com/django/django-nginx-deploy.html
http://www.biaodianfu.com/cgi-fastcgi-wsgi.html






URL分发处理

使用正则表达式定义 URL pattern，建立到View函数的映射关系。 

环境配置
settings.ROOT_URLCONF：定义URL的配置文件位置；
settings.urlpatterns：定义URL patterns 到View函数的映射关系；
URLpattern 匹配的范围：
不包含domain
不包含GET, POST参数
匹配后的参数作为字符串传入view function
从匹配结果到函数参数

传送给View函数的第一个参数是HttpRequest对象，正则表达式匹配的内容作为第二个参数传入。
可以使用Named groups，将匹配的部分作为keyword参数。
格式：(?P<name>pattern)
避免重复定义的机制
view prefix：提取view function的公共前缀
Including other URLconf

View函数

接收Web请求，返回Web响应，基本的处理流程是:
收到传入的HttpRequest参数；
从HttpRequest中获得输入数据；
进行数据处理，构造Context数据；
加载Template；
使用Context数据Render Template；
返回 HttpResponse；

相关的类
class HttpRequest：通过POST或GET属性访问传入的参数
class HttpResponse：主要派生类有 class HttpResponseRedirect，class HttpResponseNotFound
class UploadedFile
class QueryDict：multiple values for the same key

快捷函数
render
render_to_response
redirect
get_object_or_404
get_list_or_404


Template
变量格式：{{ variable }}
TAG格式： {% tag %}
常用的有：for/if/block and extends
过滤器功能格式：{{ name|lower }}
例：{{ value|default:"nothing" }}
常用内置的过滤器：default, length, striptags 
Template继承使用block/extend实现。
在父模板中，使用block定义扩展点。
在派生模板中，使用extend对扩展点进行重新定义。也可以引用父模板中的定义，使用{{ block.super }

<ul>
{% for athlete in athlete_list %}
    <li>{{ athlete.name }}</li>
{% endfor %}
</ul>

{% if condition1 %}
   ... display 1
{% elif condiiton2 %}
   ... display 2
{% else %}
   ... display 3
{% endif %}






