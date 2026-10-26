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
$currentHost = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
$currentHost = preg_replace('/:\\d+$/', '', $currentHost);
$mainHost = strtolower((string) (parse_url($site['main_url'] ?? '', PHP_URL_HOST) ?: 'beeleap.top'));
$isMainSite = $currentHost === $mainHost || $currentHost === 'www.' . $mainHost;
$navPrefix = $isMainSite ? '' : rtrim((string) ($site['main_url'] ?? ''), '/');
$homeUrl = $navPrefix !== '' ? $navPrefix . '/' : '/';
$serverUrl = rtrim((string) ($site['server_url'] ?? ''), '/');
$assetUrl = static function (string $path): string {
    $file = dirname(__DIR__) . '/' . ltrim($path, '/');
    return is_file($file) ? $path . '?v=' . filemtime($file) : $path;
};
$cssUrl = $assetUrl($config['assets']['css']);
$faviconUrl = $assetUrl($site['favicon']);
$docsCssUrl = $assetUrl('assets/css/docs.css');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($site['keywords'], ENT_QUOTES, 'UTF-8'); ?>">
  <title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="<?php echo htmlspecialchars($cssUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <?php if (!empty($docs_page)) : ?>
  <link rel="stylesheet" href="<?php echo htmlspecialchars($docsCssUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <?php endif; ?>
  <link rel="icon" href="<?php echo htmlspecialchars($faviconUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <?php if (!empty($extra_css)) : ?>
  <style data-page-style>
    <?php echo $extra_css; ?>
  </style>
  <?php endif; ?>
  <?php if (!empty($extra_head)) echo $extra_head; ?>
</head>
<body>
  <header>
    <div class="container">
      <div class="header-content">
        <a href="<?php echo htmlspecialchars($homeUrl, ENT_QUOTES, 'UTF-8'); ?>" class="logo" aria-label="BeeLeap 首页">
          <div class="logo-icon logo-image" style="width:42px;height:42px;flex:0 0 42px;overflow:hidden;"><img src="<?php echo htmlspecialchars($faviconUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="BeeLeap" width="42" height="42" style="display:block;width:42px;height:42px;max-width:none;object-fit:contain;"></div>
          <span><?php echo htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8'); ?></span>
        </a>
        <button class="mobile-menu-btn" type="button" onclick="toggleMenu()" aria-label="切换菜单" aria-controls="main-nav" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
        <nav id="main-nav">
          <?php foreach ($nav as $item) :
              $isActive = ($active === $item['url']) || ($item['url'] === 'docs-overview' && $active === 'docs');
              $attrs = $isActive ? ' class="active" aria-current="page"' : '';
          ?>
          <?php
              $itemUrl = $item['url'];
              if ($itemUrl === 'status' && $serverUrl !== '') {
                  $itemUrl = $serverUrl . '/';
              } elseif ($navPrefix !== '') {
                  $itemUrl = $itemUrl === '/' ? $homeUrl : $navPrefix . '/' . ltrim($itemUrl, '/');
              }
          ?>
          <?php if ($item['url'] === 'docs-overview' && !empty($config['project_groups'])) : ?>
          <div class="nav-projects<?php echo $isActive ? ' is-active' : ''; ?>">
            <button class="nav-project-trigger" type="button"<?php echo $isActive ? ' aria-current="page"' : ''; ?> aria-expanded="false" aria-controls="projects-menu" onclick="toggleProjectsMenu(event)"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?><svg class="nav-project-caret" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6"/></svg></button>
            <div id="projects-menu" class="projects-mega-menu groups-<?php echo count($config['project_groups']); ?>" aria-label="项目分类">
              <?php foreach ($config['project_groups'] as $group) : ?>
              <section class="projects-mega-group"><h3><?php echo htmlspecialchars($group['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <?php foreach ($group['items'] as $project) :
                    $projectAttrs = !empty($project['external']) ? ' target="_blank" rel="noopener noreferrer"' : '';
                    $projectUrl = $project['url'] === 'docs-overview'
                        ? rtrim((string) ($site['docs_url'] ?? ''), '/') . rtrim((string) ($site['docs_path'] ?? ''), '/') . '/'
                        : $project['url'];
                ?>
                <a href="<?php echo htmlspecialchars($projectUrl, ENT_QUOTES, 'UTF-8'); ?>"<?php echo $projectAttrs; ?>><span class="projects-mega-icon icon-<?php echo htmlspecialchars($project['icon'] ?? 'project', ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M12 3 4 7v10l8 4 8-4V7l-8-4Z"/><path d="m4 7 8 4 8-4M12 11v10"/></svg></span><span class="projects-mega-copy"><strong><?php echo htmlspecialchars($project['label'], ENT_QUOTES, 'UTF-8'); ?></strong><span><?php echo htmlspecialchars($project['desc'], ENT_QUOTES, 'UTF-8'); ?></span></span></a>
                <?php endforeach; ?>
              </section>
              <?php endforeach; ?>
              <a class="projects-mega-footer" href="https://github.com/BeeLeap" target="_blank" rel="noopener noreferrer"><strong>在 GitHub 查看全部仓库</strong><span aria-hidden="true">→</span></a>
            </div>
          </div>
          <?php else : ?>
          <a href="<?php echo htmlspecialchars($itemUrl, ENT_QUOTES, 'UTF-8'); ?>"<?php echo $attrs; ?>><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
          <?php endif; ?>
          <?php endforeach; ?>
          <a href="https://github.com/BeeLeap" target="_blank" rel="noopener noreferrer">GitHub</a>
        </nav>
      </div>
    </div>
  </header>
