<?php
/**
 * jiao.php
 */
$page_title = "如何加入服务器 - LuckyClover";
$page_desc = "查看 LuckyClover 加入方式，了解客户端准备、交流群入口与入服流程。";
$extra_css = <<<CSS
.steps { max-width: 700px; margin: 0 auto; }
    .step-card { display: flex; gap: 24px; padding: 32px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); margin-bottom: 20px; }
    .step-number { width: 48px; height: 48px; background: var(--accent-gradient); border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; flex-shrink: 0; }
    .step-content h3 { font-size: 1.25rem; margin-bottom: 12px; }
    .step-content p { color: var(--text-secondary); }
    .step-content .btn { margin-top: 16px; }
    .page-header { text-align: center; padding: 120px 24px 60px; }
    .page-header h1 { font-size: 3rem; margin-bottom: 16px; }
    .page-header p { font-size: 1.125rem; color: var(--text-secondary); }
CSS;
require __DIR__ . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
      <h1>如何<span style="color: var(--accent-secondary);">加入</span></h1>
      <p>三步快速进入 LuckyClover</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="steps">
        <div class="step-card">
          <div class="step-number">1</div>
          <div class="step-content">
            <h3>准备客户端</h3>
            <p>请使用正版 Minecraft 基岩版，推荐更新到较新稳定版本。</p>
            <a href="https://play.google.com/store/apps/details?id=com.mojang.minecraftpe" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">Google Play</a>
            <a href="https://www.microsoft.com/zh-cn/store/p/minecraft-for-windows/9nblggh2jhxj" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">Microsoft Store</a>
          </div>
        </div>
        <div class="step-card">
          <div class="step-number">2</div>
          <div class="step-content">
            <h3>加入 QQ 群</h3>
            <p>点击下方按钮加入交流群，获取服务器地址与白名单申请方式。</p>
            <a href="https://qm.qq.com/q/VpseZW3KO6" class="btn btn-primary" target="_blank" rel="noopener noreferrer">加入交流群</a>
          </div>
        </div>
        <div class="step-card">
          <div class="step-number">3</div>
          <div class="step-content">
            <h3>进入服务器</h3>
            <p>在游戏中添加服务器地址，按群公告完成申请后即可进入。</p>
            <p style="margin-top: 12px; color: var(--accent-secondary);">服务器地址：加群获取</p>
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