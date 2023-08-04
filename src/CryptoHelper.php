<?php

namespace Forever2077\PhpHelper;

use Exception;

class CryptoHelper
{
    /**
     * 使用 AES ECB 算法模式加密数据
     * @throws Exception
     */
    public static function aesEcbEncrypt($data, $key): string
    {
        $encrypted = openssl_encrypt($data, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 AES ECB 算法模式解密数据
     * @throws Exception
     */
    public static function aesEcbDecrypt($data, $key): string
    {
        $decrypted = openssl_decrypt($data, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 使用 AES CBC 算法模式加密数据
     * @throws Exception
     */
    public static function aesCbcEncrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 AES CBC 算法模式解密数据
     * @throws Exception
     */
    public static function aesCbcDecrypt($data, $key, $iv): string
    {
        $decrypted = openssl_decrypt($data, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 使用 AES CTR 算法模式加密/解密数据
     * @throws Exception
     */
    public static function aesCtrCrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'AES-128-CTR', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 AES CFB 算法模式加密数据
     * @throws Exception
     */
    public static function aesCfbEncrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'AES-128-CFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 AES CFB 算法模式解密数据
     * @throws Exception
     */
    public static function aesCfbDecrypt($data, $key, $iv): string
    {
        $decrypted = openssl_decrypt($data, 'AES-128-CFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 使用 AES OFB 算法模式加密数据
     * @throws Exception
     */
    public static function aesOfbEncrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'AES-128-OFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 AES OFB 算法模式解密数据
     * @throws Exception
     */
    public static function aesOfbDecrypt($data, $key, $iv): string
    {
        $decrypted = openssl_decrypt($data, 'AES-128-OFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 将字符串 base64 编码
     */
    public static function base64StdEncode($data): string
    {
        return base64_encode($data);
    }

    /**
     * 解码 base64 字符串
     */
    public static function base64StdDecode($data): string
    {
        $decoded = base64_decode($data, true);
        if ($decoded === false) {
            throw new Exception('Invalid base64 data');
        }
        return $decoded;
    }

    /**
     * 使用 DES ECB 算法模式加密数据
     * @throws Exception
     */
    public static function desEcbEncrypt($data, $key): string
    {
        $encrypted = openssl_encrypt($data, 'DES-ECB', $key, OPENSSL_RAW_DATA);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 DES ECB 算法模解密数据
     * @throws Exception
     */
    public static function desEcbDecrypt($data, $key): string
    {
        $decrypted = openssl_decrypt($data, 'DES-ECB', $key, OPENSSL_RAW_DATA);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 使用 DES CBC 算法模式加密数据
     * @throws Exception
     */
    public static function desCbcEncrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'DES-CBC', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 DES CBC 算法模式解密数据
     * @throws Exception
     */
    public static function desCbcDecrypt($data, $key, $iv): string
    {
        $decrypted = openssl_decrypt($data, 'DES-CBC', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 使用 DES CFB 算法模式加密数据
     * @throws Exception
     */
    public static function desCfbEncrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'DES-CFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 DES CFB 算法模式解密数据
     * @throws Exception
     */
    public static function desCfbDecrypt($data, $key, $iv): string
    {
        $decrypted = openssl_decrypt($data, 'DES-CFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 使用 DES OFB 算法模式加密数据
     * @throws Exception
     */
    public static function desOfbEncrypt($data, $key, $iv): string
    {
        $encrypted = openssl_encrypt($data, 'DES-OFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $encrypted;
    }

    /**
     * 使用 DES OFB 算法模式解密数据
     * @throws Exception
     */
    public static function desOfbDecrypt($data, $key, $iv): string
    {
        $decrypted = openssl_decrypt($data, 'DES-OFB', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception(openssl_error_string());
        }
        return $decrypted;
    }

    /**
     * 返回字符串 md5 hmac 值
     */
    public static function hmacMd5($data, $key): string
    {
        return hash_hmac('md5', $data, $key);
    }

    /**
     * 获取字符串 md5 hmac base64 字符串值
     */
    public static function hmacMd5WithBase64($data, $key): string
    {
        $hmac = self::hmacMd5($data, $key);
        return base64_encode($hmac);
    }

    /**
     * 返回字符串 sha1 hmac 值
     */
    public static function hmacSha1($data, $key): string
    {
        return hash_hmac('sha1', $data, $key);
    }

    /**
     * 获取字符串的 sha1 base64 值
     */
    public static function hmacSha1WithBase64($data, $key): string
    {
        $hmac = self::hmacSha1($data, $key);
        return base64_encode($hmac);
    }

    /**
     * 返回字符串 sha256 hmac 值
     */
    public static function hmacSha256($data, $key): string
    {
        return hash_hmac('sha256', $data, $key);
    }

    /**
     * 获取字符串 sha256 hmac base64 值
     */
    public static function hmacSha256WithBase64($data, $key): string
    {
        $hmac = self::hmacSha256($data, $key);
        return base64_encode($hmac);
    }

    /**
     * 返回字符串 sha512 hmac 值
     */
    public static function hmacSha512($data, $key): string
    {
        return hash_hmac('sha512', $data, $key);
    }

    /**
     * 获取字符串 sha512 hmac base64 值
     */
    public static function hmacSha512WithBase64($data, $key): string
    {
        $hmac = self::hmacSha512($data, $key);
        return base64_encode($hmac);
    }

    /**
     * 返回 byte slice 的 md5 值
     */
    public static function md5Byte($data): string
    {
        return md5($data);
    }

    /**
     * 获取 byte slice 的 md5 base64 值
     */
    public static function md5ByteWithBase64($data): string
    {
        $md5 = self::md5Byte($data);
        return base64_encode($md5);
    }

    /**
     * 返回字符串 md5 值
     */
    public static function md5String($data): string
    {
        return md5($data);
    }

    /**
     * 获取字符串 md5 base64 值
     */
    public static function md5StringWithBase64($data): string
    {
        $md5 = self::md5String($data);
        return base64_encode($md5);
    }

    /**
     * 返回文件 md5 值
     * @throws Exception
     */
    public static function md5File($filePath): string
    {
        if (!file_exists($filePath)) {
            throw new Exception("File not found: " . $filePath);
        }
        return md5_file($filePath);
    }

    /**
     * 返回字符串 sha1 哈希值
     */
    public static function sha1($data): string
    {
        return sha1($data);
    }

    /**
     * 获取字符串 sha1 base64 值
     */
    public static function sha1WithBase64($data): string
    {
        $sha1 = self::sha1($data);
        return base64_encode($sha1);
    }

    /**
     * 返回字符串 sha256 哈希值
     */
    public static function sha256($data): string
    {
        return hash('sha256', $data);
    }

    /**
     * 获取字符串 sha256 base64 值
     */
    public static function sha256WithBase64($data): string
    {
        $sha256 = self::sha256($data);
        return base64_encode($sha256);
    }

    /**
     * 返回字符串 sha512 哈希值
     */
    public static function sha512($data): string
    {
        return hash('sha512', $data);
    }

    /**
     * 获取字符串 sha512 base64 值
     */
    public static function sha512WithBase64($data): string
    {
        $sha512 = self::sha512($data);
        return base64_encode($sha512);
    }

    /**
     * 在当前目录下创建 rsa 私钥文件和公钥文件
     */
    public static function generateRsaKey($privateKeyFile, $publicKeyFile)
    {
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        $res = openssl_pkey_new($config);

        openssl_pkey_export($res, $privKey);

        $publicKey = openssl_pkey_get_details($res);
        $pubKey = $publicKey["key"];

        file_put_contents($privateKeyFile, $privKey);
        file_put_contents($publicKeyFile, $pubKey);
    }

    /**
     * 用公钥文件 ras 加密数据
     */
    public static function rsaEncrypt($data, $publicKeyFile): string
    {
        $pubKey = file_get_contents($publicKeyFile);
        $pubKeyRes = openssl_pkey_get_public($pubKey);

        openssl_public_encrypt($data, $encrypted, $pubKeyRes);
        return base64_encode($encrypted);
    }

    /**
     * 用私钥文件 rsa 解密数据
     */
    public static function rsaDecrypt($encryptedData, $privateKeyFile): string
    {
        $encryptedData = base64_decode($encryptedData);
        $privKey = file_get_contents($privateKeyFile);
        $privKeyRes = openssl_pkey_get_private($privKey);

        openssl_private_decrypt($encryptedData, $decrypted, $privKeyRes);
        return $decrypted;
    }
}