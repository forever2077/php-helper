<?php

use Forever2077\PhpHelper\EnvHelper;
use PHPUnit\Framework\TestCase;

class EnvHelperTest extends TestCase
{
    public function testInstance()
    {
        $env = EnvHelper::instance(__DIR__ . '/.env');
        $this->assertInstanceOf(EnvHelper::class, $env);
    }

    public function testDotenv()
    {
        $env = EnvHelper::dotenv(__DIR__);
        $this->assertInstanceOf(EnvHelper::class, $env);
    }

    public function testSave()
    {
        $env = EnvHelper::instance(__DIR__ . '/.env');
        $env->save(['foo' => 'bar']);
        $this->assertEquals('bar', $env->get('foo'));
    }

    public function testGet()
    {
        $env = EnvHelper::instance(__DIR__ . '/.env');
        $this->assertEquals('bar', $env->get('foo'));
        $this->assertEquals('bar', $env->get('foo', 'bar'));
        $this->assertEquals('bar', $env->get('foo', function (Dotenv\Dotenv $dotenv) {
            $dotenv->required('bar')->allowedValues(['bar']);
        }));
    }

    public function testHas()
    {
        $env = EnvHelper::instance(__DIR__ . '/.env');
        $this->assertTrue($env->has('foo'));
        $this->assertFalse($env->has('bar'));
    }

    public function testDelEnv()
    {
        unlink(__DIR__ . '/.env');
        $this->assertFileDoesNotExist(__DIR__ . '/.env');
    }
}