<?php

namespace Helpful;

use Exception;

class DownloadHelper
{
    /*最大文件数量*/
    private int $maxFiles = 100;

    /*保存路径*/
    private string $destFolder;

    /*下载文件队列*/
    private array $remoteFiles = [];

    /*检查文件类型*/
    private bool $checkFileType = true;

    /*下载目标文件重命名*/
    private bool $fileRename = false;

    /*根据文件信息修复扩展名*/
    private bool $fixFileExt = false;

    /*允许的文件类型*/
    private array $allowedFileTypes = [
        'jpg', 'jpeg', 'png', 'gif', // 图像格式
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv', 'md', // 文档格式
        'zip', 'tar', 'gz', '7z', 'rar', // 压缩文件格式
        'mp3', 'wav', 'ogg', // 音频格式
        'mp4', 'avi', 'mkv', 'flv', // 视频格式
        'xml', 'json', 'yaml', 'toml', // 数据表示格式
        'html', 'htm', 'css', 'js', // Web 技术相关格式
        'svg', 'ico', 'webp', // 其他图像和Web相关格式
        'rtf', 'odt', 'ods' // 开放文档格式和其他文本格式
    ];

    /*检查目标路径是否已经存在相同名称的文件，并在需要时进行重命名*/
    private bool $autoRenameIfExists = false;

    /**
     * @param array $remoteFiles
     * @throws Exception
     */
    public function __construct(array $remoteFiles = [])
    {
        if (count($remoteFiles) > $this->maxFiles) {
            throw new Exception('Exceeded max number of files.');
        }
        $this->remoteFiles = $remoteFiles;
    }

    /**
     * @param string $destFolder 目标文件夹路径
     * @param bool $createIfNotExist 如果目录不存在，是否创建它
     * @return void
     * @throws Exception
     */
    public function setDestFolder(string $destFolder, bool $createIfNotExist = false): void
    {
        if (is_dir($destFolder)) {
            $this->destFolder = $destFolder;
        } else {
            if ($createIfNotExist) {
                if (mkdir($destFolder, 0777, true)) {
                    $this->destFolder = $destFolder;
                } else {
                    throw new Exception('Failed to create dest folder.');
                }
            } else {
                throw new Exception('Invalid dest folder.');
            }
        }
    }

    /**
     * @param bool $checkFileType
     * @return void
     */
    public function switchCheckFileType(bool $checkFileType): void
    {
        $this->checkFileType = $checkFileType;
    }

    public function switchFileRename(bool $fileRename): void
    {
        $this->fileRename = $fileRename;
    }

    public function switchFixFileExt(bool $fixFileExt): void
    {
        $this->fixFileExt = $fixFileExt;
    }

    public function switchRenameIfExists(bool $flag): void
    {
        $this->autoRenameIfExists = $flag;
    }

    /**
     * @param $maxFiles
     * @return bool
     */
    public function setMaxFiles($maxFiles): bool
    {
        if (is_numeric($maxFiles) && $maxFiles > 0) {
            $this->maxFiles = $maxFiles;
            return true;
        }
        return false;
    }

    public function setAllowedFileType(array $allowedFileTypes): void
    {
        $this->allowedFileTypes = $allowedFileTypes;
    }

    /**
     * @param $newType
     * @return void
     */
    public function addAllowedFileType($newType): void
    {
        if (!in_array($newType, $this->allowedFileTypes)) {
            $this->allowedFileTypes[] = $newType;
        }
    }

    /**
     * @return array|string[]
     */
    public function getAllowedFileType(): array
    {
        return $this->allowedFileTypes;
    }

    /**
     * @param array $newTypes
     * @return void
     */
    public function addAllowedFileTypes(array $newTypes): void
    {
        foreach ($newTypes as $newType) {
            $this->addAllowedFileType($newType);
        }
    }

    /**
     * @param $url
     * @return bool
     */
    public function addFile($url): bool
    {
        if (count($this->remoteFiles) >= $this->maxFiles) {
            return false;
        }
        $this->remoteFiles[] = $url;
        return true;
    }

