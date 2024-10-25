---
layout: docs-ja
title: 応用チュートリアル
category: Manual
permalink: /manuals/1.0/ja/tutorial_rest.html
---

# RESTアプリケーションのためのALPSチュートリアル

## はじめに

現代のWebアプリケーション（オンラインショッピング、SNS、動画配信サービス、業務システムなど）は、多くがRESTアーキテクチャに基づいて構築されています。このチュートリアルでは、RESTの基本概念を踏まえ、ALPSを用いたアプリケーション設計の方法を解説します。

### RESTアプリケーションの本質

RESTアプリケーションは本質的に「状態遷移システム」です。たとえば：

- 商品を探し、カートに入れ、注文を確定する（オンラインショッピング）
- 投稿を読み、反応し、コメントを残す（SNS）

これらの一連の行動はすべて「状態」から「状態」への移り変わり（遷移）として捉えられ、RESTアプリケーションはこの遷移を管理する仕組みです。

### 状態遷移とは

状態遷移は、あるシステムが持つ状態が別の状態に変化することを指します。Webアプリケーションでは：

1. ユーザーは常に「どこか」にいます（現在の状態）
2. そこから「どこかへ」移動できます（遷移可能な状態）
3. 「どうやって」移動するかが定義されています（遷移方法）

RESTアプリケーション2種類の重要な状態があります：

1. **アプリケーション状態**
   - クライアント（ブラウザ）側での現在の位置を示し、URLで表現されます。

2. **リソース状態**
   - サーバー側で管理されるデータの状態で、クライアントがアクセスする情報の内容です。

### RESTアプリケーションの状態遷移の基本的な流れ

RESTアプリケーションにおける状態遷移は、次のような流れで行われます：

1. 状態の認識
   - クライアントは現在の状態を把握し、利用可能な情報を理解します

2. 遷移の選択
   - 提供されているリンクや操作を確認し、次の遷移先を選択します。

3. 状態の遷移
   - 選択した操作を実行し、新しい状態へ移行します。

この流れは、アプリケーションの利用中、継続的に繰り返されます。

## 情報アーキテクチャとALPS

RESTアプリケーションを適切に設計するためには、状態遷移システムを体系的に記述する必要があります。
Dan Klynは、この記述に必要な3つの重要な側面を提唱しています：

1. オントロジー（Ontology）
   - 「何を意味するのか」を定義します
   - 例：「ブログ記事」「作成日時」という言葉の意味
   - 用語の同じ意味を共有します

2. タクソノミー（Taxonomy）
   - 「どのように関係しているか」を整理します
   - 例：「ブログ記事」は「作成日時」と「本文」を持ちます
   - 情報の構造を定義します

3. コレオグラフィー（Choreography）
   - 「どのように動作するか」を記述します
   - 例：記事の閲覧、作成、更新、削除
   - 操作の流れを示します

ALPSは、これらの概念を実践的に表現するための手段です。以降のチュートリアルでは：

1. オントロジー：基本的な用語の定義
2. タクソノミー（１）：情報構造の定義
3. コレオグラフィー：状態遷移の定義
4. タクソノミー（２）：状態と遷移の統合

の順で、具体的な実装方法を学んでいきます。

## オントロジー：用語の定義

オントロジーでは、アプリケーションで使用する言葉の意味を定義します。この段階で明確に定義することで、チーム間での共通理解が生まれ、API設計が一貫性を持つようになります。

### エディターの準備

1. ブラウザで [https://app-state-diagram.com/](https://app-state-diagram.com/) を開きます
2. 左側のエディターペインに表示されているデモコードを全て削除します

### 最初の用語を定義する

以下は「作成日時」を表す用語の定義です。

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}}
        ]
    }
}
```

この定義の各要素の意味：

1. `id`属性
   - 用語の識別子

2. `title`属性
   - 人間が理解しやすい短い説明です
   - 画面やドキュメントでの表示に使用します

3. `doc`要素
   - 用語の正確な意味や使用方法を記述します
   -形式（format属性）を指定できます

### 記事の本文を定義する

続いて、ブログ記事の本文を表す用語を追加します。

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}}
        ]
    }
}
```

### オントロジー定義のポイント

1. 命名規則
   - [セマンティック用語](semantic-terms.html)を優先して選びます
   - 一貫性のある命名パターンを使用します
   - キャメルケースを推奨（例：dateCreated, articleBody）

