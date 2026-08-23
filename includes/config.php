<?php
/**
 * LuckyClover 站点配置
 */

return [
    // 站点信息
    'site' => [
        'name'        => 'LuckyClover',
        'title'       => 'LuckyClover | 官方网站',
        'description' => 'LuckyClover Minecraft 服务器官网，查看服务器状态、活动公告、加入方式与玩家文档。',
        'keywords'    => 'LuckyClover, Minecraft, 我的世界, 基岩版服务器, Java服务器',
        'favicon'     => 'images/cd.ico',
        'copyright'   => '© 2026 LuckyClover. All Rights Reserved.',
    ],

    // 导航菜单
    'nav' => [
        ['url' => '/',          'label' => '首页'],
        ['url' => 'docs',       'label' => '文档'],
        ['url' => 'huodong',    'label' => '活动'],
        ['url' => 'team',       'label' => '团队'],
        ['url' => 'status',     'label' => '服务器状态'],
        ['url' => 'note',       'label' => '最新动态'],
    ],

    // 文档侧边栏
    'docs_nav' => [
        ['url' => 'docs',              'label' => '文档首页'],
        ['url' => 'docs-overview',     'label' => '概览'],
        ['url' => 'docs-server-info',  'label' => '服务器信息'],
        ['url' => 'docs-command-guide','label' => '指令说明'],
        ['url' => 'docs-rules',        'label' => '玩家守则'],
        ['url' => 'docs-guide',        'label' => '新手指南'],
        ['url' => 'docs-faq',          'label' => '常见问题'],
    ],

    // 服务器列表
    'servers' => [
        'bedrock' => [
            'name'    => 'LuckyClover',
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
        'password' => getenv('LUCKYCLOVER_ADMIN_PASSWORD') ?: 'change-me-now',
    ],
];
