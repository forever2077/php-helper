<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\EmojiHelper;

class EmojiHelperTest extends TestCase
{
    private string $test_unified;
    private string $test_iphone;
    private string $test_docomo;
    private string $test_kddi;
    private string $test_google;
    private string $test_html;

    public function __construct()
    {
        parent::__construct();
    }

    private function data1(): void
    {
        $this->test_unified = "Hello " . EmojiHelper::utf82bytes(0x2649);
        $this->test_iphone = "Hello " . EmojiHelper::utf82bytes(0xE240);
        $this->test_docomo = "Hello " . EmojiHelper::utf82bytes(0xE647);
        $this->test_kddi = "Hello " . EmojiHelper::utf82bytes(0xE490);
        $this->test_google = "Hello " . EmojiHelper::utf82bytes(0xFE02C);
        $this->test_html = "Hello " . EmojiHelper::htmlEmoji(2649);
    }

    private function data2(): void
    {
        $this->test_unified = "Hello " . EmojiHelper::utf82bytes(0x36) . EmojiHelper::utf82bytes(0x20E3);
        $this->test_iphone = "Hello " . EmojiHelper::utf82bytes(0xE221);
        $this->test_docomo = "Hello " . EmojiHelper::utf82bytes(0xE6E7);
        $this->test_kddi = "Hello " . EmojiHelper::utf82bytes(0xE527);
        $this->test_google = "Hello " . EmojiHelper::utf82bytes(0xFE833);
        $this->test_html = "Hello <span class=\"emoji-outer emoji-sizer\"><span class=\"emoji-inner emoji3620e3\"></span></span>";
    }

    public function testInstance()
    {
        $this->assertEquals(EmojiHelper::class, Helper::emoji()::class);
    }

    public function test2unified()
    {
        $this->data1();
        $this->assertEquals($this->test_unified, EmojiHelper::docomo2unified($this->test_docomo));
        $this->assertEquals($this->test_unified, EmojiHelper::kddi2unified($this->test_kddi));
        $this->assertEquals($this->test_unified, EmojiHelper::softbank2unified($this->test_iphone));
        $this->assertEquals($this->test_unified, EmojiHelper::google2unified($this->test_google));
    }

    public function testUnified2()
    {
        $this->data1();
        $this->assertEquals($this->test_docomo, EmojiHelper::unified2docomo($this->test_docomo));
        $this->assertEquals($this->test_kddi, EmojiHelper::unified2kddi($this->test_kddi));
        $this->assertEquals($this->test_iphone, EmojiHelper::unified2softbank($this->test_iphone));
        $this->assertEquals($this->test_google, EmojiHelper::unified2google($this->test_google));
    }

    public function testHtml()
    {
        $this->data1();
        $this->assertEquals($this->test_html, EmojiHelper::unified2html($this->test_unified));
        $this->assertEquals($this->test_unified, EmojiHelper::html2unified($this->test_html));
    }

    private function test2unified_iphone()
    {
        /*不再支持*/
        /*$this->data2();
        $this->assertEquals($this->test_unified, EmojiHelper::docomo2unified($this->test_docomo));
        $this->assertEquals($this->test_unified, EmojiHelper::kddi2unified($this->test_kddi));
        $this->assertEquals($this->test_unified, EmojiHelper::softbank2unified($this->test_iphone));
        $this->assertEquals($this->test_unified, EmojiHelper::google2unified($this->test_google));*/
    }

    public function testUnified2_iphone()
    {
        $this->data2();
        $this->assertEquals($this->test_docomo, EmojiHelper::unified2docomo($this->test_docomo));
        $this->assertEquals($this->test_kddi, EmojiHelper::unified2kddi($this->test_kddi));
        $this->assertEquals($this->test_iphone, EmojiHelper::unified2softbank($this->test_iphone));
        $this->assertEquals($this->test_google, EmojiHelper::unified2google($this->test_google));
    }

    private function testHtml_iphone()
    {
        /*不再支持*/
        /*$this->data2();
        $this->assertEquals($this->test_html, EmojiHelper::unified2html($this->test_unified));
        $this->assertEquals($this->test_unified, EmojiHelper::html2unified($this->test_html));*/
    }

    public function testGetName()
    {
        $this->assertEquals('CHURCH', EmojiHelper::getName(EmojiHelper::utf82bytes(0x26EA)));
        $this->assertEquals('SKULL', EmojiHelper::getName(EmojiHelper::utf82bytes(0x1F480)));
        $this->assertEquals('OPEN HANDS SIGN', EmojiHelper::getName(EmojiHelper::utf82bytes(0x1F450)));
        $this->assertEquals('PISTOL', EmojiHelper::getName(EmojiHelper::utf82bytes(0x1F52B)));
    }

    public function testContains()
    {
        $this->assertEquals('simple', EmojiHelper::contains('test ' . EmojiHelper::utf82bytes(0x2600) . ' test'));
    }

    public function testModifiers()
    {
        // EmojiHelper::htmlEmoji('2764');
        $this->assertIsString(EmojiHelper::unified2html("\xE2\x9D\xA4"));
        $this->assertIsString(EmojiHelper::unified2html("\xE2\x9D\xA4\xEF\xB8\x8F"));
    }

    public function testGetCssOrImage()
    {
        // EmojiHelper::getEmojiCss()
        $this->assertFileExists(dirname(__DIR__) . '/data/emoji/emoji.css');
        // EmojiHelper::getEmojiImage()
        $this->assertFileExists(dirname(__DIR__) . '/data/emoji/emoji.png');
    }
}