<?php

namespace Forever2077\PhpHelper;

use think\DbManager;

class DbHelper extends DbManager
{
    /**
     * thinkphp orm
     * @link https://doc.thinkphp.cn/v8_0/database.html
     * @link https://github.com/top-think/think-orm
     */
    public function __construct()
    {
        parent::__construct();
    }
}