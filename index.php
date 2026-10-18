<?php
require __DIR__ . '/includes/bootstrap.php';

$servers = $db->query("SELECT slug, name, type FROM servers WHERE enabled = 1 ORDER BY sort_order ASC, id ASC")->fetchAll();
$news = $db->query("SELECT title, content, created_at FROM news WHERE status = 'published' ORDER BY created_at DESC LIMIT 3")->fetchAll();
$page_title = 'BeeLeap';
$page_desc = 'BeeLeap：面向 Minecraft 基岩版服务器的插件、资源包、运维工具与 LuckyClover 社区。';
$active_nav = '/';
$extra_css = <<<'CSS'
.beeleap-hero { min-height: 680px; display:grid; align-items:center; padding:92px 0 78px; }
.hero-grid { display:grid; grid-template-columns:minmax(0,1.12fr) minmax(300px,.88fr); gap:56px; align-items:center; }
.eyebrow, .pixel-tag { display:inline-flex; align-items:center; gap:8px; padding:7px 11px; border:2px solid #111; background:var(--accent-secondary); color:#102018; box-shadow:3px 3px 0 #111; font-size:.78rem; font-weight:900; letter-spacing:.06em; text-transform:uppercase; }
.beeleap-hero h1 { max-width:760px; margin:22px 0 18px; font-family:"Minecraft","Microsoft YaHei",sans-serif; font-size:clamp(3.2rem,8vw,7.4rem); line-height:.94; letter-spacing:.03em; text-shadow:7px 7px 0 rgba(0,0,0,.35); }
.beeleap-hero h1 span { color:var(--accent-secondary); }
.hero-copy { max-width:650px; color:var(--text-secondary); font-size:1.12rem; line-height:1.9; }
.hero-actions { display:flex; gap:14px; flex-wrap:wrap; margin-top:30px; }
.pixel-button { display:inline-flex; align-items:center; justify-content:center; padding:13px 18px; border:3px solid #111; background:var(--accent-primary); color:#102018; box-shadow:5px 5px 0 #111; font-weight:900; }
.pixel-button:hover { transform:translate(2px,2px); box-shadow:3px 3px 0 #111; }
.pixel-button.secondary { background:transparent; color:var(--text-primary); border-color:var(--accent-secondary); }
.hero-board { padding:26px; border:4px solid #111; background:rgba(16,32,24,.84); box-shadow:10px 10px 0 rgba(0,0,0,.38); transform:rotate(2deg); }
.hero-board-top { display:flex; justify-content:space-between; gap:14px; border-bottom:2px solid rgba(255,255,255,.18); padding-bottom:16px; color:var(--accent-secondary); font-weight:900; }
.hero-board h2 { margin:24px 0 10px; font-size:1.8rem; }
.hero-board p { color:var(--text-secondary); }
.board-row { display:flex; justify-content:space-between; gap:18px; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.1); color:var(--text-secondary); }
.board-row strong { color:var(--text-primary); }
.section-heading { display:flex; align-items:end; justify-content:space-between; gap:24px; margin-bottom:28px; }
.section-heading h2 { font-family:"Minecraft","Microsoft YaHei",sans-serif; font-size:clamp(2rem,5vw,3.4rem); line-height:1; }
.section-heading p { max-width:540px; color:var(--text-secondary); }
.home-section { padding:78px 0; }
.home-section.alt { background:rgba(6,18,11,.34); border-block:2px solid rgba(255,255,255,.06); }
.project-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.project-card { min-height:260px; display:flex; flex-direction:column; padding:24px; border:3px solid #111; background:var(--bg-card); box-shadow:var(--shadow-block); }
.project-card:hover { transform:translate(2px,2px); border-color:var(--accent-secondary); }
.project-card .project-icon { width:54px; height:54px; display:grid; place-items:center; margin-bottom:24px; border:3px solid #111; background:var(--accent-gradient); color:#102018; font-family:"Minecraft"; font-size:1.3rem; }
.project-card h3 { margin-bottom:10px; font-size:1.35rem; }
.project-card p { color:var(--text-secondary); line-height:1.75; }
.project-card .card-link { margin-top:auto; padding-top:22px; color:var(--accent-secondary); font-weight:900; }
.server-strip { display:grid; grid-template-columns:1.2fr .8fr; gap:24px; align-items:center; padding:30px; border:3px solid #111; background:linear-gradient(120deg,rgba(90,189,60,.24),rgba(255,223,94,.08)); box-shadow:var(--shadow-block); }
.server-strip h2 { margin:10px 0; font-size:2rem; }
.server-list { display:grid; gap:10px; }
.server-list a { display:flex; justify-content:space-between; gap:18px; padding:14px 16px; background:rgba(10,21,16,.62); border:2px solid rgba(255,255,255,.12); }
.server-list a:hover { border-color:var(--accent-secondary); }
.news-list { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.news-card { padding:22px; border-left:5px solid var(--accent-primary); background:rgba(16,32,24,.72); }
.news-card small { color:var(--accent-secondary); }
.news-card h3 { margin:12px 0 8px; }
.news-card p { color:var(--text-secondary); }
@media(max-width:850px){.hero-grid,.server-strip{grid-template-columns:1fr}.hero-board{transform:none}.project-grid,.news-list{grid-template-columns:1fr}.section-heading{display:block}.section-heading p{margin-top:12px}}
CSS;
require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="beeleap-hero">
    <div class="container hero-grid">
      <div>
        <div class="eyebrow">BeeLeap / Minecraft ecosystem</div>
        <h1>Build the <span>next</span> block.</h1>
        <p class="hero-copy">BeeLeap 是一个面向 Minecraft 基岩版社区的开源组织。我们制作插件、资源包、运维工具，也维护 LuckyClover 服务器，把复杂的服务端能力变成可以独立部署、长期维护的模块。</p>
        <div class="hero-actions"><a class="pixel-button" href="projects">浏览项目</a><a class="pixel-button secondary" href="https://github.com/BeeLeap" target="_blank" rel="noopener noreferrer">访问 GitHub ↗</a></div>
      </div>
      <div class="hero-board" aria-label="BeeLeap 项目概览">
        <div class="hero-board-top"><span>BEELEAP_STATUS</span><span>● ONLINE</span></div>
        <h2>工具，玩法，社区。</h2><p>从一个插件，到一整套可持续运营的基岩版服务器生态。</p>
        <div class="board-row"><span>Runtime</span><strong>BDS + LeviLamina</strong></div><div class="board-row"><span>Projects</span><strong>Plugins / Packs / Tools</strong></div><div class="board-row"><span>Community</span><strong>LuckyClover</strong></div>
      </div>
    </div>
  </section>
  <section class="home-section alt"><div class="container"><div class="section-heading"><div><span class="pixel-tag">01 / Projects</span><h2>正在建造的东西</h2></div><p>每个项目都可以独立使用，也可以组合成一套完整的服务器基础设施。</p></div><div class="project-grid">
    <a class="project-card" href="projects"><div class="project-icon">LC</div><h3>LuckyClover</h3><p>BeeLeap 的 Minecraft 服务器社区，承载我们的玩法、活动和玩家文档。</p><span class="card-link">查看服务器 →</span></a>
    <a class="project-card" href="docs"><div class="project-icon">PL</div><h3>Server Plugins</h3><p>面向 LeviLamina / LegacyScriptEngine 的独立插件、管理能力和玩法模块。</p><span class="card-link">阅读插件文档 →</span></a>
    <a class="project-card" href="https://github.com/BeeLeap" target="_blank" rel="noopener noreferrer"><div class="project-icon">GH</div><h3>Open Source</h3><p>源码、配置、迁移说明和构建脚本都跟随项目公开，欢迎一起改进。</p><span class="card-link">打开组织主页 ↗</span></a>
  </div></div></section>
  <section class="home-section"><div class="container"><div class="server-strip"><div><span class="pixel-tag">02 / LuckyClover</span><h2>进入我们的服务器世界</h2><p class="hero-copy">查看当前服务器状态、版本与在线人数，获取加入方式和玩家文档。</p></div><div class="server-list"><?php foreach ($servers as $server): ?><a href="status"><strong><?php echo e($server['name']); ?></strong><span><?php echo e($server['type']); ?> →</span></a><?php endforeach; ?><?php if (!$servers): ?><a href="status"><strong>LuckyClover</strong><span>查看状态 →</span></a><?php endif; ?></div></div></div></section>
  <?php if ($news): ?><section class="home-section alt"><div class="container"><div class="section-heading"><div><span class="pixel-tag">03 / Changelog</span><h2>最近动态</h2></div><p>来自 BeeLeap 和 LuckyClover 的更新。</p></div><div class="news-list"><?php foreach ($news as $item): ?><article class="news-card"><small><?php echo e(substr($item['created_at'], 0, 10)); ?></small><h3><?php echo e($item['title']); ?></h3><p><?php echo e($item['content']); ?></p></article><?php endforeach; ?></div></div></section><?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
