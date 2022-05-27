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

PGroongaのExtensionを手動で入れてる人は
database/migrations/2022_05_27_create_posts_table.phpの下記をコメントアウトしてご利用ください。
  DB::statement("CREATE EXTENSION pgroonga;"); 


下記コマンドでDB作成とサンプルデータを流し込みます（20万レコード流し込むので少し時間がかります）
php artisan migrate --seed


php artisan serve

http://127.0.0.1:8000 にアクセス
```

## SQLの処理時間確認

http://localhost:8000 にアクセス後「LIKE検索」と「&@~全文検索」をそれぞれ
クリックして検索速度の違いを画面下のDebugBarにあるQueriesからご確認ください。
PGroongaの全文検索である&@~が妙に遅いです。
