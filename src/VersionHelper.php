<?php

namespace Forever2077\PhpHelper;

use PharIo\Version\Version;
use PharIo\Version\VersionConstraintParser;

class VersionHelper extends Version
{
    public static function instance(string $versionString): Version
    {
        return new self($versionString);
    }

    public static function complies($value, $version): bool
    {
        $parser = new VersionConstraintParser();
        $caret_constraint = $parser->parse($value);
        return $caret_constraint->complies(new Version($version));
    }
}