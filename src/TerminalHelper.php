<?php

namespace Helpful;

use League\CLImate\CLImate;

class TerminalHelper extends CLImate
{
    /**
     * @link https://github.com/thephpleague/climate
     * @return CLImate
     */
    public static function instance(): CLImate
    {
        return new CLImate();
    }
}