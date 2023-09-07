<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\Google2faHelper;
use PragmaRX\Google2FA\Support\Constants;

class Google2faHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(Google2faHelper::class, Helper::google2fa());
    }

    public function testGenerate()
    {
        $rtn = Google2faHelper::generate('test', 'test@qq.com');
        $this->assertIsArray($rtn);
    }

    public function testTimestamp()
    {
        $google2fa = Google2faHelper::instance();
        $google2fa->setKeyRegeneration(30);
        $this->assertEquals((int)(time() / 30), $google2fa->getTimestamp());
    }

    public function testConfigGenerate()
    {
        $rtn = Google2faHelper::generate('test', 'test@qq.com', [
            'length' => 64,
            'algorithm' => Constants::SHA1, // google2fa only support SHA1
            'compatibility' => true,
            'keyRegeneration' => 30,
            'passwordLength' => 6,
        ]);
        /*dump($rtn['secretKey']);
        dump($rtn['qrCodeUrl']);
        dump($rtn['timestamp']);*/
        $this->assertIsArray($rtn);
    }

    private function testVerify()
    {
        $secretKey = 'GJHG2SRWKZKXSTCKMN3VMYRSGVRFI6TTO6AKBYN3T7HYJKDJRLJ4O4E3NYCU6BE4';
        $userKey = '684557';
        $oldTimestamp = Google2faHelper::verify($secretKey, $userKey, [
            'window' => 0, // 窗口期：60s
            'returnTimestamp' => true,
        ]);
        $this->assertTrue($oldTimestamp !== false);

        // $oldTimestamp 时间戳用于 verifyKeyNewer，确保同一个码不能重复使用
        $timestamp = Google2faHelper::verifyKeyNewer($secretKey, $userKey, $oldTimestamp);
        $this->assertFalse($timestamp);
    }
}