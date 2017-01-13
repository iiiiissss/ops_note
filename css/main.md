, 同分组
空格 上下文(可隔层包含)
#id     div#id  基于元素的id选择  区分大小写
.class   div.class 基于元素的类选择 类自动分割去除空格,id/属性不会
h1+p  相邻,选择了h1后的p
html > body table + ul   >子元素(紧连)
input[type="text"]
[title] [title=xx]精确等 [title~=xx]空格分隔的包含  [lang|=en]前置-分隔 [lang^=en]开头 [lang$=en]结尾 [lang*=en]包含

<link rel="stylesheet" type="text/css" href="mystyle.css" />
<style type="text/css">
  hr {color: sienna;}
  p {margin-left: 20px;}
</style>
<p style="color: sienna; margin-left: 20px">
This is a paragraph
</p>

上、右、下、左 顺时针方向
伪类
:active	向被激活的元素添加样式。	1
:focus	向拥有键盘输入焦点的元素添加样式。	2
:hover	当鼠标悬浮在元素上方时，向元素添加样式。	1
:link	向未被访问的链接添加样式。	1
:visited	向已被访问的链接添加样式。	1
:first-child	向元素的第一个子元素添加样式。	2
:lang
伪元素
:first-letter	向文本的第一个字母添加特殊样式。	1
:first-line	向文本的首行添加特殊样式。	1
:before	在元素之前添加内容。	2
:after	在元素之后添加内容。

  width: 70px;
  margin: 10px;
  padding: 5px

max-width 替代 width

position: relative; //absolute float:right;
  left: 30px;
  top: 20px;

display: none;
display: inline;
display: block;  https://developer.mozilla.org/en-US/docs/Web/CSS/display

block:
div p center dir dl form header footer section h1~h6  ol ul pre table 
address blockquote fieldset hr isindex menu noframs niscript 
一个块级元素会新开始一行并且尽可能撑满容器。其他常用的块级元素包括 p 、 form 和HTML5中的新元素： header 、 footer 、 section 等等。
inline:
a abbr acronym b bdo big br cite code dfn em font i img input kbd label q s smap select 
small span strike strong sub sup textarea tt u var 

可变:
applet button del iframe ins map object script 

