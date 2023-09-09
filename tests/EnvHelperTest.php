<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\EnvHelper;

class EnvHelperTest extends TestCase
{
    public function testCreateEnv()
    {
        Helper::file()::createFile(dirname(__FILE__) . '/.env', '');
        $this->assertFileExists(dirname(__FILE__) . '/.env');
    }

    public function testSave()
    {
        $env = EnvHelper::instance(dirname(__FILE__));
        $env->save(['foo' => 'bar']);
        $this->assertEquals('bar', $env->get('foo'));
    }

    public function testInstance()
    {
        $env = Helper::env(dirname(__FILE__));
        $this->assertInstanceOf(EnvHelper::class, $env);
    }

    public function testDotenv()
    {
        $env = EnvHelper::dotenv(dirname(__FILE__));
        $this->assertInstanceOf(EnvHelper::class, $env);
    }

    public function testGet()
    {
        $env = EnvHelper::instance(dirname(__FILE__));
        $this->assertEquals('bar', $env->get('foo'));
        $this->assertEquals('bar', $env->get('foo', 'bar'));
        $this->assertEquals('bar', $env->get('foo', function (Dotenv\Dotenv $dotenv) {
            $dotenv->required('bar')->allowedValues(['bar']);
        }));
    }

    public function testHas()
    {
        $env = EnvHelper::instance(dirname(__FILE__));
        $this->assertTrue($env->has('foo'));
        $this->assertFalse($env->has('bar'));
    }

    public function testSet()
    {
        $env = EnvHelper::instance(dirname(__FILE__));
        $env->set('bar', 'foo');
        $this->assertEquals('foo', $env->get('bar'));
    }

    public function testEnv()
    {
        $this->assertEquals('foo', getenv('bar'));
    }

    public function testDelEnv()
    {
        unlink(dirname(__FILE__) . '/.env');
        $this->assertFileDoesNotExist(dirname(__FILE__) . '/.env');
    }
}