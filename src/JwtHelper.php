<?php

namespace Forever2077\PhpHelper;

use DateTimeImmutable;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;
use Lcobucci\JWT\UnencryptedToken;
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

    /**
     * 生成密钥
     * @param array $options
     *  - encryption_method: rsa, hmac, blake2b, ec
     *  - hmac_bytes: >= 256 bits
     *  - rsa_bits: >= 2048 bits
     *  - curve_name: secp256k1, secp384r1, secp521r1
     * @return string
     * @throws \Exception
     */
    public static function generateKey(array $options = []): string
    {
        $privateKeyPem = '';

        try {
            switch ($options['encryption_method']) {
                case 'rsa':
                    $res = openssl_pkey_new([
                        'private_key_bits' => $options['private_key_bits'],
                        'private_key_type' => OPENSSL_KEYTYPE_RSA,
                    ]);
                    openssl_pkey_export($res, $privateKeyPem);
                    break;

                case 'hmac':
                    $privateKeyPem = random_bytes($options['private_key_bits']);
                    break;

                case 'blake2b':
                    $privateKeyPem = sodium_crypto_generichash_keygen();
                    break;

                case 'ec':
                    $res = openssl_pkey_new([
                        'curve_name' => $options['curve_name'],
                        'private_key_type' => OPENSSL_KEYTYPE_EC,
                    ]);
                    openssl_pkey_export($res, $privateKeyPem);
                    break;

                default:
                    throw new \Exception("Unsupported encryption method");
            }
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

        return $privateKeyPem;
    }

    /**
     * 用于生成一个未加密的 JWT（JSON Web Token）
     * @param array $config 配置数组，可以包括以下选项：
     *    - signing_algorithm: 签名算法。可选值包括：
     *        - 'HS256': HMAC 使用 SHA-256
     *        - 'HS384': HMAC 使用 SHA-384
     *        - 'HS512': HMAC 使用 SHA-512
     *        - 'Blake2b': 使用 Blake2b 算法
     *        - 'ES256': ECDSA 使用 SHA-256
     *        - 'ES384': ECDSA 使用 SHA-384
     *        - 'ES512': ECDSA 使用 SHA-512
     *        - 'RS256': RSA 使用 SHA-256
     *        - 'RS384': RSA 使用 SHA-384
     *        - 'RS512': RSA 使用 SHA-512
     *      默认为 'HS256'
     *    - private_key_bits: 加密时的密钥位数（可选）
     *    - curve_name: ECDSA 加密时的曲线名称（可选）
     *    - token_options: JWT 令牌的额外选项，支持如下：
     *          - issuedBy: 令牌的发行者
     *          - relatedTo: 令牌的主题
     *          - permittedFor: 令牌的接收者
     *          - issuedAt: 令牌的发行时间
     *          - identifiedBy: 令牌的唯一标识
     *          - canOnlyBeUsedAfter: 令牌可用的开始时间
     *          - expiresAt: 令牌的过期时间
     *          - withClaim: 自定义声明，支持二维数组
     *          - withHeader: 自定义头部，支持二维数组
     * @return UnencryptedToken 返回生成的未加密的令牌
     * @throws \Exception 如果生成令牌过程中出现问题，将抛出异常
     */
    public static function issuingTokens(array $config): UnencryptedToken
    {
        $defaultConfig = [
            'signing_algorithm' => 'HS256',
            'curve_name' => 'secp521r1', // ec：secp256k1, secp384r1, secp521r1
        ];
        $config = array_merge($defaultConfig, $config);

        switch ($config['signing_algorithm']) {
            case 'RS256':
            case 'RS384':
            case 'RS512':
                $config['encryption_method'] = 'rsa';
                $config['private_key_bits'] = $config['private_key_bits'] ?? 2048;
                break;
            case 'ES256':
                $config['encryption_method'] = 'ec';
                $config['private_key_bits'] = 256;
                break;
            case 'ES384':
                $config['encryption_method'] = 'ec';
                $config['private_key_bits'] = 384;
                break;
            case 'ES512':
                $config['encryption_method'] = 'ec';
                $config['private_key_bits'] = 512;
                break;
            case 'HS256':
                $config['encryption_method'] = 'hmac';
                $config['private_key_bits'] = 256;
                break;
            case 'HS384':
                $config['encryption_method'] = 'hmac';
                $config['private_key_bits'] = 384;
                break;
            case 'HS512':
                $config['encryption_method'] = 'hmac';
                $config['private_key_bits'] = 512;
                break;
            case 'Blake2b':
                $config['encryption_method'] = 'blake2b';
                $config['private_key_bits'] = false;
                break;
            default:
                throw new \Exception("Unknown signing algorithm");
        }

        try {
            $privateKeyPem = self::generateKey([
                'encryption_method' => $config['encryption_method'],
                'private_key_bits' => $config['private_key_bits'],
                'curve_name' => $config['curve_name'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }

        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $signingKey = InMemory::plainText($privateKeyPem);

        $algorithm = match ($config['signing_algorithm']) {
            'HS256' => new Signer\Hmac\Sha256(),
            'HS384' => new Signer\Hmac\Sha384(),
            'HS512' => new Signer\Hmac\Sha512(),
            'Blake2b' => new Signer\Blake2b(),
            'ES256' => new Signer\Ecdsa\Sha256(),
            'ES384' => new Signer\Ecdsa\Sha384(),
            'ES512' => new Signer\Ecdsa\Sha512(),
            'RS256' => new Signer\Rsa\Sha256(),
            'RS384' => new Signer\Rsa\Sha384(),
            'RS512' => new Signer\Rsa\Sha512(),
            default => throw new \Exception("Unknown signing algorithm"),
        };

        foreach ($config['token_options'] as $key => $value) {
            switch ($key) {
                case 'issuedBy':
                    $tokenBuilder->issuedBy($value);
                    break;
                case 'relatedTo':
                    $tokenBuilder->relatedTo($value);
                    break;
                case 'permittedFor':
                    $tokenBuilder->permittedFor($value);
                    break;
                case 'issuedAt':
                    $tokenBuilder->issuedAt($value);
                    break;
                case 'identifiedBy':
                    $tokenBuilder->identifiedBy($value);
                    break;
                case 'canOnlyBeUsedAfter':
                    $tokenBuilder->canOnlyBeUsedAfter($value);
                    break;
                case 'expiresAt':
                    $tokenBuilder->expiresAt($value);
                    break;
                case 'withClaim':
                    if (is_array($value[0])) {
                        foreach ($value as $claim) {
                            $tokenBuilder->withClaim($claim[0], $claim[1]);
                        }
                    } else {
                        $tokenBuilder->withClaim($value[0], $value[1]);
                    }
                    break;
                case 'withHeader':
                    if (is_array($value[0])) {
                        foreach ($value as $header) {
                            $tokenBuilder->withHeader($header[0], $header[1]);
                        }
                    } else {
                        $tokenBuilder->withHeader($value[0], $value[1]);
                    }
                    break;
                default:
                    break;
            }
        }

        return $tokenBuilder->getToken($algorithm, $signingKey);
    }

    public static function parsingTokens(string $jwtString): Token
    {
        $parser = new Parser(new JoseEncoder());
        try {
            return $parser->parse($jwtString);
        } catch (CannotDecodeContent|InvalidTokenStructure|UnsupportedHeaderFound $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public static function validator(Token $token, Constraint ...$constraints): bool
    {
        $validator = new Validator();
        return $validator->validate($token, ...$constraints);
    }
}