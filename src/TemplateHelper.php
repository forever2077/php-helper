<?php

namespace Helpful;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Loader\ChainLoader;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

class TemplateHelper
{
    public static function array(array $templates = []): ArrayLoader|Environment
    {
        return new ArrayLoader($templates);
    }

    public static function filesystem(string|array $paths = [], string $rootPath = null): FilesystemLoader|Environment
    {
        return new FilesystemLoader($paths, $rootPath);
    }

    public static function chain(array $loaders = []): ChainLoader|Environment
    {
        return new ChainLoader($loaders);
    }

    public static function env(LoaderInterface $loader, $options = []): Environment
    {
        return new Environment($loader, $options);
    }
}