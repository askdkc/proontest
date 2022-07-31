## pgroonga_query_extract_keywordsの書き方で重たくなるサンプル

pgroonga_query_extract_keywordsの呼び出し場所が悪いとデータ量が多い時にページネーションとか重たくなってPostgreSQLが死んじゃうテスト。

### 再現用に作成したこの "synonyms" ブランチを使ってね
```
git clone このURL
cd proontest

git checkout -b synonyms origin/synonyms

composer install
cp .env.example .env

vi .env

---こちらを自環境に合わせて適当に変えてください---
DB_DATABASE=proontest
DB_USERNAME=root
DB_PASSWORD=
-------------------------------------------

下記コマンドでDB作成とサンプルデータを流し込みます（20万レコード流し込むので少し時間がかります）
php artisan migrate --seed


php artisan serve

http://localhost:8000 にアクセス

LIKE検索->通常のLike中間一致

PGroonga 同義語検索->pgroonga_query_extract_keywordsの呼び出し場所が悪いとデータ量が多い時にページネーションとか重たくなってPostgreSQLが死んじゃうテスト。

→ M1 Macbook Airでは耐えれたけど、いきなり死んだら
databse/seeders/DatabaseSeeder.php のダミーレコード数調整してください
```
