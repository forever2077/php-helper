<?php

namespace Forever2077\PhpHelper;

use Exception;

class NetHelper
{
    /**
     * DNS查询
     * @param string $hostname
     * @param int $type
     * @param $authoritative_name_servers
     * @param $additional_records
     * @param bool $raw
     * @return array|string
     */
    public static function dnsQuery(string $hostname, int $type = DNS_ANY, &$authoritative_name_servers = null, &$additional_records = null, bool $raw = false): array|string
    {
        return dns_get_record($hostname, $type, $authoritative_name_servers, $additional_records, $raw);
    }

    /**
     * DNS在线查询
     * @param string $domainName
     * @return bool|array
     */
    public static function dnsQueryOnline(string $domainName): bool|array
    {
        try {
            $domainName = DomainHelper::resolve($domainName);
        } catch (\Exception $e) {
            return false;
        }

        $domainName = $domainName->domain()->toString();
        $data = [];
        $i = 0;

        try {
            $document = DomHelper::load("https://who.is/dns/{$domainName}");
            $thead = $document->find('.queryResponseBodyKey table thead th');
            $tbody = $document->find('.queryResponseBodyKey table tbody tr');
            foreach ($thead as $th) {
                $data[$i][] = $th->text();
            }
            foreach ($tbody as $tr) {
                $i++;
                foreach ($tr->find('td') as $td) {
                    $data[$i][] = $td->text();
                }
            }
            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Whois在线查询
     * @param string $domainName 域名
     * @param string $mode : whois / who
     * @return string|false
     */
    public static function whoisQueryOnline(string $domainName, string $mode = 'whois'): string|false
    {
        try {
            $domainName = DomainHelper::resolve($domainName);
        } catch (\Exception $e) {
            return false;
        }

        $registrableDomain = $domainName->registrableDomain()->toString();

        try {
            switch ($mode) {
                case 'who':
                    $document = DomHelper::load("https://who.is/whois/{$registrableDomain}");
                    $content = $document->find('.queryResponseBodyValue > pre');
                    return $content[0]->text();
                default:
                    $document = DomHelper::load("https://www.whois.com/whois/{$registrableDomain}");
                    $content = $document->find('#registrarData');
                    return $content[0]->text();
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 对给定的 IP 地址执行 ping 操作（仅支持Ipv4）
     * @param string $ipAddress 要 ping 的 IP 地址
     * @param int $count 回显请求的次数
     * @param bool $returnIP 是否返回目标 IP 地址
     * @return string|bool 若 ping 成功并且 $returnIP 为 true，返回目标 IP 地址；若 $returnIP 为 false，返回 true；否则返回 false
     */
    public static function ping(string $ipAddress, int $count = 1, bool $returnIP = false): string|bool
    {
        $output = [];
        $status = null;
        $foundIP = null;

        if ($count < 1) {
            return false;
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = "ping -n $count $ipAddress";
        } else {
            $command = "ping -c $count $ipAddress";
        }

        exec($command, $output, $status);

        if ($returnIP) {
            foreach ($output as $line) {
                if (preg_match('/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/', $line, $matches)) {
                    $foundIP = $matches[0];
                    break;
                }
            }

            return $foundIP ?? false;
        }

        return $status === 0;
    }

    /**
     * 扫描给定 IP 地址上的指定端口。
     *
     * @param string $ipAddress 要扫描的 IP 地址。
     * @param array|string $ports 要扫描的端口数组。
     * @return array|bool 包含开放端口的数组。
     */
    public static function portScanner(string $ipAddress, array|string $ports): array|bool
    {
        $openPorts = [];

        if (is_array($ports)) {
            $portList = $ports;
        } elseif (str_contains($ports, '-')) {
            list($start, $end) = explode('-', $ports);
            $portList = range((int)$start, (int)$end);
        } else {
            return false;
        }

        foreach ($portList as $port) {
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_set_nonblock($socket);

            $connection = @socket_connect($socket, $ipAddress, $port);

            if ($connection || socket_last_error($socket) === SOCKET_EISCONN) {
                $openPorts[] = $port;
                socket_close($socket);
                continue;
            }

            $read = $write = [$socket];
            $except = null;
            $selected = socket_select($read, $write, $except, 1);

            if ($selected > 0) {
                $openPorts[] = $port;
            }

            socket_close($socket);
        }

        return $openPorts;
    }

    /**
     * 执行traceroute来追踪到达目标IP地址的路径
     * @param string $ipAddress 目标IP地址
     * @param int $maxHops 搜索目标的最大跃点数
     * @param int $timeout 等待每个回复的超时时间，单位：秒
     * @return array|bool 执行结果的输出数组
     */
    public static function traceroute(string $ipAddress, int $maxHops = 30, int $timeout = 5): array|bool
    {
        $output = [];

        $ipAddress = NetHelper::ping($ipAddress, 1, true);

        if ($ipAddress) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                exec("tracert -h $maxHops -w " . ($timeout * 1000) . " $ipAddress", $output);
            } else {
                exec("traceroute -m $maxHops -w $timeout $ipAddress", $output);
            }

            return $output;
        }
        return false;
    }

    /**
     * 对给定的 IP 地址或域名执行 nslookup 操作
     * @param string $ipAddress 要查询的 IP 地址或域名
     * @param string $type 查询类型（例如，A, MX, CNAME 等）。默认为 'A'
     * @param string|null $server 要使用的 DNS 服务器。默认为 null
     * @param int $timeout 超时时间（单位：秒）。默认为 5 秒
     * @return array 返回 nslookup 的输出
     */
    public static function nslookup(string $ipAddress, string $type = 'A', ?string $server = null, int $timeout = 5): array
    {
        $command = "nslookup -type=$type $ipAddress";
        if ($server !== null) {
            $command .= " $server";
        }

        $descriptorspec = [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "w"]
        ];

        $process = proc_open($command, $descriptorspec, $pipes);

        if (is_resource($process)) {
            $start = time();
            $output = "";

            do {
                $timePassed = time() - $start;
                $read = [$pipes[1]];
                $write = null;
                $except = null;

                if (stream_select($read, $write, $except, $timeout - $timePassed) > 0) {
                    $output .= fread($pipes[1], 8192);
                }

            } while ($timePassed < $timeout);

            foreach ($pipes as $pipe) {
                fclose($pipe);
            }

            proc_close($process);

            return explode("\n", trim($output));
        } else {
            // 处理错误，例如返回空数组或抛出异常
            return [];
        }
    }

    /**
     * 获取ARP表并以关联数组形式返回
     * @return array ARP表，键为IP地址，值为MAC地址
     */
    public static function arpLookup(): array
    {
        $arpTable = [];

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows 系统
            exec('arp -a', $output);

            foreach ($output as $line) {
                if (preg_match('/(\d+\.\d+\.\d+\.\d+)\s+(\w\w-\w\w-\w\w-\w\w-\w\w-\w\w)/', $line, $matches)) {
                    $arpTable[$matches[1]] = $matches[2];
                }
            }
        } else {
            // Linux 系统
            exec('/usr/sbin/arp -an', $output);

            foreach ($output as $line) {
                if (preg_match('/\((\d+\.\d+\.\d+\.\d+)\)\s+at\s+(\w\w:\w\w:\w\w:\w\w:\w\w:\w\w)/', $line, $matches)) {
                    $arpTable[$matches[1]] = $matches[2];
                }
            }
        }

        return $arpTable;
    }

    /**
     * 计算给定 IP 地址的最大传输单元（MTU）
     * @param string $ipAddress 要测试 MTU 的 IP 地址
     * @param int $minMTU 起始测试的最小 MTU 值。默认为 500
     * @param int $maxMTU 要测试的最大 MTU 值。默认为 1500
     * @return int 在指定范围内找到的最佳 MTU 大小
     */
    public static function mtuTest(string $ipAddress, int $minMTU = 500, int $maxMTU = 1500): int
    {
        $bestMTU = 0;

        for ($size = $minMTU; $size <= $maxMTU; $size += 10) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $command = "ping -f -l " . $size . " " . escapeshellarg($ipAddress) . " -n 1";
            } else {
                $command = "ping -c 1 -M do -s " . $size . " " . escapeshellarg($ipAddress);
            }

            exec($command, $output, $status);

            if ($status === 0) {
                $bestMTU = $size;
            } else {
                break;
            }
        }

