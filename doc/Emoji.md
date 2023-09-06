## 表情符号 Emoji

```php
// 定义表情
$this->test_unified = "Hello " . EmojiHelper::utf82bytes(0x2649);
$this->test_iphone = "Hello " . EmojiHelper::utf82bytes(0xE240);
$this->test_docomo = "Hello " . EmojiHelper::utf82bytes(0xE647);
$this->test_kddi = "Hello " . EmojiHelper::utf82bytes(0xE490);
$this->test_google = "Hello " . EmojiHelper::utf82bytes(0xFE02C);
$this->test_html = "Hello " . EmojiHelper::htmlEmoji(2649);

// 转成通用表情
$this->assertEquals($this->test_unified, EmojiHelper::docomo2unified($this->test_docomo));
$this->assertEquals($this->test_unified, EmojiHelper::kddi2unified($this->test_kddi));
$this->assertEquals($this->test_unified, EmojiHelper::softbank2unified($this->test_iphone));
$this->assertEquals($this->test_unified, EmojiHelper::google2unified($this->test_google));

// 通用表情转其他平台
$this->assertEquals($this->test_docomo, EmojiHelper::unified2docomo($this->test_docomo));
$this->assertEquals($this->test_kddi, EmojiHelper::unified2kddi($this->test_kddi));
$this->assertEquals($this->test_iphone, EmojiHelper::unified2softbank($this->test_iphone));
$this->assertEquals($this->test_google, EmojiHelper::unified2google($this->test_google));

// 通用表情转HTML（需导入CSS文件支持）
$this->assertEquals($this->test_html, EmojiHelper::unified2html($this->test_unified));
$this->assertEquals($this->test_unified, EmojiHelper::html2unified($this->test_html));

// 获取表情名称
$this->assertEquals('CHURCH', EmojiHelper::getName(EmojiHelper::utf82bytes(0x26EA)));
$this->assertEquals('SKULL', EmojiHelper::getName(EmojiHelper::utf82bytes(0x1F480)));
$this->assertEquals('OPEN HANDS SIGN', EmojiHelper::getName(EmojiHelper::utf82bytes(0x1F450)));
$this->assertEquals('PISTOL', EmojiHelper::getName(EmojiHelper::utf82bytes(0x1F52B)));

// 字符串是否包含表情
$this->assertEquals('simple', EmojiHelper::contains('test ' . EmojiHelper::utf82bytes(0x2600) . ' test'));

// 获取前端样式 和 素材图片
EmojiHelper::getEmojiCss();
EmojiHelper::getEmojiImage();

文档 https://github.com/iamcal/php-emoji
数据 https://github.com/iamcal/emoji-data
```
