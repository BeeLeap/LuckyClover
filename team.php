<?php
/**
 * team.php
 */
$page_desc = "了解 LuckyClover 管理团队，查看服务器核心成员与各自负责的工作。";
$active_nav = "team";
$extra_css = <<<'CSS'
.team-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-top: 48px; }
    .team-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; text-align: center; transition: all 0.3s ease; }
    .team-card:hover { transform: translateY(-4px); border-color: var(--border-hover); box-shadow: var(--shadow-card); }
    .team-avatar { width: 80px; height: 80px; background: var(--accent-gradient); border-radius: var(--radius-full); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; }
    .team-card h3 { font-size: 1.25rem; margin-bottom: 8px; }
    .team-card p { color: var(--text-secondary); font-size: 0.9rem; }
    .page-header { text-align: center; padding: 120px 24px 60px; }
    .page-header h1 { font-size: 3rem; margin-bottom: 16px; }
    .page-header p { font-size: 1.125rem; color: var(--text-secondary); }
CSS;
require __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
      <h1>Bee<span style="color: var(--accent-secondary);">Leap</span></h1>
      <p>维护服务器稳定运行的核心成员</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="team-grid">
        <div class="team-card">
          <div class="team-avatar">👑</div>
          <h3>Beeeeereally</h3>
          <p>服主，负责整体规划与服务器运营。</p>
        </div>
        <div class="team-card">
          <div class="team-avatar">🛠</div>
          <h3>DreamXbox1961</h3>
          <p>管理员，负责日常维护、活动与玩家支持。</p>
        </div>
      </div>
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