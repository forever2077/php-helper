<?php

namespace Helpful;

use Exception;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;
use Lcobucci\JWT\Validation\Constraint;
use Lcobucci\JWT\Validation\Validator;

class JwtHelper
{
    /**
     * @link https://lcobucci-jwt.readthedocs.io/en/stable/quick-start/
     * @return JwtHelper
     */
    public static function instance(): JwtHelper
    {
        return new self();
    }

    private static string $verificationKey = 'mBC5v3sOKVvbdEitdSBenu16nfNfhwkedkJVNabosTw=';

    /**
     * 生成公钥和密钥
     * @param string $encryptionMethod
     *  - encryption_method: rsa, hmac, blake2b, ec
     *  - hmac_bytes: >= 256 bits
     *  - rsa_bits: >= 2048 bits
     *  - curve_name: secp256k1, secp384r1, secp521r1
     * @return array
     * @throws Exception
     */
    public static function generateKey(string $encryptionMethod = 'HS256'): array
    {
        $options = [];
        $keys = [];
        $encryptionMethod = strtoupper($encryptionMethod);

        switch ($encryptionMethod) {
            case 'RS256':
            case 'RS384':
            case 'RS512':
                $options['encryption_method'] = 'rsa';
                $options['private_key_bits'] = $options['private_key_bits'] ?? 2048;
                break;
            case 'ES256':
                $options['encryption_method'] = 'ec';
                $options['curve_name'] = 'secp256k1';
                $options['private_key_bits'] = 256;
                break;
            case 'ES384':
                $options['encryption_method'] = 'ec';
                $options['curve_name'] = 'secp384r1';
                $options['private_key_bits'] = 384;
                break;
            case 'ES512':
                $options['encryption_method'] = 'ec';
                $options['curve_name'] = 'secp521r1';
                $options['private_key_bits'] = 521;
                break;
            case 'HS256':
                $options['encryption_method'] = 'hmac';
                $options['private_key_bits'] = 256;
                break;
            case 'HS384':
                $options['encryption_method'] = 'hmac';
                $options['private_key_bits'] = 384;
                break;
            case 'HS512':
                $options['encryption_method'] = 'hmac';
                $options['private_key_bits'] = 512;
                break;
            case 'BLAKE2B':
                $options['encryption_method'] = 'BLAKE2B';
                $options['private_key_bits'] = false;
                break;
            default:
                throw new Exception("Unknown signing algorithm");
        }

        try {
            switch ($options['encryption_method']) {
                case 'hmac':
                    $keys['privateKeyPem'] = random_bytes($options['private_key_bits']);
                    break;
                case 'BLAKE2B':
                    $keys['privateKeyPem'] = sodium_crypto_generichash_keygen();
                    break;
                case 'rsa':
                    $res = openssl_pkey_new([
                        'private_key_bits' => $options['private_key_bits'],
                        'private_key_type' => OPENSSL_KEYTYPE_RSA,
                    ]);
                    openssl_pkey_export($res, $keys['privateKeyPem']);
                    $publicKey = openssl_pkey_get_details($res);
                    $keys['publicKeyPem'] = $publicKey['key'];
                    break;
                case 'ec':
                    $res = openssl_pkey_new([
                        'curve_name' => $options['curve_name'],
                        'private_key_type' => OPENSSL_KEYTYPE_EC,
                    ]);
                    openssl_pkey_export($res, $keys['privateKeyPem']);
                    $publicKey = openssl_pkey_get_details($res);
                    $keys['publicKeyPem'] = $publicKey['key'];
                    break;
                default:
                    throw new Exception("Unsupported encryption method");
            }
        } catch (Exception $e) {
            throw new Exception($e);
        }

        return $keys;
    }

