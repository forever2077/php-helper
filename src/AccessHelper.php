<?php

namespace Forever2077\PhpHelper;

use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use CasbinAdapter\DBAL\Adapter as DatabaseAdapter;
use Doctrine\DBAL\Exception;

class AccessHelper
{
    /**
     * @link https://github.com/php-casbin/php-casbin#examples
     * 内置 model 方法 BuiltinOperations.php
     * @param ...$params
     * @return Enforcer
     * @throws CasbinException
     */
    public static function enforcer(...$params): Enforcer
    {
        try {
            return new Enforcer(...$params);
        } catch (CasbinException $e) {
            throw new CasbinException($e);
        }
    }

    /**
     * @link https://github.com/php-casbin/dbal-adapter
     * 支持驱动：
     * pdo_mysql,pdo_sqlite,pdo_pgsql,pdo_oci (unstable),pdo_sqlsrv,pdo_sqlsrv,
     * mysqli,sqlanywhere,sqlsrv,ibm_db2 (unstable),drizzle_pdo_mysql
     * @param array $config
     * @return DatabaseAdapter
     * @throws Exception
     */
    public static function dbAdapter(array $config): DatabaseAdapter
    {
        return DatabaseAdapter::newAdapter($config);
    }
}