<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require_admin();

$message = '';
$now = date('Y-m-d H:i:s');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = $_POST['action'] ?? '';
    if ($action === 'news_save') {
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim((string) ($_POST['title'] ?? ''));
        $content = trim((string) ($_POST['content'] ?? ''));
        $status = ($_POST['status'] ?? '') === 'draft' ? 'draft' : 'published';
        if ($title !== '' && $content !== '') {
            if ($id) { $stmt = $db->prepare('UPDATE news SET title=?, content=?, status=?, updated_at=? WHERE id=?'); $stmt->execute([$title, $content, $status, $now, $id]); }
            else { $stmt = $db->prepare('INSERT INTO news (title, content, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?)'); $stmt->execute([$title, $content, $status, $now, $now]); }
            $message = '新闻已保存。';
        }
    } elseif ($action === 'activity_save') {
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim((string) ($_POST['activity_title'] ?? ''));
        $summary = trim((string) ($_POST['summary'] ?? ''));
        $tags = trim((string) ($_POST['tags'] ?? ''));
        $content = trim((string) ($_POST['activity_content'] ?? ''));
        $start = trim((string) ($_POST['start_at'] ?? ''));
        $status = ($_POST['activity_status'] ?? '') === 'draft' ? 'draft' : 'published';
        if ($title !== '' && $content !== '') {
            if ($id) { $stmt = $db->prepare('UPDATE activities SET title=?, summary=?, tags=?, content=?, start_at=?, status=?, updated_at=? WHERE id=?'); $stmt->execute([$title, $summary, $tags, $content, $start, $status, $now, $id]); }
            else { $stmt = $db->prepare('INSERT INTO activities (title, summary, tags, content, start_at, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'); $stmt->execute([$title, $summary, $tags, $content, $start, $status, $now, $now]); }
            $message = '活动已保存。';
        }
    } elseif ($action === 'server_save') {
        $id = (int) ($_POST['server_id'] ?? 0);
        $name = trim((string) ($_POST['server_name'] ?? '')); $type = trim((string) ($_POST['server_type'] ?? ''));
        $host = trim((string) ($_POST['server_host'] ?? '')); $port = (int) ($_POST['server_port'] ?? 0); $enabled = empty($_POST['enabled']) ? 0 : 1;
        if ($id && $name && $type && $host && $port >= 1 && $port <= 65535) { $stmt = $db->prepare('UPDATE servers SET name=?, type=?, host=?, port=?, enabled=?, updated_at=? WHERE id=?'); $stmt->execute([$name, $type, $host, $port, $enabled, $now, $id]); $message = '服务器配置已保存。'; }
    } elseif ($action === 'server_add') {
        $name = trim((string) ($_POST['server_name'] ?? '')); $type = trim((string) ($_POST['server_type'] ?? ''));
        $host = trim((string) ($_POST['server_host'] ?? '')); $port = (int) ($_POST['server_port'] ?? 0); $enabled = empty($_POST['enabled']) ? 0 : 1;
        $slug = strtolower(trim((string) ($_POST['server_slug'] ?? '')));
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        if ($slug === '') { $slug = 'server-' . time(); }
        if ($name && $type && $host && $port >= 1 && $port <= 65535) {
            $stmt = $db->prepare('SELECT COUNT(*) FROM servers WHERE slug=?');
            $stmt->execute([$slug]);
            if ((int) $stmt->fetchColumn() === 0) {
                $stmt = $db->prepare('INSERT INTO servers (slug, name, type, host, port, enabled, sort_order, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$slug, $name, $type, $host, $port, $enabled, 0, $now]);
                $message = '服务器已添加。';
            } else { $message = '服务器标识已存在，请换一个。'; }
        } else { $message = '请完整填写服务器名称、类型、地址和有效端口。'; }
    } elseif ($action === 'delete_news') { $stmt = $db->prepare('DELETE FROM news WHERE id=?'); $stmt->execute([(int) $_POST['id']]); $message = '新闻已删除。';
    } elseif ($action === 'delete_activity') { $stmt = $db->prepare('DELETE FROM activities WHERE id=?'); $stmt->execute([(int) $_POST['id']]); $message = '活动已删除。'; }
}
$editNews = null; if (!empty($_GET['edit_news'])) { $stmt = $db->prepare('SELECT * FROM news WHERE id=?'); $stmt->execute([(int) $_GET['edit_news']]); $editNews = $stmt->fetch(); }
$editActivity = null; if (!empty($_GET['edit_activity'])) { $stmt = $db->prepare('SELECT * FROM activities WHERE id=?'); $stmt->execute([(int) $_GET['edit_activity']]); $editActivity = $stmt->fetch(); }
$news = $db->query('SELECT * FROM news ORDER BY created_at DESC')->fetchAll();
$activities = $db->query('SELECT * FROM activities ORDER BY created_at DESC')->fetchAll();
$servers = $db->query('SELECT * FROM servers ORDER BY sort_order, id')->fetchAll();
$metrics = host_metrics();
function metric_size(int $bytes): string { return $bytes > 1073741824 ? round($bytes / 1073741824, 1) . ' GB' : round($bytes / 1048576, 0) . ' MB'; }
?><!doctype html><html lang="zh-CN"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>管理后台 - LuckyClover</title><link rel="stylesheet" href="../assets/css/modern-fixed.css"><style>
.admin{max-width:1240px;margin:auto;padding:48px 20px}.top{display:flex;justify-content:space-between;align-items:center}.metrics,.grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}.grid{grid-template-columns:repeat(2,1fr);margin-top:24px}.panel{background:var(--bg-card);border:1px solid var(--border-color);border-radius:var(--radius-lg);padding:22px}.metric strong{display:block;font-size:1.7rem;color:var(--accent-secondary)}input,textarea,select{box-sizing:border-box;width:100%;padding:10px;border:1px solid var(--border-color);border-radius:8px;background:var(--bg-secondary);color:inherit}textarea{min-height:130px}.row{padding:12px 0;border-bottom:1px solid var(--border-color)}.actions{display:flex;gap:8px;margin-top:8px;align-items:center}.actions form{margin:0}@media(max-width:850px){.metrics,.grid{grid-template-columns:1fr}.top{align-items:flex-start;gap:12px;flex-direction:column}}
</style></head><body><main class="admin"><div class="top"><div><h1>LuckyClover 管理后台</h1><p>欢迎，<?php echo e($_SESSION['admin_user']); ?></p></div><a href="logout">退出登录</a></div><?php if ($message): ?><p style="color:#00d26a"><?php echo e($message); ?></p><?php endif; ?><section class="metrics"><div class="panel metric"><small>主机负载</small><strong><?php echo e((string) $metrics['load']); ?></strong></div><div class="panel metric"><small>内存</small><strong><?php echo metric_size($metrics['memory_used']); ?></strong><span><?php echo metric_size($metrics['memory_total']); ?> 总量</span></div><div class="panel metric"><small>磁盘</small><strong><?php echo metric_size($metrics['disk_used']); ?></strong><span><?php echo metric_size($metrics['disk_total']); ?> 总量</span></div><div class="panel metric"><small>运行环境</small><strong><?php echo e($metrics['os']); ?></strong><span>PHP <?php echo e($metrics['php']); ?></span></div></section><div class="grid">
<section class="panel"><h2><?php echo $editNews ? '编辑新闻' : '发布新闻'; ?></h2><form method="post"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="news_save"><input type="hidden" name="id" value="<?php echo (int) ($editNews['id'] ?? 0); ?>"><p><label>标题<input name="title" required value="<?php echo e($editNews['title'] ?? ''); ?>"></label></p><p><label>内容<textarea name="content" required><?php echo e($editNews['content'] ?? ''); ?></textarea></label></p><p><label>状态<select name="status"><option value="published">已发布</option><option value="draft"<?php echo (($editNews['status'] ?? '') === 'draft') ? ' selected' : ''; ?>>草稿</option></select></label></p><button>保存新闻</button></form><h2>新闻列表</h2><?php foreach ($news as $item): ?><div class="row"><strong><?php echo e($item['title']); ?></strong><br><small><?php echo e($item['created_at']); ?> · <?php echo $item['status'] === 'published' ? '已发布' : '草稿'; ?></small><div class="actions"><a href="?edit_news=<?php echo (int) $item['id']; ?>">编辑</a><form method="post"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="delete_news"><input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>"><button>删除</button></form></div></div><?php endforeach; ?></section>
<section class="panel"><h2><?php echo $editActivity ? '编辑活动' : '发布活动'; ?></h2><form method="post"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="activity_save"><input type="hidden" name="id" value="<?php echo (int) ($editActivity['id'] ?? 0); ?>"><p><label>标题<input name="activity_title" required value="<?php echo e($editActivity['title'] ?? ''); ?>"></label></p><p><label>摘要<input name="summary" value="<?php echo e($editActivity['summary'] ?? ''); ?>"></label></p><p><label>标签（逗号分隔）<input name="tags" value="<?php echo e($editActivity['tags'] ?? ''); ?>"></label></p><p><label>活动时间<input name="start_at" value="<?php echo e($editActivity['start_at'] ?? ''); ?>"></label></p><p><label>正文<textarea name="activity_content" required><?php echo e($editActivity['content'] ?? ''); ?></textarea></label></p><p><label>状态<select name="activity_status"><option value="published">已发布</option><option value="draft"<?php echo (($editActivity['status'] ?? '') === 'draft') ? ' selected' : ''; ?>>草稿</option></select></label></p><button>保存活动</button></form><h2>活动列表</h2><?php foreach ($activities as $item): ?><div class="row"><strong><?php echo e($item['title']); ?></strong><br><small><?php echo e($item['created_at']); ?> · <?php echo $item['status'] === 'published' ? '已发布' : '草稿'; ?></small><div class="actions"><a href="?edit_activity=<?php echo (int) $item['id']; ?>">编辑</a><form method="post"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="delete_activity"><input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>"><button>删除</button></form></div></div><?php endforeach; ?></section></div>
 <section class="panel" style="margin-top:24px"><h2>服务器 MOTD / 状态配置</h2><p>状态页会使用这里的地址和端口查询 MineBBS MOTD。关闭后不会显示该服务器。</p><form method="post" class="row"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="server_add"><div class="grid" style="margin:0"><label>标识（可选）<input name="server_slug" placeholder="survival-2"></label><label>名称<input name="server_name" required></label><label>类型<input name="server_type" required placeholder="生存服"></label><label>地址<input name="server_host" required></label><label>端口<input type="number" name="server_port" min="1" max="65535" required></label></div><p><label><input type="checkbox" name="enabled" value="1" checked> 启用</label></p><button>添加服务器</button></form><?php foreach ($servers as $server): ?><form method="post" class="row"><input type="hidden" name="csrf" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="action" value="server_save"><input type="hidden" name="server_id" value="<?php echo (int) $server['id']; ?>"><div class="grid" style="margin:0"><label>名称<input name="server_name" value="<?php echo e($server['name']); ?>"></label><label>类型<input name="server_type" value="<?php echo e($server['type']); ?>"></label><label>地址<input name="server_host" value="<?php echo e($server['host']); ?>"></label><label>端口<input type="number" name="server_port" min="1" max="65535" value="<?php echo (int) $server['port']; ?>"></label></div><p><label><input type="checkbox" name="enabled" value="1"<?php echo $server['enabled'] ? ' checked' : ''; ?>> 启用</label></p><button>保存服务器配置</button></form><?php endforeach; ?></section></main></body></html>
