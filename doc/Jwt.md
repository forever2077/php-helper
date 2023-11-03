## 认证 Jwt

```php
$signingAlgorithm = 'ES512';
$signingKeys = JwtHelper::generateKey($signingAlgorithm);
$privateKeyPem = $signingKeys['privateKeyPem'];
$keyPem = $signingKeys['publicKeyPem'] ?? $signingKeys['privateKeyPem'];

$now = new DateTimeImmutable();
$token = JwtHelper::issuingTokens([
    // 支持：HS256、HS384、HS512、Blake2b、ES256、ES384、ES512、RS256、RS384、RS512
    'signingAlgorithm' => 'ES512',
    'signingKeys' => $privateKeyPem,
    'tokenOptions' => [
        'issuedBy' => 'https://example.com',
        'relatedTo' => 'https://example.com',
        'permittedFor' => 'https://example.org',
        'identifiedBy' => '4f1g23a12aa',
        'issuedAt' => $now,
        'expiresAt' => $now->modify('+1 hour'),
        'canOnlyBeUsedAfter' => $now->modify('+1 minute'),
        'withClaim' => ['uid', 1], // 支持二维数组
        'withHeader' => [
            ['foo', 'bar'], ['baz', 'qux'],
        ],
    ]
]);
//dump($token);
$rtn = JwtHelper::parsingTokens($token, $keyPem);
//dump($rtn);
$this->assertEquals(1, $rtn->claims()->get('uid'));
$this->assertEquals('bar', $rtn->headers()->get('foo'));
$this->assertEquals('qux', $rtn->headers()->get('baz'));
$this->assertTrue(JwtHelper::validator($rtn, new HasClaimWithValue('uid', 1)));
$this->assertTrue(JwtHelper::validator($rtn, new RelatedTo('https://example.com')));
$this->assertTrue(JwtHelper::validator($rtn, new PermittedFor('https://example.org')));
$this->assertTrue(JwtHelper::validator($rtn, new IssuedBy('https://example.com')));
$this->assertTrue(JwtHelper::validator($rtn, new IdentifiedBy('4f1g23a12aa')));
文档 https://lcobucci-jwt.readthedocs.io/en/stable/
```
