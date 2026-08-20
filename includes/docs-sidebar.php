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
  <h3>目录</h3>
  <?php foreach ($docsNav as $item) :
      $isActive = ($active === $item['url']) ? ' active' : '';
  ?>
  <a class="<?php echo trim($isActive); ?>" href="<?php echo $item['url']; ?>"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
  <?php endforeach; ?>
</aside>
