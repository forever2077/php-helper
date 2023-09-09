<?php

namespace Forever2077\PhpHelper;

use Aimeos\Map;
use Arrayy\Arrayy;
use Arrayy\ArrayyIterator;

class ArrayHelper extends Map
{
    /**
     * @link https://github.com/aimeos/map
     */
    public function __construct($elements = [])
    {
        parent::__construct($elements);
    }

    /**
     * @link https://github.com/voku/Arrayy
     * @param array $data
     * @param string $iteratorClass
     * @param bool $checkPropertiesInConstructor
     * @return Arrayy
     */
    public static function create(
        array  $data = [],
        string $iteratorClass = ArrayyIterator::class,
        bool   $checkPropertiesInConstructor = true): Arrayy
    {
        return new Arrayy($data, $iteratorClass, $checkPropertiesInConstructor);
    }
}