2. 説明の書き方
   - 簡潔で明確な説明を心がけます
   - 必要な場合は例も含めます
   - 形式や制約がある場合は明記します

## タクソノミー：情報の構造化

タクソノミーでは「情報をどのように整理・分類するか」を定義します。
先ほど定義した用語を組み合わせて、より大きな概念を表現します。

ブログ記事（BlogPosting）は、作成日時と本文を持つ情報の集まりとして定義できます。

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="ブログ記事">
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}},
            {
                "id": "BlogPosting",
                "title": "ブログ記事",
                "descriptor": [
                    {"href": "#dateCreated"},
                    {"href": "#articleBody"}
                ]
            }
        ]
    }
}
```

### 構造化のポイント

1. href による参照
   - `#`を使って既存の用語を参照
   - 同じ定義を複数回使い回せる
   - 用語の一貫性を保証

2. 階層構造の表現
   - `BlogPosting`が`dateCreated`と`articleBody`を含む
   - 含まれる要素は`descriptor`タグで表現
   - 親子関係として表現される

### プレビュー画面での確認

1. ボキャブラリリスト
   - 定義した用語が階層的に表示される
   - BlogPostingの配下に含まれる要素が表示

2. 状態遷移図（State Diagram）
   - BlogPostingが一つの状態として表示
   - この時点ではまだ遷移は定義されていない

### なぜ構造化が重要か

1. 情報の関係性の明確化
   - どの情報がどの概念に属するのか
   - 情報の依存関係の可視化

2. APIの一貫性
   - 同じ構造が常に同じ形で表現される
   - クライアントの実装が容易になる

3. ドキュメントとしての役割
   - システムの全体像の把握
   - 情報構造の共通理解

## コレオグラフィー：状態遷移の定義

コレオグラフィーでは、操作の種類に応じて状態遷移を定義します。ALPSでは、操作は以下の種類に分かれます：

| 操作         | メソッド      | HTTP メソッド説明            |
|------------|------------|------------------------| 
| safe       | GET        | アプリケーションの状態のみを変更 |
| unsafe     | POST       | 新しいリソース状態を作成       |
| idempotent | PUT/DELETE | リソース状態を更新/削除       |

1. `safe`（安全）
   - アプリケーション状態のみが変化します（例：GET）
   - リソース状態は変更されません

2. `unsafe`（非安全）
   - 新しいリソース状態を作成します
   - 実行するたびに結果が異なる可能性があります

3. `idempotent`（べき等）
   - リソース状態を更新または削除します
   - 何度実行しても同じ結果になります

ALPSの操作はリソースの変更を、追加操作のように実行するたびに結果が異なる、つまりべき等性がない操作か、変更や削除のように何度繰り返しても結果が変わらない、つまりべき等性がある操作を区別します。

### 記事を閲覧する遷移を定義する

まず、ブログ記事を閲覧する操作（safe）を定義します：

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="ブログ記事">
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
        <descriptor href="#dateCreated"/>
    </descriptor>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}},
            {
                "id": "BlogPosting",
                "title": "ブログ記事",
                "descriptor": [
                    {"href": "#dateCreated"},
                    {"href": "#articleBody"}
                ]
            },
            {
                "id": "goBlogPosting",
                "type": "safe",
                "rt": "#BlogPosting",
                "title": "ブログ記事を見る",
                "descriptor": [
                    {"href": "#dateCreated"}
                ]
            }
        ]
    }
}
```

この定義で重要な要素：

0. 命名規則のプレフィックス
   - safe遷移では `go` を使用します
   - unsafe遷移では `doCreate` を使用します
   - idempotent遷移では `doUpdate`/`doDelete` を使用します

1. `type`属性
   - 操作の種類を指定します
   - ここでは`safe`（安全な遷移）です

2. `rt`（return type）属性
   - 遷移先の状態を指定します
   - `#BlogPosting`への遷移を示します

3. 遷移に必要な情報
   - `descriptor href="#dateCreated"`で指定します
   - 記事を特定するために必要な情報です

プレビュー画面では：
1. 状態遷移図に状態（BlogPosting）と遷移を示す矢印が表示されます
2. ボキャブラリリストに遷移（goBlogPosting）の情報が表示されます

### 記事を作成する遷移を定義する

続いて、記事を作成する操作（unsafe）を追加します：

