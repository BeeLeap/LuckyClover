<?php
/**
 * pic-1.php
 */
$page_title = "服内风景 - LuckyClover";
$page_desc = "浏览 LuckyClover 服内风景截图，查看玩家建筑与服务器内景观展示。";
$extra_css = <<<CSS
.gallery-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; }
    .gallery-item { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; transition: all 0.3s ease; }
    .gallery-item:hover { transform: translateY(-4px); border-color: var(--border-hover); }
    .gallery-item img { width: 100%; height: 250px; object-fit: cover; }
    .gallery-item .info { padding: 20px; }
    .gallery-item h3 { font-size: 1.125rem; margin-bottom: 8px; }
    .gallery-item p { color: var(--text-secondary); font-size: 0.875rem; }
    .page-header { text-align: center; padding: 120px 24px 60px; }
    .page-header h1 { font-size: 3rem; margin-bottom: 16px; }
    .page-header p { font-size: 1.125rem; color: var(--text-secondary); }
CSS;
require __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
      <h1>服内<span style="color: var(--accent-secondary);">风景</span></h1>
      <p>玩家日常建造与探索截图</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="gallery-grid">
        <div class="gallery-item">
          <img src="images/pic63.png" alt="LuckyClover 服内截图">
          <div class="info">
            <h3>DreamXbox1961</h3>
            <p>来自服务器内的建筑景观截图。</p>
          </div>
        </div>
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