<div align="center">
  <a href="https://hirodai-kaede.com/">
    <img alt="kaede" src="https://github.com/YamamotoNagito/l10dev/blob/feature/%23484_readme/resources/assets/img/kaedeIcon.png">
  </a>
</div>

<h2 align="center">
  広島大学授業レビューサイト
</h2>

<p align="center">
  <a href="https://www.hiroshima-u.ac.jp/iagcc/news/80635">プロジェクト概要</a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 使用技術一覧

<!-- シールド一覧 -->
<!-- 該当するプロジェクトの中から任意のものを選ぶ-->
<p style="display: inline">
  <!-- フロントエンドのフレームワーク一覧 -->
  <img src="https://img.shields.io/badge/-vue.js-000000.svg?logo=vue.js&style=for-the-badge">
  <img src="https://img.shields.io/badge/-vuetify-000000.svg?logo=vuetify&style=for-the-badge">
  <!-- バックエンドのフレームワーク一覧 -->
  <img src="https://img.shields.io/badge/-Laravel-092E20.svg?logo=laravel&style=for-the-badge">
  <!-- バックエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-PHP-F2C63C.svg?logo=php&style=for-the-badge">
  <!-- ミドルウェア一覧 -->
  <img src="https://img.shields.io/badge/-Nginx-269539.svg?logo=nginx&style=for-the-badge">
  <img src="https://img.shields.io/badge/-MySQL-4479A1.svg?logo=mysql&style=for-the-badge&logoColor=white">
  <!-- インフラ一覧 -->
  <img src="https://img.shields.io/badge/-Docker-1488C6.svg?logo=docker&style=for-the-badge">
  <img src="https://img.shields.io/badge/-githubactions-FFFFFF.svg?logo=github-actions&style=for-the-badge">
</p>

## 開発環境構築

1: .env ファイルの作成

2:Docker Desktop のインストール
以下の記事を参考に Docker をインストールすること
https://chigusa-web.com/blog/windows%E3%81%ABdocker%E3%82%92%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB%E3%81%97%E3%81%A6python%E7%92%B0%E5%A2%83%E3%82%92%E6%A7%8B%E7%AF%89/

手順 1: wsl2 のインストール(windows のみ)
手順 2: Docker Desktop のインストール

3: このリポジトリに移動してくる

3: Docker の起動

```
docker-compose up -d
```

4: Docker の app サーバーに入る
参考サイト:https://qiita.com/hitotch/items/869070c3a9f474a358ea#comment-8632d9b827cb0190f769

```
docker compose exec l10dev-app bash
```

(追記：記事を参考に app サーバーに入った後以下のコマンドを打つ)

```
cd/src
```

5: サーバーには入れたら、comoposer・npm のインストールなどを行う
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

2 回目以降

```
composer install
php artisan migrate
npm install
npm run dev
```

6: localhost:9001 を確認して、画面が移っていれば成功
もしエラーがあれば連絡ください

※vue の導入に関するサイトは以下
https://qiita.com/yuto_dev/items/d1cc909897ac8277baea
