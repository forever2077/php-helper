<?php

namespace Forever2077\PhpHelper;

use Exception;
use InvalidArgumentException;
use cebe\openapi\spec\{OpenApi, Info, PathItem};
use cebe\openapi\{Reader, Writer, SpecObjectInterface};
use cebe\openapi\json\InvalidJsonPointerSyntaxException;
use cebe\openapi\exceptions\{IOException, TypeErrorException, UnresolvableReferenceException};

/**
 * https://github.com/cebe/php-openapi
 * https://github.com/thephpleague/openapi-psr7-validator
 */
class OpenApiHelper
{
    /**
     * 读取器
     * @param string $pathOrUrlOrString
     * @param string $baseType
     * @param bool $resolveReferences
     * @return SpecObjectInterface
     * @throws IOException
     * @throws InvalidJsonPointerSyntaxException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     */
    public static function reader(string $pathOrUrlOrString, string $baseType = OpenApi::class, bool $resolveReferences = true): SpecObjectInterface
    {
        $mode = 'json';
        if (str_ends_with($pathOrUrlOrString, '.yaml')) {
            $mode = 'yaml';
        }
        if (filter_var($pathOrUrlOrString, FILTER_VALIDATE_URL)) {
            $openapi = $mode === 'json' ?
                Reader::readFromJsonFile($pathOrUrlOrString, $baseType, $resolveReferences) :
                Reader::readFromYamlFile($pathOrUrlOrString, $baseType, $resolveReferences);
        } elseif (file_exists($pathOrUrlOrString)) {
            $openapi = $mode === 'json' ?
                Reader::readFromJsonFile(realpath($pathOrUrlOrString), $baseType, $resolveReferences) :
                Reader::readFromYamlFile(realpath($pathOrUrlOrString), $baseType, $resolveReferences);
        } else {
            $openapi = $mode === 'json' ?
                Reader::readFromJson($pathOrUrlOrString, $baseType) :
                Reader::readFromYaml($pathOrUrlOrString, $baseType);
        }
        return $openapi;
    }

    /**
     * 写入器
     * @param array $data
     * @param string $filename
     * @param string $mode
     * @return string|bool
     * @throws IOException
     * @throws Exception
     */
    public static function writer(array $data, string $filename = '', string $mode = 'json'): string|bool
    {
        $data['openapi'] = $data['openapi'] ?? false;
        $data['info'] = $data['info'] ?? false;
        $data['paths'] = $data['paths'] ?? false;

        if ($data['openapi'] === false) {
            throw new InvalidArgumentException('openapi');
        }

        if ($data['info'] === false) {
            throw new InvalidArgumentException('info');
        }

        if ($data['paths'] === false) {
            throw new InvalidArgumentException('paths');
        }

        if (!($data['info'] instanceof Info)) {
            try {
                $data['info'] = new Info($data['info']);
            } catch (TypeErrorException $e) {
                throw new Exception($e);
            }
        }

        if (!empty($data['paths']) && is_array($data['paths'])) {
            try {
                foreach ($data['paths'] as $key => $value) {
                    if (!($value instanceof PathItem)) {
                        $data['paths'][$key] = new PathItem($value);
                    }
                }
            } catch (TypeErrorException $e) {
                throw new Exception($e);
            }
        }

        try {
            $openapi = new OpenApi($data);
        } catch (TypeErrorException $e) {
            throw new Exception($e);
        }

        if (!empty($filename)) {
            if (!file_exists($filename)) {
                match ($mode) {
                    'json' => Writer::writeToJsonFile($openapi, $filename),
                    'yaml' => Writer::writeToYamlFile($openapi, $filename),
                    default => throw new Exception('mode'),
                };
                return true;
            }
            return false;
        } else {
            return match ($mode) {
                'json' => Writer::writeToJson($openapi),
                'yaml' => Writer::writeToYaml($openapi),
                default => throw new Exception('mode'),
            };
        }
    }

    /**
     * 生成器
     * @link https://github.com/quicktype/quicktype
     * @link https://app.quicktype.io/
     * @param array $config
     * @return bool
     * @throws Exception
     */
    public static function generator(array $config = []): bool
    {
        $command = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? "quicktype --version 2>nul" : "quicktype --version 2>&1";
        exec($command, $output, $return_var);
        if ($return_var === 0) {

            $command = [];
            $options = [];
            $options = array_merge($options, $config ?? []);

            // Base
            $options['out'] = $options['out'] ?? ''; // The output file. Determines --lang and --top-level.
            $options['top-level'] = $options['top-level'] ?? 'test'; // The name for the top level type.
            $options['lang'] = $options['lang'] ?? 'php'; // The target language.
            $options['src-lang'] = $options['src-lang'] ?? 'json'; // The source language (default is json).
            $options['src'] = $options['src'] ?? ''; // The file, url, or data directory to type.
            $options['namespace'] = $options['namespace'] ?? ''; // The class namespace.

            if (empty($options['out'])) {
                throw new Exception('Please specify the output file.');
            }

            if (empty($options['src'])) {
                throw new Exception('Please specify the source file.');
            }

            foreach (['out', 'src', 'top-level', 'lang', 'src-lang'] as $name) {
                $command[] = "--{$name} \"{$options[$name]}\"";
            }

            // Php
            $options['fast-get'] = $options['fast-get'] ?? true; // getter without validation (off by default)
            $options['with-get'] = $options['with-get'] ?? true; // Create Getter (on by default)
            $options['with-set'] = $options['with-set'] ?? true; // Create Setter (off by default)
            $options['with-closing'] = $options['with-closing'] ?? false; // PHP Closing Tag (off by default)
            $options['acronym-style'] = $options['acronym-style'] ?? 'original'; // Acronym naming style;  original | pascal | camel | lowerCase

            foreach (['with-get', 'fast-get', 'with-set', 'with-closing', 'acronym-style'] as $name) {
                $command[] = match ($options[$name]) {
                    true => "--{$name}",
                    false => "--no-{$name}",
                    default => "--{$name} \"{$options[$name]}\"",
                };
            }

            // Common
            $options['alphabetize-properties'] = $options['alphabetize-properties'] ?? true; // Alphabetize order of class properties.
            $options['all-properties-optional'] = $options['all-properties-optional'] ?? true; // Make all class properties optional.

            foreach (['alphabetize-properties', 'all-properties-optional'] as $name) {
                if ($options[$name] === true) {
                    $command[] = "--{$name}";
                }
            }

            if (!empty($command) && is_array($command)) {
                $command = implode(" ", $command);
            }

            $output = null;
            $return_var = null;

            exec("quicktype {$command}", $output, $return_var);

            if (!$return_var) {
                if (!empty($options['namespace']) && file_exists($options['out'])) {
                    $filePath = $options['out'];
                    $fileContent = file_get_contents($filePath);
                    $newContent = "<?php\nnamespace {$options['namespace']};\n" . substr($fileContent, strlen("<?php\n"));
                    file_put_contents($filePath, $newContent);
                }
            }

            return !$return_var;

        } else {
            throw new Exception('Please visit https://github.com/quicktype/quicktype to complete the installation after continue to generate the target code');
        }
    }
}