<?php

namespace Helpful\Validation;

trait Common
{
    // 身份证号码验证
    public static function isIdentityCard(string $idCardNumber): bool
    {
        // 身份证正则表达式
        $regex = '/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/';

        if (preg_match($regex, $idCardNumber)) {
            return true;
        } else {
            return false;
        }
    }

    // 护照编号验证
    public static function isPassport(string $passportNumber): bool
    {
        // 护照正则表达式
        $regex = '/^(^[EeKkGgDdSsPpHh]\d{8}$)|(^(([Ee][a-fA-F])|([DdSsPp][Ee])|([Kk][Jj])|([Mm][Aa])|(1[45]))\d{7}$)$/';

        if (preg_match($regex, $passportNumber)) {
            return true;
        } else {
            return false;
        }
    }

    // 银行卡号验证
    public static function isBankCard(string $bankCardNumber): bool
    {
        // 银行卡正则表达式
        $regex = '/^([1-9]{1})(\d{14}|\d{18})$/';

        if (preg_match($regex, $bankCardNumber)) {
            return true;
        } else {
            return false;
        }
    }

    // 中国车牌号验证
    public static function isLicensePlate(string $licensePlateNumber): bool
    {
        // 车牌号正则表达式
        $regex = '/^[\x{4e00}-\x{9fa5}]{1}[A-Z]{1}[A-Z0-9]{5,6}$/u';

        if (preg_match($regex, $licensePlateNumber)) {
            return true;
        } else {
            return false;
        }
    }

    // 中国手机号码验证
    public static function isMobile(string $mobileNumber): bool
    {
        // 手机号正则表达式
        $regex = '/^1[3-9]\d{9}$/';

        if (preg_match($regex, $mobileNumber)) {
            return true;
        } else {
            return false;
        }
    }

    // 邮箱地址验证
    public static function isEmail(string $email): bool
    {
        // 邮箱正则表达式
        $regex = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';

        if (preg_match($regex, $email)) {
            return true;
        } else {
            return false;
        }
    }

    // 用户名验证
    public static function isUsername(string $username): bool
    {
        // 用户名正则
        $regex = '/^[a-zA-Z0-9_\.]+$/';

        if (preg_match($regex, $username)) {
            return true;
        } else {
            return false;
        }
    }

    // 强密码验证
    public static function isStrongPassword(string $password): bool
    {
        // 强密码正则
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/';

        if (preg_match($regex, $password)) {
            return true;
        } else {
            return false;
        }
    }

    // IP地址验证
    public static function isIP(string $ip): bool
    {
        // IP地址正则
        $regex = '/^(([1-9]?\d|1\d\d|2[0-4]\d|25[0-5])(\.(?1)){3})$/';

        if (preg_match($regex, $ip)) {
            return true;
        } else {
            return false;
        }
    }

    // 中文姓名验证
    public static function isChineseName(string $chineseName): bool
    {
        // 中文姓名正则
        $regex = '/^[\x{4e00}-\x{9fa5}]+(·[\x{4e00}-\x{9fa5}+])*$/u';

        if (preg_match($regex, $chineseName)) {
            return true;
        } else {
            return false;
        }
    }

    // 日期验证
    public static function isDate(string $date): bool
    {
        // 日期正则
        $regex = '/^\d{4}-\d{2}-\d{2}$/';

        if (preg_match($regex, $date)) {
            return true;
        } else {
            return false;
        }
    }

    // URL验证
    public static function isURL(string $url): bool
    {
        // URL正则
        $regex = '/^((ht|f)tp(s?)\:\/\/)?[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;%\$#_]*)?$/';

        if (preg_match($regex, $url)) {
            return true;
        } else {
            return false;
        }
    }

    // 邮政编码验证
    public static function isPostalCode(string $postalCode): bool
    {
        // 邮编正则
        $regex = '/\d{6}/';

        if (preg_match($regex, $postalCode)) {
            return true;
        } else {
            return false;
        }
    }

    // IPv6地址验证
    public static function isIPv6(string $ipv6): bool
    {
        // IPv6正则
        $regex = '/^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$/';

        if (preg_match($regex, $ipv6)) {
            return true;
        } else {
            return false;
        }
    }

    // MAC地址验证
    public static function isMAC(string $mac): bool
    {
        // MAC正则
        $regex = '/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/';

        if (preg_match($regex, $mac)) {
            return true;
        } else {
            return false;
        }
    }

    // 腾讯QQ号验证
    public static function isQQNumber(string $qqNumber): bool
    {
        // QQ号正则
        $regex = '/^[1-9][0-9]{4,10}$/';

        if (preg_match($regex, $qqNumber)) {
            return true;
        } else {
            return false;
        }
    }

