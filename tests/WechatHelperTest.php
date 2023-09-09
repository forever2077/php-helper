<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\WechatHelper;

class WechatHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(WechatHelper::class, WechatHelper::instance());
    }

    public function testWechat()
    {
        $this->assertInstanceOf(WechatHelper::class, Helper::wechat());
    }

    public function testOfficialAccount()
    {
        try {
            $this->assertInstanceOf(EasyWeChat\OfficialAccount\Application::class, WechatHelper::officialAccount([]));
        } catch (\EasyWeChat\Kernel\Exceptions\InvalidArgumentException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testPay()
    {
        try {
            $this->assertInstanceOf(EasyWeChat\Pay\Application::class, WechatHelper::pay([]));
        } catch (\EasyWeChat\Kernel\Exceptions\InvalidArgumentException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testMiniApp()
    {
        try {
            $this->assertInstanceOf(EasyWeChat\MiniApp\Application::class, WechatHelper::miniApp([]));
        } catch (\EasyWeChat\Kernel\Exceptions\InvalidArgumentException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testOpenPlatform()
    {
        try {
            $this->assertInstanceOf(EasyWeChat\OpenPlatform\Application::class, WechatHelper::openPlatform([]));
        } catch (\EasyWeChat\Kernel\Exceptions\InvalidArgumentException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testWork()
    {
        try {
            $this->assertInstanceOf(EasyWeChat\Work\Application::class, WechatHelper::work([]));
        } catch (\EasyWeChat\Kernel\Exceptions\InvalidArgumentException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testOpenWork()
    {
        try {
            $this->assertInstanceOf(EasyWeChat\OpenWork\Application::class, WechatHelper::openWork([]));
        } catch (\EasyWeChat\Kernel\Exceptions\InvalidArgumentException $e) {
            $this->fail($e->getMessage());
        }
    }
}