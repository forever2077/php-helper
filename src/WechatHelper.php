<?php

namespace Helpful;

use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;
use EasyWeChat\Pay\Application as Pay;
use EasyWeChat\MiniApp\Application as MiniApp;
use EasyWeChat\OpenPlatform\Application as OpenPlatform;
use EasyWeChat\Work\Application as Work;
use EasyWeChat\OpenWork\Application as OpenWork;

/**
 * Class WechatHelper 微信辅助类
 * @link https://easywechat.com/6.x/
 */
class WechatHelper
{
    /**
     * @return WechatHelper
     */
    public static function instance(): WechatHelper
    {
        return new self();
    }

    /**
     * 微信公众号
     * @param array $config
     * @return OfficialAccount
     * @throws InvalidArgumentException
     */
    public static function officialAccount(array $config): OfficialAccount
    {
        try {
            return new OfficialAccount($config);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * 微信支付
     * @param array $config
     * @return Pay
     * @throws InvalidArgumentException
     */
    public static function pay(array $config): Pay
    {
        try {
            return new Pay($config);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * 微信小程序
     * @param array $config
     * @return MiniApp
     * @throws InvalidArgumentException
     */
    public static function miniApp(array $config): MiniApp
    {
        try {
            return new MiniApp($config);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * 微信开放平台
     * @param array $config
     * @return OpenPlatform
     * @throws InvalidArgumentException
     */
    public static function openPlatform(array $config): OpenPlatform
    {
        try {
            return new OpenPlatform($config);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * 企业微信
     * @param array $config
     * @return Work
     * @throws InvalidArgumentException
     */
    public static function work(array $config): Work
    {
        try {
            return new Work($config);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * 企业微信开放平台
     * @param array $config
     * @return OpenWork
     * @throws InvalidArgumentException
     */
    public static function openWork(array $config): OpenWork
    {
        try {
            return new OpenWork($config);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}