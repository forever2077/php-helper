<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\XssHelper;

class XssHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(XssHelper::class, Helper::xss());
    }

    public function testClean()
    {
        $harm_string = "Hello, i try to <script>alert('Hack');</script> your site";
        $harmless_string = XssHelper::clean($harm_string);
        $this->assertEquals("Hello, i try to  your site", $harmless_string);

        $harm_string = "<IMG SRC=&#x6A&#x61&#x76&#x61&#x73&#x63&#x72&#x69&#x70&#x74&#x3A&#x61&#x6C&#x65&#x72&#x74&#x28&#x27&#x58&#x53&#x53&#x27&#x29>";
        $harmless_string = XssHelper::clean($harm_string);
        $this->assertEquals("<IMG >", $harmless_string);

        $harm_string = "<a href='&#x2000;javascript:alert(1)'>CLICK</a>";
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
    }
}