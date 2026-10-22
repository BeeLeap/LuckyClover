<?php
/**
 * BeeLeap 站点配置
 */

$config = [
    // 站点信息
    'site' => [
        'name'        => 'BeeLeap',
        'main_url'    => 'https://beeleap.top',
        'server_url'  => 'https://lcy.beeleap.top',
        'title'       => 'BeeLeap | Minecraft 开源生态',
        'description' => 'BeeLeap 是面向 Minecraft 基岩版服务器的插件、运维工具与蜜蜂园服务器生态。',
        'keywords'    => 'BeeLeap, 蜜蜂园, Minecraft, LeviLamina, BDS, 插件, 运维工具',
        'community_url'=> 'https://qm.qq.com/q/bt6f8jP0Gs',
        'favicon'     => 'images/beeleap.webp',
        'copyright'   => '© 2026 BeeLeap · Built for Minecraft communities.',
    ],

    // 导航菜单
    'nav' => [
        ['url' => '/',          'label' => '首页'],
        ['url' => 'projects',   'label' => '项目'],
        ['url' => 'status',     'label' => '蜜蜂园'],
        ['url' => 'docs',       'label' => '插件文档'],
        ['url' => 'team',       'label' => '关于 BeeLeap'],
    ],

    // 文档侧边栏
    'docs_nav' => [
        ['url' => 'docs',              'label' => '文档首页'],
        ['url' => 'docs-overview',     'label' => '生态概览'],
        ['url' => 'docs-server-info',  'label' => '蜜蜂园服务器'],
        ['url' => 'docs-command-guide','label' => '插件与指令'],
        ['url' => 'docs-rules',        'label' => '服务端规范'],
        ['url' => 'docs-guide',        'label' => '部署指南'],
        ['url' => 'docs-faq',          'label' => '常见问题'],
    ],

    // 服务器列表
    'servers' => [
        'bedrock' => [
            'name'    => '蜜蜂园',
            'type'    => 'Minecraft Bedrock',
            'ip'      => 'play.beeeeeawa.top',
            'port'    => 30081,
        ],
        'java' => [
            'name'    => 'Java 版服务器',
            'type'    => 'Minecraft Java',
            'ip'      => 'node4.yunmc.vip',
            'port'    => 10140,
        ],
        'survival' => [
            'name'    => '新生存服',
            'type'    => 'Minecraft Bedrock',
            'ip'      => 'play.beeeeeawa.top',
            'port'    => 30122,
        ],
        'java_survival' => [
            'name'    => 'Java版生存服',
            'type'    => 'Minecraft Java',
            'ip'      => 'play.beeeeeawa.top',
            'port'    => 30025,
        ],
    ],

    // 资源路径
    'assets' => [
        'css' => 'assets/css/modern-fixed.css',
    ],

    // MySQL 与后台配置。生产环境请通过环境变量设置数据库和管理员密码。
    'database' => [
        'host'     => getenv('LUCKYCLOVER_DB_HOST') ?: '127.0.0.1',
        'port'     => getenv('LUCKYCLOVER_DB_PORT') ?: '3306',
        'name'     => getenv('LUCKYCLOVER_DB_NAME') ?: 'luckyclover',
        'user'     => getenv('LUCKYCLOVER_DB_USER') ?: 'luckyclover',
        'password' => getenv('LUCKYCLOVER_DB_PASSWORD') ?: '',
    ],
    'admin' => [
        'username' => getenv('LUCKYCLOVER_ADMIN_USER') ?: 'admin',
        // 未配置密码时禁止登录，避免把默认凭据带到生产环境。
        'password' => getenv('LUCKYCLOVER_ADMIN_PASSWORD') ?: '',
    ],
];

// Server-only settings live in config.local.php and are never committed.
$localConfigPath = __DIR__ . '/config.local.php';
if (is_file($localConfigPath)) {
    $localConfig = require $localConfigPath;
    if (is_array($localConfig)) {
        $config = array_replace_recursive($config, $localConfig);
    }
}

return $config;
