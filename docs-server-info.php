<?php
$page_title = '安装与依赖 - LuckyClover-Moderation';
$page_desc = 'LuckyClover-Moderation 的构建环境、运行依赖与安装方式。';
$active_nav = 'docs'; $active_doc = 'docs-server-info'; $docs_page = true;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-layout">
  <?php require __DIR__ . '/includes/docs-sidebar.php'; ?>
  <article class="docs-content"><span class="pixel-tag">开始使用 / 安装与依赖</span><h1>安装与依赖</h1><p class="docs-lead">当前目标版本为 LeviLamina 26.51.x，运行时依赖匹配版本的 iListenAttentively。</p>
    <h2>构建环境</h2><ul><li>Visual Studio 2022 C++ 工具链，或 clang-cl</li><li>xmake</li><li>LeviLamina 开发依赖</li><li>不需要单独下载 iListenAttentively SDK</li></ul>
    <h2>从源码构建</h2><div class="docs-code">xmake f -y -p windows -a x64 -m release
xmake</div>
    <h2>安装运行时依赖</h2><p>将构建产物放入 LeviLamina 对应的插件目录，并在同一服务端安装与 ABI 匹配的 <code>iListenAttentively</code>。插件通过事件总线和网络包入口处理文本，不依赖 LseExport。</p>
    <div class="docs-callout">如果使用 GitHub Actions 发布包，优先选择与服务端 LeviLamina 版本一致的构建产物；升级 Minecraft/LeviLamina 后应重新确认 ABI 兼容性。</div>
  </article>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
