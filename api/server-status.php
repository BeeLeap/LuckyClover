<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
// JSON 接口不能把 Warning/Notice 打进响应，否则前端 response.json() 会失败。
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');

$slug = trim((string) ($_GET['slug'] ?? ''));
$stmt = $db->prepare('SELECT host, port FROM servers WHERE slug=? AND enabled=1 LIMIT 1');
$stmt->execute([$slug]);
$server = $stmt->fetch();
if (!$server) {
    http_response_code(404);
    echo json_encode(['status' => 'offline'], JSON_UNESCAPED_UNICODE);
    exit;
}

$url = 'https://motd.minebbs.com/api/status?ip=' . rawurlencode($server['host']) . '&port=' . (int) $server['port'] . '&stype=auto';
$context = stream_context_create(['http' => ['timeout' => 8, 'ignore_errors' => true]]);
$response = @file_get_contents($url, false, $context);
if ($response === false) {
    http_response_code(502);
    echo json_encode(['status' => 'offline'], JSON_UNESCAPED_UNICODE);
    exit;
}

$data = json_decode($response, true);
if (!is_array($data)) {
    http_response_code(502);
    echo json_encode(['status' => 'offline'], JSON_UNESCAPED_UNICODE);
    exit;
}

// MineBBS 对部分 Java 服会把 motd/version 等字段返回成数组，强转会触发 Warning 并污染 JSON。
$to_text = static function ($value): string {
    if (is_array($value)) {
        if (isset($value['text'])) {
            return (string) $value['text'];
        }
        $parts = [];
        foreach ($value as $item) {
            if (is_array($item)) {
                $parts[] = (string) ($item['text'] ?? '');
            } elseif (is_scalar($item)) {
                $parts[] = (string) $item;
            }
        }
        return implode("\n", $parts);
    }
    return is_scalar($value) ? (string) $value : '';
};

$onlineMax = $data['players'] ?? [];
if (!is_array($onlineMax)) {
    $onlineMax = [];
}

echo json_encode([
    'status' => ($data['status'] ?? '') === 'online' ? 'online' : 'offline',
    'players' => [
        'online' => (int) ($onlineMax['online'] ?? 0),
        'max' => (int) ($onlineMax['max'] ?? 0),
    ],
    'version' => $to_text($data['version'] ?? ''),
    'gamemode' => $to_text($data['gamemode'] ?? ''),
    'motd' => $to_text($data['motd'] ?? ''),
], JSON_UNESCAPED_UNICODE);
