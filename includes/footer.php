<?php
/**
 * 公共底部模板
 *
 * 变量:
 *   $extra_js - 额外的<script>内容（可选）
 */

$config = require __DIR__ . '/config.php';
$site = $config['site'];
$transitionScript = 'assets/js/page-transition.js';
$transitionScriptPath = dirname(__DIR__) . '/' . $transitionScript;
if (is_file($transitionScriptPath)) $transitionScript .= '?v=' . filemtime($transitionScriptPath);
?>
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-left">
          <div class="logo-icon logo-image" style="width:32px;height:32px;flex:0 0 32px;font-size:1rem;overflow:hidden;"><img src="<?php echo htmlspecialchars($faviconUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="BeeLeap" width="32" height="32" style="display:block;width:32px;height:32px;max-width:none;object-fit:contain;"></div>
          <p><?php echo htmlspecialchars($site['copyright'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://unpkg.com/swup@4"></script>
  <script src="https://unpkg.com/@swup/head-plugin@2"></script>
  <script src="https://unpkg.com/@swup/preload-plugin@3"></script>
  <script src="https://unpkg.com/@swup/scripts-plugin@2"></script>
  <script src="<?php echo htmlspecialchars($transitionScript, ENT_QUOTES, 'UTF-8'); ?>" data-swup-ignore-script></script>
  <script data-swup-ignore-script>
    function toggleMenu() {
      const nav = document.getElementById('main-nav');
      const button = document.querySelector('.mobile-menu-btn');
      const isActive = nav.classList.toggle('active');
      button.setAttribute('aria-expanded', isActive ? 'true' : 'false');
    }

    function toggleProjectsMenu(event) {
      event.preventDefault();
      const trigger = event.currentTarget;
      const wrapper = trigger.closest('.nav-projects');
      const isOpen = wrapper.classList.toggle('open');
      trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    }

    document.querySelectorAll('#main-nav a').forEach(link => {
      link.addEventListener('click', () => {
        const projectMenu = link.closest('.projects-mega-menu');
        if (projectMenu) {
          const wrapper = projectMenu.closest('.nav-projects');
          const trigger = wrapper.querySelector('.nav-project-trigger');
          wrapper.classList.remove('open');
          trigger.setAttribute('aria-expanded', 'false');
        }
        if (window.innerWidth <= 900) {
          if (link.classList.contains('nav-project-trigger')) {
            return;
          }
          const nav = document.getElementById('main-nav');
          const button = document.querySelector('.mobile-menu-btn');
          nav.classList.remove('active');
          button.setAttribute('aria-expanded', 'false');
          document.querySelectorAll('.nav-projects.open').forEach(menu => menu.classList.remove('open'));
        }
      });
    });

    document.addEventListener('click', event => {
      document.querySelectorAll('.nav-projects.open').forEach(wrapper => {
        if (!wrapper.contains(event.target)) {
          wrapper.classList.remove('open');
          wrapper.querySelector('.nav-project-trigger').setAttribute('aria-expanded', 'false');
        }
      });
    });
  </script>

  <?php if (!empty($extra_js)) : ?>
  <script data-swup-reload-script>
    <?php echo $extra_js; ?>
  </script>
  <?php endif; ?>
</body>
</html>
