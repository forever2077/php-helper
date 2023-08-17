<?php

use Forever2077\PhpHelper\OAuth2Helper;
use PHPUnit\Framework\TestCase;

class OAuth2HelperTest extends TestCase
{
    public function testOauth2()
    {
        $this->assertEquals(OAuth2Helper::class, _oauth2()::class);
    }

    public function testInstance()
    {
        $this->assertEquals(OAuth2Helper::class, OAuth2Helper::instance()::class);
    }

    public function testSocialite()
    {
        try {
            $config = [
                'github' => [
                    'client_id' => 'your-app-id',
                    'client_secret' => 'your-app-secret',
                    'redirect' => 'http://localhost/socialite/callback.php',
                ],
            ];
            $socialite = OAuth2Helper::socialite($config);
            // 让用户跳转至平台认证
            $url = $socialite->create('github')->redirect();
            //return redirect($url);

            // 服务器收到平台回调 Code，使用 Code 换取平台处用户信息
            $code = '';
            //$code = request()->query('code');
            $user = $socialite->create('github')->userFromCode($code);
            $user->getId();
            $user->getName();
            $user->getNickname();
            $user->getEmail();
        } catch (Exception $e) {
            $this->assertIsString($e->getMessage());
        }
    }
}