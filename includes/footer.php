<?php
/**
 * 公共底部模板
 *
 * 变量:
 *   $extra_js - 额外的<script>内容（可选）
 */

$config = require __DIR__ . '/config.php';
$site = $config['site'];
?>
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-left">
          <div class="logo-icon" style="width:32px;height:32px;font-size:1rem;">🍀</div>
          <p><?php echo htmlspecialchars($site['copyright'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    function toggleMenu() {
      const nav = document.getElementById('main-nav');
      const button = document.querySelector('.mobile-menu-btn');
      const isActive = nav.classList.toggle('active');
      button.setAttribute('aria-expanded', isActive ? 'true' : 'false');
    }

    document.querySelectorAll('#main-nav a').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 900) {
          const nav = document.getElementById('main-nav');
          const button = document.querySelector('.mobile-menu-btn');
          nav.classList.remove('active');
          button.setAttribute('aria-expanded', 'false');
        }
      });
    });
  </script>

  <?php if (!empty($extra_js)) : ?>
  <script>
    <?php echo $extra_js; ?>
  </script>
  <?php endif; ?>
</body>
</html>
