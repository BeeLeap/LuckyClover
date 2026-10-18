<?php
$page_title = '项目';
$page_desc = 'BeeLeap 项目集合：LuckyClover、服务端插件、资源包和开源工具。';
$active_nav = 'projects';
$extra_css = <<<'CSS'
.projects-page{padding:92px 0 80px}.projects-intro{max-width:760px;margin-bottom:48px}.projects-intro h1{font-family:"Minecraft";font-size:clamp(3rem,7vw,6rem);line-height:.95;margin:18px 0}.projects-intro h1 span{color:var(--accent-secondary)}.projects-intro p{color:var(--text-secondary);font-size:1.1rem;line-height:1.9}.project-list{display:grid;gap:24px}.project-item{display:grid;grid-template-columns:130px 1fr auto;gap:28px;align-items:center;padding:28px;border:3px solid #111;background:var(--bg-card);box-shadow:var(--shadow-block)}.project-item:hover{border-color:var(--accent-secondary);transform:translate(2px,2px)}.project-mark{width:112px;height:112px;display:grid;place-items:center;border:4px solid #111;background:var(--accent-gradient);color:#102018;font-family:"Minecraft";font-size:1.6rem;box-shadow:inset -8px -8px 0 rgba(0,0,0,.18)}.project-item h2{margin-bottom:8px;font-size:1.8rem}.project-item p{color:var(--text-secondary);line-height:1.8}.project-meta{display:flex;flex-wrap:wrap;gap:8px;margin-top:14px}.project-meta span{padding:5px 9px;background:rgba(255,223,94,.12);color:var(--accent-secondary);font-size:.8rem}.project-cta{white-space:nowrap;color:var(--accent-secondary);font-weight:900}@media(max-width:720px){.project-item{grid-template-columns:1fr}.project-mark{width:80px;height:80px}.project-cta{margin-top:4px}}
CSS;
require __DIR__ . '/includes/header.php';
?>
<main class="projects-page"><div class="container">
  <div class="projects-intro"><span class="pixel-tag">BeeLeap / Projects</span><h1>我们正在<br><span>建造什么</span>？</h1><p>从服务器里的一个小功能，到可以被其他社区复用的完整模块。BeeLeap 的项目围绕可维护、可组合和可公开协作展开。</p></div>
  <div class="project-list">
    <article class="project-item"><div class="project-mark">LC</div><div><h2>LuckyClover</h2><p>BeeLeap 的基岩版 Minecraft 社区服务器。这里是玩法实验、活动运营和插件组合的实际运行场。</p><div class="project-meta"><span>Bedrock</span><span>Community</span><span>Server</span></div></div><a class="project-cta" href="status">服务器页面 →</a></article>
    <article class="project-item"><div class="project-mark">CM</div><div><h2>LuckyClover-Moderation</h2><p>适用于 LeviLamina 的原生文本输入违禁词过滤插件，覆盖聊天、书籍、铁砧和告示牌等场景。</p><div class="project-meta"><span>C++</span><span>LeviLamina</span><span>MIT</span></div></div><a class="project-cta" href="https://github.com/BeeLeap/LuckyClover-Moderation" target="_blank" rel="noopener noreferrer">GitHub ↗</a></article>
    <article class="project-item"><div class="project-mark">UI</div><div><h2>DogeUI & Resource Packs</h2><p>面向基岩版的界面美化、表单菜单、开始界面和行为包，为服务器提供统一的视觉体验。</p><div class="project-meta"><span>UI JSON</span><span>Resource Pack</span><span>Bedrock</span></div></div><a class="project-cta" href="docs">查看文档 →</a></article>
  </div>
</div></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
