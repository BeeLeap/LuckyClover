<?php
/** Shared MySQL storage, authentication and host metrics. */
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

$appConfig = require __DIR__ . '/config.php';
$database = $appConfig['database'];
$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $database['host'], $database['port'], $database['name']);
$db = new PDO($dsn, $database['user'], $database['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->exec('CREATE TABLE IF NOT EXISTS news (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    status ENUM("draft", "published") NOT NULL DEFAULT "published",
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    INDEX idx_news_status_created (status, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
$count = (int) $db->query('SELECT COUNT(*) FROM news')->fetchColumn();
if ($count === 0) {
    $seed = $db->prepare('INSERT INTO news (title, content, status, created_at, updated_at) VALUES (?, ?, "published", ?, ?)');
    $now = date('Y-m-d H:i:s');
    $seed->execute(['官网动态管理已启用', '现在可以在后台发布公告、活动和版本更新，前台会自动显示已发布内容。', $now, $now]);
}

function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(24)); return $_SESSION['csrf']; }
function verify_csrf(): void { if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) { http_response_code(419); exit('请求已过期，请返回重试。'); } }
function admin_logged_in(): bool { return !empty($_SESSION['admin_user']); }
function require_admin(): void { if (!admin_logged_in()) { header('Location: login'); exit; } }
function host_metrics(): array {
    $load = function_exists('sys_getloadavg') ? sys_getloadavg() : [0, 0, 0];
    $memoryTotal = 0; $memoryAvailable = 0;
    if (@is_readable('/proc/meminfo')) {
        $info = @file_get_contents('/proc/meminfo');
        preg_match('/MemTotal:\s+(\d+)/', $info, $total);
        preg_match('/MemAvailable:\s+(\d+)/', $info, $available);
        $memoryTotal = (int) ($total[1] ?? 0) * 1024;
        $memoryAvailable = (int) ($available[1] ?? 0) * 1024;
    }
    if ($memoryTotal === 0 && PHP_OS_FAMILY === 'Windows' && function_exists('shell_exec')) {
        $memory = (string) @shell_exec('powershell -NoProfile -Command "Get-CimInstance Win32_OperatingSystem | Select-Object TotalVisibleMemorySize,FreePhysicalMemory | ConvertTo-Csv -NoTypeInformation" 2>NUL');
        $lines = array_values(array_filter(array_map('trim', preg_split('/\r?\n/', $memory))));
        if (isset($lines[1])) {
            $values = str_getcsv($lines[1]);
            $memoryTotal = (int) ($values[0] ?? 0) * 1024;
            $memoryAvailable = (int) ($values[1] ?? 0) * 1024;
        }
        $cpu = (string) @shell_exec('powershell -NoProfile -Command "(Get-CimInstance Win32_Processor | Measure-Object -Property LoadPercentage -Average).Average" 2>NUL');
        if (is_numeric(trim($cpu))) $load[0] = round((float) trim($cpu), 2);
    }
    $diskTotal = @disk_total_space(__DIR__); $diskFree = @disk_free_space(__DIR__);
    return [
        'hostname' => gethostname() ?: 'unknown',
        'os' => PHP_OS_FAMILY,
        'php' => PHP_VERSION,
        'load' => round((float) ($load[0] ?? 0), 2),
        'memory_total' => $memoryTotal,
        'memory_used' => max(0, $memoryTotal - $memoryAvailable),
        'disk_total' => $diskTotal ?: 0,
        'disk_used' => ($diskTotal && $diskFree !== false) ? $diskTotal - $diskFree : 0,
        'time' => date('c'),
    ];
}
