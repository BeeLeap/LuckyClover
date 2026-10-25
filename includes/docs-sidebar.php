<?php
/**
 * 文档侧边栏
 *
 * 变量:
 *   $active_doc - 当前激活的文档页 url（可选）
 */

$config = require __DIR__ . '/config.php';
$docsNav = $config['docs_nav'];
$active = isset($active_doc) ? $active_doc : '';
?>
<aside class="docs-sidebar">
  <div class="docs-sidebar-brand">LuckyClover-<span>Moderation</span></div>
  <?php foreach ($docsNav as $group) : ?>
    <div class="docs-nav-group">
      <h3><?php echo htmlspecialchars($group['group'], ENT_QUOTES, 'UTF-8'); ?></h3>
      <?php foreach ($group['items'] as $item) :
          $isActive = ($active === $item['url']) ? ' active' : '';
      ?>
      <a class="<?php echo trim($isActive); ?>" href="<?php echo $item['url']; ?>"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
  <a class="docs-sidebar-github" href="https://github.com/BeeLeap/LuckyClover-Moderation" target="_blank" rel="noopener noreferrer">在 GitHub 查看源码</a>
</aside>
