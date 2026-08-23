<?php
$page_title = '活动 - LuckyClover';
$page_desc = '查看 LuckyClover 最新活动公告和历史活动记录。';
$active_nav = 'huodong';
require __DIR__ . '/includes/bootstrap.php';
$activities = $db->query("SELECT * FROM activities WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
$extra_css = <<<'CSS'
.page-wrap{max-width:980px;margin:0 auto;padding:120px 24px 72px}.hero-card,.announce-item{border:1px solid rgba(255,159,10,.34);background:transparent;border-radius:22px;padding:28px}.hero-card{text-align:center;border-radius:30px}.hero-card h1{margin:18px 0 14px;font-size:clamp(2.2rem,6vw,4rem)}.hero-card p,.announce-item p{color:var(--text-secondary);line-height:1.85}.tag-row{display:flex;flex-wrap:wrap;justify-content:center;gap:10px}.tag{padding:8px 13px;border:1px solid rgba(255,159,10,.34);border-radius:999px;background:rgba(255,159,10,.08);color:var(--accent-secondary);font-size:.88rem;font-weight:700}.announce-grid{display:grid;gap:18px;margin-top:24px}.announce-item h2{margin:0 0 10px}.event-detail{margin-top:18px;white-space:pre-line;color:var(--text-secondary);line-height:1.85}@media(max-width:768px){.page-wrap{padding:96px 18px 56px}}
CSS;
require __DIR__ . '/includes/header.php';
?>
<main class="page-wrap">
  <section class="hero-card"><div class="tag-row"><span class="tag">活动中心</span><span class="tag">实时更新</span></div><h1>服务器<span style="color:var(--accent-secondary);">活动</span></h1><p>活动公告、报名信息与历史记录会在这里发布。</p></section>
  <section class="announce-grid">
    <?php if (!$activities): ?><article class="announce-item"><h2>暂无已发布活动</h2><p>管理员可以在后台创建并发布活动。</p></article><?php endif; ?>
    <?php foreach ($activities as $activity): ?><article class="announce-item"><div class="tag-row"><span class="tag"><?php echo e($activity['start_at'] ?: substr($activity['created_at'], 0, 10)); ?></span><?php if ($activity['tags'] !== ''): ?><span class="tag"><?php echo e($activity['tags']); ?></span><?php endif; ?></div><h2><?php echo e($activity['title']); ?></h2><p><?php echo e($activity['summary']); ?></p><div class="event-detail"><?php echo e($activity['content']); ?></div></article><?php endforeach; ?>
  </section>
</main>
<?php
$extra_js = <<<'JS'
function toggleMenu(){const nav=document.getElementById('main-nav');const button=document.querySelector('.mobile-menu-btn');const active=nav.classList.toggle('active');button.setAttribute('aria-expanded',active?'true':'false');}document.querySelectorAll('#main-nav a').forEach(link=>link.addEventListener('click',()=>{if(window.innerWidth<=768){document.getElementById('main-nav').classList.remove('active');document.querySelector('.mobile-menu-btn').setAttribute('aria-expanded','false')}}));
JS;
require __DIR__ . '/includes/footer.php';
?>
