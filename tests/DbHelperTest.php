<?php

use PHPUnit\Framework\TestCase;
use Helpful\ConfigHelper;
use Helpful\DbHelper;
use Helpful\Db\User;

class DbHelperTest extends TestCase
{
    public function testSetConfig()
    {
        $db = new DbHelper();
        $config = ConfigHelper::load(dirname(__DIR__) . '/data/db/config.yaml');
        $db->setConfig($config->all());
        $this->assertEquals('mysql', $config->get('default'));
    }

    private function testDatabase()
    {
        $db = new DbHelper();
        $config = ConfigHelper::load(dirname(__DIR__) . '/data/db/config.yaml');
        $db->setConfig($config->all());
        $conn = $db->connect();
        $rows = $conn->table('user')->where(['id' => 1])->findOrEmpty();
        $this->assertEquals('..........', $rows['username']);
    }

    private function testModel()
    {
        $user = new User();
        $rows = $user->where(['id' => 1])->findOrEmpty();
        $this->assertIsArray($rows->toArray());
    }
}