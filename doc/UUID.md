## 唯一标识符 UUID

```php
// UUID1
$uuid = UuidHelper::uuid1();
// UUID2
$localId = new Integer(1001);
$nodeProvider = new StaticNodeProvider(new Hexadecimal('121212121212'));
$clockSequence = 63;
$uuid = UuidHelper::uuid2(
	Uuid::DCE_DOMAIN_ORG,
	$localId,
	$nodeProvider->getNode(),
	$clockSequence
);
// UUID3
$uuid = UuidHelper::uuid3(Uuid::NAMESPACE_URL, 'https://www.php.net');
// UUID4
$uuid = UuidHelper::uuid4();
// UUID5
$uuid = UuidHelper::uuid5(Uuid::NAMESPACE_URL, 'https://www.php.net');
// UUID6
$uuid = UuidHelper::uuid6();
// UUID8
$uuid = UuidHelper::uuid8("\x00\x11\x22\x33\x44\x55\x66\x77\x88\x99\xaa\xbb\xcc\xdd\xee\xff");
// GUID
$guid = UuidHelper::guid($withBrackets = true);
文档 https://uuid.ramsey.dev/en/stable/
```