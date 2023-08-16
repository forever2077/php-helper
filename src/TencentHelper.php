<?php

namespace Forever2077\PhpHelper;

class TencentHelper
{
    /**
     * @return TencentHelper
     */
    public static function instance(): TencentHelper
    {
        return new self();
    }
}