    // 微信号验证
    public static function isWechatId(string $wechatId): bool
    {
        // 微信号正则
        $regex = '/^[a-zA-Z]([-_a-zA-Z0-9]{5,19})+$/';

        if (preg_match($regex, $wechatId)) {
            return true;
        } else {
            return false;
        }
    }

    // 车架号验证
    public static function isVIN(string $vin): bool
    {
        // 车架号正则
        $regex = '/^[A-HJ-NPR-Z0-9]{8}[0-9A-HJ-NPR-Z]{2}[A-HJ-NPR-Z0-9]{6}$/';

        if (preg_match($regex, $vin)) {
            return true;
        } else {
            return false;
        }
    }

    // 模糊查询验证
    public static function isFuzzyQuery(string $fuzzyQuery): bool
    {
        $regex = '/^".+"$/';
        return preg_match($regex, $fuzzyQuery);
    }

    // 语音格式验证
    public static function isAudio(string $audio): bool
    {
        $allowed = ['mp3', 'wav', 'ogg'];
        $ext = pathinfo($audio, PATHINFO_EXTENSION);
        return in_array($ext, $allowed);
    }

    // 视频格式验证
    public static function isVideo(string $video): bool
    {
        $allowed = ['mp4', 'mov', 'avi', 'wmv'];
        $ext = pathinfo($video, PATHINFO_EXTENSION);
        return in_array($ext, $allowed);
    }

    // 单词验证
    public static function isWord(string $word): bool
    {
        $regex = '/^\w+$/';
        return preg_match($regex, $word);
    }

    // 分页页码验证
    public static function isPageNumber(int $pageNumber): bool
    {
        return $pageNumber >= 1;
    }

    // 游戏ID验证
    public static function isGameId(string $gameId): bool
    {
        $regex = '/^[a-zA-Z0-9]{6,20}$/';
        return preg_match($regex, $gameId);
    }

    // 验证码验证
    public static function isCaptcha(string $captcha): bool
    {
        $regex = '/^[A-Za-z0-9]{4,10}$/';
        return preg_match($regex, $captcha);
    }

    // 模板变量验证
    public static function isValidTemplateVar(string $template): bool
    {
        return preg_match('/{{\w+}}/', $template);
    }

    // crontab表达式验证
    public static function isValidCronExp(string $cronExp): bool
    {
        return preg_match('/^(\*|([0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9])|\*\/([0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9])) (\*|([0-9]|1[0-9]|2[0-3])|\*\/([0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9])) (\*|([1-9]|1[0-9]|2[0-9]|3[0-1])|\*\/([1-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9])) (\*|([1-9]|1[0-2])|\*\/([1-9]|1[0-2])) (\*|([0-6])|\*\/([0-6]))$/', $cronExp);
    }

    // 数字字母组合验证
    public static function isValidAlphaNumeric(string $value): bool
    {
        return preg_match('/^([a-zA-Z0-9]+)$/', $value);
    }

    // 字母数字下划线验证
    public static function isValidAlphaNumUnderscore(string $value): bool
    {
        return preg_match('/^(\w)+$/', $value);
    }

    // 单选/多选项验证
    public static function isValidOptions(array $options): bool
    {
        if (empty($options)) return false;

        foreach ($options as $option) {
            if (!is_string($option)) return false;
        }

        return true;
    }

    // JSON格式验证
    public static function isValidJson(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }

    // 正则表达式验证
    public static function isValidRegex(string $regex): bool
    {
        return @preg_match($regex, null) !== false;
    }

    // 验证码长度验证
    public static function isValidCaptchaLength(string $captcha): bool
    {
        return strlen($captcha) >= 4 && strlen($captcha) <= 6;
    }

    // Base64格式验证
    public static function isBase64(string $base64): bool
    {
        if (base64_encode(base64_decode($base64)) === $base64) {
            return true;
        } else {
            return false;
        }
    }

    // MD5格式验证
    public static function isMD5(string $md5): bool
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    // GUID/UUID格式验证
    public static function isGUID(string $guid): bool
    {
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';
        return preg_match($regex, $guid);
    }

    // 金额验证
    public static function isAmount(string $amount): bool
    {
        $regex = '/^\d*(?:\.\d{1,2})?$/';
        return preg_match($regex, $amount);
    }

    // 货币符号验证
    public static function isCurrency(string $currency): bool
    {
        $regex = '/^[$£€¥]?$/';
        return preg_match($regex, $currency);
    }

