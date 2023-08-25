<?php

namespace Forever2077\PhpHelper;

use Dotenv\Dotenv;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryBuilder;
use Dotenv\Repository\RepositoryInterface;

class EnvHelper
{
    protected string $path;
    protected string $filename;
    protected RepositoryInterface $repository;

    /**
     * ConfigHelper constructor.
     * @param string $path
     * @param string $filename
     */
    protected function __construct(string $path = __DIR__, string $filename = '')
    {
        $this->path = $path;
        $this->filename = $filename;
    }

    /**
     * 配置实例
     * @param string $filePath 文件路径
     * @param string $filename 文件名
     * @return EnvHelper
     * @throws \Exception
     */
    public static function instance(string $filePath, string $filename = '.env'): EnvHelper
    {
        try {
            return self::dotenv($filePath, $filename);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * 处理 .env 文件
     * @param string $path .env 文件所在目录
     * @param string $filename .env 文件名
     * @return EnvHelper
     * @throws \Exception
     */
    public static function dotenv(string $path, string $filename = '.env'): EnvHelper
    {
        try {
            $instance = new self($path, $filename);
            $instance->repository = RepositoryBuilder::createWithNoAdapters()
                ->addAdapter(PutenvAdapter::class)
                ->immutable()
                ->make();
            return $instance;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * 保存/创建变量到 .env 文件
     * @param array $data
     * @param string $filename
     */
    public function save(array $data, string $filename = '.env'): void
    {
        $content = '';
        foreach ($data as $key => $value) {
            $content .= "$key=$value\n";
        }
        file_put_contents($this->path . '/' . $filename, $content);
    }

    /**
     * 获取变量
     * @param string $key
     * @param mixed|null $default
     * @param callable|null $callable function(Dotenv\Dotenv $dotenv): void
     * @return mixed
     */
    public function get(string $key, mixed $default = null, callable $callable = null): mixed
    {
        $dotenv = Dotenv::create($this->repository, $this->path, $this->filename);
        if ($callable) {
            $callable($dotenv);
        }
        $dotenv->load();
        return $this->repository->get($key) ?? $default;
    }

    /**
     * 判断变量是否存在
     * @param string $key
     * @param callable|null $callable
     * @return bool
     */
    public function has(string $key, callable $callable = null): bool
    {
        $dotenv = Dotenv::create($this->repository, $this->path, $this->filename);
        if ($callable) {
            $callable($dotenv);
        }
        $dotenv->load();
        return $this->repository->has($key);
    }

    /**
     * 设置变量
     * @param string $key
     * @param string $value
     * @param callable|null $callable function(Dotenv\Dotenv $dotenv): void
     */
    public function set(string $key, string $value, callable $callable = null): void
    {
        $dotenv = Dotenv::create($this->repository, $this->path, $this->filename);
        if ($callable) {
            $callable($dotenv);
        }
        $dotenv->load();
        $this->repository->set($key, $value);
    }

    /**
     * 清除变量
     * @param string $key
     * @param callable|null $callable function(Dotenv\Dotenv $dotenv): void
     */
    public function clear(string $key, callable $callable = null): void
    {
        $dotenv = Dotenv::create($this->repository, $this->path, $this->filename);
        if ($callable) {
            $callable($dotenv);
        }
        $dotenv->load();
        $this->repository->clear($key);
    }
}
