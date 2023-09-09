<?php

namespace Helpful;

use Respect\Validation\Factory;
use Respect\Validation\Validator;
use Webmozart\Assert\Assert;
use Helpful\Validation\{Common, Custom};

/**
 * @link https://github.com/webmozarts/assert
 */
class ValidateHelper extends Assert
{
    /**
     * AI生成的常见验证规则
     * 其他规则需使用 ValidateHelper 对象调用，ValidateHelper::isValidFilename();
     * todo: 测试用例
     */
    use Common, Custom;

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
                ->withRuleNamespace('Helpful\\Validation\\Rules')
                ->withExceptionNamespace('Helpful\\Validation\\Exceptions')
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