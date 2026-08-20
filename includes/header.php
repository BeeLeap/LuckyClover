<?php
/**
 * 公共头部模板
 *
 * 变量:
 *   $page_title  - 页面标题（可选）
 *   $page_desc   - 页面描述（可选）
 *   $active_nav  - 当前激活的导航标识（可选，与 config nav url 对应）
 *   $extra_css   - 额外的<style>内容（可选）
 *   $extra_head  - 额外的<head>内容（可选）
 */

$config = require __DIR__ . '/config.php';
$site   = $config['site'];
$nav    = $config['nav'];

$title = isset($page_title) && $page_title !== ''
    ? $page_title . ' - ' . $site['name']
    : $site['title'];

$desc = isset($page_desc) ? $page_desc : $site['description'];
$active = isset($active_nav) ? $active_nav : '';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($site['keywords'], ENT_QUOTES, 'UTF-8'); ?>">
  <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="<?php echo $config['assets']['css']; ?>">
  <link rel="icon" href="<?php echo $site['favicon']; ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <?php if (!empty($extra_css)) : ?>
  <style>
    <?php echo $extra_css; ?>
  </style>
  <?php endif; ?>
  <?php if (!empty($extra_head)) echo $extra_head; ?>
</head>
<body>
  <header>
    <div class="container">
      <div class="header-content">
        <a href="/" class="logo">
          <div class="logo-icon">🍀</div>
          <span><?php echo htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8'); ?></span>
        </a>
        <button class="mobile-menu-btn" type="button" onclick="toggleMenu()" aria-label="切换菜单" aria-controls="main-nav" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
        <nav id="main-nav">
          <?php foreach ($nav as $item) :
              $isActive = ($active === $item['url']);
              $attrs = $isActive ? ' class="active" aria-current="page"' : '';
          ?>
          <a href="<?php echo $item['url']; ?>"<?php echo $attrs; ?>><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
          <?php endforeach; ?>
          <?php if (!empty($docs_search)) : ?>
          <button class="docs-search-btn" type="button" onclick="openDocsSearch()">搜索</button>
          <?php endif; ?>
        </nav>
      </div>
    </div>
  </header>
