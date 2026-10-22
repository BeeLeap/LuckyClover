<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
if (!admin_logged_in()) {
    http_response_code(401);
    echo json_encode(['error' => 'authentication_required'], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode(host_metrics(), JSON_UNESCAPED_UNICODE);
