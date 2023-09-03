## 验证/断言 Validate/Assert

```php
// 检查字符串是否为有效的电子邮件地址，错误抛出异常提示语
ValidateHelper::email('alganet@gmail.com', 'Email (%s) is invalid');
文档 https://github.com/webmozarts/assert

// 检查字符串是否为有效的电子邮件地址，返回bool类型
ValidateHelper::rule()::email()->validate('alganet@gmail.com');
文档 https://respect-validation.readthedocs.io/en/latest/list-of-rules/

// 检查文件名是否符合 Windows 和 Linux 系统的命名规范
ValidateHelper::isValidFilename(string $filename, bool $replaceInvalid = false, array $options = []);

// 检查护照号格式是否正确（默认：中国）
ValidateHelper::isPassportNumber('EA1234567');
// 计划从 validator.js 移植
文档 https://github.com/validatorjs/validator.js
```