    // 数字验证
    public static function isNumber(string $number): bool
    {
        $regex = '/^\d+$/';
        return preg_match($regex, $number);
    }

    // 浮点数验证
    public static function isFloat(string $float): bool
    {
        $regex = '/^[+-]?(\d+(\.\d*)?|\.\d+)([eE][+-]?\d+)?$/';
        return preg_match($regex, $float);
    }

    // 十六进制颜色值验证
    public static function isHexColor(string $hexColor): bool
    {
        $regex = '/^#?([a-f0-9]{6}|[a-f0-9]{3})$/i';
        return preg_match($regex, $hexColor);
    }

    // RGB颜色值验证
    public static function isRGBColor(string $rgbColor): bool
    {
        $regex = '/^rgb\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)$/';
        return preg_match($regex, $rgbColor);
    }

    // 小数验证
    public static function isDecimal(string $decimal): bool
    {
        $regex = '/^\d+\.\d+$/';
        return preg_match($regex, $decimal);
    }

    // MIME类型验证
    public static function isMimeType(string $mime): bool
    {
        $regex = '/^([a-zA-Z0-9\-]+)\/([a-zA-Z0-9\.+-]+)$/';
        return preg_match($regex, $mime);
    }

    // 单位名称验证
    public static function isUnit(string $unit): bool
    {
        $allowed = ['kg', 'g', 'm', 'cm', 'mm', 'km'];
        return in_array(strtolower($unit), $allowed);
    }

    // 网络端口验证
    public static function isPort(int $port): bool
    {
        return $port >= 0 && $port <= 65535;
    }

    // 语言代码验证
    public static function isLanguageCode(string $languageCode): bool
    {
        $regex = '/^[a-z]{2,3}(?:-[A-Z]{2,3}(?:-[a-zA-Z]{4})?)?$/';
        return preg_match($regex, $languageCode);
    }

    // 半角字符验证
    public static function isHalfWidthChar(string $text): bool
    {
        return preg_match('/^[\x00-\x7F]*$/', $text);
    }

