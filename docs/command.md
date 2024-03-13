## やるべきこと

1: .env ファイルの作成
.env ファイルは太郎広大の google drive を参照

.env ファイルは notion を参照
DB 設計(.env)

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

---

## How to deploy

main ブランチに push すると自動でデプロイされるようになっています。
以下のようにdevelop to mainのPRを作成してmergeしてください。
https://github.com/YamamotoNagito/l10dev/pull/441

### 細かい操作コマンド

#### DB への初期データ格納

太郎広大の google drive から以下の csv ファイルを取ってくる

```
lectures.csv
lectureDetailTimes.csv
lectureLables.csv
labels.csv
lectureDetails.csv
```

`database`配下に`csv`というフォルダ名でフォルダを作成し，上記の csv ファイルを格納

##### DB の再起動コマンド

```
php artisan migrate:fresh --seed
```

##### Docker の再起動コマンド

```
docker-compose down
docker-compose build; docker-compose up -d
```

##### Docker の mysql コマンド

1. ログインコマンド

```
mysql -h l10dev-mysql -u root -p
```

この後に求められるパスワードは`root`

2. データベース選択

```
use l10dev
```

3.  全体のテーブルを確認する

```
show tables;
```

3. (例)格納された授業データを確認する

```
select * from lectures;
```

#### docker 関連のコマンド

Makefile に記載されているコマンドを実行することで，docker の操作を行うことができます。
Makefile が入っていない場合は DL してください。

```bash
# l10dev-app のログを確認する
$ make app.logs
# l10dev-app のコンテナに入る
$ make app.shell
```
