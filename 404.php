<?php
/**
 * 404.php
 */
$page_title = "404 - LuckyClover";
$page_desc = "LuckyClover 页面未找到提示页，可返回首页继续浏览其他内容。";
$extra_css = <<<'CSS'
.not-found {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 24px;
    }

    .not-found-card {
      background: transparent;
      border: 1px solid var(--border-color);
      border-radius: var(--radius-lg);
      padding: 40px;
      max-width: 560px;
      width: 100%;
    }

    .not-found-card h1 {
      font-size: 4rem;
      margin-bottom: 8px;
    }

    .not-found-card p {
      color: var(--text-secondary);
      margin-bottom: 20px;
    }
CSS;
require __DIR__ . '/includes/header.php';
?>

<main class="not-found">
    <section class="not-found-card">
      <h1>404</h1>
      <p>页面不存在，你可以返回首页继续浏览。</p>
      <a class="btn btn-primary" href="index">立即返回首页</a>
    </section>
  </main>

<?php require __DIR__ . '/includes/footer.php'; ?>