    // 全角字符验证
    public static function isFullWidthChar(string $text): bool
    {
        return preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $text);
    }

    // GB2312编码验证
    public static function isGB2312(string $text): bool
    {
        return mb_check_encoding($text, 'GB2312');
    }

    // UTF-8编码验证
    public static function isUTF8(string $text): bool
    {
        return mb_check_encoding($text, 'UTF-8');
    }

    // 中文字符验证
    public static function isChineseChar(string $text): bool
    {
        return preg_match('/^[\p{Han}]+$/u', $text);
    }

    // 英文字符验证
    public static function isEnglishChar(string $text): bool
    {
        return preg_match('/^[A-Za-z]+$/', $text);
    }

    // 字母数字下划线组合验证
    public static function isAlphaNumUnderscoreCombo(string $value): bool
    {
        return preg_match('/^([A-Za-z0-9_])+$/', $value);
    }

    // 数字字母DASH组合验证
    public static function isDigitAlphaDashCombo(string $value): bool
    {
        return preg_match('/^([A-Za-z0-9-])+$/', $value);
    }

    // 中文名称验证
    public static function isValidChineseName(string $name): bool
    {
        return preg_match('/^[\x{4e00}-\x{9fa5}·]{2,15}$/u', $name);
    }

    // 英文名称验证
    public static function isValidEnglishName(string $name): bool
    {
        return preg_match('/^[A-Za-z\\s]{2,30}$/', $name);
    }

    // 微博昵称验证
    public static function isValidWeiboNickname(string $nickname): bool
    {
        return preg_match('/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{4,15}$/u', $nickname);
    }

    // 中文手机号验证
    public static function isValidChineseMobile(string $mobile): bool
    {
        return preg_match('/^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(17[0|6-8])|(18[0-9])|166|198|199)\d{8}$/', $mobile);
    }

    // 抖音号验证
    public static function isValidDouyinId(string $douyinId): bool
    {
        return preg_match('/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/', $douyinId);
    }

    // 微信openid验证
    public static function isValidWechatOpenid(string $openid): bool
    {
        return preg_match('/^[a-zA-Z0-9\-\_]{28}$/', $openid);
    }

    // 车牌号颜色验证
    public static function isValidPlateColor(string $color): bool
    {
        $allowed = ['blue', 'yellow', 'black', 'white', 'green'];
        return in_array(strtolower($color), $allowed);
    }

    // 域名验证
    public static function isValidDomain(string $domain): bool
    {
        return preg_match('/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/', $domain);
    }

    // 整数数组验证
    public static function isIntegerArray(array $array): bool
    {
        foreach ($array as $item) {
            if (!is_int($item)) {
                return false;
            }
        }
        return true;
    }

    // 布尔值数组验证
    public static function isBooleanArray(array $array): bool
    {
        foreach ($array as $item) {
            if (!is_bool($item)) {
                return false;
            }
        }
        return true;
    }

    // 字符串数组验证
    public static function isStringArray(array $array): bool
    {
        foreach ($array as $item) {
            if (!is_string($item)) {
                return false;
            }
        }
        return true;
    }

    // 字段必填验证
    public static function isRequired($value): bool
    {
        return !empty($value);
    }

    // 强制手机号格式
    public static function formatMobile(string $mobile): string
    {
        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        if (strlen($mobile) == 11) {
            return preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1****$3', $mobile);
        }

        return $mobile;
    }

    // 强制邮箱加密
    public static function formatEmail(string $email): string
    {
        $emailParts = explode('@', $email);

        if (count($emailParts) == 2) {
            return substr($emailParts[0], 0, 1) . '*****' . '@' . $emailParts[1];
        }

        return $email;
    }

    // 强制身份证脱敏
    public static function formatIdNumber(string $idNumber): string
    {
        return substr($idNumber, 0, 6) . '******' . substr($idNumber, -4);
    }

    // 字符串首字母大写
    public static function capitalize(string $text): string
    {
        return ucfirst($text);
    }

    // JSON编码
    public static function jsonEncode($value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // JSON解码
    public static function jsonDecode(string $json)
    {
        return json_decode($json, true);
    }

    // 特殊字符过滤
    public static function filterSpecialChar(string $text): string
    {
        return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $text);
    }

    // 单词首字母大写验证
    public static function isCapitalizedWord(string $word): bool
    {
        return preg_match('/^[A-Z][a-z]+$/', $word);
    }

    // 版本号验证
    public static function isValidVersion(string $version): bool
    {
        return preg_match('/^\d+(\.\d+){1,2}$/', $version);
    }

    // 十进制数验证
    public static function isDecimalNumber(string $number): bool
    {
        return preg_match('/^\d+$/', $number);
    }

    // 数字范围验证
    public static function isNumberInRange(int $number, int $min, int $max): bool
    {
        return $number >= $min && $number <= $max;
    }

    // 单词字母全大写验证
    public static function isUppercaseWord(string $word): bool
    {
        return preg_match('/^[A-Z]+$/', $word);
    }

    // 加密密码强度验证
    public static function isStrongEncryptedPassword(string $password): bool
    {
        $regex = '/^[A-Za-z0-9!\#\$\%\\\&\+\-,\.\/;\=\?\@\^_`\{|\}~]+$/';
        return preg_match($regex, $password) && strlen($password) >= 8;
    }

    // 验证码内容验证
    public static function isValidCaptchaContent(string $captcha): bool
    {
        return !preg_match('/[a-zA-Z0-9]+/', $captcha);
    }

    // 数字字母特殊字符组合验证
    public static function isComplexString(string $value): bool
    {
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/', $value);
    }

    // 单词字母全小写验证
    public static function isLowercaseWord(string $word): bool
    {
        return preg_match('/^[a-z]+$/', $word);
    }

    // 字母数字空格组合验证
    public static function isAlphaSpaceNumeric(string $value): bool
    {
        return preg_match('/^[A-Za-z0-9 ]+$/', $value);
    }

    // 十六进制颜色代码验证
    public static function isValidHexCode(string $hex): bool
    {
        return preg_match('/^[#][A-Fa-f0-9]{6}$/', $hex);
    }

    // 数组元素类型验证
    public static function isValidArrayType(array $array, string $type): bool
    {
        foreach ($array as $item) {
            if (gettype($item) !== $type) {
                return false;
            }
        }
        return true;
    }

    // 单词中字母大小写混合验证
    public static function isMixedCaseWord(string $word): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])[A-Za-z]+$/', $word);
    }

    // Drive盘链接验证
    public static function isValidGoogleDriveShareLink(string $shareLink): bool
    {
        return preg_match('/^https:\/\/drive\.google\.com\/[a-zA-Z0-9\-_]+\/[a-zA-Z0-9\-_]+$/', $shareLink);
    }

    // YouTube视频链接验证
    public static function isValidYoutubeUrl(string $youtubeUrl): bool
    {
        return preg_match('/^https:\/\/(?:www\.)?youtu(?:\.be|be\.com)\/.+$/', $youtubeUrl);
    }

    // 年龄验证
    public static function isValidAge(int $age): bool
    {
        return $age > 0 && $age <= 150;
    }
}