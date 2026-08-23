<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
if (admin_logged_in()) { header('Location: index'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    if (hash_equals($appConfig['admin']['username'], (string) ($_POST['username'] ?? '')) && hash_equals($appConfig['admin']['password'], (string) ($_POST['password'] ?? ''))) {
        session_regenerate_id(true); $_SESSION['admin_user'] = $appConfig['admin']['username']; header('Location: index'); exit;
    }
    $error = '用户名或密码错误。';
}
?><!doctype html><html lang="zh-CN"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>后台登录 - LuckyClover</title><link rel="stylesheet" href="../assets/css/modern-fixed.css"></head><body><main class="container" style="max-width:460px;padding:120px 20px"><div class="status-card"><h1>后台登录</h1><?php if ($error): ?><p style="color:#f44336"><?php echo e($error); ?></p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><p><label>用户名<br><input name="username" required autofocus></label></p><p><label>密码<br><input type="password" name="password" required></label></p><button type="submit">登录后台</button></form><p style="color:var(--text-muted);font-size:.85rem">请通过 LUCKYCLOVER_ADMIN_PASSWORD 设置生产环境密码。</p></div></main></body></html>
