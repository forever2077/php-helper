<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\AccessHelper;

class AccessHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(Helper::access()::class, (new AccessHelper())::class);
    }

    public function testAclEnforcer()
    {
        $model = dirname(__DIR__) . '/data/access/basic_model.conf';
        $policy = dirname(__DIR__) . '/data/access/basic_policy.csv';
        $e = AccessHelper::enforcer($model, $policy);

        $sub = "bob"; // 想要访问资源的用户
        $obj = "/openapi/users"; // 将要被访问的资源
        $act = "write"; // 用户对资源进行的操作

        $this->assertTrue($e->enforce($sub, $obj, $act));
    }

    public function testRbacEnforcer()
    {
        $model = dirname(__DIR__) . '/data/access/rbac_model.conf';
        $policy = dirname(__DIR__) . '/data/access/rbac_policy.csv';
        $e = AccessHelper::enforcer($model, $policy);

        $sub = "bob"; // 想要访问资源的用户
        $obj = "data2"; // 将要被访问的资源
        $act = "write"; // 用户对资源进行的操作

        $this->assertTrue($e->enforce($sub, $obj, $act));
    }

    private function testRbacDatabasesEnforcer()
    {
        $model = dirname(__DIR__) . '/data/access/rbac_database_model.conf';
        $policy = AccessHelper::dbAdapter([
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'dbname' => 'test',
            'user' => 'root',
            'password' => '',
            'port' => '3306',
        ]);
        $e = AccessHelper::enforcer($model, $policy);

        // 指定用户所属组
        $e->addRoleForUser('alice', 'admin');
        $e->addRoleForUser('bob', 'member');
        // 为member用户添加规则
        $e->addPermissionForUser('member', '/foo', 'GET');
        $e->addPermissionForUser('member', '/foo/:id', 'GET');
        // 设置admin继承member所有规则
        $e->addRoleForUser('admin', 'member');
        // 为admin用户添加规则
        $e->addPermissionForUser('admin', '/foo', 'POST');
        $e->addPermissionForUser('admin', '/foo/:id', 'PUT');
        $e->addPermissionForUser('admin', '/foo/:id', 'DELETE');

        $this->assertTrue($e->enforce('alice', '/foo', 'GET'));
        $this->assertTrue($e->enforce('alice', '/foo', 'POST'));
        $this->assertTrue($e->enforce('alice', '/foo/1', 'PUT'));
        $this->assertTrue($e->enforce('alice', '/foo/1', 'DELETE1'));

        $this->assertTrue($e->enforce('bob', '/foo', 'GET'));
        $this->assertFalse($e->enforce('bob', '/foo', 'POST'));
        $this->assertFalse($e->enforce('bob', '/foo/1', 'PUT'));
        $this->assertFalse($e->enforce('bob', '/foo/1', 'DELETE'));
    }

    public function testAbacEnforcer()
    {
        $model = dirname(__DIR__) . '/data/access/abac_model.conf';
        $e = AccessHelper::enforcer($model);

        $data1 = new \stdClass();
        $data1->Name = 'data1';
        $data1->Owner = 'alice';

        $data2 = new \stdClass();
        $data2->Name = 'data2';
        $data2->Owner = 'bob';

        $this->assertTrue($e->enforce('alice', $data1, 'read'));
        $this->assertFalse($e->enforce('alice', $data2, 'read'));

        $this->assertFalse($e->enforce('bob', $data1, 'read'));
        $this->assertTrue($e->enforce('bob', $data2, 'read'));
    }
}