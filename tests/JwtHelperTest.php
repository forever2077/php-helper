<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\JwtHelper;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\HasClaimWithValue;

class JwtHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(JwtHelper::class, Helper::jwt()::class);
    }

    public function testIssuingTokens()
    {
        try {
            $now = new DateTimeImmutable();
            $token = JwtHelper::issuingTokens([
                'signing_algorithm' => 'ES512',
                'token_options' => [
                    'issuedBy' => 'https://example.com',
                    'relatedTo' => 'https://example.com',
                    'permittedFor' => 'https://example.org',
                    'identifiedBy' => '4f1g23a12aa',
                    'issuedAt' => $now,
                    'expiresAt' => $now->modify('+1 hour'),
                    'canOnlyBeUsedAfter' => $now->modify('+1 minute'),
                    'withClaim' => ['uid', 1],
                    'withHeader' => [
                        ['foo', 'bar'], ['baz', 'qux'],
                    ],
                ]
            ]);
            dump($token->toString());

            $rtn = JwtHelper::parsingTokens($token->toString());
            dump($rtn);

            $this->assertEquals(1, $rtn->claims()->get('uid'));
            $this->assertFalse($token->toString() instanceof UnencryptedToken);
            $this->assertTrue(JwtHelper::validator($token, new HasClaimWithValue('uid', 1)));
        } catch (Exception $e) {
            $this->fail($e);
        }
    }
}