XMLの場合：
```xml
<descriptor id="doCreateBlogPosting" type="unsafe" rt="#BlogPosting" title="ブログ記事を作成する">
    <descriptor href="#articleBody"/>
</descriptor>
```

JSONの場合：
```json
{
    "id": "doCreateBlogPosting",
    "type": "unsafe",
    "rt": "#BlogPosting",
    "title": "ブログ記事を作成する",
    "descriptor": [
        {"href": "#articleBody"}
    ]
}
```

ここで、閲覧（safe）と作成（unsafe）の違いに注目してください：

1. 必要な情報
   - 閲覧：dateCreated（記事を特定）
   - 作成：articleBody（記事の内容）

2. 状態の変化
   - 閲覧：アプリケーション状態のみ
   - 作成：リソース状態も変化

3. 実行結果
   - 閲覧：何度実行しても同じ
   - 作成：実行ごとに新しい記事が作られる

次のステップでは、これらの遷移をブログ全体の構造に組み込んでいきます。

## タクソノミー（2）：操作を含む構造化

ここまでで定義した用語と操作を組み合わせ、ブログ全体を表現する構造を定義します。

XMLの場合：

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="ブログ記事">
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
        <descriptor href="#dateCreated"/>
    </descriptor>
    <descriptor id="doCreateBlogPosting" type="unsafe" rt="#BlogPosting" title="ブログ記事を作成する">
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="Blog" title="ブログ">
        <descriptor href="#BlogPosting"/>
        <descriptor href="#goBlogPosting"/>
        <descriptor href="#doCreateBlogPosting"/>
    </descriptor>
</alps>
```

JSONの場合：

```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}},
            {"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
                {"href": "#dateCreated"},
                {"href": "#articleBody"}
            ]},
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "ブログ記事を見る", "descriptor": [{"href": "#dateCreated"}]},
            {"id": "doCreateBlogPosting", "type": "unsafe", "rt": "#BlogPosting", "title": "ブログ記事を作成する", "descriptor": [{"href": "#articleBody"}]},
            {"id": "Blog", "title": "ブログ", "descriptor": [
                {"href": "#BlogPosting"},
                {"href": "#goBlogPosting"},
                {"href": "#doCreateBlogPosting"}
            ]}
        ]
    }
}
```

### Blogの構成要素

このBlogの定義には以下の要素が含まれています：

1. 情報構造
   - BlogPosting：ブログ記事の構造

2. 状態遷移
   - goBlogPosting：記事の閲覧操作（safe）
   - doCreateBlogPosting：記事の作成操作（unsafe）

プレビュー画面では：
1. 状態遷移図
   - Blog、BlogPostingが状態として表示されます
   - 状態間の遷移が矢印として表示されます
   - safe遷移とunsafe遷移が異なるスタイルで表現されます

2. ボキャブラリリスト
   - 定義した全ての要素が階層的に表示されます
   - Blog配下の情報構造と操作が確認できます

### 1. オントロジー（用語の定義）

XMLの場合：
```xml
<descriptor id="dateCreated" title="作成日時">
    <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
</descriptor>
```

JSONの場合：
```json
{"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}}
```
- アプリケーションで使用する言葉の意味を定義します
- `id`、`title`、`doc`を使って表現します

### 2. タクソノミー（情報の構造化）

XMLの場合：
```xml
<descriptor id="BlogPosting" title="ブログ記事">
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
</descriptor>
```

JSONの場合：
```json
{"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
    {"href": "#dateCreated"},
    {"href": "#articleBody"}
]}
```
- 用語を組み合わせて構造を定義します
- `descriptor`と`href`による参照で表現します

### 3. コレオグラフィー（状態遷移）

XMLの場合：
```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
    <descriptor href="#dateCreated"/>
</descriptor>
```

JSONの場合：
```json
{"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "ブログ記事を見る", 
 "descriptor": [{"href": "#dateCreated"}]}
```
- 操作の種類を定義します
- safe：閲覧操作（prefixは`go`）
- unsafe：作成操作（prefixは`create`）
- idempotent：更新・削除操作（prefixは`update`/`delete`）

### リンク関係の指定

これらの遷移の種類に加えて、標準的なリンク関係を`rel`属性で指定することができます：

XMLの場合：

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" rel="item" title="記事を見る">
    <descriptor href="#id"/>
</descriptor>

<descriptor id="returnToBlog" type="safe" rt="#Blog" rel="collection" title="記事リストに戻る"/>
```

