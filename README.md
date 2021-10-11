# meal_app

## About This App
* 食事投稿アプリ
* https://github.com/elites-team/camp202109-laravel/blob/master/doc/08_laravel/07_hare_blog/exercise/meal_app/01.md

## 性能チェック
* 講義中にお気に入り(Likeテーブル)に関する性能の話があったので、確認してみました
* faker&seederで10万件ほどデータを用意し、性能をチェック
* 結論、レスポンスタイムは問題なし
* SQLについて、Likeテーブルの索引(外部キー索引)が効き、ちゃんとIndexScanになっていました
```
mysql> explain select * from `likes` where `likes`.`post_id` in (801, 802, 803, 804);
+----+-------------+-------+------------+-------+-----------------------+-----------------------+---------+------+------+----------+-----------------------+
| id | select_type | table | partitions | type  | possible_keys         | key                   | key_len | ref  | rows | filtered | Extra                 |
+----+-------------+-------+------------+-------+-----------------------+-----------------------+---------+------+------+----------+-----------------------+
|  1 | SIMPLE      | likes | NULL       | range | likes_post_id_foreign | likes_post_id_foreign | 8       | NULL | 4000 |   100.00 | Using index condition |
+----+-------------+-------+------------+-------+-----------------------+-----------------------+---------+------+------+----------+-----------------------+
1 row in set, 1 warning (0.00 sec)
```

## 画面

### 一覧画面

![index01](./doc/images/index_01.png)

![index02](./doc/images/index_02.png)

### 登録画面

![create01](./doc/images/create_01.png)

![create02](./doc/images/create_02.png)

### 詳細画面(ログイン済)

自分の投稿
![show01](./doc/images/show_01.png)

![show02](./doc/images/show_02.png)

他の人の投稿
![show03](./doc/images/show_03.png)

![show04](./doc/images/show_04.png)

お気に入り済
![show05](./doc/images/show_05.png)

未ログイン
![show06](./doc/images/show_06.png)

### 編集画面

![edit01](./doc/images/edit_01.png)

![edit02](./doc/images/edit_02.png)
