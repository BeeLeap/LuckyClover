<?php
/**
 * note.php
 */
$page_title = "最新动态 - LuckyClover";
$page_desc = "查看 LuckyClover 最新动态，获取公告、更新记录和社区通知。";
$active_nav = "note.php";
$extra_css = <<<CSS
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
      <div class="news-list">
        <article class="news-item">
          <div class="news-date">2026-04-28</div>
          <h3>官网页面维护完成</h3>
          <p>本次更新修复了页面乱码、导航异常和脚本错误，同时统一了站点页脚与移动端菜单体验。</p>
        </article>

        <article class="news-item">
          <div class="news-date">2026-04-20</div>
          <h3>新成员入服说明优化</h3>
          <p>加入流程页面新增了更清晰的三步引导，减少新玩家第一次进入时的配置成本。</p>
        </article>

        <article class="news-item">
          <div class="news-date">2026-04-10</div>
          <h3>社区建议征集</h3>
          <p>欢迎在群内反馈你想要的玩法活动。我们会持续优化服务器体验与规则细节。</p>
        </article>
      </div>
    </div>
  </section>

<?php
$extra_js = <<<JS
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