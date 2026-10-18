<?php
$page_title = '插件文档';
$page_desc = 'BeeLeap 插件、资源包和 LuckyClover 服务器文档中心。';
$active_nav = 'docs';
$extra_css = <<<'CSS'
.docs-home{padding:92px 0 80px}.docs-intro{max-width:800px;margin-bottom:48px}.docs-intro h1{font-family:"Minecraft";font-size:clamp(3rem,7vw,6rem);line-height:.95;margin:18px 0}.docs-intro h1 span{color:var(--accent-secondary)}.docs-intro p{color:var(--text-secondary);font-size:1.1rem;line-height:1.9}.docs-groups{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}.docs-group{padding:25px;border:3px solid #111;background:var(--bg-card);box-shadow:var(--shadow-block)}.docs-group h2{margin-bottom:10px}.docs-group>p{color:var(--text-secondary);line-height:1.7}.docs-link{display:flex;justify-content:space-between;gap:12px;padding:14px 0;border-top:1px solid rgba(255,255,255,.12);margin-top:16px;color:var(--accent-secondary);font-weight:900}.docs-note{margin-top:24px;padding:20px;border-left:5px solid var(--accent-secondary);background:rgba(255,223,94,.08);color:var(--text-secondary)}@media(max-width:720px){.docs-groups{grid-template-columns:1fr}}
CSS;
require __DIR__ . '/includes/header.php';
?>
<main class="docs-home"><div class="container">
  <div class="docs-intro"><span class="pixel-tag">BeeLeap / Documentation</span><h1>让每个模块<br>都能被<span>读懂</span>。</h1><p>这里记录 BeeLeap 的插件、资源包、服务器配置和部署方式。文档会跟随源码一起更新，优先提供可以直接复制、验证和迁移的内容。</p></div>
  <div class="docs-groups">
    <section class="docs-group"><h2>插件与工具</h2><p>独立插件的安装、配置、API 和已知限制。</p><a class="docs-link" href="https://github.com/BeeLeap/LuckyClover-Moderation#readme" target="_blank" rel="noopener noreferrer"><span>LuckyClover-Moderation</span><span>GitHub ↗</span></a><a class="docs-link" href="docs-command-guide"><span>插件与常用指令</span><span>阅读 →</span></a></section>
    <section class="docs-group"><h2>LuckyClover 服务器</h2><p>玩家入服、服务器信息和社区规范。</p><a class="docs-link" href="status"><span>服务器状态</span><span>查看 →</span></a><a class="docs-link" href="docs-server-info"><span>服务器信息</span><span>阅读 →</span></a><a class="docs-link" href="docs-rules"><span>社区规范</span><span>阅读 →</span></a></section>
    <section class="docs-group"><h2>资源包与界面</h2><p>DogeUI、表单菜单和基岩版资源包的说明。</p><a class="docs-link" href="docs-overview"><span>生态概览</span><span>阅读 →</span></a><a class="docs-link" href="docs-guide"><span>部署指南</span><span>阅读 →</span></a></section>
    <section class="docs-group"><h2>贡献与迁移</h2><p>从源码构建、提交问题和迁移旧版配置。</p><a class="docs-link" href="https://github.com/BeeLeap" target="_blank" rel="noopener noreferrer"><span>GitHub 组织</span><span>打开 ↗</span></a><a class="docs-link" href="docs-faq"><span>常见问题</span><span>阅读 →</span></a></section>
  </div>
  <div class="docs-note">文档中的项目能力以对应仓库当前版本为准。提交问题或贡献代码时，请优先查看仓库 README、CHANGELOG 和 issue。</div>
</div></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