JSONの場合：

```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            { "id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "rel": "item", "title": "記事を見る", "descriptor": [{ "href": "#id" }] },
            { "id": "returnToBlog", "type": "safe", "rt": "#Blog", "rel": "collection", "title": "記事リストに戻る" }
        ]
    }
}
```

`rel`属性には以下のいずれかを指定できます：

1. [IANAで定義されたリンク関係](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
   - `collection`：コレクションへのリンク（例：記事リストへの遷移）
   - `item`：個別アイテムへのリンク（例：個別記事への遷移）
   - `next`/`prev`：ページネーション
   - `edit`：リソースの編集

2. 完全なURL（絶対URI）
   - カスタムのリンク関係を定義する場合に使用します
   - 例：`rel="https://example.com/rels/custom-relation"`

リンク関係を指定することで、APIの意図がより明確になり、クライアントが適切な振る舞いを選択できるようになります。

### 4. 統合（タクソノミー2）

XMLの場合：
```xml
<descriptor id="Blog" title="ブログ">
    <descriptor href="#BlogPosting"/>
    <descriptor href="#goBlogPosting"/>
    <descriptor href="#doCreateBlogPosting"/>
</descriptor>
```

JSONの場合：
```json
{"id": "Blog", "title": "ブログ", "descriptor": [
    {"href": "#BlogPosting"},
    {"href": "#goBlogPosting"},
    {"href": "#doCreateBlogPosting"}
]}
```
- 情報構造と操作を組み合わせて完全な定義を作成します
- リソースの全体構造を表現します

### 要素の分類とグループ化

`tag`属性を使って要素を分類できます：

XMLの場合：
```xml
<descriptor id="BlogPosting" title="ブログ記事">
    <descriptor href="#dateCreated" tag="metadata"/>
    <descriptor href="#articleBody" tag="content"/>
    <descriptor href="#goBlogPosting" tag="navigation"/>
    <descriptor href="#doCreateBlogPosting" tag="action"/>
</descriptor>
```

JSONの場合：
```json
{
    "id": "BlogPosting",
    "title": "ブログ記事",
    "descriptor": [
        { "href": "#dateCreated", "tag": "metadata" },
        { "href": "#articleBody", "tag": "content" },
        { "href": "#goBlogPosting", "tag": "navigation" },
        { "href": "#doCreateBlogPosting", "tag": "action" }
    ]
}
```

tagによる分類は以下のような目的で使用できます：

1. 情報の種類の明確化
   - `metadata`：作成日時などのメタ情報
   - `content`：実際のコンテンツ
   - `navigation`：ナビゲーション要素
   - `action`：状態を変更する操作

2. 処理の分類
   - `validation`：検証が必要な項目
   - `required`：必須項目
   - `cache`：キャッシュ可能な情報

タグは複数指定することもできます：

XMLの場合：
```xml
<descriptor href="#title" tag="metadata content"/>
```

JSONの場合：
```json
{"href": "#title", "tag": "metadata content"}
```

## まとめ：設計手法としてのALPS

ここまで、ブログシステムを例にALPSによる設計手法を学んできました。
この手法には以下のような利点があります：

1. API設計の明確化
   - 意味、構造、遷移の一貫した定義
   - 設計の意図の共有
   - 実装の指針

2. ドキュメントとしての役割
   - 視覚的な状態遷移の理解
   - 用語の定義の明確化
   - チーム内での共通理解

3. 実装との対応
   - HTTPメソッドとの明確な関係（safe→GET, unsafe→POST, idempotent→PUT/DELETE）
   - URLによる状態の表現
   - RESTful APIの設計指針

## チュートリアルの次のステップ

このチュートリアルで学んだ知識は、以下のような形で活用できます：

1. 既存アプリケーションのALPSによる記述
   - 現在の設計の可視化と理解
   - 改善ポイントの発見
   - ドキュメントの整備

2. 新規APIの設計とALPSの連携
   - 一貫性のある設計の実現
   - クライアントとの効果的なコミュニケーション
   - メンテナンス性の向上

ALPSを使った設計は、当初は手間がかかるように感じるかもしれません。しかし、プロジェクトの規模が大きくなるにつれて、その価値は明確になっていきます。一貫性のある設計、明確なドキュメント、効果的なコミュニケーションは、長期的なプロジェクトの成功に大きく貢献します。
