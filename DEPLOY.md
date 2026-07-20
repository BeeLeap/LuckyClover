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

Example Nginx config:

```nginx
server {
    listen 80;
    server_name lcy.beeeeeawa.top;

    root /www/wwwroot/lcy.beeeeeawa.top;
    index index.html;

    error_page 404 /404.html;

    location = /404.html {
    }

    location = /index.html {
        return 301 /;
    }

    location = / {
        try_files /index.html =404;
    }

    location / {
        try_files $uri $uri.html $uri/ /404.html;
    }
}
```

In BaoTa, open the site config for `lcy.beeeeeawa.top`, replace the old extensionless URL rules with this block, then reload Nginx.

## GitHub Secrets

Add these in `Settings -> Secrets and variables -> Actions -> New repository secret`:

```text
DEPLOY_HOST=your.server.ip.or.domain
DEPLOY_USER=your-ssh-user
DEPLOY_PORT=22
DEPLOY_PATH=/var/www/luckyclover
DEPLOY_SSH_KEY=the-private-key-used-for-deploy
```

`DEPLOY_PORT` can stay `22` unless your server uses a custom SSH port.

## SSH key

Create a deploy key on your computer:

```bash
ssh-keygen -t ed25519 -C "luckyclover-deploy" -f ~/.ssh/luckyclover_deploy
```

Put the public key on the server:

```bash
ssh-copy-id -i ~/.ssh/luckyclover_deploy.pub your-ssh-user@your.server.ip
```

Put the private key content into the GitHub secret `DEPLOY_SSH_KEY`:

```bash
cat ~/.ssh/luckyclover_deploy
```

After that, every push to `main` deploys the website automatically. You can also run it manually from the GitHub Actions tab.
