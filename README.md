## このリポジトリについて

PGroongaの全文検索を使うとLIKE検索よりも、何故か検索が遅いのを確かめるデモ

## 使い方

```
git clone このURL
cd proontest
composer install
cp .env.example .env

php artisan key:generate

vi .env

---こちらを自環境に合わせて適当に変えてください---
DB_DATABASE=proontest
DB_USERNAME=root
DB_PASSWORD=
-------------------------------------------

PGroongaのExtensionをDB作成時に手動で入れてる人は
database/migrations/2022_05_27_create_posts_table.phpの下記をコメントアウトしてご利用ください。
  DB::statement("CREATE EXTENSION pgroonga;"); 


下記コマンドでDB作成とサンプルデータを流し込みます（20万レコード流し込むので少し時間がかります。1〜2分程度。）
php artisan migrate --seed


php artisan serve

http://127.0.0.1:8000 にアクセス
```

## SQLの処理時間確認

http://localhost:8000 にアクセス後「LIKE検索」と「&@~全文検索」をそれぞれ
クリックして検索速度の違いを画面下のDebugBarにあるQueriesからご確認ください。
PGroongaの全文検索である&@~が妙に遅いです。


## インデックスの指定ミス

単純にデータ項目に応じたインデックス指定が出来ておりませんでした。

- varcharには pgroonga_varchar_full_text_search_ops_v2 を指定する必要あり
- textの場合は特に指定不要でOK

下記に修正版ブランチを作成しました
[修正版ブランチ](https://github.com/askdkc/proontest/tree/pgindexfix)

以下のやり方でお試しください
```
git checkout pgindexfix

dropdb proontest
createdb proontest

php artisan migrate --seed

php artisan serve

http://127.0.0.1:8000 にアクセス
```

