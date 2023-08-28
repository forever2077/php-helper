<?php

namespace Forever2077\PhpHelper\Db;

use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    public function get(string $key, mixed $default = null): mixed
    {
        // TODO: Implement get() method.
        return false;
    }

    public function set(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
    {
        // TODO: Implement set() method.
        return false;
    }

    public function delete(string $key): bool
    {
        // TODO: Implement delete() method.
        return false;
    }

    public function clear(): bool
    {
        // TODO: Implement clear() method.
        return false;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        // TODO: Implement getMultiple() method.
        return [];
    }

    public function setMultiple(iterable $values, \DateInterval|int|null $ttl = null): bool
    {
        // TODO: Implement setMultiple() method.
        return false;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        // TODO: Implement deleteMultiple() method.
        return false;
    }

    public function has(string $key): bool
    {
        // TODO: Implement has() method.
        return false;
    }
}