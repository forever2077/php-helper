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
            $token = JwtHelper::issuingTokens();
            $rtn = JwtHelper::parsingTokens($token->toString());

            $this->assertEquals(1, $rtn->claims()->get('uid'));
            $this->assertFalse($token->toString() instanceof UnencryptedToken);
            $this->assertTrue(JwtHelper::validator($token, new HasClaimWithValue('uid', 1)));
        } catch (Exception $e) {
            $this->fail($e);
        }
    }
}