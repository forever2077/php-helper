<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\DbHelper;
use Forever2077\PhpHelper\ContainerHelper;
use Forever2077\PhpHelper\TemplateHelper;

class ContainerHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(ContainerHelper::class, Helper::container()::class);
    }

    public function testContainer()
    {
        $container = Helper::container();

        // 定义参数
        $container['tempConfig'] = ['index' => 'Hello {{ name }}!'];

        // 定义服务
        $container['db_service_1'] = fn($c) => new DbHelper();
        $container['templateLoader'] = fn($c) => TemplateHelper::array($c['tempConfig']); // 调用动态参数

        // 每次返回相同实例
        $db1 = $container['db_service_1'];
        $db2 = $container['db_service_1'];
        $this->assertTrue($db1 === $db2);

        // 工厂模式，每次返回不同实例
        $container['db_service_2'] = $container->factory(fn($c) => new DbHelper());
        $db3 = $container['db_service_2'];
        $db4 = $container['db_service_2'];
        $this->assertFalse($db3 === $db4);

        // 参数保护
        $container['random'] = $container->protect(fn() => rand()); // 匿名函数
        $this->assertIsInt($container['random']());
        $container['templateLoader_factory'] = $container->protect(function ($config) {
            return TemplateHelper::array($config); // 工厂函数
        });
        $this->assertEquals(Twig\Loader\ArrayLoader::class, $container['templateLoader_factory']($container['tempConfig'])::class);
    }
}