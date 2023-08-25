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

    public static function issuingTokens(): UnencryptedToken
    {
        try {
            // Hmac
            $privateKeyPem = random_bytes(512);

            // Blake2b
            //$privateKeyPem = sodium_crypto_generichash_keygen();

            // Rsa >= 2048
            /*$res = openssl_pkey_new(array(
                'private_key_bits' => 2048,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ));
            openssl_pkey_export($res, $privateKeyPem);*/

            // Ec Sha512(secp521r1)、Sha384(secp384r1)、Sha256(secp256k1)
            /*$res = openssl_pkey_new([
                "curve_name" => "secp256k1",
                "private_key_type" => OPENSSL_KEYTYPE_EC,
            ]);
            openssl_pkey_export($res, $privateKeyPem);*/

        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $signingKey = InMemory::plainText($privateKeyPem);
        $algorithm = new Signer\Hmac\Sha512();
        $now = new DateTimeImmutable();

        return $tokenBuilder
            // Configures the issuer (iss claim)
            ->issuedBy('https://example.com')
            // Configures the audience (aud claim)
            ->permittedFor('https://example.org')
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify('+1 minute'))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+1 hour'))
            // Configures a new claim, called "uid"
            ->withClaim('uid', 1)
            // Configures a new header, called "foo"
            ->withHeader('foo', 'bar')
            // Builds a new token
            ->getToken($algorithm, $signingKey);
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