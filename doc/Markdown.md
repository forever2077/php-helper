## 文档处理 Markdown

```php
// HTML to Markdown
$option = [
    'strip_tags' => true, // 过滤HTML标签
    'remove_nodes' => 'div', // 删除指定标签内容，多个用空格分隔
    'preserve_comments' => false, // 默认删除注释，true：不删除
    'strip_placeholder_links' => true, // 默认删除占位符链接
    'italic_style' => '*', // 样式选项
    'bold_style' => '__', // 样式选项
    'hard_break' => false, // 换行选项
    'use_autolinks' => false, // 自动转为链接
];

$html = "<h3>Quick, to the Batpoles!</h3>";
$markdown = MarkdownHelper::toMarkdown($html, $option);
$this->assertEquals('### Quick, to the Batpoles!', $markdown);

// 转换器实例
$converter = MarkdownHelper::converter($option);
文档 https://github.com/thephpleague/html-to-markdown

// Markdown to HTML
$option = [
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
];
$markdown = '# Hello World!';

$html = MarkdownHelper::toHtml($markdown, $option);
$this->assertEquals('<h1>Hello World!</h1>', trim($html));

$html = MarkdownHelper::toHtml($markdown, $option, GithubFlavoredMarkdownConverter::class);
$this->assertEquals('<h1>Hello World!</h1>', trim($html));

// 转换器实例
$converter = MarkdownHelper::parser($option);
文档 https://github.com/thephpleague/commonmark
```
