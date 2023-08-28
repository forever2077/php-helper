## 身份标识 Identity ID

```php
// 解析中国身份证号码
$ID = IdentityHelper::parseChineseID();
$passed = $ID->validateIDCard($pid);
$area = $ID->getArea($pid);
$gender = $ID->getGender($pid);
$birthday = $ID->getBirth($pid);
$age = $ID->getAge($pid);
$constellation = $ID->getConstellation($pid);
文档 https://github.com/douyasi/identity-card
```