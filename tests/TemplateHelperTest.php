<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\TemplateHelper;
use Twig\Environment;

class TemplateHelperTest extends TestCase
{
    public function testInstance()
    {
        $arrayLoader = Helper::template()::array();
        $this->assertInstanceOf(Environment::class, $arrayLoader);
        $fileLoader = Helper::template()::filesystem();
        $this->assertInstanceOf(Environment::class, $fileLoader);
        $chainLoader = Helper::template()::chain();
        $this->assertInstanceOf(Environment::class, $chainLoader);
    }

    public function testArray()
    {
        $arrayLoader = TemplateHelper::array([
            'index' => 'Hello {{ name }}!',
        ]);
        $this->assertEquals('Hello World!', $arrayLoader->render('index', ['name' => 'World']));
    }

    public function testFilesystem()
    {
        $fileLoader = TemplateHelper::filesystem(
            dirname(__DIR__) . '/data/temp/templates',
            null,
            [
                'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
            ]
        );
        $this->assertEquals('<p>Hello World!</p>', $fileLoader->render('index.html', ['name' => 'World']));
    }

    public function testChain()
    {
        $arrayLoader = TemplateHelper::array([
            'index' => 'Hello {{ name }}!',
        ], [
            '__loader' => true,
        ]);
        $fileLoader = TemplateHelper::filesystem(
            dirname(__DIR__) . '/data/temp/templates',
            null,
            [
                'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
                '__loader' => true
            ]
        );
        $chainLoader = Helper::template()::chain([$arrayLoader, $fileLoader]);
        $this->assertEquals('<p>Hello World!</p>', $chainLoader->render('index.html', ['name' => 'World']));
    }
}