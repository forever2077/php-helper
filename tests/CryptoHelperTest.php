<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\CryptoHelper;

class CryptoHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(CryptoHelper::Class, _crypto()::class);
    }

    public function testAesEcbEncrypt()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::aesEcbEncrypt($data, $key);
        $this->assertEquals('Hello World', CryptoHelper::aesEcbDecrypt($encryptedData, $key));
    }

    public function testAesCbcEncrypt()
    {
        $key = '1234567890abcdef';
        $iv = '1234567890abcdef';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::aesCbcEncrypt($data, $key, $iv);
        $this->assertEquals('Hello World', CryptoHelper::aesCbcDecrypt($encryptedData, $key, $iv));
    }

    public function testAesCfbEncrypt()
    {
        $key = '1234567890abcdef';
        $iv = '1234567890abcdef';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::aesCfbEncrypt($data, $key, $iv);
        $this->assertEquals('Hello World', CryptoHelper::aesCfbDecrypt($encryptedData, $key, $iv));
    }

    public function testAesOfbEncrypt()
    {
        $key = '1234567890abcdef';
        $iv = '1234567890abcdef';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::aesOfbEncrypt($data, $key, $iv);
        $this->assertEquals('Hello World', CryptoHelper::aesOfbDecrypt($encryptedData, $key, $iv));
    }

    public function testBase64StdEncode()
    {
        $data = 'Hello World';
        $this->assertEquals('SGVsbG8gV29ybGQ=', CryptoHelper::base64StdEncode($data));
    }

    public function testBase64StdDecode()
    {
        $data = 'SGVsbG8gV29ybGQ=';
        $this->assertEquals('Hello World', CryptoHelper::base64StdDecode($data));
    }

    public function testDesEcbEncrypt()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::desEcbEncrypt($data, $key);
        $this->assertEquals('Hello World', CryptoHelper::desEcbDecrypt($encryptedData, $key));
    }

    public function testDesCbcEncrypt()
    {
        $key = '1234567890abcdef';
        $iv = '12323def';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::desCbcEncrypt($data, $key, $iv);
        $this->assertEquals('Hello World', CryptoHelper::desCbcDecrypt($encryptedData, $key, $iv));
    }

    public function testDesCfbEncrypt()
    {
        $key = '1234567890abcdef';
        $iv = '12323def';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::desCfbEncrypt($data, $key, $iv);
        $this->assertEquals('Hello World', CryptoHelper::desCfbDecrypt($encryptedData, $key, $iv));
    }

    public function testDesOfbEncrypt()
    {
        $key = '1234567890abcdef';
        $iv = '12323def';
        $data = 'Hello World';
        $encryptedData = CryptoHelper::desOfbEncrypt($data, $key, $iv);
        $this->assertEquals('Hello World', CryptoHelper::desOfbDecrypt($encryptedData, $key, $iv));
    }

    public function testHmacMd5()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $this->assertEquals('1cabc35ef624965e7b7d620b5ebbad4c', CryptoHelper::hmacMd5($data, $key));
    }

    public function testHmacMd5WithBase64()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $this->assertEquals('MWNhYmMzNWVmNjI0OTY1ZTdiN2Q2MjBiNWViYmFkNGM=', CryptoHelper::hmacMd5WithBase64($data, $key));
    }

    public function testHmacSha1()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $this->assertEquals('c9d6bb762ca138a3152f2c1e81fea1cf697344b3', CryptoHelper::hmacSha1($data, $key));
    }

    public function testHmacSha1WithBase64()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $this->assertEquals('YzlkNmJiNzYyY2ExMzhhMzE1MmYyYzFlODFmZWExY2Y2OTczNDRiMw==', CryptoHelper::hmacSha1WithBase64($data, $key));
    }

    public function testHmacSha256()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $this->assertEquals('74847e23b1488199f57ad7a7e08375d900d1d4266af94e38fae559fb866bcf35', CryptoHelper::hmacSha256($data, $key));
    }

    public function testHmacSha256WithBase64()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $this->assertEquals('NzQ4NDdlMjNiMTQ4ODE5OWY1N2FkN2E3ZTA4Mzc1ZDkwMGQxZDQyNjZhZjk0ZTM4ZmFlNTU5ZmI4NjZiY2YzNQ==', CryptoHelper::hmacSha256WithBase64($data, $key));
    }

    public function testHmacSha512()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $expected = hash_hmac('sha512', $data, $key);
        $this->assertEquals($expected, CryptoHelper::hmacSha512($data, $key));
    }

    public function testHmacSha512WithBase64()
    {
        $key = '1234567890abcdef';
        $data = 'Hello World';
        $hmac = CryptoHelper::hmacSha512($data, $key);
        $expected = base64_encode($hmac);
        $this->assertEquals($expected, CryptoHelper::hmacSha512WithBase64($data, $key));
    }

    public function testMd5Byte()
    {
        $data = 'Hello World';
        $expected = md5($data);
        $this->assertEquals($expected, CryptoHelper::md5Byte($data));
    }

    public function testMd5ByteWithBase64()
    {
        $data = 'Hello World';
        $md5 = CryptoHelper::md5Byte($data);
        $expected = base64_encode($md5);
        $this->assertEquals($expected, CryptoHelper::md5ByteWithBase64($data));
    }

    public function testMd5String()
    {
        $data = 'Hello World';
        $expected = md5($data);
        $this->assertEquals($expected, CryptoHelper::md5String($data));
    }

    public function testMd5StringWithBase64()
    {
        $data = 'Hello World';
        $md5 = CryptoHelper::md5String($data);
        $expected = base64_encode($md5);
        $this->assertEquals($expected, CryptoHelper::md5StringWithBase64($data));
    }

    public function testMd5File()
    {
        // 创建一个临时文件
        $tempFile = tmpfile();
        fwrite($tempFile, 'Hello World');
        $metaDatas = stream_get_meta_data($tempFile);
        $tempFilePath = $metaDatas['uri'];

        $expected = md5_file($tempFilePath);
        $this->assertEquals($expected, CryptoHelper::md5File($tempFilePath));

        // 测试文件不存在的情况
        $this->expectException(Exception::class);
        CryptoHelper::md5File('non_existent_file_path');

        // 删除临时文件
        fclose($tempFile);
    }

    public function testSha1()
    {
        $data = 'Hello World';
        $expected = sha1($data);
        $this->assertEquals($expected, CryptoHelper::sha1($data));
    }

    public function testSha1WithBase64()
    {
        $data = 'Hello World';
        $sha1 = CryptoHelper::sha1($data);
        $expected = base64_encode($sha1);
        $this->assertEquals($expected, CryptoHelper::sha1WithBase64($data));
    }

    public function testSha256()
    {
        $data = 'Hello World';
        $expected = hash('sha256', $data);
        $this->assertEquals($expected, CryptoHelper::sha256($data));
    }

    public function testSha256WithBase64()
    {
        $data = 'Hello World';
        $sha256 = CryptoHelper::sha256($data);
        $expected = base64_encode($sha256);
        $this->assertEquals($expected, CryptoHelper::sha256WithBase64($data));
    }

    public function testSha512()
    {
        $data = 'Hello World';
        $expected = hash('sha512', $data);
        $this->assertEquals($expected, CryptoHelper::sha512($data));
    }

    public function testSha512WithBase64()
    {
        $data = 'Hello World';
        $sha512 = CryptoHelper::sha512($data);
        $expected = base64_encode($sha512);
        $this->assertEquals($expected, CryptoHelper::sha512WithBase64($data));
    }

    public function testGenerateRsaKeyAndEncryptionDecryption()
    {
        $privateKeyFile = 'private.pem';
        $publicKeyFile = 'public.pem';

        // 测试 generateRsaKey 方法
        CryptoHelper::generateRsaKey($privateKeyFile, $publicKeyFile);
        $this->assertFileExists($privateKeyFile);
        $this->assertFileExists($publicKeyFile);

        $data = 'Hello World';

        // 测试 rsaEncrypt 方法
        $encryptedData = CryptoHelper::rsaEncrypt($data, $publicKeyFile);
        $this->assertNotNull($encryptedData);

        // 测试 rsaDecrypt 方法
        $decryptedData = CryptoHelper::rsaDecrypt($encryptedData, $privateKeyFile);
        $this->assertEquals($data, $decryptedData);

        // 清理生成的文件
        unlink($privateKeyFile);
        unlink($publicKeyFile);
    }
}