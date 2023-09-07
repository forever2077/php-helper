<?php

namespace Forever2077\PhpHelper;

use Exception;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FA\Support\Constants;
use PragmaRX\Google2FA\Exceptions\{
    IncompatibleWithGoogleAuthenticatorException,
    InvalidAlgorithmException,
    InvalidCharactersException,
    SecretKeyTooShortException
};

class Google2faHelper
{
    public static function instance(): Google2FA
    {
        return new Google2FA();
    }

    /**
     * 生成一个秘钥和用于Google Authenticator的二维码URL
     * @link https://pragmarx.com/playground/google2fa
     * @param string $name 名称
     * @param string $email 电子邮件
     * @param array $options 选项数组 (可选)
     *  - 'length'：指定秘钥的长度，默认为16。可以设置为其他正整数值
     *  - 'algorithm'：指定用于生成秘钥的算法，默认为Constants::SHA512。可以设置为其他算法，如 Constants::SHA256 或 Constants::SHA1
     * @return array 包含秘钥和二维码URL的数组
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidAlgorithmException
     * @throws InvalidCharactersException
     * @throws Exception
     */
    public static function generate(string $name, string $email, array $options = []): array
    {
        $google2fa = self::instance();

        $options['length'] = $options['length'] ?? 64;
        /* @see https://en.wikipedia.org/wiki/Google_Authenticator */
        $options['algorithm'] = $options['algorithm'] ?? Constants::SHA1;
        $options['compatibility'] = $options['compatibility'] ?? true;
        $options['keyRegeneration'] = $options['keyRegeneration'] ?? 30;
        $options['passwordLength'] = $options['passwordLength'] ?? 6;

        // 更改密钥重新生成间隔，默认为30秒，但请记住，这是大多数身份验证应用程序的缺省值，如谷歌验证器，这基本上会使你的应用程序与它们不同步
        if (is_int($options['keyRegeneration']) && $options['keyRegeneration'] > 0 && $options['keyRegeneration'] <= 120) {
            $google2fa->setKeyRegeneration($options['keyRegeneration']);
        } else {
            throw new Exception('keyRegeneration must be between 1 and 120');
        }

        if (is_int($options['passwordLength']) && $options['passwordLength'] > 4 && $options['passwordLength'] <= 10) {
            $google2fa->setOneTimePasswordLength($options['passwordLength']);
        } else {
            throw new Exception('passwordLength must be between 4 and 10');
        }

        // 默认情况下，此包将强制兼容性，但是，如果Google Authenticator不是目标，您可以通过以下操作禁用它
        if (is_bool($options['compatibility'])) {
            $google2fa->setEnforceGoogleAuthenticatorCompatibility($options['compatibility']);
        }

        // 为符合RFC6238，此程序包支持SHA1、SHA256和SHA512。默认为sha1
        $google2fa->setAlgorithm($options['algorithm']);

        // 生成秘钥
        $secret = $google2fa->generateSecretKey($options['length']);

        // 生成二维码URL
        $qrCodeUrl = $google2fa->getQRCodeUrl($name, $email, $secret);

        return [
            'secretKey' => $secret,
            'qrCodeUrl' => $qrCodeUrl,
            'timestamp' => $google2fa->getTimestamp(),
        ];
    }

    /**
     * 验证秘钥
     * @see https://pragmarx.com/playground/google2fa
     * @param string $secret
     * @param string $key
     * @param array $options
     * @return bool|int
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     * @throws Exception
     */
    public static function verify(string $secret, string $key, array $options = []): bool|int
    {
        $options['window'] = $options['window'] ?? null;
        $options['timestamp'] = $options['timestamp'] ?? null;
        $options['oldTimestamp'] = $options['oldTimestamp'] ?? null;
        $options['returnTimestamp'] = $options['returnTimestamp'] ?? false;

        if (!is_bool($options['returnTimestamp'])) {
            throw new Exception('returnTimestamp must be boolean');
        }

        $google2fa = Google2faHelper::instance();
        $isVerify = $google2fa->verifyKey($secret, $key, $options['window'], $options['timestamp'], $options['oldTimestamp']);

        if ($isVerify && $options['returnTimestamp']) {
            return $google2fa->getTimestamp();
        } else {
            return $isVerify;
        }
    }

    /**
     * 验证秘钥（需提供第一次验证成功的时间戳，确保当前OTP码是最新）
     * @param string $secret
     * @param string $key
     * @param int $oldTimestamp
     * @param array $options
     * @return bool|int
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     * @throws Exception
     */
    public static function verifyKeyNewer(string $secret, string $key, int $oldTimestamp, array $options = []): bool|int
    {
        $options['window'] = $options['window'] ?? null;
        $options['timestamp'] = $options['timestamp'] ?? null;

        $google2fa = Google2faHelper::instance();
        return $google2fa->verifyKeyNewer($secret, $key, $oldTimestamp, $options['window'], $options['timestamp']);
    }
}