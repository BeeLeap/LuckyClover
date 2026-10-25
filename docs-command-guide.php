<?php
$page_title = '配置文件 - LuckyClover-Moderation';
$page_desc = 'LuckyClover-Moderation config.json 字段说明与示例。';
$active_nav = 'docs'; $active_doc = 'docs-command-guide'; $docs_page = true;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-layout">
  <?php require __DIR__ . '/includes/docs-sidebar.php'; ?>
  <article class="docs-content"><span class="pixel-tag">核心能力 / 配置文件</span><h1>配置文件</h1><p class="docs-lead">首次运行时复制 <code>config.example.json</code> 为运行时配置文件。配置默认使用插件自带的 <code>data/banned-words</code> 分类词库。</p>
    <div class="docs-code">{
  "enabled": true,
  "replacement": "***",
  "categories": {
    "adult": true,
    "political": true,
    "advertising": true,
    "weapons": true,
    "urls": true
  },
  "wordListPath": "data/banned-words",
  "customWords": [],
  "whitelist": [],
  "logMatches": true,
  "migrated": false
}</div>
    <table class="docs-table"><thead><tr><th>字段</th><th>作用</th></tr></thead><tbody><tr><td><code>enabled</code></td><td>总开关，关闭后不执行过滤。</td></tr><tr><td><code>replacement</code></td><td>命中违禁内容时替换成的文本。</td></tr><tr><td><code>categories</code></td><td>分别启用成人、政治、广告、武器和网址分类。</td></tr><tr><td><code>wordListPath</code></td><td>分类词库目录，可使用相对插件目录的路径。</td></tr><tr><td><code>customWords</code></td><td>额外加入的自定义词。</td></tr><tr><td><code>whitelist</code></td><td>白名单优先级高于内置词和自定义词。</td></tr><tr><td><code>logMatches</code></td><td>是否记录命中的过滤日志。</td></tr></tbody></table>
  </article>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
