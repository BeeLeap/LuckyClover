<?php
$page_title = '插件概览 - LuckyClover-Moderation';
$page_desc = '了解 LuckyClover-Moderation 的过滤能力、处理入口和运行方式。';
$active_nav = 'docs'; $active_doc = 'docs-overview'; $docs_page = true;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-layout">
  <?php require __DIR__ . '/includes/docs-sidebar.php'; ?>
  <article class="docs-content"><span class="pixel-tag">开始使用 / 概览</span><h1>插件概览</h1><p class="docs-lead">LuckyClover-Moderation 在文本提交前检查并修改违禁内容，面向 LeviLamina 服务端提供原生实现。</p>
    <h2>它解决什么问题？</h2><p>插件把过滤逻辑放在聊天、书籍、铁砧和告示牌文本真正提交之前，避免只在日志或显示层处理而让客户端仍然看到原文。</p>
    <div class="docs-grid"><div class="docs-card"><h3>原生插件</h3><p>使用 C++ 构建，直接运行在 LeviLamina 环境中，不依赖 LLSE。</p></div><div class="docs-card"><h3>多入口过滤</h3><p>覆盖聊天、书籍、铁砧、普通告示牌和悬挂告示牌。</p></div><div class="docs-card"><h3>可配置词库</h3><p>支持分类词库、自定义词、白名单和替换文本。</p></div><div class="docs-card"><h3>脚本桥接</h3><p>可选安装 API 插件，让 LLSE 脚本复用同一套过滤逻辑。</p></div></div>
    <div class="docs-callout"><strong>运行依赖：</strong>服务端需要安装与当前 LeviLamina ABI 匹配的 <code>iListenAttentively</code>。不需要单独下载 iListen SDK 或 LseExport。</div>
  </article>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
