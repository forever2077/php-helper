<?php

namespace Forever2077\PhpHelper\Validation\Rules;

use Forever2077\PhpHelper\ValidateHelper;
use Respect\Validation\Rules\AbstractRule;

final class Passport extends AbstractRule
{
    private string $countryCode = '';

    private array $passportRegexByCountryCode = array(
        'AM' => '/^[A-Z]{2}\d{7}$/', // ARMENIA
        'AR' => '/^[A-Z]{3}\d{6}$/', // ARGENTINA
        'AT' => '/^[A-Z]\d{7}$/', // AUSTRIA
        'AU' => '/^[A-Z]\d{7}$/', // AUSTRALIA
        'AZ' => '/^[A-Z]{2,3}\d{7,8}$/', // AZERBAIJAN
        'BE' => '/^[A-Z]{2}\d{6}$/', // BELGIUM
        'BG' => '/^\d{9}$/', // BULGARIA
        'BR' => '/^[A-Z]{2}\d{6}$/', // BRAZIL
        'BY' => '/^[A-Z]{2}\d{7}$/', // BELARUS
        'CA' => '/^[A-Z]{2}\d{6}$/', // CANADA
        'CH' => '/^[A-Z]\d{7}$/', // SWITZERLAND
        'CN' => '/^G\d{8}$|^E(?![IO])[A-Z0-9]\d{7}$/', // CHINA
        'CY' => '/^[A-Z](\d{6}|\d{8})$/', // CYPRUS
        'CZ' => '/^\d{8}$/', // CZECH REPUBLIC
        'DE' => '/^[CFGHJKLMNPRTVWXYZ0-9]{9}$/', // GERMANY
        'DK' => '/^\d{9}$/', // DENMARK
        'DZ' => '/^\d{9}$/', // ALGERIA
        'EE' => '/^([A-Z]\d{7}|[A-Z]{2}\d{7})$/', // ESTONIA
        'ES' => '/^[A-Z0-9]{2}([A-Z0-9]?)\d{6}$/', // SPAIN
        'FI' => '/^[A-Z]{2}\d{7}$/', // FINLAND
        'FR' => '/^\d{2}[A-Z]{2}\d{5}$/', // FRANCE
        'GB' => '/^\d{9}$/', // UNITED KINGDOM
        'GR' => '/^[A-Z]{2}\d{7}$/', // GREECE
        'HR' => '/^\d{9}$/', // CROATIA
        'HU' => '/^[A-Z]{2}(\d{6}|\d{7})$/', // HUNGARY
        'IE' => '/^[A-Z0-9]{2}\d{7}$/', // IRELAND
        'IN' => '/^[A-Z]{1}-?\d{7}$/', // INDIA
        'ID' => '/^[A-C]\d{7}$/', // INDONESIA
        'IR' => '/^[A-Z]\d{8}$/', // IRAN
        'IS' => '/^(A)\d{7}$/', // ICELAND
        'IT' => '/^[A-Z0-9]{2}\d{7}$/', // ITALY
        'JM' => '/^[Aa]\d{7}$/', // JAMAICA
        'JP' => '/^[A-Z]{2}\d{7}$/', // JAPAN
        'KR' => '/^[MS]\d{8}$/', // SOUTH KOREA
        'KZ' => '/^[a-zA-Z]\d{7}$/', // KAZAKHSTAN
        'LI' => '/^[a-zA-Z]\d{5}$/', // LIECHTENSTEIN
        'LT' => '/^[A-Z0-9]{8}$/', // LITHUANIA
        'LU' => '/^[A-Z0-9]{8}$/', // LUXEMBURG
        'LV' => '/^[A-Z0-9]{2}\d{7}$/', // LATVIA
        'LY' => '/^[A-Z0-9]{8}$/', // LIBYA
        'MT' => '/^\d{7}$/', // MALTA
        'MZ' => '/^([A-Z]{2}\d{7})|(\d{2}[A-Z]{2}\d{5})$/', // MOZAMBIQUE
        'MY' => '/^[AHK]\d{8}$/', // MALAYSIA
        'MX' => '/^\d{10,11}$/', // MEXICO
        'NL' => '/^[A-Z]{2}[A-Z0-9]{6}\d$/', // NETHERLANDS
        'NZ' => '/^([Ll]([Aa]|[Dd]|[Ff]|[Hh])|[Ee]([Aa]|[Pp])|[Nn])\d{6}$/', // NEW ZEALAND
        'PH' => '/^([A-Z](\d{6}|\d{7}[A-Z]))|([A-Z]{2}(\d{6}|\d{7}))$/', // PHILIPPINES
        'PK' => '/^[A-Z]{2}\d{7}$/', // PAKISTAN
        'PL' => '/^[A-Z]{2}\d{7}$/', // POLAND
        'PT' => '/^[A-Z]\d{6}$/', // PORTUGAL
        'RO' => '/^\d{8,9}$/', // ROMANIA
        'RU' => '/^\d{9}$/', // RUSSIAN FEDERATION
        'SE' => '/^\d{8}$/', // SWEDEN
        'SL' => '/^(P)[A-Z]\d{7}$/', // SLOVENIA
        'SK' => '/^[0-9A-Z]\d{7}$/', // SLOVAKIA
        'TH' => '/^[A-Z]{1,2}\d{6,7}$/', // THAILAND
        'TR' => '/^[A-Z]\d{8}$/', // TURKEY
        'UA' => '/^[A-Z]{2}\d{6}$/', // UKRAINE
        'US' => '/^\d{9}$/', // UNITED STATES
        'ZA' => '/^[TAMD]\d{8}$/', // SOUTH AFRICA
    );

    public function __construct(string $countryCode = 'CN')
    {
        $this->countryCode = $countryCode ?: $this->countryCode;
    }

    public function validate($input): bool
    {
        // 必须是字符串
        ValidateHelper::string($input, 'Passport (%s) is invalid');
        // 删除所有空格，转换为大写
        $normalizedStr = strtoupper(preg_replace('/\s/', '', $input));
        // 必须是有效的国家代码
        if (!array_key_exists(strtoupper($this->countryCode), $this->passportRegexByCountryCode)) {
            throw new \InvalidArgumentException(sprintf('Country code (%s) is invalid', $this->countryCode));
        }
        // 检验护照格式
        return preg_match($this->passportRegexByCountryCode[strtoupper($this->countryCode)], $normalizedStr);
    }
}