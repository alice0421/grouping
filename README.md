# ランダム性を持った自動グループ分け

## 各Routing
- `GET /groups`
  - グループ一覧表示画面。用途をクリックすると、各グループの詳細画面（グループ分け結果画面）に遷移する。
- `GET /group/create`
  - グループ分け画面。「用途、グループ数、（任意）グループ名、メンバー」を入力する。
  - 用途は必須。
  - グループ数は必須。ボタンを押して値を増減させる。グループ名のinputタグの数と連動している。
  - グループ名は任意。グループ名を記載しなかった場合、数字が１から順に振られる。この際の番号の振られ方は、配列のindex番号に一致。
  - メンバーは1人以上必須。
- `GET /groups/{maker}`
  - 各グループの詳細画面（グループ分け結果画面）。「用途、メンバー数、グループ数、グループごとの名前とメンバーの表」を表示。
- `POST /groups`
  - グループ分け+グループ保存機能。保存が完了すると、作成したグループの詳細画面にリダイレクトする。

## 実装順
※ [GitHubのコミット履歴](https://github.com/alice0421/grouping/commits/master/src)を見たらなんとなくわかるかと。
<br>
※ やったことの順番を以下に書いています。どのように弄ったかは、上記コミット履歴か実際のファイルを見てみてください。

1. マイグレーションファイルとシーディングファイルの作成。
   - マイグレーションファイルは以下の順番で作成（リレーションの関係上）。
       1. src/database/migrations/2014_10_12_000000_create_users_table.php
       2. src/database/migrations/2023_05_25_015113_create_makers_table.php
       3. src/database/migrations/2023_05_25_015123_create_members_table.php
       4. src/database/migrations/2023_05_25_015134_create_groups_table.php
   - ./src/database/seeders/UserSeeder.phpの作成（`migrate:fresh`するたびにユーザー登録するのが面倒だったため作成）。 
2. 各テーブルのモデルを作成し、リレーション関係を追記。
   - src/app/Models/Group.php
   - src/app/Models/Maker.php
   - src/app/Models/Member.php
   - src/app/Models/User.php（デフォルトで作成済みのため、リレーション関係のみ追記）
3. グループ作成画面を作成。
   - src/routes/web.phpに`GET /groups/create`を追記。
   - src/app/Http/Controllers/GroupController.phpの`create`メソッドを追記。
   - src/resources/views/groups/create.blade.phpの作成。
4. ランダム性のあるグループ作成のアルゴリズム作成。
   - src/routes/web.phpに`POST /groups`を追記。
   - src/app/Http/Controllers/GroupController.phpの`store`メソッドを追記。
     - ランダム性のあるグループ作成のアルゴリズムは、src/app/Models/Group.phpの`makeGroups`メソッドに記述。
     - グループのデフォルトの名前（グループ名を入力していなかった場合）のために行う処理を、src/app/Models/Group.phpの`formatGroupName`メソッドに記述。
       - グループ名を記載しなかった場合、数字が１から順に振られる。この際の番号の振られ方は、配列のindex番号に一致。
5. グループ分け保存機能作成。
   - src/app/Http/Controllers/GroupController.phpの`store`メソッドを追記。
     - 保存機能は、src/app/Models/Group.phpの`storeGroups`メソッドに記述。
   - モデルに$fillableの記述を追記（保存処理のため）。
     - src/app/Models/Group.php
     - src/app/Models/Maker.php
     - src/app/Models/Member.php
     - src/app/Models/User.php
6. グループ詳細画面（グループ分け結果画面）の作成。
   - src/routes/web.phpに`GET /groups/{maker}`を追記。
   - src/app/Http/Controllers/GroupController.phpの`show`メソッドを追記。
   - src/resources/views/groups/show.blade.phpの作成。
7. グループ一覧画面の作成。
   - src/routes/web.phpに`GET /groups`を追記。
   - src/app/Http/Controllers/GroupController.phpの`index`メソッドを追記。
     - ペジネーションのために、src/app/Models/Maker.phpに`getByPagination`メソッドを追記。
   - src/resources/views/groups/index.blade.phpの作成。
8. ログイン直後のホーム画面をグループ一覧画面に遷移するように変更。
   - src/app/Providers/RouteServiceProvider.phpの`HOME`を`/groups`に変更。
9. グループ一覧とグループ詳細画面に削除機能を実装。
   - リレーション関係のすべてのデータを削除させるため、membersテーブルにmaker_idを追加。

