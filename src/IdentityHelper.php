<?php

namespace Forever2077\PhpHelper;

use Douyasi\IdentityCard\ID as ChineseIdentityCard;

class IdentityHelper
{
    /**
     * @return IdentityHelper
     */
    public static function instance(): IdentityHelper
    {
        return new self();
    }

    /**
     * @link https://github.com/douyasi/identity-card
     * @return ChineseIdentityCard
     */
    public static function parseChineseID(): ChineseIdentityCard
    {
        return new ChineseIdentityCard();
    }
}