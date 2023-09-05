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

    public static function generator()
    {
        /**
         * https://github.com/OpenAPITools/openapi-generator
         * https://github.com/swagger-api/swagger-codegen
         * https://github.com/quicktype/quicktype
         * https://github.com/janephp/janephp
         * https://github.com/wol-soft/php-json-schema-model-generator#Installation
         */
    }
}