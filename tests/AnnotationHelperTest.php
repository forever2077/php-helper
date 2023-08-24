<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\AnnotationHelper;
use Forever2077\PhpHelper\Annotations\{After, Before, Cache, Log, Limit};

class AnnotationHelperTest extends TestCase
{
    public function testMain()
    {
        try {
            //AnnotationHelper::process($this);
            AnnotationHelper::process(__CLASS__);
            //AnnotationHelper::process([new AnnotationHelperTest, 'doAction'], ['a' => 1, 'b' => 2]);
            $this->assertTrue(true);
        } catch (Exception $e) {
            $this->fail($e);
        }
    }

    /**
     * @param int $a
     * @param int $b
     * @return bool
     */
//    #[Log]
//    #[Limit]
//    #[Cache]
    #[Before("beforeAction", ['a' => 3, 'b' => 4])]
    #[After(['AnnotationHelperTest', 'afterAction'], ['a' => 5, 'b' => 6])]
    public static function doAction(int $a = 0, int $b = 0): bool
    {
        echo "testAction：{$a}, {$b}" . PHP_EOL;
        return true;
    }

    public static function beforeAction($a = 0, $b = 0): void
    {
        echo "beforeActionMethod：{$a}, {$b}" . PHP_EOL;
    }

    public function afterAction($a = 0, $b = 0): void
    {
        echo "beforeActionMethod：{$a}, {$b}" . PHP_EOL;
    }
}