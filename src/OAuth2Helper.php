<?php

namespace Helpful;

use Overtrue\Socialite\SocialiteManager;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use League\OAuth2\Client\Provider\GenericProvider;

class OAuth2Helper
{
    public static function instance(): OAuth2Helper
    {
        return new self();
    }

    /**
     * 支持平台有：
     * Facebook，Github，Google，Linkedin，Outlook，QQ，TAPD，支付宝，淘宝，
     * 百度，钉钉，微博，微信，抖音，飞书，Lark，豆瓣，企业微信，腾讯云，Line，Gitee，Coding
     * @link https://github.com/overtrue/socialite
     * @param array $config
     * @return SocialiteManager
     */
    public static function socialite(array $config): SocialiteManager
    {
        return new SocialiteManager($config);
    }

    /**
     * OAuth2.0 授权服务器
     * @link https://oauth2.thephpleague.com/
     * @param ClientRepositoryInterface $clientRepository
     * @param AccessTokenRepositoryInterface $accessTokenRepository
     * @param ScopeRepositoryInterface $scopeRepository
     * @param $privateKey
     * @param $encryptionKey
     * @param ResponseTypeInterface|null $responseType
     * @return AuthorizationServer
     */
    public static function server(ClientRepositoryInterface      $clientRepository,
                                  AccessTokenRepositoryInterface $accessTokenRepository,
                                  ScopeRepositoryInterface       $scopeRepository,
                                                                 $privateKey,
                                                                 $encryptionKey,
                                  ResponseTypeInterface          $responseType = null): AuthorizationServer
    {
        return new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKey,
            $encryptionKey,
            $responseType);
    }

    /**
     * OAuth2.0 客户端
     * @link https://oauth2-client.thephpleague.com/
     * @param array $options
     * @param array $collaborators
     * @return GenericProvider
     */
    public static function client(array $options = [], array $collaborators = []): GenericProvider
    {
        return new GenericProvider($options, $collaborators);
    }
}