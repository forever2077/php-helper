<?php

namespace Forever2077\PhpHelper;

use Respect\Validation\Validator;
use Webmozart\Assert\Assert;

/**
 * @link https://github.com/webmozarts/assert
 */
class ValidateHelper extends Assert
{
    public static function instance(): Validator
    {
        return self::rule();
    }

    /**
     * @link https://respect-validation.readthedocs.io/en/latest/list-of-rules/
     * @return Validator
     */
    public static function rule(): Validator
    {
        return Validator::create();
    }
}