    /**
     * @param $filePath
     * @return bool
     */
    private function checkFileType($filePath): bool
    {
        if (file_exists($filePath)) {
            try {
                $ext = FileHelper::getRealFileType($filePath, true);
            } catch (Exception $e) {
                return false;
            }
            if (isset($ext['exts'])) {
                $arr = ArrayHelper::from($this->allowedFileTypes)->intersect($ext['exts'], function ($v1, $v2) {
                    return strtolower($v1) <=> strtolower($v2);
                });
                return !empty($arr->toArray());
            }
        }
        return false;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function downloadFiles(): array
    {
        $result = [];

        if (!is_dir($this->destFolder)) {
            throw new Exception('Invalid dest folder.');
        }

        if (count($this->remoteFiles) > $this->maxFiles) {
            throw new Exception('Exceeded max number of files.');
        }

        $mh = curl_multi_init();
        $handles = [];

        foreach ($this->remoteFiles as $index => $url) {

            $fileName = pathinfo($url, PATHINFO_FILENAME);
            $fileExt = pathinfo($url, PATHINFO_EXTENSION);

            if ($this->fileRename) {
                $newFileName = ($index + 1) . '_' . helper::uuid()::uuid4() . (!empty($fileExt) ? ('.' . $fileExt) : '');
            } else {
                $newFileName = $fileName . (!empty($fileExt) ? ('.' . $fileExt) : '');
            }

            // 验证文件名并且返回过滤后文件名
            $newFileName = ValidateHelper::isValidFilename($newFileName, true);
            if (is_bool($newFileName) && $newFileName === false) {
                throw new Exception('Invalid file name.');
            }

            $filePath = "{$this->destFolder}/{$newFileName}";

            // 若存在同名文件自动重命名新文件名
            if ($this->autoRenameIfExists && file_exists($filePath)) {
                $fileName = pathinfo($url, PATHINFO_FILENAME);
                $fileExt = pathinfo($url, PATHINFO_EXTENSION);

                $newFileName = "{$fileName}_" . microtime(true) . (!empty($fileExt) ? ('.' . $fileExt) : '');
                $newFileName = ValidateHelper::isValidFilename($newFileName, true);
                if (is_bool($newFileName) && $newFileName === false) {
                    throw new Exception('Invalid file name.');
                }

                $filePath = "{$this->destFolder}/{$newFileName}";
            }

            $fp = fopen($filePath, 'wb');
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_multi_add_handle($mh, $ch);

            $handles[] = ['ch' => $ch, 'fp' => $fp, 'url' => $url, 'name' => $newFileName, 'ext' => $fileExt];
        }

        $active = 0;
        do {
            curl_multi_exec($mh, $active);
            curl_multi_select($mh);
        } while ($active);

        foreach ($handles as $handle) {

            $ch = $handle['ch'];
            $fp = $handle['fp'];
            $url = $handle['url'];
            $ext = $handle['ext'];
            $name = $handle['name'];

            $filePath = "{$this->destFolder}/{$name}";

            // 修改文件扩展名缺失
            if ($this->fixFileExt) {
                $fileType = FileHelper::getRealFileType("{$this->destFolder}/{$name}", true);
                if (!empty($fileType['ext']) && empty($ext)) {
                    $newFilePath = "{$filePath}.{$fileType['ext']}";
                    rename($filePath, $newFilePath);
                    $filePath = $newFilePath;
                }
            }

            if (!curl_errno($ch)) {
                if ($this->checkFileType && !$this->checkFileType($filePath)) {
                    $result['disallowed'][] = [
                        'url' => $url,
                        'error' => 'Invalid file type.',
                    ];
                    unlink($filePath);
                } else {
                    $result['success'][] = [
                        'url' => $url,
                        'file' => $filePath,
                        'size' => filesize($filePath),
                    ];
                }
            } else {
                $result['failed'][] = [
                    'url' => $url,
                    'error' => curl_error($ch),
                ];
            }

            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);
            fclose($fp);
        }

        curl_multi_close($mh);

        return $result;
    }
}
