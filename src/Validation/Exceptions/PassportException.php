<?php

namespace Helpful\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class PassportException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid passport number',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid passport number',
        ],
    ];
}