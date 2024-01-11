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

.envファイルは下記のリンク（notionを参照）

2:Docker Desktopのインストール
以下のページを参考にDockerをインストールすること
https://www.notion.so/DB-5c5bab8907474e24b27562974032a0fb?pvs=4#06a18740bf624dbdb978ac99ce4b87ba

手順1: wsl2のインストール(windowsのみ)
手順2: Docker Desktopのインストール

3: このリポジトリに移動してくる

3: Dockerの起動
```
docker-compose up -d
```

nginxが起動しない場合，以下にファイルを新規作成
```
docker/nginx/logs/access.log
```

4: Dockerのappサーバーに入る
参考サイト:https://qiita.com/hitotch/items/869070c3a9f474a358ea#comment-8632d9b827cb0190f769
```
docker compose exec l10dev-app bash
```

(追記：記事を参考にappサーバーに入った後以下のコマンドを打つ)
```
cd/src
```

5: サーバーには入れたら、comoposer・npmのインストールなどを行う
初回
```
php artisan key:generate
composer install
composer require spatie/laravel-permission
npm install
npm install --save-dev vue @vitejs/plugin-vue
php artisan migrate:fresh --seed
npm run dev
```

2回目以降
```
composer install
php artisan migrate
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
