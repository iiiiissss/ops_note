 <style type="text/css">
 body, html {width: 100%; height: 100%; margin: 0; padding: 0}
.fro_iframe iframe {display: block; width: 100%; height: 100%; border: none;}
</style>
<div class="fro_iframe">
  <iframe src="https://www.baidu.com"></iframe>
</div>






a correct markup should be like:
<iframe src="./myPage.aspx" id="myIframe" scrolling="no" frameborder="0"
    style="position: relative; height: 100%; width: 100%;">
...
</iframe>
also, if this frame already has an ID, why don't you put this in CSS like this (from a separate stylesheet file):

#myIframe
{
    position: relative;
    height: 100%;
    width: 100%; 
}
and HTML

<iframe src="./myPage.aspx" id="myIframe" scrolling="no" frameborder="0" > ... </iframe>
mind that scrolling & frameborder are iframe attribute, not style attribute.