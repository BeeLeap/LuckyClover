<?php
// 文档首页已由项目导航菜单取代，保留旧地址以兼容历史链接。
$config = require __DIR__ . '/includes/config.php';
$docsUrl = rtrim((string) ($config['site']['docs_url'] ?? ''), '/');
header('Location: ' . ($docsUrl !== '' ? $docsUrl . '/' : 'docs-overview'), true, 301);
exit;
