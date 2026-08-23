<?php
/**
 * note.php
 */
$page_title = "最新动态 - LuckyClover";
$page_desc = "查看 LuckyClover 最新动态，获取公告、更新记录和社区通知。";
$active_nav = "note";
require __DIR__ . '/includes/bootstrap.php';
$news = $db->query("SELECT title, content, created_at FROM news WHERE status = 'published' ORDER BY created_at DESC")->fetchAll();
$extra_css = <<<'CSS'
.news-list { max-width: 900px; margin: 0 auto; display: grid; gap: 20px; }
    .news-item { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 24px; }
    .news-date { color: var(--text-muted); font-size: 0.875rem; margin-bottom: 10px; }
    .news-item h3 { margin-bottom: 10px; }
    .news-item p { color: var(--text-secondary); line-height: 1.8; }
    .page-header { text-align: center; padding: 120px 24px 60px; }
    .page-header h1 { font-size: 3rem; margin-bottom: 16px; }
    .page-header p { font-size: 1.125rem; color: var(--text-secondary); }
CSS;
require __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
      <h1>最新<span style="color: var(--accent-secondary);">动态</span></h1>
      <p>公告、活动与版本更新会在这里发布</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="news-list"><?php foreach ($news as $item): ?><article class="news-item"><div class="news-date"><?php echo e(substr($item['created_at'], 0, 10)); ?></div><h3><?php echo e($item['title']); ?></h3><p><?php echo nl2br(e($item['content'])); ?></p></article><?php endforeach; ?></div>
    </div>
  </section>

<?php
$extra_js = <<<'JS'
function toggleMenu() {
      const nav = document.getElementById('main-nav');
      const button = document.querySelector('.mobile-menu-btn');
      const isActive = nav.classList.toggle('active');
      button.setAttribute('aria-expanded', isActive ? 'true' : 'false');
    }
    document.querySelectorAll('#main-nav a').forEach(link => { link.addEventListener('click', () => { if (window.innerWidth <= 768) { const nav = document.getElementById('main-nav'); const button = document.querySelector('.mobile-menu-btn'); nav.classList.remove('active'); button.setAttribute('aria-expanded', 'false'); } }); });
JS;
require __DIR__ . '/includes/footer.php';
?>
