<?php

use PHPUnit\Framework\TestCase;
use Exceptions\Data\NotFoundException;

class ExceptionsTest extends TestCase
{
    public function testNotFoundException()
    {
        try {
            throw new NotFoundException();
        } catch (NotFoundException $e) {
            $this->assertEquals('Data requested for cannot be found in the data source.', $e->getMessage());
        }
    }
}