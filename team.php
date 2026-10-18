<?php
/**
 * team.php
 */
$page_title = "关于 BeeLeap";
$page_desc = "了解 BeeLeap 的开源方向、技术栈与社区项目。";
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
      <p>让 Minecraft 基岩版社区的工具更好用、更开放</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="team-grid">
        <div class="team-card">
          <div class="team-avatar">⚒</div>
          <h3>我们的方向</h3>
          <p>围绕 BDS、LeviLamina 与 LegacyScriptEngine，制作可独立部署的插件和运维工具。</p>
        </div>
        <div class="team-card">
          <div class="team-avatar">◈</div>
          <h3>模块化协作</h3>
          <p>核心能力按职责拆分，插件之间通过明确的接口契约协作，单个模块缺失也不影响其他功能。</p>
        </div>
        <div class="team-card">
          <div class="team-avatar">↗</div>
          <h3>开放源码</h3>
          <p>源码、配置、迁移说明和构建脚本跟随项目公开，欢迎通过 GitHub 参与改进。</p>
          <a class="btn btn-secondary" href="https://github.com/BeeLeap" target="_blank" rel="noopener noreferrer">访问 GitHub ↗</a>
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
