<?php

namespace Forever2077\PhpHelper;

final class LruNode
{
    public $key;
    public $value;
    public $prev;
    public $next;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}