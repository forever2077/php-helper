<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\DownloadHelper;

class DownloadHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(DownloadHelper::class, Helper::download([]));
    }

    public function testDownload()
    {
        $list = [
            //'https://t7.baidu.com/it/u=1956604245,3662848045&fm=193&f=GIF',
        ];
        // 创建下载实例并导入下载清单
        $download = Helper::download($list);
        // 获取默认允许下载文件类型（根据扩展名）
        $fileTypes = $download->getAllowedFileType();
        $this->assertIsArray($fileTypes);
        // 设置允许下载的文件类型（根据扩展名）
        $download->setAllowedFileType(['gif', 'png', 'jpg']);
        // 添加目标下载文件
        //$download->addFile('https://t7.baidu.com/it/u=2621658848,3952322712&fm=193&f=GIF');
        // 设置最大下载数量
        $download->setMaxFiles(5);
        // 检查下载后的文件类型若不是名单内则直接删除（根据文件mime类型）
        $download->switchCheckFileType(true);
        // 所有下载后的文件名都将自动重命名（序号 + UUID4 + EXT）
        $download->switchFileRename(false);
        // 若目标文件无扩展名，则根据mime值自动补充
        $download->switchFixFileExt(true);
        // 若目标文件已存在，则重命名文件名
        // 注意：若开启修复扩展名（switchFixFileExt）功能，重命名功能会失效
        $download->switchRenameIfExists(true);
        try {
            // 设置下载文件保存目录
            $download->setDestFolder(dirname(__DIR__) . '/data/temp');
            // 执行下载任务
            $rtn = $download->downloadFiles();
            // 任务结果
            dump($rtn);
            $this->assertIsArray($rtn);
        } catch (Exception $e) {
            $this->fail($e);
        }
    }
}