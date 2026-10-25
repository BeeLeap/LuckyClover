<?php
$page_title = '词库与白名单 - LuckyClover-Moderation';
$page_desc = 'LuckyClover-Moderation 分类词库、自定义词和白名单的使用说明。';
$active_nav = 'docs'; $active_doc = 'docs-guide'; $docs_page = true;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-layout">
  <?php require __DIR__ . '/includes/docs-sidebar.php'; ?>
  <article class="docs-content"><span class="pixel-tag">核心能力 / 词库与白名单</span><h1>词库与白名单</h1><p class="docs-lead">词库按类别放在插件的 <code>data/banned-words</code> 目录，自定义词和白名单则直接写入配置文件。</p>
    <h2>词库结构</h2><p>默认词库随插件发布，配置中的 <code>categories</code> 决定哪些分类启用。修改词库后可通过 API 触发重新加载，不需要更换插件二进制。</p>
    <h2>自定义词</h2><div class="docs-code">{
  "customWords": [
    "example-word",
    "another-word"
  ],
  "whitelist": [
    "trusted-name"
  ]
}</div>
    <h2>匹配顺序</h2><ol><li>对输入进行大小写和全半角 ASCII 归一化。</li><li>先检查白名单，命中则跳过过滤。</li><li>再匹配启用的内置分类词和自定义词。</li><li>命中后使用 <code>replacement</code> 替换，并按配置决定是否记录日志。</li></ol>
    <div class="docs-callout">建议把服务器专属词放进 <code>customWords</code>，把需要保留的品牌名、项目名或玩家名放进 <code>whitelist</code>，不要直接改动随插件发布的默认词库。</div>
  </article>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
