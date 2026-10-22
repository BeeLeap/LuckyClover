# Deploying LuckyClover

This site is deployed by GitHub Actions over SSH.

## Server setup

On the server, install Nginx and create the website directory:

```bash
sudo apt update
sudo apt install nginx rsync -y
sudo mkdir -p /var/www/luckyclover
sudo chown -R "$USER:$USER" /var/www/luckyclover
```

Example Nginx + PHP-FPM config:

```nginx
server {
    listen 80;
    server_name lcy.beeeeeawa.top;

    root /www/wwwroot/lcy.beeeeeawa.top;
    index index.php;

    location / {
        try_files $uri $uri/ $uri.php /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    }

    location ~ /\. { deny all; }
}
```

在宝塔/1Panel 中确认 PHP-FPM 版本和 `fastcgi_pass` socket 路径与服务器一致，然后 reload Nginx。生产环境还需要设置数据库和 `LUCKYCLOVER_ADMIN_PASSWORD` 环境变量，或部署不提交的 `includes/config.local.php`。

## GitHub Secrets

当前 workflow 使用 SSH 密码登录。请在 `Settings -> Secrets and variables -> Actions` 中配置：

```text
DEPLOY_HOST=your.server.ip.or.domain
DEPLOY_USER=your-ssh-user
DEPLOY_PORT=22
DEPLOY_PATH=/var/www/luckyclover
DEPLOY_PASSWORD=the-SSH-password-used-for-deploy
```

`DEPLOY_PORT` can stay `22` unless your server uses a custom SSH port.

## SSH key

The current workflow authenticates with an SSH password, so configure `DEPLOY_PASSWORD` in GitHub Actions secrets. If you later switch the workflow to key-based authentication, update this section and the workflow together.

After that, every push to `main` deploys the website automatically. You can also run it manually from the GitHub Actions tab.

## Local configuration

The deployment uses `rsync --delete`, so server-only files must be explicitly excluded from synchronization. The workflow preserves:

```text
includes/config.local.php
```

Create that file on the server from `includes/config.local.example.php` and fill in the MySQL and administrator settings. Do not commit `config.local.php`; it is listed in `.gitignore` and excluded from the deployment workflow.
