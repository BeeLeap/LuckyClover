<?php
// 项目与项目文档已合并到 docs 页面，保留旧地址以兼容历史链接。
$config = require __DIR__ . '/includes/config.php';
$docsUrl = rtrim((string) ($config['site']['docs_url'] ?? ''), '/');
$docsPath = rtrim((string) ($config['site']['docs_path'] ?? ''), '/');
header('Location: ' . ($docsUrl !== '' ? $docsUrl . $docsPath . '/' : 'docs-overview'), true, 301);
exit;
