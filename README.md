<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## やるべきこと
1: .envファイルの作成
.env .exampleをコピーして、.envファイルを作成する

2:Docker Desktopのインストール
以下の記事を参考にDockerをインストールすること
https://chigusa-web.com/blog/windows%E3%81%ABdocker%E3%82%92%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB%E3%81%97%E3%81%A6python%E7%92%B0%E5%A2%83%E3%82%92%E6%A7%8B%E7%AF%89/

手順1: wsl2のインストール(windowsのみ)
手順2: Docker Desktopのインストール

3: このリポジトリに移動してくる

3: Dockerの起動
```
docker-compose up -d
```

nginxが起動しない場合
```
docker/nginx/logs/access.log
```
を作成

4: Dockerのappサーバーに入る
参考サイト:https://qiita.com/hitotch/items/869070c3a9f474a358ea#comment-8632d9b827cb0190f769
```
docker compose exec l10dev-app bash
```

5: サーバーには入れたら、comoposer・npmのインストールなどを行う
初回
```
php artisan key:generate
composer install
npm install 
npm install --save-dev vue @vitejs/plugin-vue
npm run dev
```

2回目以降
```
composer install
npm install 
npm run dev
```

6: localhost:9001を確認して、画面が移っていれば成功
もしエラーがあれば連絡ください

※vueの導入に関するサイトは以下
https://qiita.com/yuto_dev/items/d1cc909897ac8277baea

※Dockerの再起動コマンド
```
docker-compose down
docker-compose build; docker-compose up -d
```
