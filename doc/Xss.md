## 跨站点脚本 Xss

```php
$harm_string = "Hello, i try to <script>alert('Hack');</script> your site";
$harmless_string = XssHelper::clean($harm_string);
$this->assertEquals("Hello, i try to  your site", $harmless_string);

$harm_string = "<IMG SRC=javascript:alert('XSS')>";
$harmless_string = XssHelper::clean($harm_string);
$this->assertEquals("<IMG >", $harmless_string);

$harm_string = "<a href=' javascript:alert(1)'>CLICK</a>";
$harmless_string = XssHelper::clean($harm_string);
$this->assertEquals("<a href=' (1)'>CLICK</a>", $harmless_string);

$harm_string = "<a href=\"\u0001java\u0003script:alert(1)\">CLICK<a>";
$harmless_string = XssHelper::clean($harm_string);
$this->assertEquals('<a href="(1)">CLICK<a>', $harmless_string);

$harm_string = '<li style="list-style-image: url(javascript:alert(0))">';
$harmless_string = XssHelper::clean($harm_string);
$this->assertEquals("<li >", $harmless_string);

$harm_string = "\x3cscript src=http://www.example.com/malicious-code.js\x3e\x3c/script\x3e";
$antiXss = XssHelper::from($harm_string);
$this->assertTrue($antiXss->isXssFound());

// 使用内联 CSS
$harm_string = '<li style="list-style-image: url(javascript:alert(0))">';
$antiXss = XssHelper::from($harm_string);
$antiXss->removeEvilAttributes(array('style')); // 允许样式属性
$harmless_string = $antiXss->xss_clean($harm_string);
$this->assertEquals('<li style="list-style-image: url((0))">', $harmless_string);

// 允许例如iframe
$harm_string = '<iframe width="560" onclick="alert(\'xss\')" height="315" src="https://www.youtube.com/embed/foobar?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>';
$antiXss = XssHelper::from($harm_string);
$antiXss->removeEvilHtmlTags(array('iframe'));
$harmless_string = $antiXss->xss_clean($harm_string);
$this->assertEquals('<iframe width="560"  height="315" src="https://www.youtube.com/embed/foobar?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>', $harmless_string);

文档 https://github.com/voku/anti-xss
```
