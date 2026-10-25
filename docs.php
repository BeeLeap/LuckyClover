<?php
$page_title = 'LuckyClover-Moderation 文档';
$page_desc = 'LuckyClover-Moderation 的安装、配置、过滤范围与 LLSE API 文档。';
$active_nav = 'docs';
$docs_page = true;
$extra_css = <<<'CSS'
.docs-home-hero{max-width:820px;margin-bottom:46px}.docs-home-hero h1{margin:18px 0;font-size:clamp(3rem,8vw,6.6rem);line-height:.92}.docs-home-hero h1 span{color:var(--accent-secondary)}.docs-home-hero p{max-width:760px;color:var(--text-secondary);font-size:1.1rem;line-height:1.9}.docs-directory-panel{padding:28px;background:rgba(16,32,24,.84);border:2px solid rgba(90,189,60,.38);box-shadow:8px 8px 0 rgba(0,0,0,.24)}.docs-directory-heading{display:flex;justify-content:space-between;gap:20px;align-items:end;margin-bottom:22px}.docs-directory-heading h2{margin:0;font-size:1.35rem}.docs-directory-heading p{margin:0;color:var(--text-muted);font-size:.9rem}.docs-directory .docs-directory-group{min-height:190px}
CSS;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-page"><div class="container">
  <div class="docs-home-hero"><span class="pixel-tag">BEELEAP / MODERATION DOCS</span><h1>Keep text<br><span>safe.</span></h1><p>LuckyClover-Moderation 是面向 LeviLamina 的原生文本过滤插件。这里按功能分栏整理安装、配置、词库和脚本接口，内容跟随仓库版本更新。</p><div class="docs-meta"><span class="docs-badge">v0.2.11</span><span class="docs-badge">LeviLamina 26.51.x</span><span class="docs-badge">Native C++</span></div></div>
  <section class="docs-directory-panel"><div class="docs-directory-heading"><h2>文档目录</h2><p>从任意栏目开始阅读</p></div><div class="docs-grid">
    <section class="docs-directory docs-directory-group"><h2>开始使用</h2><a href="docs-overview"><strong>插件概览</strong><span>能力与工作方式 →</span></a><a href="docs-server-info"><strong>安装与依赖</strong><span>构建与运行环境 →</span></a></section>
    <section class="docs-directory docs-directory-group"><h2>核心能力</h2><a href="docs-command-guide"><strong>配置文件</strong><span>开关、类别与路径 →</span></a><a href="docs-rules"><strong>过滤范围</strong><span>聊天、书籍、告示牌与铁砧 →</span></a><a href="docs-guide"><strong>词库与白名单</strong><span>分类词库与文本归一化 →</span></a></section>
    <section class="docs-directory docs-directory-group"><h2>扩展与参考</h2><a href="docs-faq"><strong>LLSE API 与常见问题</strong><span>脚本桥接、迁移与排错 →</span></a><a href="https://github.com/BeeLeap/LuckyClover-Moderation" target="_blank" rel="noopener noreferrer"><strong>GitHub 源码</strong><span>构建、更新日志与 Issue ↗</span></a></section>
  </div></section>
</div></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
