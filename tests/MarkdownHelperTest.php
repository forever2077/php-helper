<?php

use League\CommonMark\GithubFlavoredMarkdownConverter;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\MarkdownHelper;

class MarkdownHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(MarkdownHelper::class, Helper::markdown());
    }

    public function testConverter()
    {
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
        $converter = MarkdownHelper::converter($option);

        $html = "<h3>Quick, to the Batpoles!</h3>";
        $markdown = $converter->convert($html);
        $this->assertEquals('### Quick, to the Batpoles!', $markdown);

        $html = '<!-- Monkeys! --><span>Turnips!</span><div>Monkeys!</div>';
        $markdown = $converter->convert($html);
        $this->assertEquals('Turnips!', $markdown);

        $html = '<a>Github</a>';
        $markdown = $converter->convert($html);
        $this->assertEquals('Github', $markdown);

        $html = '<p><a href="https://thephpleague.com">https://thephpleague.com</a></p>';
        $markdown = $converter->convert($html);
        $this->assertEquals('[https://thephpleague.com](https://thephpleague.com)', $markdown);

        $html = '<em>Italic</em> and a <strong>bold</strong>';
        $markdown = $converter->convert($html);
        $this->assertEquals('*Italic* and a __bold__', $markdown);

        $html = '<p>test<br>line break</p>';
        $markdown = $converter->convert($html);
        $this->assertIsString('test\nline break', $markdown);

        $html = "<table><tr><th>A</th></tr><tr><td>a</td></tr></table>";
        $markdown = $converter->convert($html);
        $this->assertIsString($markdown);
    }

    public function testToMarkdown()
    {
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

        $html = '<!-- Monkeys! --><span>Turnips!</span><div>Monkeys!</div>';
        $markdown = MarkdownHelper::toMarkdown($html, $option);
        $this->assertEquals('Turnips!', $markdown);

        $html = '<a>Github</a>';
        $markdown = MarkdownHelper::toMarkdown($html, $option);
        $this->assertEquals('Github', $markdown);

        $html = '<p><a href="https://thephpleague.com">https://thephpleague.com</a></p>';
        $markdown = MarkdownHelper::toMarkdown($html, $option);
        $this->assertEquals('[https://thephpleague.com](https://thephpleague.com)', $markdown);

        $html = '<em>Italic</em> and a <strong>bold</strong>';
        $markdown = MarkdownHelper::toMarkdown($html, $option);
        $this->assertEquals('*Italic* and a __bold__', $markdown);

        $html = '<p>test<br>line break</p>';
        $markdown = MarkdownHelper::toMarkdown($html, $option);
        $this->assertIsString('test\nline break', $markdown);

        $html = "<table><tr><th>A</th></tr><tr><td>a</td></tr></table>";
        $markdown = MarkdownHelper::toMarkdown($html, $option);
        $this->assertIsString($markdown);
    }

    public function testParser()
    {
        $option = [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ];
        $markdown = '# Hello World!';

        $converter = MarkdownHelper::parser($option);
        $html = $converter->convert($markdown);
        $this->assertEquals('<h1>Hello World!</h1>', trim($html->getContent()));

        $converter = MarkdownHelper::parser($option, GithubFlavoredMarkdownConverter::class);
        $html = $converter->convert($markdown);
        $this->assertEquals('<h1>Hello World!</h1>', trim($html->getContent()));
    }

    public function testToHtml()
    {
        $option = [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ];
        $markdown = '# Hello World!';

        $html = MarkdownHelper::toHtml($markdown, $option);
        $this->assertEquals('<h1>Hello World!</h1>', trim($html));

        $html = MarkdownHelper::toHtml($markdown, $option, GithubFlavoredMarkdownConverter::class);
        $this->assertEquals('<h1>Hello World!</h1>', trim($html));
    }
}