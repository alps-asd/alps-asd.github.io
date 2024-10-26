---
layout: docs-ja
title: プロンプト
category: Manual
permalink: /manuals/1.0/ja/prompt.html
---

# プロンプト
OpenAPI、GraphQL、SQLなど、システムの具体的な実装定義は多くの詳細を含むため煩雑になりがちです。一方、ALPSはセマンティックな記述によって、システムのコアとなる情報設計を抽象度高く表現できます。

## ALPSプロファイルを作成

Chat-GPT PlusユーザーはALPS Assistantを利用することができます。ALPS Assistantでは適切なALPSプロファイルがAIによって生成されるようにあらかじめAIにインストラクションが与えられています。

- [ALPS Assistant](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant)

あるいは、ALPSプロファイルをAIで生成する時に以下のプロンプトを使うことができます。このプロンプトに従うことで、後述するプロンプトでの変換に適した、一貫性のあるALPSプロファイルを作成できます。

- [ALPS](#alps)

## ALPSプロファイルを変換

OpenAPI、GraphQL、SQLなど、システムの具体的な実装定義は多くの詳細を含むため煩雑になりがちです。一方、ALPSはセマンティックな記述によって、システムのコアとなる情報設計を抽象度高く表現することができます。

この抽象的な表現は、AIとの効率的なコミュニケーションを可能にし、API仕様、データベーススキーマ、型定義など、様々な具体的な実装形式への変換を容易にします。ここで紹介するプロンプトを活用することで、ALPSから各種実装定義を効率的に生成できます。

- [OpenAPI](#openapi)
- [JSON Schema](#jsonスキーマ)
- [GraphQL](#graphql)
- [SQL](#sql)
- [TypeScript type definitions](#typescript-type-definitions)

## ALPS

<pre style="font-size: x-small">
# ALPSプロファイル作成プロンプト

後述するガイドラインに基づいて以下の要件のALPSプロファイルを作成してください

* 形式: [XML|JSON]
* 内容: [作成するプロファイルの説明]

## ‼️ 重要：JSON形式の記述ルール ‼️

1. descriptorは1つを1行で記述（必須）
2. descriptorがdescriptorを含む場合のみ、含まれる部分をインデントして改行
3. 含まれるdescriptorは必ずhrefで参照

```json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "type": "semantic", "title": "Name", "def": "https://schema.org/name"},
{"id": "email", "type": "semantic", "title": "Email", "def": "https://schema.org/email"},
{"id": "User", "type": "semantic", "title": "User Profile", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "type": "semantic", "title": "User List", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "View User Details", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "Create User", "rt": "#UserList"}
]}}
```

## XML形式の記述ルール

- インデントを使用して階層構造を表現
- 1要素1行の形式で記述
```xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
```

## セマンティックディスクリプタの構造化

以下の3つのブロックに分けて記述します。全てのdescriptorは他のdescriptorから参照されるか、他のdescriptorを含む必要があります：

1. 意味定義（オントロジー）
   - 基本要素の定義（小文字始まりのローワーキャメルケース）
   - Schema.Orgの定義がある場合は必ずdefを指定（完全なURL）
   - 全てのdescriptorにtitleを付与
   - 必要な場合のみdocを追加
   - ここで定義した要素は必ずタクソノミーのいずれかの状態から参照される

2. 包含関係（タクソノミー）
   - 状態を表すディスクリプタは大文字始まりのアッパーキャメルケース
   - 要素を参照する場合は必ずhrefを使用（id属性での直接定義は不可）
   - 各アプリケーション状態には以下を含める：
     * その状態で表示/使用する要素（オントロジーで定義したもの）
     * その状態で実行可能な操作（コレオグラフィーで定義したもの）
   - 必要な場合のみdocで詳細を説明
   - ここで定義したタクソノミーは他のタクソノミーから含まれいているか遷移ができる

3. 状態遷移（コレオグラフィー）
   - 遷移操作の定義
   - 適切なtype属性の選択
   - rt（遷移先）の明示
   - 操作に必要なデータ項目をhrefで参照
   - ここで定義した操作は必ずタクソノミーのいずれかの状態から参照される

## type属性の選択基準

1. safe
   - 読み取り専用の操作
   - プレフィックス: "go"
   - 例：`goUserProfile`
   - 別の状態への遷移を表す

2. idempotent
   - 同じ操作を複数回実行しても結果が変わらない操作
   - プレフィックス: "do"
   - 例：`doUpdateUser`, `doDeleteUser`
   - PUTやDELETEによる操作

3. unsafe
   - 実行のたびに異なる結果となる可能性がある操作
   - プレフィックス: "do"
   - 例：`doCreateUser`
   - POSTによる新規作成など
   - **注意**: 可能な限りidempotentを使用し、本当に必要な場合のみunsafeを使用

## descriptor属性の使用ガイドライン

1. 必須属性
   - id: 一意の識別子（または href）
   - title: 人間が読むための表示名

2. 条件付き属性
   - def: schema.orgの定義が存在する場合は必ず指定
   - doc: 追加の説明が必要な場合のみ使用
   - rt: 状態遷移を伴う操作の場合は必須
   - rel: IANAで定義されたリレーションがある場合は指定
　 - tag: 適切なグルーピングを行う

## チェックリスト

### フォーマット共通
- [ ] スキーマ参照とバージョン情報が含まれている
- [ ] 全てのdescriptorにtitleが付与されている
- [ ] Schema.Orgの定義が存在する要素には完全なURLでdefを指定している
- [ ] 状態遷移の命名規則が正しい（go/doプレフィックス）
- [ ] typeの選択が適切（特にidempotentとunsafeの区別）
- [ ] 3つのブロック（オントロジー・タクソノミー・コレオグラフィー）が明確に分かれている
- [ ] ケース規則が正しい（状態は大文字始まり、要素は小文字始まり）
- [ ] 要素の参照は全てhrefを使用している（id属性での直接定義はしない）
- [ ] 各アプリケーション状態が適切に定義され、実行可能な操作を含んでいる
- [ ] 全ての操作に適切な遷移先（rt）が指定されている

### 関係性の検証（必須）
- [ ] ‼️ 全てのdescriptorが他のdescriptorから参照されているか、他のdescriptorを含んでいる
- [ ] ‼️ オントロジーで定義した要素が全てタクソノミーのいずれかの状態から参照されている
- [ ] ‼️ コレオグラフィーで定義した操作が全てタクソノミーのいずれかの状態から参照されている
- [ ] ‼️ タクソノミーで定義した要素は他のタクソノミーのいずれかに含まれているか、繊維が可能
- [ ] ‼️ 孤立したdescriptorは存在しない。

### JSON形式の場合（必須）
- [ ] ‼️ descriptorは1つを1行で記述している（必須）
- [ ] descriptorがdescriptorを含む場合のみ、含まれる部分をインデントして改行している
- [ ] プロパティ名にダブルクォートを使用している

### XML形式の場合
- [ ] 適切にインデントされている

</alps>
</pre>

## OpenAPI

<pre style="font-size: x-small">
**タスク:** 提供されたALPS（Application-Level Profile Semantics）ファイルをOpenAPI 3.0の定義ファイル（YAML形式）に変換してください。

```alps
_YOUR_ALPS_HERE_
```

**考慮すべき重要なポイント:**

1. **Descriptor要素:**
    - **`descriptor`の理解:** ALPSでは、`descriptor`はデータ要素や状態遷移を表す意味的な要素です。
    - **OpenAPIパスと操作へのマッピング:**
        - 状態遷移（`type`が`safe`、`unsafe`、`idempotent`の`descriptor`）は、適切なHTTPメソッド（`GET`、`POST`、`PUT`、`DELETE`）の下にOpenAPI操作としてマッピングします。
        - 冪等性のある操作には`PUT`または`DELETE`を使用します。
        - `DELETE`操作にはリクエストボディを含めません。

2. **コンポーネントと再利用性:**
    - **スキーマとパラメータ:**
        - データ要素のディスクリプタ（`type`が`semantic`のもの）を抽出し、`components/schemas`の下で再利用可能なスキーマとして定義します。
        - これらのスキーマをリクエストボディやレスポンスで適用します。
    - **共通パラメータ:**
        - 共通のパラメータ（例: ID、クエリパラメータ）を特定し、再利用のために`components/parameters`の下に定義します。

3. **レスポンスとステータスコード:**
    - **適切なステータスコード:**
        - 正常に取得できた場合には`200 OK`を使用します。
        - 新しいリソースが作成された場合には`201 Created`を使用します。
        - コンテンツを返さない成功した操作には`204 No Content`を使用します。
        - エラーハンドリングには`400 Bad Request`、`404 Not Found`などを使用します。
    - **レスポンススキーマ:**
        - 先に定義したコンポーネントを使ってレスポンススキーマを定義します。

4. **データの制約:**
    - **バリデーション:**
        - データの制約を追加します。
            - **文字列の制約:** `minLength`、`maxLength`、`pattern`（正規表現）
            - **数値の制約:** `minimum`、`maximum`
            - **列挙:** 固定値の集合に対して`enum`
    - **制約の適用:**
        - `components/schemas`内のスキーマにこれらの制約を適用します。

5. **リンクと外部ドキュメント:**
    - **リンクの関係:**
        - `descriptor`が`href`または`rel`を含む場合、OpenAPIの`externalDocs`または`links`を使って関係を表現します。
    - **説明:**
        - ALPSの`doc`要素を使用して、操作、パラメータ、スキーマの説明を提供します。

**出力形式:**
- OpenAPI定義は**YAML**形式で提供してください。

---

**追加の注意点:**

- ALPSディスクリプタを正確にOpenAPIのパス、操作、およびコンポーネントに変換することに焦点を当ててください。
- 生成されたOpenAPIファイルが有効であり、ベストプラクティスに従うことを確認してください。
- OpenAPI定義に貢献しないALPSファイルの不要な情報は含めないでください。
</pre>

## JSONスキーマ

<pre style="font-size: x-small">
**タスク:** 提供されたALPS（Application-Level Profile Semantics）ファイルをJSONスキーマ定義に変換してください。

**考慮すべき重要なポイント:**

1. **ディスクリプタ要素:**
    - **`descriptor`の理解:** ALPSでは、`descriptor`は意味的な要素を表します。
    - **JSONスキーマへのマッピング:**
        - データ要素（`type`が`semantic`の`descriptor`）をJSONスキーマのプロパティにマッピングします。
        - データ要素の性質に基づいて適切なJSONスキーマタイプを使用します。

2. **スキーマ構造:**
    - **ルートスキーマ:**
        - `$schema`および`type`プロパティを持つルートスキーマを定義します。
        - `title`や`description`などの適切なメタデータを含めます。
    - **プロパティ:**
        - ALPSディスクリプタに基づいてプロパティを定義します。
        - `properties`や`items`を使って入れ子構造を整理します。

3. **データ型とフォーマット:**
    - **基本タイプ:**
        - 適切なJSONスキーマタイプを使用します:
            - `string`
            - `number`
            - `integer`
            - `boolean`
            - `object`
            - `array`
    - **フォーマット:**
        - 適用可能な標準フォーマットを適用します:
            - `date-time`
            - `date`
            - `email`
            - `uri`
            - etc.

4. **データ制約:**
    - **バリデーションルール:**
        - 以下のような制約を追加します:
            - **文字列:** `minLength`、`maxLength`、`pattern`
            - **数値:** `minimum`、`maximum`、`multipleOf`
            - **配列:** `minItems`、`maxItems`、`uniqueItems`
            - **オブジェクト:** `required`、`additionalProperties`
    - **列挙:**
        - 固定値の集合には`enum`を使用します
        - 列挙値の説明を含めます

5. **定義と参照:**
    - **再利用可能なコンポーネント:**
        - `$defs`の下に共通スキーマを定義します
        - 再利用可能なスキーマを`$ref`で参照します
    - **継承:**
        - 複雑な型の関係には`allOf`、`anyOf`、`oneOf`を使用します

6. **ドキュメンテーション:**
    - **説明:**
        - ALPSの`doc`要素を使用して、スキーマおよびプロパティの説明を提供します
    - **例:**
        - 助けになる場合は`examples`を含めます
    - **タイトル:**
        - プロパティおよび定義に明確なタイトルを追加します

**出力形式:**
- JSONスキーマは標準のJSON形式で提供してください
- 読みやすさのために適切にインデントを使用してください

**追加の要件:**
- スキーマはJSONスキーマドラフト2020-12に対して有効である必要があります
- 適切な`required`プロパティを含めてください
- 意味のあるプロパティ名を使用してください
- 複雑なバリデーションやビジネスルールに関するコメントを追加してください
</pre>

## SQL

<pre style="font-size: x-small">
**タスク:** 提供されたALPS（Application-Level Profile Semantics）ファイルをSQLのDDL（データ定義言語）およびDML（データ操作言語）ステートメントに変換してください。

```alps
_YOUR_ALPS_HERE_
```

**パート1: DDLステートメント**

1. **スキーマとテーブル設計:**
   - **データベーススキーマ:**
      - ALPSプロファイルに基づいて適切なデータベーススキーマ名を作成
      - スキーマのバージョン管理の考慮を含めます
   - **テーブル作成:**
      - `type`が`semantic`のALPSディスクリプタをデータベーステーブルにマッピング
      - テーブル間のリレーションシップを通じてネストされた構造を扱います

**パート2: DMLステートメント生成**

1. **SELECTクエリ:**
    - **基本クエリ:**
        - 各主要リソースに対してSELECTステートメントを生成
        - リレーションシップに基づいて適切なJOIN句を含める
        - WHERE句でフィルタリング
        - ページネーション（LIMIT/OFFSET）を考慮

    - **複雑なクエリ:**
        - 複数のJOINを持つクエリを作成
        - 必要に応じてサブクエリを追加
        - 集約関数（COUNT、SUMなど）を含める
        - GROUP BYおよびHAVING句を実装

    - **ビュークエリ:**
        - 有用なビュー定義を生成
        - パフォーマンス向上のためのマテリアライズドビューを作成

2. **INSERTステートメント:**
    - 次の要素を含むINSERTステートメントを生成:
        - 単一行の挿入
        - バルク挿入テンプレート
        - INSERT ... SELECTパターン
        - 適用可能な場合にはRETURNING句

3. **UPDATEステートメント:**
    - 次のテンプレートを作成:
        - 単一レコードの更新
        - バルク更新
        - JOINを含む更新
        - 条件付き更新

    - 含めるもの:
        - 安全な更新のためのWHERE句
        - UPDATEトリガーの考慮
        - 楽観的ロックのパターン

4. **DELETEステートメント:**
    - 次の要素を含むDELETEステートメントを生成:
        - 安全な削除パターン
        - ソフトデリートの実装
        - カスケード削除の考慮
        - アーカイブ戦略

5. **トランザクションパターン:**
    - 次のためのトランザクションテンプレートを作成:
        - 複雑な操作
        - データの一貫性
        - エラーハンドリング
        - ロールバックシナリオ

6. **共通クエリパターン:**
    - **検索:**
        - フルテキスト検索クエリ
        - パターンマッチング（LIKE/ILIKE）
        - ファジーマッチング

    - **レポート:**
        - サマリークエリ
        - 時間ベースの集計
        - クロステーブルの分析

    - **監査:**
        - 変更追跡クエリ
        - 履歴の閲覧
        - アクティビティログ

**出力形式の要件:**

1. **DDL形式:**
    - 完全なCREATEステートメント
    - インデックス定義
    - 制約定義
    - 設計決定を説明するコメントブロック

2. **DML形式:**
    - パラメータ化されたクエリ（`:param`または`$n`記法）
    - 複雑なロジックを説明するコメント
    - パフォーマンスの考慮
    - 予想されるインデックスの使用

3. **クエリの組織化:**
    - 関連するクエリをグループ化
    - ユースケースの説明を含める
    - 期待される結果を文書化
    - 特定のデータベースエンジンの要件を記載

**追加の考慮事項:**

1. **パフォーマンス:**
    - インデックスの使用ヒント
    - EXPLAINプランの考慮
    - クエリの最適化提案
    - バッチ処理パターン

2. **セキュリティ:**
    - SQLインジェクション防止
    - 権限要件
    - 行レベルのセキュリティパターン
    - 監査トレイルの実装

3. **メンテナビリティ:**
    - 明確なクエリ構造
    - 一貫した命名規則
    - 再利用可能なコンポーネント（CTE、ビュー）
    - 複雑なロジックの文書化

4. **エラーハンドリング:**
    - EXCEPTIONブロック
    - トランザクション管理
    - デッドロックの処理
    - 制約違反の処理
</pre>

## GraphQL

<pre style="font-size: x-small">

**タスク:** 提供されたALPS（Application-Level Profile Semantics）ファイルを完全なGraphQL実装に変換し、スキーマ定義と操作例を含めてください。

**考慮すべき重要なポイント:**

1. **スキーマ定義:**
   - **タイプ定義:**
     - ALPSのセマンティックディスクリプタをGraphQLのタイプにマッピングします
     - 適切なスカラタイプ（ID、String、Int、Float、Boolean）を使用します
     - 必要に応じてカスタムスカラタイプを定義します（DateTime、JSONなど）
     ```graphql
     scalar DateTime
     scalar JSON

     type User {
       id: ID!
       name: String!
       email: String!
       createdAt: DateTime!
       metadata: JSON
     }
     ```

   - **リレーションシップ:**
     - 一対一、一対多、多対多のリレーションシップを扱います
     - NullableとNon-Nullableフィールドを考慮します
     ```graphql
     type Order {
       id: ID!
       user: User!
       items: [OrderItem!]!
       total: Float!
     }
     ```

   - **入力タイプ:**
     - ミューテーション用の入力タイプを作成します
     - バリデーション要件を考慮します
     ```graphql
     input CreateUserInput {
       name: String!
       email: String!
       password: String!
     }
     ```

   - **インターフェースとユニオン:**
     - 共有フィールドのためにインターフェースを定義します
     - ポリモーフィックなリレーションシップのためにユニオンを使用します
     ```graphql
     interface Node {
       id: ID!
     }

     union SearchResult = User | Order | Product
     ```

2. **クエリ操作:**
   - **基本クエリ:**
     - 単一アイテムの取得
     - フィルタリングされたリストの取得
     - 検索操作
     ```graphql
     type Query {
       user(id: ID!): User
       users(filter: UserFilter, limit: Int, offset: Int): [User!]!
       search(term: String!): [SearchResult!]!
     }
     ```

   - **フィルタリングシステム:**
     - フィルタ入力タイプを定義します
     - 複雑なフィルタリング操作をサポート
     ```graphql
     input UserFilter {
       name: StringFilter
       age: IntFilter
       AND: [UserFilter!]
       OR: [UserFilter!]
     }

     input StringFilter {
       eq: String
       contains: String
       startsWith: String
       in: [String!]
     }
     ```

   - **ページネーション:**
     - カーソルベースのページネーションを実装
     - limit/offsetページネーションをサポート
     ```graphql
     type UserConnection {
       edges: [UserEdge!]!
       pageInfo: PageInfo!
       totalCount: Int!
     }

     type UserEdge {
       node: User!
       cursor: String!
     }

     type PageInfo {
       hasNextPage: Boolean!
       hasPreviousPage: Boolean!
       startCursor: String
       endCursor: String
     }
     ```

3. **ミューテーション操作:**
   - **作成操作:**
     ```graphql
     type Mutation {
       createUser(input: CreateUserInput!): CreateUserPayload!
       updateUser(id: ID!, input: UpdateUserInput!): UpdateUserPayload!
       deleteUser(id: ID!): DeleteUserPayload!
     }

     type CreateUserPayload {
       user: User
       errors: [Error!]
     }
     ```

   - **バッチ操作:**
     ```graphql
     input BatchCreateUserInput {
       users: [CreateUserInput!]!
     }

     type BatchCreateUserPayload {
       users: [User!]!
       errors: [BatchError!]!
     }
     ```

   - **エラーハンドリング:**
     ```graphql
     type Error {
       field: String
       message: String!
       code: ErrorCode!
     }

     type BatchError {
       index: Int!
       errors: [Error!]!
     }

     enum ErrorCode {
       INVALID_INPUT
       NOT_FOUND
       UNAUTHORIZED
       INTERNAL_ERROR
     }
     ```

4. **サブスクリプション操作:**
   ```graphql
   type Subscription {
     userUpdated(id: ID): User!
     newOrder: Order!
     notifications(userId: ID!): Notification!
   }
   ```

5. **ディレクティブ:**
   ```graphql
   directive @auth(
     requires: Role = USER
   ) on OBJECT | FIELD_DEFINITION

   directive @deprecated(
     reason: String = "No longer supported"
   ) on FIELD_DEFINITION | ENUM_VALUE

   enum Role {
     ADMIN
     USER
     GUEST
   }
   ```

**パート2: 実装ガイドライン**

1. **リゾルバー構造:**
   ```typescript
   // リゾルバー構造の例
   const resolvers = {
     Query: {
       user: (parent, { id }, context) => {},
       users: (parent, { filter, limit, offset }, context) => {}
     },
     Mutation: {
       createUser: (parent, { input }, context) => {}
     },
     User: {
       orders: (parent, args, context) => {}
     }
   }
   ```

2. **コンテキストと認証:**
   ```typescript
   interface Context {
     user: User | null;
     dataSources: DataSources;
     authenticate: () => Promise<User>;
   }
   ```

3. **ベストプラクティス:**
    - N+1クエリの防止のためにDataLoaderを使用する
    - 適切なエラーハンドリングを実装する
    - 名前付けの規約に従う
    - フィールドレベルのドキュメンテーションを追加する
    - レート制限を考慮する
    - 適切な認可を実装する

**追加の考慮事項:**

1. **パフォーマンス:**
    - クエリの複雑性分析
    - フィールドレベルのコスト計算
    - キャッシュ戦略
    - バッチ最適化

2. **セキュリティ:**
    - 入力のバリデーション
    - 認可チェック
    - レート制限
    - クエリ深度の制限

3. **テスト:**
    - リゾルバーのユニットテスト
    - 操作の統合テスト
    - スキーマのバリデーションテスト
    - パフォーマンスベンチマーク

**出力形式の要件:**

1. **スキーマの組織化:**
    - 異なる関心事ごとにファイルを分ける
    - 明確なモジュール構造
    - 適切なタイプのインポート/エクスポート

2. **ドキュメンテーション:**
    - スキーマドキュメンテーション
    - 操作の例
    - ユースケース
    - エラーステナリオ

提供されたALPS文書をもとに、これらのガイドラインに従ってGraphQL実装への変換をお手伝いします。

