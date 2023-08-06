<?php

namespace Forever2077\PhpHelper;

use DateTimeInterface;
use Ramsey\Uuid\Guid\Guid;
use Ramsey\Uuid\Type\Hexadecimal;
use Ramsey\Uuid\Type\Integer as IntegerObject;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidHelper
{
    public static function instance(): UuidHelper
    {
        return new self();
    }

    public static function uuid1($node = null, ?int $clockSeq = null): UuidInterface
    {
        return Uuid::uuid1($node, $clockSeq);
    }

    public static function uuid2(int $localDomain, ?IntegerObject $localIdentifier = null, ?Hexadecimal $node = null, ?int $clockSeq = null): UuidInterface
    {
        return Uuid::uuid2($localDomain, $localIdentifier, $node, $clockSeq);
    }

    public static function uuid3($ns, string $name): UuidInterface
    {
        return Uuid::uuid3($ns, $name);
    }

    public static function uuid4(): UuidInterface
    {
        return Uuid::uuid4();
    }

    public static function uuid5($ns, string $name): UuidInterface
    {
        return Uuid::uuid5($ns, $name);
    }

    public static function uuid6(?Hexadecimal $node = null, ?int $clockSeq = null): UuidInterface
    {
        return Uuid::uuid6($node, $clockSeq);
    }

    public static function uuid7(?DateTimeInterface $dateTime = null): UuidInterface
    {
        return Uuid::uuid7($dateTime);
    }

    public static function uuid8(string $bytes): UuidInterface
    {
        return Uuid::uuid8($bytes);
    }

    public static function guid($withBrackets = true): string
    {
        $uuid4 = Uuid::uuid4();
        $guid = Guid::fromBytes($uuid4->getBytes());
        $guidStr = $guid->toString();
        return $withBrackets ? sprintf('{%s}', $guidStr) : $guidStr;
    }
}