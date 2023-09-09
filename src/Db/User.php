<?php

namespace Helpful\Db;

use think\Model;

class User extends Model
{
    protected $pk = 'id';
    protected $name = 'user';
}