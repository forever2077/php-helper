<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\TemplateHelper;
use Twig\Environment;
use Twig\Loader\{ArrayLoader, FilesystemLoader, ChainLoader};

class TemplateHelperTest extends TestCase
{
    public function testTempDir()
    {
        $path = dirname(__DIR__) . '/data/temp/templates';
        if (!file_exists($path)) {
            Helper::file()::createDir($path, 0777, true);
        }
        file_put_contents($path . '/index.html', '<p>Hello {{ name }}!</p>');
        $this->assertFileExists($path);
    }

    public function testInstance()
    {
        $array = Helper::template()::array();
        $this->assertInstanceOf(ArrayLoader::class, $array);
        $file = Helper::template()::filesystem();
        $this->assertInstanceOf(FilesystemLoader::class, $file);
        $chain = Helper::template()::chain();
        $this->assertInstanceOf(ChainLoader::class, $chain);
    }

    public function testArray()
    {
        $loader = TemplateHelper::array([
            'index' => 'Hello {{ name }}!',
        ]);
        $twig = TemplateHelper::env($loader);
        $this->assertEquals('Hello World!', $twig->render('index', ['name' => 'World']));
    }

    public function testFilesystem()
    {
        $loader = TemplateHelper::filesystem(
            dirname(__DIR__) . '/data/temp/templates',
        );
        $twig = TemplateHelper::env($loader, [
            'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
        ]);
        $this->assertEquals('<p>Hello World!</p>', $twig->render('index.html', ['name' => 'World']));
    }

    public function testChain()
    {
        $arrayLoader = TemplateHelper::array([
            'index' => 'Hello {{ name }}!',
        ]);
        $fileLoader = TemplateHelper::filesystem(
            dirname(__DIR__) . '/data/temp/templates',
        );
        $chain = TemplateHelper::chain([$arrayLoader, $fileLoader]);
        $twig = TemplateHelper::env($chain, [
            'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
        ]);
        $this->assertEquals('<p>Hello World!</p>', $twig->render('index.html', ['name' => 'World']));
    }
}