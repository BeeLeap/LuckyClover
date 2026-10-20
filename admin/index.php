<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require_admin();

$message = '';
$now = date('Y-m-d H:i:s');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = $_POST['action'] ?? '';
    $name = trim((string) ($_POST['server_name'] ?? ''));
    $type = trim((string) ($_POST['server_type'] ?? ''));
    $host = trim((string) ($_POST['server_host'] ?? ''));
    $port = (int) ($_POST['server_port'] ?? 0);
    $enabled = empty($_POST['enabled']) ? 0 : 1;
    if ($action === 'server_save') {
        $id = (int) ($_POST['server_id'] ?? 0);
        if ($id && $name && $type && $host && $port >= 1 && $port <= 65535) {
            $stmt = $db->prepare('UPDATE servers SET name=?, type=?, host=?, port=?, enabled=?, updated_at=? WHERE id=?');
            $stmt->execute([$name, $type, $host, $port, $enabled, $now, $id]);
            $message = '服务器 MOTD 配置已保存。';
        } else { $message = '请填写完整的服务器名称、类型、地址和有效端口。'; }
    } elseif ($action === 'server_add') {
        $slug = strtolower(trim((string) ($_POST['server_slug'] ?? '')));
        $slug = trim((string) preg_replace('/[^a-z0-9-]+/', '-', $slug), '-');
        if ($slug === '') { $slug = 'server-' . time(); }
        if ($name && $type && $host && $port >= 1 && $port <= 65535) {
            $stmt = $db->prepare('SELECT COUNT(*) FROM servers WHERE slug=?');
            $stmt->execute([$slug]);
            if ((int) $stmt->fetchColumn() === 0) {
                $stmt = $db->prepare('INSERT INTO servers (slug, name, type, host, port, enabled, sort_order, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$slug, $name, $type, $host, $port, $enabled, 0, $now]);
                $message = '服务器已添加。';
            } else { $message = '服务器标识已存在，请换一个。'; }
        } else { $message = '请填写完整的服务器名称、类型、地址和有效端口。'; }
    }
}
$servers = $db->query('SELECT * FROM servers ORDER BY sort_order, id')->fetchAll();
?><!doctype html><html lang="zh-CN"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>服务器配置 - BeeLeap</title><link rel="stylesheet" href="../assets/css/modern-fixed.css"><style>
.admin{max-width:1060px;margin:auto;padding:58px 20px}.top{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:30px}.top h1{font-family:"Minecraft";font-size:2.4rem}.panel{background:var(--bg-card);border:3px solid #111;box-shadow:var(--shadow-block);padding:24px;margin-bottom:24px}.panel h2{margin-bottom:10px}.muted{color:var(--text-secondary);line-height:1.7}.server-form{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}.server-form label{display:grid;gap:6px;color:var(--text-secondary);font-weight:900}.server-form input{box-sizing:border-box;width:100%;padding:11px;border:2px solid rgba(255,255,255,.16);background:var(--bg-secondary);color:inherit}.server-form .wide{grid-column:1/-1}.server-row{padding:20px 0;border-top:2px solid rgba(255,255,255,.1)}.server-row:first-child{border-top:0}.server-row form{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}.check{display:flex!important;align-items:center;display:flex!important;gap:8px}.check input{width:auto}.message{padding:12px 14px;background:rgba(90,189,60,.18);border-left:4px solid var(--accent-primary);margin-bottom:20px}@media(max-width:700px){.top,.server-form,.server-row form{display:block}.server-form label,.server-row label{margin-bottom:14px}}
</style></head><body><main class="admin"><div class="top"><div><span class="pixel-tag">BeeLeap / Admin</span><h1>服务器 MOTD 配置</h1><p class="muted">欢迎，<?php echo e($_SESSION['admin_user']); ?>。这里只管理蜜蜂园状态页使用的服务器地址、端口和显示名称。</p></div><a class="pixel-button secondary" href="logout">退出登录</a></div><?php if ($message): ?><div class="message"><?php echo e($message); ?></div><?php endif; ?>
<section class="panel"><h2>添加服务器</h2><p class="muted">MOTD 查询通过服务器地址和端口完成。标识只允许小写字母、数字和短横线。</p><form method="post" class="server-form"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="server_add"><label>标识<input name="server_slug" placeholder="survival-2"></label><label>名称<input name="server_name" required placeholder="蜜蜂园生存服"></label><label>类型<input name="server_type" required placeholder="Minecraft Bedrock"></label><label>地址<input name="server_host" required placeholder="play.example.com"></label><label>端口<input type="number" name="server_port" min="1" max="65535" required placeholder="19132"></label><label class="check"><input type="checkbox" name="enabled" value="1" checked> 在服务器页面显示</label><div class="wide"><button class="pixel-button" type="submit">添加服务器</button></div></form></section>
<section class="panel"><h2>现有服务器</h2><?php foreach ($servers as $server): ?><div class="server-row"><form method="post"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="server_save"><input type="hidden" name="server_id" value="<?php echo (int) $server['id']; ?>"><label>名称<input name="server_name" value="<?php echo e($server['name']); ?>"></label><label>类型<input name="server_type" value="<?php echo e($server['type']); ?>"></label><label>地址<input name="server_host" value="<?php echo e($server['host']); ?>"></label><label>端口<input type="number" name="server_port" min="1" max="65535" value="<?php echo (int) $server['port']; ?>"></label><label class="check"><input type="checkbox" name="enabled" value="1"<?php echo $server['enabled'] ? ' checked' : ''; ?>> 在服务器页面显示</label><div><button class="pixel-button" type="submit">保存配置</button></div></form></div><?php endforeach; ?><?php if (!$servers): ?><p class="muted">暂无服务器配置。</p><?php endif; ?></section></main></body></html>
