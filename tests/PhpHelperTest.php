<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\PhpHelper;

class PhpHelperTest extends TestCase
{
    public function testPhpHelper()
    {
        $this->assertIsString(PhpHelper::$version);
    }

    private function testDoc()
    {
        echo PHP_EOL;

        $path = dirname(__DIR__) . '/doc';
        Helper::file()::scanDirectory([
            'dir' => $path,
            'callback' => function ($file) use ($path) {

                $content = file_get_contents($file);
                preg_match("/##(.*)/", $content, $match);
                if (isset($match[1])) {
                    $title = trim($match[1]);
                } else {
                    throw new \Exception($file);
                }

                $filepath = "doc/" . pathinfo($file, PATHINFO_BASENAME);
                echo "[{$title}]({$filepath})";

                echo PHP_EOL;
            }
        ]);
    }
}