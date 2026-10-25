<?php
$page_title = '过滤范围 - LuckyClover-Moderation';
$page_desc = 'LuckyClover-Moderation 支持的文本入口与处理时机。';
$active_nav = 'docs'; $active_doc = 'docs-rules'; $docs_page = true;
require __DIR__ . '/includes/header.php';
?>
<main id="swup" class="docs-layout">
  <?php require __DIR__ . '/includes/docs-sidebar.php'; ?>
  <article class="docs-content"><span class="pixel-tag">核心能力 / 过滤范围</span><h1>过滤范围</h1><p class="docs-lead">插件在文本提交前修改违禁内容，覆盖玩家最常见的原生文本入口。</p>
    <table class="docs-table"><thead><tr><th>入口</th><th>处理内容</th><th>实现路径</th></tr></thead><tbody><tr><td>聊天</td><td>玩家发送的聊天文本</td><td>原始 TextPacket 入口</td></tr><tr><td>书籍</td><td>标题、作者和正文</td><td>LeviLamina 网络包入口</td></tr><tr><td>铁砧</td><td>物品重命名文本</td><td>LeviLamina 网络包入口</td></tr><tr><td>普通告示牌</td><td>编辑中的告示牌文本</td><td>iListenAttentively PlayerEditSignBeforeEvent</td></tr><tr><td>悬挂告示牌</td><td>编辑中的悬挂告示牌文本</td><td>LeviLamina 网络包入口</td></tr></tbody></table>
    <h2>处理原则</h2><ul><li>在文本落地或发送前处理，避免只修改后台显示。</li><li>白名单优先于内置分类词和自定义词。</li><li>大小写与全半角 ASCII 会进行温和归一化后再匹配。</li><li>词库热重载失败时保留当前可用状态，并记录错误。</li></ul>
  </article>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
