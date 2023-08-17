<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\EnvHelper;

class EnvHelperTest extends TestCase
{
    public function testSave()
    {
        $env = EnvHelper::instance(__DIR__);
        $env->save(['foo' => 'bar']);
        $this->assertEquals('bar', $env->get('foo'));
    }

    public function testInstance()
    {
        $env = Helper::env(__DIR__);
        $this->assertInstanceOf(EnvHelper::class, $env);
    }

    public function testDotenv()
    {
        $env = EnvHelper::dotenv(__DIR__);
        $this->assertInstanceOf(EnvHelper::class, $env);
    }

    public function testGet()
    {
        $env = EnvHelper::instance(__DIR__);
        $this->assertEquals('bar', $env->get('foo'));
        $this->assertEquals('bar', $env->get('foo', 'bar'));
        $this->assertEquals('bar', $env->get('foo', function (Dotenv\Dotenv $dotenv) {
            $dotenv->required('bar')->allowedValues(['bar']);
        }));
    }

    public function testHas()
    {
        $env = EnvHelper::instance(__DIR__);
        $this->assertTrue($env->has('foo'));
        $this->assertFalse($env->has('bar'));
    }

    public function testSet()
    {
        $env = EnvHelper::instance(__DIR__);
        $env->set('bar', 'foo');
        $this->assertEquals('foo', $env->get('bar'));
    }

    public function testDelEnv()
    {
        unlink(__DIR__ . '/.env');
        $this->assertFileDoesNotExist(__DIR__ . '/.env');
    }
}