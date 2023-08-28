## 认证 OAuth2

```php
/** 
 * 支持平台有：
 * Facebook，Github，Google，Linkedin，Outlook，QQ，TAPD，支付宝，淘宝，
 * 百度，钉钉，微博，微信，抖音，飞书，Lark，豆瓣，企业微信，腾讯云，Line，Gitee，Coding
 */
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
return redirect($url);

// 服务器收到平台回调 Code，使用 Code 换取平台处用户信息
$code = request()->query('code');
$user = $socialite->create('github')->userFromCode($code);
$user->getId();
$user->getName();
$user->getNickname();
$user->getEmail();
文档 https://github.com/overtrue/socialite

// OAuth2.0 授权服务器
OAuth2Helper::server(...);
文档 https://oauth2.thephpleague.com

// OAuth2.0 客户端
OAuth2Helper::client(...);
文档 https://oauth2-client.thephpleague.com
```