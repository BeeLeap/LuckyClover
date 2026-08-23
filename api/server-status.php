<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
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

echo json_encode([
    'status' => ($data['status'] ?? '') === 'online' ? 'online' : 'offline',
    'players' => [
        'online' => (int) ($data['players']['online'] ?? 0),
        'max' => (int) ($data['players']['max'] ?? 0),
    ],
    'version' => (string) ($data['version'] ?? ''),
    'gamemode' => (string) ($data['gamemode'] ?? ''),
    'motd' => (string) ($data['motd'] ?? ''),
], JSON_UNESCAPED_UNICODE);