    /**
     * 生成JWT（JSON Web Token）
     * @param array $config 配置数组，可以包括以下选项：<br/>
     *    - signing_algorithm: 签名算法。可选值包括：<br/>
     *        - 'HS256': HMAC + SHA-256<br/>
     *        - 'HS384': HMAC + SHA-384<br/>
     *        - 'HS512': HMAC + SHA-512<br/>
     *        - 'Blake2b': Blake2b<br/>
     *        - 'ES256': ECDSA + SHA-256<br/>
     *        - 'ES384': ECDSA + SHA-384<br/>
     *        - 'ES512': ECDSA + SHA-512<br/>
     *        - 'RS256': RSA + SHA-256<br/>
     *        - 'RS384': RSA + SHA-384<br/>
     *        - 'RS512': RSA + SHA-512<br/>
     *      默认为 'HS256'<br/>
     *    - private_key_bits: 加密时的密钥位数（可选）<br/>
     *    - curve_name: ECDSA 加密时的曲线名称（可选）<br/>
     *    - token_options: JWT 令牌的额外选项，支持如下：<br/>
     *          - issuedBy: 令牌的发行者<br/>
     *          - relatedTo: 令牌的主题<br/>
     *          - permittedFor: 令牌的接收者<br/>
     *          - issuedAt: 令牌的发行时间<br/>
     *          - identifiedBy: 令牌的唯一标识<br/>
     *          - canOnlyBeUsedAfter: 令牌可用的开始时间<br/>
     *          - expiresAt: 令牌的过期时间<br/>
     *          - withClaim: 自定义声明，支持二维数组<br/>
     *          - withHeader: 自定义头部，支持二维数组<br/>
     * @return string
     * @throws Exception 如果生成令牌过程中出现问题，将抛出异常
     */
    public static function issuingTokens(array $config): string
    {
        $algorithm = match ($config['signingAlgorithm']) {
            'HS256' => new Signer\Hmac\Sha256(),
            'HS384' => new Signer\Hmac\Sha384(),
            'HS512' => new Signer\Hmac\Sha512(),
            'BLAKE2B' => new Signer\Blake2b(),
            'ES256' => new Signer\Ecdsa\Sha256(),
            'ES384' => new Signer\Ecdsa\Sha384(),
            'ES512' => new Signer\Ecdsa\Sha512(),
            'RS256' => new Signer\Rsa\Sha256(),
            'RS384' => new Signer\Rsa\Sha384(),
            'RS512' => new Signer\Rsa\Sha512(),
            default => throw new Exception("Unknown signing algorithm"),
        };

        if (empty($config['signingKeys'])) {
            throw new Exception('Missing signingKeys');
        }

        if (in_array($config['signingAlgorithm'], ['HS256', 'HS384', 'HS512', 'BLAKE2B'])) {
            /*对称加密*/
            $configuration = Configuration::forSymmetricSigner(
                $algorithm,
                InMemory::plainText($config['signingKeys'])
            );
        } else {
            /*非对称加密*/
            $configuration = Configuration::forAsymmetricSigner(
                $algorithm,
                InMemory::plainText($config['signingKeys']),
                InMemory::base64Encoded(self::$verificationKey),
            );
        }

        $signingKey = $configuration->signingKey();
        $tokenBuilder = $configuration->builder();

        foreach ($config['tokenOptions'] as $key => $value) {
            switch ($key) {
                case 'issuedBy':
                    $tokenBuilder = $tokenBuilder->issuedBy($value);
                    break;
                case 'relatedTo':
                    $tokenBuilder = $tokenBuilder->relatedTo($value);
                    break;
                case 'permittedFor':
                    $tokenBuilder = $tokenBuilder->permittedFor($value);
                    break;
                case 'identifiedBy':
                    $tokenBuilder = $tokenBuilder->identifiedBy($value);
                    break;
                case 'issuedAt':
                    $tokenBuilder = $tokenBuilder->issuedAt($value);
                    break;
                case 'expiresAt':
                    $tokenBuilder = $tokenBuilder->expiresAt($value);
                    break;
                case 'canOnlyBeUsedAfter':
                    $tokenBuilder = $tokenBuilder->canOnlyBeUsedAfter($value);
                    break;
                case 'withClaim':
                    if (is_array($value[0])) {
                        foreach ($value as $claim) {
                            $tokenBuilder = $tokenBuilder->withClaim($claim[0], $claim[1]);
                        }
                    } else {
                        $tokenBuilder = $tokenBuilder->withClaim($value[0], $value[1]);
                    }
                    break;
                case 'withHeader':
                    if (is_array($value[0])) {
                        foreach ($value as $header) {
                            $tokenBuilder = $tokenBuilder->withHeader($header[0], $header[1]);
                        }
                    } else {
                        $tokenBuilder = $tokenBuilder->withHeader($value[0], $value[1]);
                    }
                    break;
                default:
                    break;
            }
        }

        $token = $tokenBuilder->getToken($algorithm, $signingKey);

        return $token->toString();
    }

    /**
     * 解析Token
     * @param string $jwtString
     * @param string $signingKeys
     * @return Token
     * @throws Exception
     */
    public static function parsingTokens(string $jwtString, string $signingKeys): Token
    {
        $parser = new Parser(new JoseEncoder());

        try {
            $token = $parser->parse($jwtString);
        } catch (CannotDecodeContent|InvalidTokenStructure|UnsupportedHeaderFound $e) {
            throw new Exception($e->getMessage());
        }

        $signingAlgorithm = $token->headers()->get('alg');

        $algorithm = match ($signingAlgorithm) {
            'HS256' => new Signer\Hmac\Sha256(),
            'HS384' => new Signer\Hmac\Sha384(),
            'HS512' => new Signer\Hmac\Sha512(),
            'BLAKE2B' => new Signer\Blake2b(),
            'ES256' => new Signer\Ecdsa\Sha256(),
            'ES384' => new Signer\Ecdsa\Sha384(),
            'ES512' => new Signer\Ecdsa\Sha512(),
            'RS256' => new Signer\Rsa\Sha256(),
            'RS384' => new Signer\Rsa\Sha384(),
            'RS512' => new Signer\Rsa\Sha512(),
            default => throw new Exception("Unknown signing algorithm"),
        };

        if (in_array($signingAlgorithm, ['HS256', 'HS384', 'HS512', 'BLAKE2B'])) {
            /*对称加密*/
            $configuration = Configuration::forSymmetricSigner(
                $algorithm,
                InMemory::plainText($signingKeys)
            );
        } else {
            /*非对称加密*/
            $configuration = Configuration::forAsymmetricSigner(
                $algorithm,
                InMemory::plainText($signingKeys),
                InMemory::base64Encoded(self::$verificationKey),
            );
        }

        if ($configuration->signer()->verify($token->signature()->hash(), $token->payload(), $configuration->signingKey())) {
            return $token;
        } else {
            throw new Exception('Token is invalid');
        }
    }

    /**
     * 校验器
     * @param Token $token
     * @param Constraint ...$constraints
     * @return bool
     */
    public static function validator(Token $token, Constraint ...$constraints): bool
    {
        $validator = new Validator();
        return $validator->validate($token, ...$constraints);
    }
}