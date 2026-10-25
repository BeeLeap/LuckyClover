<?php
$page_title = 'LLSE API 与常见问题 - LuckyClover-Moderation';
$page_desc = 'LuckyClover-Moderation API 桥接插件、迁移行为与常见问题。';
$active_nav = 'docs'; $active_doc = 'docs-faq'; $docs_page = true;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-layout">
  <?php require __DIR__ . '/includes/docs-sidebar.php'; ?>
  <article class="docs-content"><span class="pixel-tag">扩展与参考 / API</span><h1>LLSE API 与常见问题</h1><p class="docs-lead">安装独立的 <code>LuckyClover-Moderation-API</code> 后，LLSE 脚本可以复用原生插件的过滤逻辑。</p>
    <h2>API 方法</h2><table class="docs-table"><thead><tr><th>方法</th><th>用途</th></tr></thead><tbody><tr><td><code>LuckyCloverModeration.filterText(text)</code></td><td>返回过滤后的文本。</td></tr><tr><td><code>LuckyCloverModeration.containsBannedWord(text)</code></td><td>检查文本是否命中违禁词。</td></tr><tr><td><code>LuckyCloverModeration.reload()</code></td><td>重新读取配置和静态词库。</td></tr></tbody></table>
    <h2>常见问题</h2><h3>必须安装 LseExport 吗？</h3><p>不需要。原生插件不依赖 LseExport；脚本桥接插件也只读取本插件的配置和静态词库。</p><h3>为什么日志显示过滤了，客户端仍看到原文？</h3><p>请确认使用的是 0.2.10 或更新版本，并检查聊天、书籍、铁砧和物品请求包的入口是否来自匹配版本的 LeviLamina。</p><h3>旧配置能直接迁移吗？</h3><p>如果首次启动时没有新插件配置，但检测到旧核心配置，会自动迁移 <code>LuckyClover-Plugin/config.json</code> 中的 <code>bannedWords</code> 设置。</p>
    <div class="docs-callout">遇到问题时，请同时提供插件版本、LeviLamina 版本、iListenAttentively 版本和相关日志，便于在 GitHub Issue 中复现。</div>
  </article>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