        return $bestMTU;
    }

    /**
     * 获取给定域名的 SSL 证书信息
     * @param string $domainName 要获取 SSL 证书的域名
     * @param int $port SSL 连接的端口号。默认为 443
     * @param int $timeout SSL 连接的超时时间。默认为 30 秒
     * @return array 包含 SSL 证书信息的数组。
     * @throws Exception 如果连接到 SSL 套接字时发生错误
     */
    public static function sslCertificateInfo(string $domainName, int $port = 443, int $timeout = 30): array
    {
        $context = stream_context_create([
            "ssl" => [
                "capture_peer_cert" => true,
                "verify_peer" => false,
                "verify_peer_name" => false,
            ]
        ]);

        $socket = stream_socket_client(
            "ssl://$domainName:$port",
            $errno,
            $errStr,
            $timeout,
            STREAM_CLIENT_CONNECT,
            $context
        );

        if (!$socket) {
            return [
                'error' => true,
                'message' => "$errStr ($errno)"
            ];
        }

        $params = stream_context_get_params($socket);
        return openssl_x509_parse($params["options"]["ssl"]["peer_certificate"]);
    }

    public static function httpHeaders($url, $timeout = 10): array
    {
        $contextOptions = [
            'http' => [
                'timeout' => $timeout
            ]
        ];
        $context = stream_context_create($contextOptions);
        $headerLines = @get_headers($url, 0, $context);

        if (!$headerLines) {
            return [];
        }

        $headers = [];
        foreach ($headerLines as $line) {
            if (str_contains($line, ':')) {
                list($key, $value) = explode(':', $line, 2);
                $headers[trim($key)] = trim($value);
            } else {
                if (preg_match('/^HTTP\/[\d\.]+ (\d+) (.+)$/', $line, $matches)) {
                    $headers['Status-Code'] = intval($matches[1]);
                    $headers['Reason-Phrase'] = trim($matches[2]);
                } else {
                    // 如果没有匹配，只是简单地保存原始行
                    $headers[] = trim($line);
                }
            }
        }

        return $headers;
    }

    /**
     * 使用 NTP 服务器进行时间同步
     * @param string $prefix 服务器前缀或自定义服务器地址，用于选择特定地区的 NTP 服务器
     *        可用的前缀包括：
     *        'global' - 全球（pool.ntp.org）
     *        'cn' - 中国（cn.pool.ntp.org）
     *        'jp' - 日本（jp.pool.ntp.org）
     *        'kr' - 韩国（kr.pool.ntp.org）
     *        'us' - 美国（us.pool.ntp.org）
     *        'uk' - 英国（uk.pool.ntp.org）
     *        'de' - 德国（de.pool.ntp.org）
     *        'br' - 巴西（br.pool.ntp.org）
     *        'za' - 南非（za.pool.ntp.org）
     *        'au' - 澳大利亚（au.pool.ntp.org）
     *        'nz' - 新西兰（nz.pool.ntp.org）
     * @param int $port NTP 服务器的端口号。默认值是 123
     * @param int $timeout 等待服务器响应的超时时间（以秒为单位）。默认值是 10
     * @return int|bool 返回从 NTP 服务器获取的 Unix 时间戳
     */
    public static function ntpTimeSync(string $prefix = 'cn', int $port = 123, int $timeout = 5): int|bool
    {
        $servers = [
            'global' => 'pool.ntp.org',
            'cn' => 'cn.pool.ntp.org',
            'jp' => 'jp.pool.ntp.org',
            'kr' => 'kr.pool.ntp.org',
            'us' => 'us.pool.ntp.org',
            'uk' => 'uk.pool.ntp.org',
            'de' => 'de.pool.ntp.org',
            'br' => 'br.pool.ntp.org',
            'za' => 'za.pool.ntp.org',
            'au' => 'au.pool.ntp.org',
            'nz' => 'nz.pool.ntp.org'
        ];

        if (array_key_exists(strtolower($prefix), $servers)) {
            $server = $servers[strtolower($prefix)];
        } elseif (filter_var($prefix, FILTER_VALIDATE_IP) || preg_match("/^[a-zA-Z0-9-.]+$/", $prefix)) {
            $server = $prefix;
        } else {
            $server = 'pool.ntp.org';
        }

        $request = "\010" . str_repeat("\0", 47);
        $socket = fsockopen('udp://' . $server, $port, $err_no, $err_str, $timeout);

        if (!$socket) {
            return false;
        }

        fwrite($socket, $request);
        stream_set_timeout($socket, $timeout);

        $response = fread($socket, 48);
        fclose($socket);

        if (strlen($response) !== 48) {
            return false;
        }

        $unpack = unpack('N12', $response);
        $timestamp = sprintf('%u', $unpack[9]);
        $timestamp -= 2208988800;

        return $timestamp;
    }

    /**
     * 对电子邮件服务器进行黑名单检查（默认：spamhaus.org）
     * @param string $server 要检查的电子邮件服务器
     * @param array $dnsblServers 自定义DNSBL服务器组
     * @return array 黑名单检查的结果
     */
    public static function emailServerBlacklistCheck(string $server, array $dnsblServers = []): array
    {
        // 获取邮件服务器的 IP 地址
        $serverIP = gethostbyname($server);

        // 定义一组DNSBL服务器
        if (empty($dnsblServers)) {
            $dnsblServers = array(
                "pbl.spamhaus.org",
                "sbl.spamhaus.org",
                "xbl.spamhaus.org",
                "zen.spamhaus.org",
            );
        }

        $isListed = false;
        $blacklists = [];
        $reasons = [];

        foreach ($dnsblServers as $host) {
            $checkHost = implode('.', array_reverse(explode('.', $serverIP))) . '.' . $host;

            // 查询 A 记录
            $result = gethostbyname($checkHost);

            if ($result !== $checkHost) {
                // IP 地址在黑名单上
                $isListed = true;
                $blacklists[] = $host;

                // 查询 TXT 记录以获取原因
                $txtResult = dns_get_record($checkHost, DNS_TXT);
                if (!empty($txtResult[0]['txt'])) {
                    $reasons[$host] = $txtResult[0]['txt'];
                }
            }
        }

        // 整合结果
        return [
            'isListed' => $isListed,
            'blacklists' => $blacklists,
            'reasons' => $reasons
        ];
    }

    /**
     * 检查给定 URL 的 CORS 配置
     *
     * @param string $url 要检查的 URL
     * @return array 返回一个包含 CORS 配置信息的数组
     */
    public static function corsConfigChecker(string $url): array
    {
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ]);

        $all_headers = @get_headers($url, 1, $context);

        if ($all_headers === false) {
            return [];
        }

        $cors_headers = [];

        foreach ($all_headers as $name => $value) {
            if (stripos($name, 'Access-Control') === 0) {
                $cors_headers[$name] = is_array($value) ? implode(', ', $value) : $value;
            }
        }

        return $cors_headers;
    }
}
