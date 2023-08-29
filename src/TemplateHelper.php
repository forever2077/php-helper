<?php

namespace Forever2077\PhpHelper;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Loader\ChainLoader;
use Twig\Loader\FilesystemLoader;

class TemplateHelper
{
    public static function array(array $templates = [], array $options = []): ArrayLoader|Environment
    {
        $loader = new ArrayLoader($templates);
        if (isset($options['__loader']) && !!$options['__loader']) {
            return $loader;
        }
        return new Environment($loader, $options);
    }

    public static function filesystem(string|array $paths = [], string $rootPath = null, array $options = []): FilesystemLoader|Environment
    {
        $loader = new FilesystemLoader($paths, $rootPath);
        if (isset($options['__loader']) && !!$options['__loader']) {
            return $loader;
        }
        return new Environment($loader, $options);
    }

    public static function chain(array $loaders = [], array $options = []): ChainLoader|Environment
    {
        $loader = new ChainLoader($loaders);
        if (isset($options['__loader']) && !!$options['__loader']) {
            return $loader;
        }
        return new Environment($loader, $options);
    }
}