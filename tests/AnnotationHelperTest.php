<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\Annotations\{After, Before, Cache, Log, Limit};

class AnnotationHelperTest extends TestCase
{
    public function testMain()
    {
        try {
            $rtn = Helper::annotation([$this, 'doAction'], ['a' => 1, 'b' => 2]);
            dump($rtn['targetMethod']);
            dump($rtn[Before::class]);
            dump($rtn[After::class]);
            $this->assertIsArray($rtn);
        } catch (Exception $e) {
            $this->fail($e);
        }
    }

    /**
     * @param int $a
     * @param int $b
     * @return string
     */
    //#[Limit]
    #[Before("beforeAction", ['a' => 3, 'b' => 4])]
    #[After(['AnnotationHelperTest', 'afterAction'], ['a' => 5, 'b' => 6])]
    public static function doAction(int $a = 0, int $b = 0): string
    {
        try {
            Helper::annotation([__CLASS__, 'innerAction'], ['a' => 7, 'b' => 8]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return "doAction：{$a}, {$b}";
    }

    public static function beforeAction($a = 0, $b = 0): string
    {
        return "beforeAction：{$a}, {$b}";
    }

    public function afterAction($a = 0, $b = 0): string
    {
        return "afterAction：{$a}, {$b}";
    }

    //#[Log]
    //#[Log('自定义日志信息')]
    #[Cache]
    public function innerAction($a = 0, $b = 0): string
    {
        return "innerAction：{$a}, {$b}";
    }
}