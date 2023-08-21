<?php

namespace Forever2077\PhpHelper;

use Respect\Validation\Factory;
use Respect\Validation\Validator;
use Webmozart\Assert\Assert;
use Forever2077\PhpHelper\Validation\Common;

/**
 * @link https://github.com/webmozarts/assert
 */
class ValidateHelper extends Assert
{
    /**
     * 由AI生成的常见验证规则
     * todo: 测试用例
     */
    use Common;

    public static function instance(): Validator
    {
        return self::rule();
    }

    /**
     * @link https://github.com/validatorjs/validator.js
     * @link https://respect-validation.readthedocs.io/en/latest/list-of-rules/
     * @return Validator
     */
    public static function rule(): Validator
    {
        Factory::setDefaultInstance(
            (new Factory())
                ->withRuleNamespace('Forever2077\\PhpHelper\\Validation\\Rules')
                ->withExceptionNamespace('Forever2077\\PhpHelper\\Validation\\Exceptions')
        );
        return Validator::create();
    }

    /**
     * 检查字符串是否为有效的护照号码
     * @param string $str
     * @param string $countryCode
     * @return mixed
     */
    public static function isPassportNumber(string $str, string $countryCode = 'CN'): bool
    {
        try {
            return ValidateHelper::rule()::passport($countryCode)->validate($str);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }
}