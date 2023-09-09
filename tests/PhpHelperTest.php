<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\PhpHelper;

class PhpHelperTest extends TestCase
{
    public function testPhpHelper()
    {
        $this->assertIsString(PhpHelper::$version);
    }

    public function testCountPubMethod()
    {
        try {
            $str = PhpHelper::countPubMethod();
            print_r($str);
            $this->assertIsString($str);
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }

    public function testQ()
    {
        try {
            $this->assertIsString(Helper::file()->format(1024));
            $arr = [1, 3, 2, 5, 4];
            $this->assertIsArray(Helper::algorithm()->BubbleSort($arr));
        } catch (Exception $e) {
            dump($e->getMessage());
        }
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