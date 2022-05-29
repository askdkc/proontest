## 使い方

```
git clone このURL
cd proontest
composer install
cp .env.example .env

vi .env

---こちらを自環境に合わせて適当に変えてください---
DB_DATABASE=proontest
DB_USERNAME=root
DB_PASSWORD=
-------------------------------------------

PGroongaのExtensionが入っていない人は
database/migrations/2022_05_27_create_posts_table.phpの下記コメントアウト部分を外してご利用ください。
 // DB::statement("CREATE EXTENSION pgroonga;"); 


下記コマンドでDB作成とサンプルデータを流し込みます（20万レコード流し込むので少し時間がかります）
php artisan migrate --seed


php artisan serve

http://localhost:8000 にアクセス
```

## JSONB形式

JSONB形式に対しての全文検索サンプル

- jsonbには pgroonga_jsonb_ops_v2 を指定する必要あり
- &@~を使用した全文検索の場合、jsonbの各項目に個別にインデックス生成が必要でスキーマレスには不向き


以下のやり方でお試しください
```
git checkout jsonb

dropdb proontest
createdb proontest

php artisan migrate --seed

php artisan serve

http://127.0.0.1:8000 にアクセス
```
