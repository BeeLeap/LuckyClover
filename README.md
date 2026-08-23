# LuckyClover

LuckyClover Minecraft 服务器官网，使用原生 PHP + MySQL，包含前台动态新闻、管理员后台和主机资源监控。

## 后台使用

- 后台地址：`/admin/login`
- 默认用户名：`admin`
- 生产环境务必设置 `LUCKYCLOVER_ADMIN_PASSWORD`，并可用 `LUCKYCLOVER_ADMIN_USER` 修改用户名。
- 后台支持新闻新增、编辑、删除以及草稿/发布状态。
- 主机指标接口：`/api/metrics`，后台每 15 秒自动刷新。

## 部署要求

- PHP 7.4+，启用 `pdo_mysql` 扩展。
- 在宝塔 MySQL 中创建数据库和独立数据库用户，并授予该数据库的完整权限。
- 设置 `LUCKYCLOVER_DB_HOST`、`LUCKYCLOVER_DB_PORT`、`LUCKYCLOVER_DB_NAME`、`LUCKYCLOVER_DB_USER`、`LUCKYCLOVER_DB_PASSWORD`。
- 也可以复制 `includes/config.local.example.php` 为 `includes/config.local.php`，填写服务器配置；该文件不会被 Git 提交。
- Apache 需要启用 `.htaccess` 和 `mod_rewrite`，也可以直接访问 `.php` 文件。
- 首次访问时会自动创建 `news` 表和一条示例新闻，数据库本身需要提前在宝塔创建。

主机监控读取运行 PHP 的这台主机的负载、内存和磁盘信息。它不等于 Minecraft 服务器进程监控；如果 Minecraft 运行在另一台机器，需要在另一台机器部署 Agent，再扩展指标接口。
