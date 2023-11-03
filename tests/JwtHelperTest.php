<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\JwtHelper;
use Lcobucci\JWT\Validation\Constraint\HasClaimWithValue;
use Lcobucci\JWT\Validation\Constraint\RelatedTo;
use Lcobucci\JWT\Validation\Constraint\PermittedFor;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;

class JwtHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(JwtHelper::class, Helper::jwt()::class);
    }

    public function testIssuingTokens()
    {
        try {
            $signingAlgorithm = 'ES512';
            $signingKeys = JwtHelper::generateKey($signingAlgorithm);
            $keyPem = $signingKeys['publicKeyPem'] ?? $signingKeys['privateKeyPem'];

            $now = new DateTimeImmutable();
            $token = JwtHelper::issuingTokens([
                'signingAlgorithm' => $signingAlgorithm,
                'signingKeys' => $signingKeys,
                'tokenOptions' => [
                    'issuedBy' => 'https://example.com',
                    'relatedTo' => 'https://example.com',
                    'permittedFor' => 'https://example.org',
                    'identifiedBy' => '4f1g23a12aa',
                    'issuedAt' => $now,
                    'expiresAt' => $now->modify('+1 hour'),
                    'canOnlyBeUsedAfter' => $now->modify('+1 minute'),
                    'withClaim' => [
                        ['uid', 1], ['company', 'example']
                    ],
                    'withHeader' => [
                        ['foo', 'bar'], ['baz', 'qux'],
                    ],
                ]
            ]);
            //dump($token);
            $rtn = JwtHelper::parsingTokens($token, $keyPem);
            //dump($rtn);
            $this->assertEquals(1, $rtn->claims()->get('uid'));
            $this->assertEquals('example', $rtn->claims()->get('company'));
            $this->assertEquals('bar', $rtn->headers()->get('foo'));
            $this->assertEquals('qux', $rtn->headers()->get('baz'));
            $this->assertTrue(JwtHelper::validator($rtn, new HasClaimWithValue('uid', 1)));
            $this->assertTrue(JwtHelper::validator($rtn, new RelatedTo('https://example.com')));
            $this->assertTrue(JwtHelper::validator($rtn, new PermittedFor('https://example.org')));
            $this->assertTrue(JwtHelper::validator($rtn, new IssuedBy('https://example.com')));
            $this->assertTrue(JwtHelper::validator($rtn, new IdentifiedBy('4f1g23a12aa')));
        } catch (Exception $e) {
            $this->fail($e);
        }
    }
}