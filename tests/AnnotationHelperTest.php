<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\AnnotationHelper;
use Forever2077\PhpHelper\Annotations\AfterMethod;
use Forever2077\PhpHelper\Annotations\BeforeMethod;

class AnnotationHelperTest extends TestCase
{
    public function testMain()
    {
        try {
            $rtn = AnnotationHelper::process(
                [new AnnotationHelperTest, 'doAction'], ['a' => 1, 'b' => 2],
            );
            $this->assertTrue($rtn);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    #[BeforeMethod("beforeAction", ['a' => 3, 'b' => 4])]
    #[AfterMethod(['AnnotationHelperTest', 'afterAction'], ['a' => 5, 'b' => 6])]
    public static function doAction($a = 0, $b = 0): bool
    {
        echo "testAction：{$a}, {$b}" . PHP_EOL;
        return true;
    }

    public static function beforeAction($a = 0, $b = 0): void
    {
        echo "beforeActionMethod：{$a}, {$b}" . PHP_EOL;
    }

    public static function afterAction($a = 0, $b = 0): void
    {
        echo "beforeActionMethod：{$a}, {$b}" . PHP_EOL;
    }
}