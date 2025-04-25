---
layout: docs-ja
title: 1 Page Manual
category: Manual
permalink: /manuals/1.0/ja/1page.html
---
これはBEAR.Sundayの全てのマニュアルページを一つにまとめたページです。




# 高度な実装ガイド

## 概要

このドキュメントでは、Application-Level Profile Semantics (ALPS)のより高度な実装トピックについて説明します。基本的な要素や属性の説明については[ALPSリファレンス](reference.html)を参照してください。

## ディスクリプタとリンクリレーションタイプ

表現に状態遷移を含める場合、リンクリレーションタイプの有効な値は以下のいずれかを使用できます：

1. **標準リンクリレーションタイプ**
    - IANAやMicroformats.orgなどのレジストリに登録された短い文字列
    - 例：`rel="edit"`, `rel="next"`, `rel="collection"`
    - [IANAリンクリレーション](https://www.iana.org/assignments/link-relations/)を参照

2. **拡張リンクリレーションタイプ** ([RFC8288])
    - リレーションタイプを説明する文書の完全修飾URI
    - ALPSディスクリプタへのURIフラグメント識別子を含む
    - 例：`rel="http://alps.io/profiles/item#purchased-by"`
    - 例：`rel="http://alps.io/profiles/blog#comment"`

3. **ALPSディスクリプタID**
    - ALPSドキュメントの状態遷移ディスクリプタのid属性値
    - 表現にALPSプロファイルが含まれる場合のみ使用可能
    - 例：`rel="purchased-by"`
    - 例：`rel="create-comment"`

### リンクリレーションの競合解決

1. **標準リレーションとの競合**
    - 状態遷移ディスクリプタが標準リンクリレーションと同じ意味を持つ場合、その意味を変更してはいけません
    - 例：`edit`という名前のディスクリプタを作る場合、IANA登録済みの`edit`リレーションの意味と一致する必要があります

2. **ID競合の解決**
    - 複数のディスクリプタ間でidの競合が発生する場合：
        - 一意のidを定義する必要があります
        - 必要に応じてname属性を使用して元の名前を保持できます
    - 例：
      ```xml
      <descriptor id="user-edit" name="edit" type="safe">
        <doc>ユーザー情報の編集</doc>
      </descriptor>
      ```

## 既存メディアタイプとの統合

ALPSは様々な既存メディアタイプと組み合わせて使用できます。以下に主要なメディアタイプとの統合方法を説明します。

### HTML

HTMLでは主にclass属性を使用してALPSディスクリプタを表現します：

```html
<div class="blog-post">
  <h1 class="title">記事タイトル</h1>
  <div class="content">本文...</div>
  <form class="add-comment" method="post">
    <input name="comment-text" class="comment-text">
    <button type="submit">コメント追加</button>
  </form>
</div>
```

対応するALPSプロファイル：
```xml
<alps version="1.0">
  <descriptor id="blog-post" type="semantic">
    <descriptor id="title" type="semantic"/>
    <descriptor id="content" type="semantic"/>
    <descriptor id="add-comment" type="unsafe">
      <descriptor id="comment-text" type="semantic"/>
    </descriptor>
  </descriptor>
</alps>
```

### HAL (Hypertext Application Language)

HALではリンクリレーションとして状態遷移を、プロパティとしてセマンティックディスクリプタを表現します：

```json
{
  "_links": {
    "self": {"href": "/posts/1"},
    "add-comment": {"href": "/posts/1/comments"}
  },
  "title": "記事タイトル",
  "content": "本文...",
  "_embedded": {
    "comments": [
      {
        "_links": {
          "self": {"href": "/comments/1"}
        },
        "text": "コメント内容..."
      }
    ]
  }
}
```

### Collection+JSON

Collection+JSONではクエリとデータ要素としてディスクリプタを表現します：

```json
{
  "collection": {
    "version": "1.0",
    "href": "/posts/1",
    "items": [
      {
        "data": [
          {"name": "title", "value": "記事タイトル"},
          {"name": "content", "value": "本文..."}
        ]
      }
    ],
    "template": {
      "data": [
        {"name": "comment-text", "value": "", "prompt": "コメントを入力"}
      ]
    }
  }
}
```

## ALPSドキュメントの参照

ALPSプロファイルを適用する際の参照方法について説明します。

### リンクによる参照

1. **HTML内での参照**
   ```html
   <link rel="profile" href="http://example.com/alps/blog" />
   ```

2. **HTTP Linkヘッダーでの参照**
   ```http
   Link: <http://example.com/alps/blog>; rel="profile"
   ```

3. **メディアタイプパラメータでの参照**
   ```http
   Content-Type: application/json; profile="http://example.com/alps/blog"
   ```

### 複数プロファイルの適用

1つの表現に複数のALPSプロファイルを適用できます：

```http
Link: <http://example.com/alps/blog>; rel="profile",
      <http://example.com/alps/comments>; rel="profile"
```

### プロファイルの優先順位

複数のプロファイルが競合する場合の優先順位：

1. メディアタイプのprofileパラメータで指定されたプロファイル
2. HTTPの`Link`ヘッダーで指定されたプロファイル
3. 表現内で指定されたプロファイル（先に指定されたものが優先）

## エラー処理とバリデーション

実装時の一般的なエラーケースと対処方法について説明します。

### よくあるエラー

1. **無効なディスクリプタ参照**
    - 解決できないURLやフラグメント識別子
    - 存在しないディスクリプタへの参照

2. **リンクリレーションの競合**
    - 標準リレーションとの意味的な競合
    - 複数プロファイル間でのリレーション定義の競合

3. **メディアタイプの制約**
    - 特定のメディアタイプで表現できない要素の存在
    - リンク表現のサポート不足





# ベストプラクティス


## 状態

アプリケーション状態のセマンティックディスクリプタは大文字始まりのアッパーキャメルケースで表されます。

```json
"descriptor": [
  {"id": "BlogPosting", "type": "semantic", "def": "https://schema.org/BlogPosting", "descriptor": [
    {"href": "#id"},
    {"href": "#articleBody"},
    {"href": "#dateCreated"},
    {"href": "#blog"}
  ]}
]
```

## 安全な状態遷移

typeが`safe`のセマンティックディスクリプタは、次の遷移先のディスクリプタに`go`のプレフィックスを付加します。
([RFC8288](https://datatracker.ietf.org/doc/html/rfc8288#section-3.3))

```json
[
  {"id": "goHome", "type": "safe", "rt": "#Home"},
  {"id": "goFirst", "type": "safe", "rt": "#TodoList"},
  {"id": "goPrevious", "type": "safe", "rt": "#TodoList"}
]
```

safe以外のセマンティックディスクリプタには、`do`の接頭辞をつけます。

```json
[
  {"id": "doEditUser", "type": "idempotent", "rt": "#UserList"},
  {"id": "doDeleteUser", "type": "idempotent", "rt": "#UserList"}
]
```

rt（遷移先）のIDは`go`または`do`のプレフィックスに次の遷移先のディスクリプタIDを付加します。

```json
[
  {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting"},
  {"id": "doEditBlogPosting", "type": "idempotent", "rt": "#Blog"}
]
```

## 要素

アプリケーション状態として定義されないセマンティックディスクリプタ、つまり要素(element)のセマンティックディスクリプタは小文字始まりのローワーキャメルケースで表記します。

```json
[
    {"id": "articleBody"},
    {"id": "dateCreated"}
]
```


## ALPSファイルの構造

ALPSファイルのセマンティクディスクリプターは以下の順の3つのブロックに分けます。

1. `def`や`doc`を用いた意味定義のセマンティックディスクリプタ群（オントロジー）
2. 包含関係のセマンティックディスクリプタ群（タクソノミー）
3. 状態遷移のセマンティックディスクリプタ群(コレオグラフィー)

```json
"descriptor" : [
    {"id" : "name", "type" : "semantic", "def": "http://schema.org/identifier"},
    {"id" : "age", "type" : "semantic", "def": "http://schema.org/title"},

    {"id" : "Person", "type": "semantic", "descriptor":[
      {"href": "#name"},
      {"href": "#age"}
    ]}
    
    {"id": "goPerson", "type": "safe", "rt": "#Person"},
]
```

## ALPSの外にある階層構造

ALPSでは、階層的な意味をポジションで表現できます。

```json
"descriptor": [
    {"id": "name", "def": "https://schema.org/name"},
    {"id": "Product", "descriptor":[
      {"href": "#name"}
    ]}
    {"id": "Person", "descriptor":[
      {"href": "#name"}
    ]}
]
```

* 上記の例では、`name`は、`Product/name`と`Person/name`で共有されています。
このような語をフラットな階層しかないフォーマットで表現する場合には、各フォーマットの慣習に従うのが基本です。
* htmlの場合は、Lower camel caseで表します。

```html
<form>
    <input name="productName" type="text">
    <input name="personName" type="text">
</form>
```

## スキーマ参照の追加

ALPSプロファイルを作成する際には、スキーマ参照を追加することをお勧めします。

```json
{
  "$schema": "https://alps-io.github.io/schemas/alps.json",
  "alps" : {
  }
}
```

```xml
<alps 
  version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>  
```

## 実装例

### セマンティック要素

基本要素の定義：

```xml
<descriptor id="title" title="タイトル" doc="記事のタイトル。最大100文字。"/>
<descriptor id="content" title="内容" doc="記事の本文。Markdown形式をサポート。"/>
<descriptor id="publishedAt" title="公開日時" doc="記事の公開日時。ISO 8601形式。"/>
```

```json
{
    "descriptor": [
        {"id": "title", "title": "タイトル", "doc": {"value": "記事のタイトル。最大100文字。"}},
        {"id": "content", "title": "内容", "doc": {"value": "記事の本文。Markdown形式をサポート。"}},
        {"id": "publishedAt", "title": "公開日時", "doc": {"value": "記事の公開日時。ISO 8601形式。"}}
    ]
}
```

基本要素の再利用：

```xml
<descriptor id="blogPost">
    <doc>ユーザーが作成した記事。公開後は全てのユーザーが閲覧可能。</doc>
    <descriptor href="#title"/>
    <descriptor href="#content"/>
    <descriptor href="#publishedAt"/>
</descriptor>

<descriptor id="pagePost">
    <doc>固定ページ。サイトの基本情報などの永続的なコンテンツ。</doc>
    <descriptor href="#title"/>
    <descriptor href="#content"/>
</descriptor>
```

```json
{"descriptor": [
    {"id": "blogPost", "doc": {"value": "ユーザーが作成した記事。公開後は全てのユーザーが閲覧可能。"}, "descriptor": [
        {"href": "#title"},
        {"href": "#content"},
        {"href": "#publishedAt"}
    ]},
    {"id": "pagePost", "doc": {"value": "固定ページ。サイトの基本情報などの永続的なコンテンツ。"}, "descriptor": [
        {"href": "#title"},
        {"href": "#content"}
    ]}
]}
```

### 操作の定義

```xml
<descriptor id="goBlog" type="safe" rt="#Blog" doc="ブログのトップページを表示。最新10件の記事を一覧表示。"/>

<descriptor id="doCreateBlogPost" type="unsafe" rt="#BlogPost">
    <doc>新規記事を作成。下書き状態で保存される。</doc>
    <descriptor href="#title"/>
    <descriptor href="#content"/>
</descriptor>

<descriptor id="doPublishBlogPost" type="idempotent" rt="#BlogPost">
    <doc>記事を公開。publishedAtに現在時刻が設定される。</doc>
    <descriptor href="#id"/>
</descriptor>
```

```json
{"descriptor": [
    {"id": "goBlog", "type": "safe", "rt": "#Blog", "doc": {"value": "ブログのトップページを表示。最新10件の記事を一覧表示。"}},
    {"id": "doCreateBlogPost", "type": "unsafe", "rt": "#BlogPost", "doc": {"value": "新規記事を作成。下書き状態で保存される。"}, "descriptor":[
        {"href": "#title"},
        {"href": "#content"}
    ]},
    {"id": "doPublishBlogPost", "type": "idempotent", "rt": "#BlogPost", "doc": {"value": "記事を公開。publishedAtに現在時刻が設定される。"}, "descriptor": [
        {"href": "#id"}
    ]}
]}
```



# 例

* [todomvc](https://alps-asd.github.io/app-state-diagram/todomvc/)
* [mini amazon](/alps/ja/amazon.html)
* [LMS](/alps/ja/lms.html)


#  FAQ

<strong>Q. どのような人が利用できますか</strong>

A. サイト制作に関わる全ての人（エンジニア、デザイナー、PO）が利用できます。

<strong>Q. どのような人がALPSを記述できますか</strong>

A. XMLやJSONを理解でき、簡単なHTMLのコーディングができる人ならALPSを記述できます。

<strong>Q. どのように使いますか</strong>

A. 情報を最小限必要な要素に整理してサイト設計を行い、WebやAPIサービスの設計に使います。設計はJSONやXMLなどのフォーマットとして表し、遷移図やボキャブラリリストなどのドキュメントを生成できます。また各制作者はその情報設計に基づいて情報の正確な言葉や意味、構造を知ることができます。

<strong>Q. 情報設計とはなんですか</strong>

A. IA（Information Architecture)に基づいて、情報のオントロジー（言葉の意味）、タクソノミー（情報の分類）、コレオグラフィー（リンク）の観点で情報の情報（メタ情報）を定義します。

<strong>Q. 設計の清書に使うものでしょうか</strong>

A. いいえ。サイト設計のごく初期段階から、情報を整理しどのようなサイトを形作っていくなどモデリングツールとして利用できます。

<strong>Q. ALPSを記述するのには何が必要ですか</strong>

A. JSONやXMLを編集するエディターが必要です。

<strong>Q. XMLやJSONを直接編集するのは大変じゃないですか</strong>

A. WebStormなどのスキーマをサポートするエディターを使うと補完やバリデーションが効いて快適に編集できます。

<strong>Q. XMLとJSONではどちらが良いですか</strong>

A. 機能に違いはありません。また複数のALPSファイルを利用する場合でも統一する必要がありません。実際に見比べてみてください。[XML](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.xml) / [JSON](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.json)

<strong>Q. リンクのないAPIにも使えますか</strong>

A. 遷移図は表せませんが、ボキャブラリや情報の性質を表すドキュメントが生成できます。

<strong>Q. ALPSと同様の技術は他にありますか</strong>

A. 直接の競合技術はありません。近い技術に[Microformat](http://www.asahi-net.or.jp/~ax2s-kmtn/internet/rec-owl-features-20040210.html)があります。

<strong>Q. OpenAPIなどのIDLと何が違いますか</strong>

A. ALPSはHTTPよりさらに上位のRESTの抽象を扱います。そのためOpenAPI実装のためのモデリングや設計言語として用いることもできます。

<strong>Q. 私に必要ですか</strong>

A. ユーザー体験の質の向上のために情報中心でサイトを設計したい、制作メンバー間の認識を統一するための**信頼できる唯一の情報源**（SSOT)が欲しい、設計を俯瞰し再利用したい、情報設計を規格化されたドキュメントとして残したい、などの動機があれば役に立つでしょう。



# 情報アーキテクチャとALPS

API設計やシステム構築において、情報アーキテクチャ（IA）の考え方をドメインモデリングに適用することで、ビジネス要件を体系的に整理できます。もともとUXやコンテンツ設計で培われてきたIAの「意味」「構造」「インタラクション」という要素は、ビジネスドメインの知識を構造化する際にも重要な役割を果たし、ALPSはこの考え方を標準化された方法で表せます。

## 情報アーキテクチャの適用

情報アーキテクチャの専門家であるDan Klynは情報アーキテクチャ（IA）を「意味（`Ontology`）」「構造（`Taxonomy`）」「インタラクションのルール（`Choreography`）」の相互作用として定義しました。[^uia] これらの概念はコンテンツ設計だけでなく、システム設計の基盤としても機能します。OpenAPIがAPIの技術的な詳細（エンドポイント、HTTPメソッド、リクエスト/レスポンス構造など）に焦点を当てるのに対し、ALPSはこれらのIA概念を用いてビジネスドメインの構造化を行います。

[^uia]: [Understanding Information Architecture](https://understandinggroup.com/ia-theory/understanding-information-architecture)

## 設計プロセスにおける位置づけ

ALPSは設計の初期段階からビジネス要件とシステム設計を橋渡しします。従来のエンドポイント中心の設計が決定済みの仕様を文書化する段階で使用されるのに対し、ALPSは要件定義のフェーズから活用できます。これにより、ビジネス要件の解釈の違いを早期に発見し、修正できます。また、技術チームとビジネスチーム間で共通言語が確立され、設計変更の影響範囲を把握しやすい仕組みが整えられます。

ALPSはAPIエンドポイントの設計を超え、ビジネス領域の知識を体系化し共有するための手段を提供します。信頼できる唯一の情報源（Single Source of Truth, SSOT）として、システムの構造と動作を一貫してモデル化します。ビジネス用語を中心とした記述により、複雑なビジネスルールを明確に表現し、ワークフローを可視化し情報の相互作用を俯瞰し直感的に理解できます。

## 技術変化への対応

ALPSはさまざまなAPIスタイルに適用できる柔軟性を持っています。技術の進化によってアーキテクチャスタイルが変化しても、ビジネスドメインの設計を維持できます。例えば、RESTful APIからGraphQLへの移行や、マイクロサービスアーキテクチャの導入、新しい通信プロトコルの採用など、技術的な変更が生じても、ALPSで定義したドメインモデルは継続して使用できます。これは、ALPSが実装の詳細ではなく、抽象化されたビジネスロジックに焦点を当てているためです。

## 知識基盤の構築

`Taxonomy`の実装では、ビジネスエンティティ間の関係性を定義し、階層構造による拡張性を確保します。これにより、組織全体で共通の語彙が確立され、コミュニケーションが効率化されます。`Choreography`では、ビジネスプロセスのフローとサービス間の連携ルールを定義し、システム全体の一貫性と信頼性を高めます。

IAの考え方をドメインモデリングに適用することで、技術的な実装とビジネス要件を自然に結びつけます。ALPSはこの橋渡しを実現するフレームワークとして機能し、組織の知識を体系的に構造化し、進化させる基盤となります。

この取り組みにより、技術の変化に影響されない持続可能な組織の知識基盤を構築する事ができます。





# IANAリンクリレーション

このドキュメントはALPSプロファイルのrel属性で使用が推奨される、IANAリンクリレーションの一覧です。

## 状態遷移

| リレーション | 説明 |
|||
| edit | 対象の状態を編集できる遷移を表す |
| edit-form | 編集用のフォームを取得する遷移を表す |
| create-form | 作成用のフォームを取得する遷移を表す |
| collection | コレクション全体を表す状態への遷移 |
| item | コレクションの個別要素を表す状態への遷移 |

## 順序のある遷移

| リレーション | 説明 |
|||
| first | シリーズの最初の状態への遷移 |
| last | シリーズの最後の状態への遷移 |
| next | シリーズの次の状態への遷移 |
| prev | シリーズの前の状態への遷移 |

## 意味的記述

| リレーション | 説明 |
|||
| describedby | セマンティックディスクリプタの詳細な説明への参照 |
| describes | セマンティックディスクリプタが説明する対象への参照（describedbyの逆関係） |
| type | セマンティックディスクリプタの抽象的な型を示す |

## 文書構造

| リレーション | 説明 |
|||
| section | 文書内のセクションを示す |
| subsection | 文書内のサブセクションを示す |
| chapter | 文書内の章を示す |
| contents | 文書の目次を示す |

## メタデータ

| リレーション | 説明 |
|||
| author | 作成者情報への参照 |
| license | ライセンス情報への参照 |
| copyright | 著作権情報への参照 |

## バージョン管理

| リレーション | 説明 |
|||
| latest-version | 最新バージョンの状態への遷移 |
| predecessor-version | 前バージョンの状態への遷移 |
| successor-version | 次バージョンの状態への遷移 |
| version-history | バージョン履歴を示す状態への遷移 |

## 関連情報

| リレーション | 説明 |
|||
| help | ヘルプ情報への参照 |
| status | 状態に関する情報への参照 |
| alternate | 代替表現への参照 |

注意:
1. このリストはALPSプロファイルでよく使用される可能性のあるリレーションの抜粋です
2. 完全な一覧は[IANAのRegistry](https://www.iana.org/assignments/link-relations/link-relations.xhtml)を参照してください
3. カテゴリ分けは便宜上のものです
4. 実際の使用時は、アプリケーションの要件に応じて適切なリレーションを選択してください


# イントロダクション

[![ALPS document](/images/alps.svg)](/alps/index.html)

## ALPS: アプリケーションレベルの意味と構造を明確にするフォーマット

Application-Level Profile Semantics ([ALPS](http://alps.io/))は、アプリケーションレベルのセマンティクスを表現し、JSONやHTMLなどの汎用メディアにアプリケーション固有の情報を付加するフォーマットです。ALPSはデータの意味や構造、そして操作を明確化し、開発プロセスの効率化、システム間の互換性向上、APIの再利用性と発見性の促進を実現します。

電子商取引プラットフォームを例に考えてみましょう。クレジットカード、電子マネー、銀行振込など、複数の支払いサービスとの統合時、ALPSは支払いプロセスの各ステップにおけるデータと操作の意味を標準化します。これにより、新しい決済方法の追加や既存システムとの統合が容易になり、開発者は一貫した方法でAPIを実装できます。フロントエンドとバックエンドの開発者も共通の言語で効率的にコミュニケーションを取り、迅速に機能を追加・改善できます。

## ASD: アプリケーション状態遷移の可視化

ASD（Application State Diagram）は、ALPSドキュメントからアプリケーションの状態遷移と行動を可視化するツールです。これにより、アプリケーションの全体構造を俯瞰し、状態間の遷移や可能なアクションを直感的に捉えることが可能になります。例えば、オンラインショッピングアプリにおいて、ユーザーが商品を検索してから購入に至るプロセスが明確に可視化され、開発者はユーザーが各段階で直面する選択と可能な操作を理解しやすくなります。これはユーザー体験の向上に繋がる設計上の意思決定を助けます。


ASDの利用により、プロダクトオーナー、バックエンドおよびフロントエンドの開発者、UI/UXデザイナーなど、プロジェクトに関わる全てのチームメンバーが同じ視点でアプリケーションを理解し、効果的に協力できるようになります。 これにより、専門分野の異なるメンバー間でスムーズなコミュニケーションが可能になり、複雑なプロジェクトでも新しいメンバーがスムーズに参加できるようになります。また、アプリケーションの流れやロジックを素早く把握して必要な調整ができるため、設計の早い段階で問題を見つけて解決でき、開発の効率と品質を高めます。

ASDを活用することで、プロジェクトの透明性が高まり、各チームメンバーが持つビジョンの齟齬を最小化できます。

## RESTアプリケーション設計のための情報アーキテクチャ

情報アーキテクチャの観点からRESTアプリケーションを設計する際、ALPSとASDはお互いを補完する役割を果たします。ALPSはアプリケーションが扱うデータの意味や構造を標準化し、チーム全体で共通の語彙を使って情報を定義できるようにします。一方、ASDはアプリケーションの状態の変化を図で表現し、ユーザーの操作とアプリケーションの反応を視覚的に理解しやすくします。ALPSの仕様とASDによる可視化により、RESTアプリケーションの開発における情報設計が強化され、チーム間のコミュニケーションがスムーズになり、プロジェクト全体の一貫性と品質を高めます。

開発効率の向上、優れたユーザーエクスペリエンスの提供、そしてプロジェクトの持続可能性の確保には、多様な開発者間で共有される理解の基盤が不可欠です。ALPSとASDは、この基盤を構築しプロジェクトの長期的な成功を支えます。


# イントロダクション

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## ALPS：アプリの情報を整理する方法

ALPS（アプリケーションレベルのプロファイルセマンティクス）は、アプリの情報や仕組みをきちんと説明するための方法です。インターネット上でよく使われる形式（例えばJSONやHTML）に、アプリ固有の情報を加えて、そのアプリがどのように動くのか、どんな情報を扱っているのかをはっきりさせます。これにより、アプリを作る過程がスムーズになり、異なるアプリやシステム同士が上手く連携できるようになります。

例えば、ネットショッピングのサイトを考えてみましょう。お客さんが商品を選んで買うまでの一連の手順（支払いを含む）について、ALPSを使うと、それぞれのステップで何が起こっているのかを明確に示すことができます。これにより、アプリを作る人たちは、お客さんがスムーズに買い物ができるように、必要な改善をしやすくなります。

## ASD：アプリの動きを図で見る

ASD（アプリケーション状態遷移図）は、ALPSで説明されたアプリの情報をもとに、アプリの動きやユーザーができる操作を図で示します。これにより、アプリがどのように動いているのかを一目で理解できるようになります。ネットショッピングのサイトでいうと、商品を探してカートに入れる、支払う、という一連の流れが図で示されます。

ASDを使うと、アプリを作っているチームの中で、プログラマーやデザイナーなど、異なる役割の人たちが、アプリがどのように動くべきかについて、共通の理解を持つことができます。これは、アプリをより良くするための議論や、新しいアイデアを出し合う際にとても役立ちます。

## RESTアプリケーションの設計

ALPSとASDは、特にWeb上で動くアプリ（RESTアプリケーションと呼ばれます）の設計に役立ちます。これらのツールを使うことで、アプリがどのような情報を扱い、どのように動くのかをはっきりと示すことができます。結果として、アプリの作成や改善がしやすくなり、使っている人にとっても、より使いやすいアプリになります。

多様なスキルを持つチームメンバーが同じ目標に向かって効率的に作業を進めるためには、お互いの作業内容を正確に理解し合うことが大切です。ALPSとASDは、そのための理解を深めるのに非常に役立つツールです。



# リソース

* [ALPS 公式](http://alps.io/)
* [RFC](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07)
* スケルトン
  * [json](https://github.com/alps-asd/alps-skeleton-json)
  * [xml](https://github.com/alps-asd/alps-skeleton-xml)
* [GitHub Action](https://github.com/marketplace/actions/app-state-diagram)
* [app-state-diagram](https://github.com/alps-asd/app-state-diagram)


<style>
  /* Common Styles */
  .alps-brewery {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }
  
  .alps-brewery .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .alps-brewery header {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .alps-brewery .logo {
    font-size: 2.5rem;
    font-weight: bold;
    color: #336699;
    margin-bottom: 10px;
  }
  
  .alps-brewery .tagline {
    font-size: 1.2rem;
    color: #666;
  }
  
  .alps-brewery .gpts-link {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #f0f4f8;
    border-radius: 6px;
    font-size: 0.95rem;
    display: inline-block;
  }
  
  .alps-brewery .gpts-link a {
    color: #336699;
    text-decoration: none;
    font-weight: bold;
  }
  
  .alps-brewery .gpts-link a:hover {
    text-decoration: underline;
  }
  
  .alps-brewery main {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px 30px;
    margin-bottom: 40px;
  }
  
  .alps-brewery h1, .alps-brewery h2, .alps-brewery h3 {
    color: #336699;
    margin-top: 0;
  }
  
  .alps-brewery textarea {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
    font-family: monospace;
    font-size: 14px;
    resize: vertical;
  }
  
  .alps-brewery button {
    background-color: #336699;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
  }
  
  .alps-brewery button:hover {
    background-color: #254e77;
  }
  
  .alps-brewery button.selected {
    background-color: #254e77;
    box-shadow: 0 0 0 2px rgba(37, 78, 119, 0.5);
  }
  
  .alps-brewery button.secondary-btn {
    background-color: #6c757d;
  }
  
  .alps-brewery button.secondary-btn:hover {
    background-color: #5a6268;
  }
  
  .alps-brewery button.copy-btn {
    background-color: #4CAF50;
    font-size: 0.9rem;
    padding: 6px 12px;
  }
  
  .alps-brewery button.copy-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery .hidden {
    display: none;
  }
  
  .alps-brewery footer {
    text-align: center;
    margin-top: 20px;
    color: #666;
    font-size: 0.9rem;
  }
  
  /* Step Indicator */
  .alps-brewery .step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }
  
  .alps-brewery .step {
    width: 180px;
    padding: 10px;
    text-align: center;
    background-color: #e9ecef;
    position: relative;
    z-index: 1;
  }
  
  .alps-brewery .step:not(:last-child):after {
    content: '';
    position: absolute;
    top: 50%;
    right: -15px;
    width: 30px;
    height: 2px;
    background-color: #e9ecef;
    z-index: 0;
  }
  
  .alps-brewery .step.active {
    background-color: #336699;
    color: white;
    font-weight: bold;
  }
  
  .alps-brewery .step.active:not(:last-child):after {
    background-color: #336699;
  }
  
  /* Tabs */
  .alps-brewery .tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
  }
  
  .alps-brewery .tab-btn {
    padding: 10px 20px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-bottom: none;
    margin-right: 5px;
    border-radius: 5px 5px 0 0;
    cursor: pointer;
    font-weight: normal;
  }
  
  .alps-brewery .tab-btn.active {
    background-color: #336699;
    color: white;
    border-color: #336699;
    font-weight: bold;
  }
  
  .alps-brewery .tab-content {
    display: none;
    padding-top: 15px;
  }
  
  .alps-brewery .tab-content.active {
    display: block;
  }
  
  /* Section Controls */
  .alps-brewery .options-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
  }
  
  .alps-brewery .format-selection, .alps-brewery .language-selection {
    margin-bottom: 15px;
  }
  
  .alps-brewery .format-selection label, .alps-brewery .language-selection label {
    margin-right: 10px;
  }
  
  .alps-brewery select, .alps-brewery input[type="text"] {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.9rem;
  }
  
  .alps-brewery .sample-controls {
    margin-bottom: 15px;
  }
  
  .alps-brewery .sample-controls select {
    width: 100%;
    max-width: 300px;
  }
  
  /* Format Buttons */
  .alps-brewery .format-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  /* Result Section */
  .alps-brewery .result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .alps-brewery .verification-tip {
    background-color: #f8f9fa;
    border-left: 4px solid #336699;
    padding: 10px 15px;
    margin: 15px 0;
    font-size: 0.95rem;
  }
  
  .alps-brewery .verification-tip .tip-text {
    background-color: #eef1f7;
    padding: 3px 6px;
    border-radius: 3px;
    font-family: monospace;
  }
  
  .alps-brewery .mini-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    padding: 3px 8px;
    font-size: 0.8rem;
    cursor: pointer;
    margin-left: 5px;
    vertical-align: middle;
  }
  
  .alps-brewery .mini-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery #promptResult {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
    white-space: pre-wrap;
    font-family: monospace;
    font-size: 14px;
    overflow-y: auto;
    margin-bottom: 20px;
  }
  
  /* Navigation Buttons */
  .alps-brewery .nav-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
</style>

<div class="alps-brewery">
  <div class="container">
    <header>
      <div class="logo">ALPS Prompt Brewery</div>
      <div class="tagline">AI prompt generator for ALPS and implementation code</div>
    </header>

    <main>
      <div class="step-indicator">
        <div class="step active" id="step1">Step 1: User Story</div>
        <div class="step" id="step2">Step 2: ALPS</div>
      </div>
      
      <!-- Step 1: User Story to ALPS Prompt -->
      <section id="userStorySection" class="section-active">
        <h2>ALPS Prompt Creation</h2>
        
        <div class="tabs">
          <button class="tab-btn active" id="userStoryTabBtn">Create from User Story</button>
          <button class="tab-btn" id="directAlpsTabBtn">Convert Existing ALPS</button>
        </div>
        <!-- User Story Tab Content -->
        <div id="userStoryTab" class="tab-content active">
          <div class="sample-controls">
            <label>Need inspiration?</label>
<select id="sampleStorySelect">
  <option value="">サンプルユーザーストーリーを選択してください...</option>
  <optgroup label="ビジネスアプリケーション">
    <option value="ecommerce">Eコマース商品管理</option>
    <option value="taskapp">タスク管理アプリ</option>
    <option value="restaurant">レストラン予約システム</option>
  </optgroup>
  <optgroup label="コンテンツ・情報システム">
    <option value="blog">ブログシステム</option>
    <option value="library">図書館管理システム</option>
    <option value="lms">学習管理システム（LMS）</option>
  </optgroup>
  <optgroup label="サービス業">
    <option value="travel">旅行予約システム</option>
    <option value="events">イベント管理プラットフォーム</option>
    <option value="healthcare">医療患者管理</option>
  </optgroup>
</select>
          </div>
          
          <textarea id="userStoryInput" placeholder="Enter your user story or system requirements here..."></textarea>
          
          <div class="options-row">
            <div class="format-selection">
              <label>ALPS Format:</label>
              <label><input type="radio" name="alpsFormat" value="json" checked> JSON</label>
              <label><input type="radio" name="alpsFormat" value="xml"> XML</label>
            </div>
            
            <div class="language-selection">
              <label>Documentation Language:</label>
              <select id="languageSelect">
                <option value="English">English</option>
                <option value="Japanese">Japanese</option>
                <option value="Spanish">Spanish</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Chinese">Chinese</option>
                <option value="other">Other...</option>
              </select>
              <input type="text" id="customLanguage" placeholder="Specify language" class="hidden">
            </div>
          </div>
          
          <button id="generateAlpsPromptBtn" class="primary-btn">Generate ALPS Prompt</button>
        </div>
        
        <!-- Direct ALPS Tab Content -->
        <div id="directAlpsTab" class="tab-content">
          <p>Paste your existing ALPS profile below and proceed directly to the format conversion step.</p>
          <textarea id="directAlpsInput" placeholder="Paste your existing ALPS profile here..."></textarea>
          <div class="format-selection">
            <label>Select the format of your ALPS profile:</label>
            <label><input type="radio" name="directAlpsFormat" value="json" checked> JSON</label>
            <label><input type="radio" name="directAlpsFormat" value="xml"> XML</label>
          </div>
          <button id="proceedToConversionBtn" class="primary-btn">Proceed to Conversion</button>
        </div>
      </section>
      
      <!-- Step 2: ALPS to Implementation -->
      <section id="alpsSection" class="hidden">
        <h2>Convert ALPS to Implementation Format</h2>
        
        <div class="result-header">
          <h3>Generated ALPS Prompt</h3>
          <button id="copyAlpsBtn" class="copy-btn">Copy ALPS Prompt</button>
        </div>
        
        <textarea id="alpsInput" placeholder="Your generated ALPS prompt will appear here. You can also paste your own ALPS profile."></textarea>
        
        <div class="verification-tip">
          <p><strong>💡 Pro Tip:</strong> After receiving your ALPS profile from the AI, consider asking: <span class="tip-text">"Please review this ALPS profile to verify that there are no isolated states (unreachable or exit-less states) and that all state transitions are properly connected. Also check if all semantic descriptors are consistently tagged and grouped."</span> <button id="copyTipBtn" class="mini-btn">Copy Tip</button></p>
          <p><strong>💡 Next Step:</strong> After confirming that ALPS is rendered correctly at <a target="_blank" href="https://editor.app-state-diagram.com/">https://editor.app-state-diagram.com/</a>, Paste your ALPS profile into textarea and proceed directly to the format conversion step. 
          </p>
        </div>
        
        <h3>Select Target Implementation Format</h3>
        <div class="format-buttons">
          <button id="openApiBtn">OpenAPI</button>
          <button id="jsonSchemaBtn">JSON Schema</button>
          <button id="graphqlBtn">GraphQL</button>
          <button id="sqlBtn">SQL</button>
          <button id="typescriptBtn">TypeScript</button>
        </div>
        
        <button id="convertAlpsBtn" class="primary-btn">Generate Conversion Prompt</button>
        
        <div class="nav-buttons">
          <button id="backToUserStoryBtn" class="secondary-btn">← Back to User Story</button>
        </div>
      </section>
      
      <!-- Step 3: Result -->
      <section id="resultSection" class="hidden">
        <div class="result-header">
          <h2 id="resultTitle">Generated Conversion Prompt</h2>
          <button id="copyResultBtn" class="copy-btn">Copy to Clipboard</button>
        </div>
        
        <p>Copy this prompt to ChatGPT, Claude, or any other AI assistant:</p>
        <div id="promptResult"></div>
        
        <div class="verification-tip">
          <p><strong>💡 Remember:</strong> For best results, first have the AI verify the ALPS profile for correctness, then provide this conversion prompt.</p>
        </div>
        
        <div class="nav-buttons">
          <button id="startOverBtn" class="secondary-btn">Start Over</button>
          <button id="backToAlpsBtn" class="secondary-btn">← Back to ALPS</button>
        </div>
        
        <div class="gpts-link" style="margin-top: 25px; text-align: center;">
          <p>Tip: For quick results, you can also use <a href="https://chatgpt.com/g/g-HYPygRnLS-alps-assistant" target="_blank">ALPS Assistant GPTs</a> with your prompts.</p>
        </div>
      </section>
    </main>
    
    <footer>
    </footer>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const userStoryInput = document.getElementById('userStoryInput');
    const alpsInput = document.getElementById('alpsInput');
    const promptResult = document.getElementById('promptResult');
    const resultTitle = document.getElementById('resultTitle');
    
    // Sections
    const userStorySection = document.getElementById('userStorySection');
    const alpsSection = document.getElementById('alpsSection');
    const resultSection = document.getElementById('resultSection');
    
    // Step indicators
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    // Buttons
    const generateAlpsPromptBtn = document.getElementById('generateAlpsPromptBtn');
    const convertAlpsBtn = document.getElementById('convertAlpsBtn');
    const copyAlpsBtn = document.getElementById('copyAlpsBtn');
    const copyResultBtn = document.getElementById('copyResultBtn');
    const backToUserStoryBtn = document.getElementById('backToUserStoryBtn');
    const backToAlpsBtn = document.getElementById('backToAlpsBtn');
    const startOverBtn = document.getElementById('startOverBtn');
    
    // Format buttons
    const openApiBtn = document.getElementById('openApiBtn');
    const jsonSchemaBtn = document.getElementById('jsonSchemaBtn');
    const graphqlBtn = document.getElementById('graphqlBtn');
    const sqlBtn = document.getElementById('sqlBtn');
    const typescriptBtn = document.getElementById('typescriptBtn');
    
    // サンプルユーザーストーリー
const sampleStories = {
  'ecommerce': `ストア所有者として、商品在庫を管理したいです。
商品には、名前、説明、価格、カテゴリ、在庫数量があります。
新しい商品を追加し、既存の商品を更新し、廃止された商品を削除する必要があります。
顧客はカテゴリ別に商品を閲覧し、商品の詳細を確認できるようにする必要があります。`,
  
  'taskapp': `プロジェクトマネージャーとして、タスク追跡システムが必要です。
タスクにはタイトル、説明、期限、優先度、担当ユーザーがあります。
ユーザーはタスクを作成し、ステータスを更新し、完了としてマークできる必要があります。
システムはステータスまたは担当ユーザーでフィルタリングされたタスクリストを表示する必要があります。`,
  
  'blog': `コンテンツ作成者として、ブログ管理システムが必要です。
記事にはタイトル、内容、公開日、タグ、著者があります。
下書きを作成し、記事を公開し、コメントを管理したいです。
読者はタグまたは著者別に記事を閲覧し、コメントを残すことができる必要があります。`,
  
  'travel': `旅行代理店として、予約管理システムが必要です。
旅行には目的地、出発/到着日、交通手段、宿泊施設があります。
顧客には個人情報、支払い情報、旅行の好みがあります。
エージェントは利用可能な旅行を検索し、予約を行い、旅程を管理できる必要があります。
システムは予約状況、支払い、確認通知の送信を追跡する必要があります。`,
  
  'healthcare': `クリニック管理者として、患者管理システムが必要です。
患者には個人情報、医療履歴、保険の詳細があります。
予約には日付、時間、医師、患者、ステータスがあります。
医療スタッフは予約をスケジュールし、診断を記録し、処方箋を管理する必要があります。
患者は自分の医療記録と今後の予約を確認できる必要があります。`,
  
  'events': `イベントプランナーとして、イベント管理プラットフォームが必要です。
イベントには名前、会場、日付、時間、収容人数、チケットタイプがあります。
参加者はチケットを購入し、セッションに登録し、フィードバックを残すことができます。
主催者は会場、スピーカー、スケジュール、チケット販売を管理する必要があります。
システムはチェックイン、リマインダーの送信、出席レポートの生成をサポートする必要があります。`,
  
  'library': `図書館員として、図書館管理システムが必要です。
本にはタイトル、著者、ジャンル、ISBN、出版日、利用可能状況があります。
会員には個人情報、借りている本、貸出履歴を含むアカウントがあります。
図書館員は本をカタログ化し、貸出と返却を処理し、予約を管理する必要があります。
会員はカタログを検索し、本を予約し、アカウント状況を確認できる必要があります。`,
  
  'restaurant': `レストラン所有者として、予約と注文システムが必要です。
テーブルには収容人数、場所、利用可能状況があります。
メニュー項目には名前、説明、価格、カテゴリ、食事制限情報があります。
スタッフは予約を管理し、注文を受け、支払いを処理する必要があります。
顧客はテーブルを予約し、メニューを閲覧し、注文を行うことができる必要があります。`,
  
  'lms': `## 学習管理システム（LMS）

### 主要ユーザー
1. **学生**: コースに登録し、コンテンツにアクセスし、課題を提出する個人
2. **講師**: コースを作成・管理し、学生の進捗を評価する教育者
3. **管理者**: システム全体を監督し、ユーザーアカウントとコースカタログを管理する人々

### コース・コンテンツ管理
- **講師として**、タイトル、説明、カテゴリ、開始/終了日、登録定員、難易度などのメタデータを持つコースを作成したいです。
- **講師として**、コンテンツを論理的な順序で整理するためにコースにモジュールやセクションを追加したいです。
- **講師として**、テキスト、ビデオ、音声、PDF、スライドショー、インタラクティブなHTML要素など、様々な形式の教材をアップロードしたいです。
- **講師として**、コースコンテンツをドラフトモードで作成し、公開前にプレビューしたいです。
- **管理者として**、コース全体のカタログを閲覧し、カテゴリ、講師、ステータス（アクティブ、プライベート、アーカイブ）でフィルタリングしたいです。

### 登録・進捗追跡
- **学生として**、利用可能なコースを閲覧し、詳細を確認してから登録したいです。
- **学生として**、自分の進捗を追跡し、完了したモジュールと次に何があるかを確認したいです。
- **学生として**、登録前に必要なスキルや予備知識を理解するためにコースの前提条件を確認したいです。
- **講師として**、学生の登録・登録解除を行い、個人またはクラス全体のコース開始/終了日の延長を設定したいです。
- **講師として**、ダッシュボードでクラス全体の進捗を確認し、遅れている学生を特定したいです。

### 評価・フィードバック
- **講師として**、多肢選択、記述、ファイルアップロード、プログラミング課題など、様々なタイプの課題やテストを作成したいです。
- **講師として**、採点基準（ルーブリック）を設定し、課題に詳細なフィードバックを提供したいです。
- **学生として**、課題を提出し、必要に応じて締め切り前に再提出したいです。
- **学生として**、自分の成績とフィードバックを確認し、必要に応じて講師に質問したいです。
- **講師として**、成績簿を管理し、各学生の総合成績を計算したいです。

### コミュニケーション・コラボレーション
- **学生として**、ディスカッションフォーラムで質問を投稿し、他の学生や講師から回答を受け取りたいです。
- **講師として**、クラス全体または個々の学生に通知やアナウンスを送信したいです。
- **学生として**、他の学生との共同作業のための共有ワークスペースを持つグループプロジェクトに参加したいです。
- **すべてのユーザーとして**、システム内でメッセージを送受信し、添付ファイルを共有したいです。
- **講師として**、リアルタイムのウェビナーやオンラインセッションをスケジュールし、録画を保存して学生が後からアクセスできるようにしたいです。

### レポート・分析
- **講師として**、学生のエンゲージメントとアクティビティ（ログイン頻度、閲覧したコンテンツ、課題完了までの時間）に関する分析を確認したいです。
- **管理者として**、プラットフォーム全体の使用状況とパフォーマンスメトリクスを確認したいです。
- **管理者として**、登録傾向、完了率、満足度評価に関するレポートを生成したいです。
- **講師として**、外部分析ツールで使用するために学生のパフォーマンスデータをエクスポートしたいです。

### アクセシビリティ・ローカライゼーション
- **すべてのユーザーとして**、システムとの対話のためのインターフェース言語を選択したいです。
- **学生として**、視覚または聴覚障害のためのアクセシビリティ機能を使用したいです。
- **講師として**、キャプションや代替テキストなどのアクセシビリティ要素をコンテンツに追加したいです。

### モバイル・オフラインアクセス
- **学生として**、モバイルデバイスからコースにアクセスし、スマートフォンやタブレットで快適に学習したいです。
- **学生として**、インターネット接続なしでオフライン学習のためにコンテンツをダウンロードしたいです。
- **講師として**、学生のエンゲージメントを高めるためにモバイルアプリを通じて通知を送信したいです。`
};
    
    // ALPS guide content
    const alpsGuide = `## ‼️ Important: JSON Format Guidelines ‼️

1. Write each descriptor on a single line (mandatory).
2. Only indent and line-break descriptors if they contain other descriptors.
3. All nested descriptors must reference their parent with \`href\`.

\`\`\`json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "title": "Name", "def": "https://schema.org/name"},
{"id": "email", "title": "Email", "def": "https://schema.org/email"},
{"id": "User", "title": "User Profile", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "title": "User List", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "View User Details", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "Create User", "rt": "#UserList"}
]}}
\`\`\`

## XML Format Guidelines

- Use indentation to indicate hierarchy.
- Write each element on a single line.

\`\`\`xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
\`\`\`

## Structuring Semantic Descriptors

Organize into the following three blocks. Each descriptor must either reference or contain other descriptors:

1. Semantic Definitions (Ontology)
   - Define basic elements (lowerCamelCase).
   - Always specify \`def\` as a full URL if there's a Schema.org definition.
   - Add a \`title\` to all descriptors.
   - Include \`doc\` only if necessary.
   - Each defined element must be referenced by at least one taxonomy state.

2. Containment Relationships (Taxonomy)
   - Descriptors representing states use UpperCamelCase.
   - Use \`href\` for referencing elements (direct definition via \`id\` is not allowed).
   - Each application state includes:
     * Elements displayed/used in the state (defined in the ontology).
     * Actions that can be performed (defined in choreography).
   - Use \`doc\` for additional details if needed.
   - Each taxonomy must either contain or transition to other taxonomies.

3. State Transitions (Choreography)
   - Define transition actions.
   - Select the appropriate \`type\` attribute.
   - Specify the transition destination (\`rt\`).
   - Use \`href\` to refer to necessary data items.
   - Each operation must be referenced by at least one taxonomy state.`;
    
    // Conversion prompt templates
    const conversionPrompts = {
      'OpenAPI': `**Task:** Convert this ALPS profile into a comprehensive OpenAPI 3.1 specification.

**Key Instructions:**

1. **State to Endpoint Mapping:**
   - Map each semantic state to a resource endpoint
   - Use tag attributes to organize endpoints into logical groups
   - Apply proper REST principles (plural nouns for collections, etc.)

2. **Transition Operations:**
   - Convert transitions with specific type attributes:
     - \`safe\` → GET operations
     - \`unsafe\` → POST operations 
     - \`idempotent\` → PUT/PATCH operations
     - Include DELETE operations for removal actions
   - Use appropriate HTTP status codes (200, 201, 204, 400, 404, etc.)

3. **Schema Definitions:**
   - Build schemas from semantic descriptors
   - Include all properties referenced in state descriptors
   - Use Schema.org definitions when available via \`def\` attributes
   - Apply proper validation constraints based on domain knowledge
   - Create both request and response schemas

4. **Complete Documentation:**
   - Use titles as summary descriptions
   - Convert doc attributes to detailed descriptions
   - Include examples for each operation
   - Document error responses and handling

5. **Consistent Design:**
   - Apply query parameters for filtering, sorting, pagination
   - Use path parameters for resource identifiers
   - Include security schemes appropriate for the domain
   - Ensure all endpoints have complete request/response documentation

**Output Format:** Provide YAML format with appropriate indentation and organization.`,
      
      'JSON Schema': `**Task:** Convert this ALPS profile into a comprehensive JSON Schema that accurately captures all data structures.

**Key Instructions:**

1. **Semantic Descriptors:**
   - Create type definitions for each semantic descriptor
   - Use $defs for proper schema reusability
   - Follow semantic descriptor hierarchies when defining nested structures
   - Use \`$ref\` to reference repeated structures

2. **Type & Format Selection:**
   - Choose appropriate types (string, number, integer, boolean, object, array)
   - Apply formats based on semantic meaning (date-time, email, uri, etc.)
   - For descriptors with Schema.org definitions, infer types from those definitions
   - Include multitype properties where appropriate

3. **Validation Rules:**
   - Add property constraints:
     - Strings: minLength, maxLength, pattern
     - Numbers: minimum, maximum, multipleOf
     - Arrays: minItems, maxItems, uniqueItems
     - Objects: required, additionalProperties
   - Define enumerations for constrained values

4. **Documentation & Metadata:**
   - Include title from the ALPS descriptor
   - Add description from doc attributes
   - Provide examples of valid data
   - Add $schema reference for validation

5. **Design Patterns:**
   - Use oneOf/anyOf for polymorphic structures
   - Create composition patterns with allOf when appropriate
   - Add conditional validation with if/then/else where needed

**Output Format:** Provide properly formatted JSON with appropriate indentation.`,
      
'GraphQL': `**Task:** Convert this ALPS profile into a complete GraphQL schema with operations and resolvers.

**Key Instructions:**

1. **Type Definitions:**
   - Create GraphQL types for each semantic descriptor
   - Define scalars based on data nature (String, Int, Float, Boolean, ID)
   - Create custom scalars for special formats (DateTime, Email, URL)
   - Structure relationships using proper GraphQL object connections

2. **Query Operations:**
   - Create queries from \`safe\` transitions
   - Implement filtering, sorting, and pagination for collection queries
   - Design nested queries that follow the semantic connections
   - Support efficient graph traversal with proper resolver planning

3. **Mutation Operations:**
   - Create mutations from \`unsafe\` and \`idempotent\` transitions
   - Define input types for creating and updating resources
   - Implement proper error handling and return types
   - Return modified objects from mutations for efficient client updates

4. **Schema Organization:**
   - Use GraphQL directives for documentation and validation
   - Group related operations based on ALPS tag attributes
   - Design consistent naming patterns across the schema
   - Implement interfaces for shared structures

5. **Advanced Features:**
   - Add subscription operations for real-time updates where appropriate
   - Implement union types for polymorphic responses
   - Design proper pagination with cursor-based approaches
   - Add custom directives for authorization and caching hints

**Output Format:** Provide the schema in SDL (Schema Definition Language) format, along with example operations and resolver patterns.`,
      
      'SQL': `**Task:** Convert this ALPS profile into a comprehensive SQL database schema with tables, relationships, and key operations.

**Key Instructions:**

1. **Table Structure:**
   - Create tables for main semantic descriptors
   - Define appropriate column types based on semantic meaning
   - Implement proper primary keys and indexes
   - Add foreign key constraints for relationships
   - Include CHECK constraints for data validation

2. **Relationship Modeling:**
   - Identify one-to-many, many-to-many, and one-to-one relationships
   - Create junction tables for many-to-many relationships
   - Implement proper ON DELETE/UPDATE behavior for referential integrity
   - Use appropriate naming conventions for relationship columns

3. **Data Operations:**
   - Create SELECT queries for \`safe\` transitions
   - Implement INSERT statements for \`unsafe\` transitions
   - Design UPDATE operations for \`idempotent\` transitions
   - Add DELETE operations where appropriate
   - Include stored procedures for complex operations

4. **Advanced Database Features:**
   - Design appropriate indexes for performance
   - Create views for common query patterns
   - Implement triggers for data integrity and auditing
   - Add computed columns for derived properties
   - Consider partitioning for large tables

5. **Completeness & Standards:**
   - Follow SQL standards for portability
   - Include documentation as comments
   - Create role-based permissions aligned with the domain
   - Design for transaction safety
   - Include data migration considerations

**Output Format:** Provide SQL DDL statements for schema creation, followed by example DML operations.`,
      
      'TypeScript': `**Task:** Convert this ALPS profile into a comprehensive TypeScript type system with interfaces, classes, and utility types.

**Key Instructions:**

1. **Core Type Definitions:**
   - Create interfaces for each semantic descriptor
   - Use proper TypeScript types (string, number, boolean, Date, etc.)
   - Implement inheritance for related types
   - Define enums for constrained values
   - Add JSDoc comments from ALPS documentation

2. **Type Relationships:**
   - Design composition patterns for nested structures
   - Create utility types for operations (Partial<T>, Pick<T>, etc.)
   - Implement generics for reusable patterns
   - Define index signatures for dynamic properties
   - Use union and intersection types appropriately

3. **API Integration:**
   - Create request and response interfaces
   - Implement service interfaces with typed methods
   - Design error handling with typed exceptions
   - Add validation decorators if using class-validator
   - Structure according to ALPS tag groupings

4. **Advanced TypeScript Features:**
   - Use conditional types for complex logic
   - Implement mapped types for transformations
   - Add template literal types for string patterns
   - Define type guards for runtime type checking
   - Use const assertions for literal values

5. **Code Organization:**
   - Structure code into modules based on ALPS tags
   - Create barrel exports for simplified imports
   - Design for tree-shaking and code splitting
   - Add examples of type usage
   - Include TypeScript configuration recommendations

**Output Format:** Provide well-organized TypeScript code with proper imports and exports.`
    };
    
    // Tab switching functionality
    document.getElementById('userStoryTabBtn').addEventListener('click', function() {
      document.getElementById('userStoryTab').classList.add('active');
      document.getElementById('directAlpsTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('directAlpsTabBtn').classList.remove('active');
    });
    
    document.getElementById('directAlpsTabBtn').addEventListener('click', function() {
      document.getElementById('directAlpsTab').classList.add('active');
      document.getElementById('userStoryTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('userStoryTabBtn').classList.remove('active');
    });
    
    // STEP 1: Sample story handling
    document.getElementById('sampleStorySelect').addEventListener('change', function() {
      if (this.value) {
        userStoryInput.value = sampleStories[this.value];
      }
    });
    
    // Custom language handling
    document.getElementById('languageSelect').addEventListener('change', function() {
      const customLanguageInput = document.getElementById('customLanguage');
      if (this.value === 'other') {
        customLanguageInput.classList.remove('hidden');
      } else {
        customLanguageInput.classList.add('hidden');
      }
    });
    
    // Generate ALPS Prompt button (from user story)
    generateAlpsPromptBtn.addEventListener('click', function() {
      if (userStoryInput.value.trim() === '') {
        alert('Please enter a user story.');
        return;
      }
      
      const format = document.querySelector('input[name="alpsFormat"]:checked').value;
      const language = getSelectedLanguage();
      
      // Generate ALPS prompt
      const alpsPrompt = generateAlpsPrompt(userStoryInput.value, format, language);
      alpsInput.value = alpsPrompt;
      
      // Move to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // Proceed to conversion button (from direct ALPS input)
    document.getElementById('proceedToConversionBtn').addEventListener('click', function() {
      const directAlpsInput = document.getElementById('directAlpsInput');
      
      if (directAlpsInput.value.trim() === '') {
        alert('Please enter an ALPS profile.');
        return;
      }
      
      // Transfer direct ALPS input to the conversion section
      alpsInput.value = directAlpsInput.value;
      
      // Move directly to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // STEP 2: Format selection handling
    let selectedFormat = null;
    
    openApiBtn.addEventListener('click', () => selectFormat('OpenAPI', openApiBtn));
    jsonSchemaBtn.addEventListener('click', () => selectFormat('JSON Schema', jsonSchemaBtn));
    graphqlBtn.addEventListener('click', () => selectFormat('GraphQL', graphqlBtn));
    sqlBtn.addEventListener('click', () => selectFormat('SQL', sqlBtn));
    typescriptBtn.addEventListener('click', () => selectFormat('TypeScript', typescriptBtn));
    
    function selectFormat(format, button) {
      selectedFormat = format;
      
      // Update UI to show selected format
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
      button.classList.add('selected');
    }
    
    // Convert ALPS button
    convertAlpsBtn.addEventListener('click', function() {
      if (alpsInput.value.trim() === '') {
        alert('Please generate or paste an ALPS profile.');
        return;
      }
      
      if (!selectedFormat) {
        alert('Please select a format to convert to.');
        return;
      }
      
      // Generate conversion prompt
      const conversionPrompt = conversionPrompts[selectedFormat] + 
        '\n\n_YOUR_ALPS_HERE_\n\n```\n' + alpsInput.value + '\n```';
      
      promptResult.textContent = conversionPrompt;
      resultTitle.textContent = `${selectedFormat} Conversion Prompt`;
      
      // Move to Step 3
      alpsSection.classList.add('hidden');
      resultSection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step3.classList.add('active');
    });
    
    // Navigation buttons
    backToUserStoryBtn.addEventListener('click', function() {
      alpsSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step1.classList.add('active');
    });
    
    backToAlpsBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step2.classList.add('active');
    });
    
    startOverBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step1.classList.add('active');
      step2.classList.remove('active');
      
      // Reset selections
      selectedFormat = null;
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
    });
    
    // Copy buttons
    copyAlpsBtn.addEventListener('click', function() {
      copyToClipboard(alpsInput.value, copyAlpsBtn);
    });
    
    copyResultBtn.addEventListener('click', function() {
      copyToClipboard(promptResult.textContent, copyResultBtn);
    });
    
    // Copy verification tip
    document.getElementById('copyTipBtn').addEventListener('click', function() {
      const tipText = "Please review this ALPS profile to verify that there are no isolated states (unreachable or exit-less states) and that all state transitions are properly connected. Also check if all semantic descriptors are consistently tagged and grouped.";
      copyToClipboard(tipText, this);
    });
    
    // Helper functions
    function getSelectedLanguage() {
      const languageSelect = document.getElementById('languageSelect');
      if (languageSelect.value === 'other') {
        return document.getElementById('customLanguage').value || 'Custom';
      } else {
        return languageSelect.value;
      }
    }
    
    function generateAlpsPrompt(userStory, format, language) {
      return `# ALPS Profile Creation Prompt

Please create an ALPS profile based on the following requirements. This profile should represent a complete and consistent application state design.

* Format: ${format.toUpperCase()}
* Language: ${language}
* Content: 

${userStory}

## ‼️ Important: Guidelines for Design Consistency and Completeness ‼️

1. **All states must be connected**:
   - Avoid isolated states (states that cannot be reached or exited)
   - Every state should have at least one incoming and one outgoing transition (except for home/start and final states)
   - Ensure all transitions between states are logical and clear

2. **Consistent use of semantic descriptors**:
   - Use consistent naming conventions for the same concepts
   - Only use the \`def\` attribute when a corresponding Schema.org definition exists
   - For custom concepts, provide clear titles and use the \`doc\` attribute for details when needed

3. **Complete user flows**:
   - Provide complete state transition paths for each key user story
   - Ensure CRUD operations (Create, Read, Update, Delete) are fully represented
   - Include all necessary functionality for each user role

4. **State transition completeness**:
   - Clearly define the success path for each operation
   - Ensure transitions between key states to prevent disruption of important business processes
   - Consider alternative flows for critical failure cases when necessary

5. **Grouping related elements**:
   - Group related processes and user journeys using the \`tag\` attribute
   - Use tags like "user-management", "content-creation", "payment-process", etc.
   - Apply consistent tags to states and transitions belonging to the same functional area
   - This helps identify related functionality when converting to APIs or data models

${alpsGuide}

## Output Requirements

- Include a clear title for every descriptor (concise one-line explanation)
- Use the doc attribute for detailed explanations when necessary
- Only reference Schema.org URLs with the def attribute when a corresponding definition exists
- Set appropriate type attributes (safe, unsafe, idempotent) for all state transitions
- Create reusable descriptors for common patterns
- Use consistent IDs and naming conventions for the same concepts
- Utilize the tag attribute to group related elements
- Use consistent tags for business domains or functional areas`;
    }
    
    function copyToClipboard(text, button) {
      navigator.clipboard.writeText(text)
        .then(() => {
          const originalText = button.textContent;
          button.textContent = '✅ Copied!, Paste it to your AI assistant';
          setTimeout(() => {
            button.textContent = originalText;
          }, 2000);
        })
        .catch(err => {
          console.error('Failed to copy: ', err);
          alert('Failed to copy. Please copy manually.');
        });
    }
  });
</script>



# インストールと利用ガイド

ASD（app-state-diagram）は、アプリケーションの状態遷移図やボキャブラリリストを含んだALPSの包括的なドキュメントを作成するためのツールです。以下の方法で利用できます。

## 利用方法の選択

### 1. オンライン版

ローカルインストール不要で、すぐに利用できます：

- [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/)

特徴：
- インストール不要
- ブラウザですぐに利用可能
- JSON/XML/HTMLファイルをドラッグ＆ドロップで読み込み可能
- スニペットや高度なコード補完機能
- ローカル環境へのインストールが不要な場合の推奨オプション
- 注意）現在複数ファイルを一度に編集することができません

### 2. Homebrew版

[homebrew](https://brew.sh/ja/)がインストールされている環境では最も簡単に利用できます。

インストール:

```bash
brew install alps-asd/asd/asd
```

### 3. Docker版

Dockerで実行するためのスクリプトをダウンロードして実行します。シェルスクリプトのダウンロードと実行を伴うために以下のセキュリティ確認手順に従ってください。

#### セキュリティ確認手順

1. スクリプトの内容確認（推奨）：

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | less
```

2. チェックサム検証：

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | sha256sum
```

期待値：
```
0f05034400b2e7fbfee6cddfa9dceb922e51d93fc6dcda62e42803fb8ef05f66
```

3. インストール実行：

```bash
sudo curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh -o /usr/local/bin/asd
sudo chmod +x /usr/local/bin/asd
```

#### 前提条件
- Dockerがインストールされていること
- curlコマンドが利用可能であること

### 4. Macランチャーアプリケーション（GUI版）

コマンドライン操作が不要なMac用GUIアプリケーションです。

インストール手順：
1. [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip)をダウンロード
2. セキュリティ確認：
   - ダウンロードしたファイルの内容を確認してください
   - チェックサム（SHA-256）の検証：
     ```bash
     shasum -a 256 [ダウンロードしたzipファイル]
     ```
   - 公式リポジトリの期待値と比較してください: 659ecc3225b95a04f0e2ac4ebed544267ba78a0221db7ed84b6dfd7b08ce423b
3. ダウンロードしたスクリプトをスクリプトエディタで開く
    - セキュリティ警告が表示された場合は、スクリプトを右クリック（またはControlキーを押しながらクリック）して「開く」を選択
    - システム設定 > プライバシーとセキュリティで、表示された場合は「開く」をクリック
4. アプリケーションとして書き出す：
   - 保存先：「アプリケーション」
   - フォーマット：「アプリケーション」として保存

### 5. GitHub Actions版

CIでASD作成を行います。詳細は[マーケットプレイス](https://github.com/marketplace/actions/app-state-diagram)をご覧ください。

### 6. VSCode Plugin

VSCodeでライブプレビューを可能にするプラグインが利用可能です。 (experimental)

[Visual Studio Marketplace - Application State Diagram](https://marketplace.visualstudio.com/items?itemName=koriym.app-state-diagram)

## 使用方法

### デモ実行
```bash
# デモファイルのダウンロードと実行
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### コマンドラインオプション
```
asd [options] [alpsFile]

オプション：
    -w, --watch     ウォッチモード
    -m, --mode      描画モード
    --port          利用ポート（デフォルト3000）
```

### モード設定
- 非公開リポジトリでの利用時はMarkdownモードを使用可能
- ただし、Markdownモードではダイアグラムのリンクは機能しません
- HTMLを公開できない場合の代替オプションとして利用

## インストール確認

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## 選択の目安

- すぐに試したい、一時的な利用 → オンライン版
- Mac環境でのローカル利用 → Homebrew版
- クロスプラットフォームでの利用 → Docker版
- Macローカル環境でGUI → ランチャーアプリケーション
- CI/CD環境での利用 → GitHub Actions版



# ALPSリファレンス

## 概要

Application-Level Profile Semantics (ALPS) は、アプリケーションのセマンティクス（意味論）を記述するためのドキュメントフォーマットです。このドキュメントではALPSの要素と属性について説明します。

## 文書構造

ALPSドキュメントは以下のような階層構造を持ちます：

1. **ルート要素 (`alps`)**
- バージョン情報を含むドキュメントのルート要素
- すべての定義はこの要素の中に含まれます

2. **ディスクリプタ要素 (`descriptor`)**
- アプリケーションの機能や情報の意味を定義する中心的な要素
- 以下の4つの型があります：
  - semantic: 語句・情報を表す（デフォルト）
  - safe: 読み取り操作（リソースの状態を変更しない）
  - idempotent: 同じ操作を複数回実行しても結果が変わらない操作（PUTによる完全な置き換えやDELETEによる消去など）
  - unsafe: 同じ操作を複数回実行すると異なる結果になる操作（POSTによる新規作成、数値の加算操作など）
- 他のdescriptor要素を子要素として含むことができます
- link要素を子要素として含むことができます

3. **補足要素**
- `doc`: 詳細な説明や補足情報
- `link`: 関連ドキュメントへの参照
- `title`: プロファイルの説明

## 記述形式

ALPSドキュメントは以下の2つの形式で記述できます：

**XML形式**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps version="1.0">
    <title>ブログAPIプロファイル</title>
    <doc>ブログシステムのAPIプロファイル</doc>
    
    <descriptor id="title" title="タイトル" doc="記事のタイトル。最大100文字。"/>
    
    <descriptor id="blogPost">
        <doc>ブログ記事</doc>
        <descriptor href="#title"/>
        <link rel="related" href="http://example.org/related-docs/blog.html" />
    </descriptor>
</alps>
```

**JSON形式**

```json
{
    "alps": {
        "version": "1.0",
        "title": "ブログAPIプロファイル",
        "doc": {"value": "ブログシステムのAPIプロファイル"},
        "descriptor": [
            {"id": "title", "title": "タイトル", "doc": {"value": "記事のタイトル。最大100文字。"}},
            {"id": "blogPost", "doc": {"value": "ブログ記事"}, 
             "descriptor": [
                {"href": "#title"}
             ],
             "link": [
                {"rel": "related", "href": "http://example.org/related-docs/blog.html"}
             ]
            }
        ]
    }
}
```

## 要素と属性の詳細

### alps

ALPSドキュメントのルート要素です。

属性：
- version: 文書のバージョン（必須）

### descriptor

アプリケーションの機能や情報の意味（セマンティクス）を定義します。
idまたはhrefのいずれかが必要でその他の属性はオプションです。

descriptorは以下の子要素を持つことができます：
- descriptor: 他のdescriptor要素を入れ子にして、階層構造を表現できます
- doc: 詳細な説明
- link: 関連リソースへのリンク
- ext: 拡張情報

### descriptor属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--||--|
| id | ※1 | string | 要素の一意識別子 | `"blogPost"` |
| href | ※1 | string | 他要素への参照 | `"#title"` |
| type | 任意 | enum | 要素の型 | `"safe"` |
| rt | 任意 | string | 遷移先リソース | `"#BlogPost"` |
| rel | 任意 | string | リレーション | `"item"` |
| title | 任意 | string | 表示名 | `"ブログ投稿"` |
| tag | 任意 | string | 分類タグ | `"blog post"` |
| name | 任意 | string | 表示用名前 | `"blog"` |
| def | 任意 | string | 定義元URI | `"http://schema.org/BlogPosting"` |
| descriptor | 任意 | element | 子descriptorの入れ子 | `<descriptor id="child">...</descriptor>` |
| link | 任意 | element | 関連リソースへのリンク | `<link rel="help" href="..."/>` |

※1: idまたはhrefのいずれかが必須

各属性の詳細：

* **id**: 一意の識別子（hrefと排他）
  - descriptorを一意に識別する文字列
  - 同一文書内で重複不可
  - URL安全な文字のみ使用可能（[RFC1738](https://www.rfc-editor.org/rfc/rfc1738)に準拠）

* **href**: 参照先（idと排他）
  - 他のdescriptorを参照するための識別子
  - "#"で始まるフラグメント識別子（例：#user）
  - 外部ファイルの場合はパスを含む（例：profile.xml#user）
  - 解決可能なURLとフラグメント識別子(#)必須

* **type**: ディスクリプターの型
  - semantic: 語句・情報を表す（デフォルト）
  - safe: 読み取り操作（リソースの状態を変更しない）
  - idempotent: 同じ操作を複数回実行しても結果が変わらない操作（PUTによる完全な置き換えやDELETEによる消去など）
  - unsafe: 同じ操作を複数回実行すると異なる結果になる操作（POSTによる新規作成、数値の加算操作など）

* **rt**: 遷移先（Return Type）
  - 状態遷移後の移動先リソース
  - "#"で始まるフラグメント識別子で指定
  - type属性が`safe`/`idempotent`/`unsafe`の場合に使用

* **rel**: リレーション
  - descriptorの関係性を示す
  - [IANAで定義されたLink Relations](iana_rels.html)を使用（item, collection, self, next, prev など）
  - カスタムの場合はURIで指定

* **title**: 表示名
  - 人間が読むための表示名
  - UIやドキュメントでの表示用

* **tag**: 分類タグ
  - descriptorのグルーピングに使用
  - 複数指定する場合はスペース区切り
  - カテゴリ分類やフィルタリング用

* **name**: 表示用名前
  - 実際の表現で使用される名前
  - idが一意である必要がある場合に、共通の名前を指定するために使用
  - 同じnameを持つ複数のdescriptorが存在可能

* **def**: 定義元URI
  - descriptorの定義元となる外部リソースを示すURI
  - Schema.orgなどの標準的な定義への参照に使用

### doc

要素の詳細な説明を提供します。

#### doc属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--||--|
| href | 任意 | string | 外部ドキュメントURL | `"http://example.com/doc"` |
| format | 任意 | string | ドキュメントフォーマット | `"markdown"` |
| contentType | 任意 | string | コンテンツタイプ | `"text/html"` |
| tag | 任意 | string | 分類タグ | `"api spec"` |
| value | 任意 | string | 説明文 | `"詳細な説明"` |

format属性のサポートレベル:

- text: サポート必須（MUST）
- html: サポート推奨（SHOULD）
- asciidoc: サポート任意（MAY）
- markdown: サポート任意（MAY）、[RFC7763]に準拠

contentTypeとformatの優先順位:

- contentTypeが存在する場合はそれを使用
- contentTypeとformatが両方ある場合はformatを無視
- どちらもない場合はtext/plainと見なす

### link

関連ドキュメントへの参照を定義します。linkはalpsまたはdescriptor要素の子要素として使用できます。

#### link属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--||--|
| href | 必須 | string | リンク先URL | `"http://example.com/docs"` |
| rel | 必須 | string | リレーション | `"help"` |
| title | 任意 | string | 表示名 | `"ヘルプドキュメント"` |
| tag | 任意 | string | 分類タグ | `"documentation"` |

リレーション値:
- self: 自身へのリンク
- profile: プロファイルドキュメント
- help: ヘルプドキュメント
- related: 関連ドキュメント
- その他の[IANAリンクリレーション](iana_rels.html)

### ext

拡張情報を提供します。標準仕様にない追加情報を含める場合に使用します。

#### ext属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--||--|
| id | 必須 | string | 拡張の一意識別子 | `"range"` |
| href | 推奨 | string | 拡張の説明URL | `"http://alps.io/ext/range"` |
| value | 任意 | string | 拡張値 | `"0,100"` |
| tag | 任意 | string | 分類タグ | `"validation"` |

## バリデーション

1. descriptorにはidまたはhrefのいずれかが必要です
2. href参照先は解決可能なURLでなければならず、フラグメント識別子が必須です
3. rt遷移先は文書内に実在する必要があります
4. type属性は定義された4値（semantic、safe、idempotent、unsafe）のいずれかである必要があります
5. 操作系descriptorには以下のプレフィックスの使用を推奨します：
- safe: `go`（例：`goBlog`）
- unsafe: `do`（例：`doCreateBlog`）
- idempotent: `do`（例：`doUpdateBlog`）

## 階層構造の例

以下は、入れ子になったdescriptor要素を使用した簡潔な階層構造の例です：

**XML形式**

```xml
<alps version="1.0">
  <descriptor id="user" type="semantic">
    <doc>ユーザー情報</doc>
    <descriptor id="name" type="semantic" />
    <descriptor id="email" type="semantic" />
    <link rel="help" href="http://example.org/help/user.html" />
  </descriptor>
</alps>
```

**JSON形式**

```json
{
  "alps": {
    "version": "1.0",
    "descriptor": [
      {
        "id": "user",
        "type": "semantic",
        "doc": {"value": "ユーザー情報"},
        "descriptor": [
          {"id": "name", "type": "semantic"},
          {"id": "email", "type": "semantic"}
        ],
        "link": [
          {"rel": "help", "href": "http://example.org/help/user.html"}
        ]
      }
    ]
  }
}
```



<link rel="stylesheet" href="{{ '/css/schema-styles.css' | relative_url }}">


# Schema.org 用語集

<h2>プロパティ</h2>

{% include html/schema-search.html table_id="schema-property-table" %}

<table id="schema-property-table">
  <thead>
    <tr>
      <th>Property</th>
      <th>Description</th>
      <th>Meta information</th>
    </tr>
  </thead>
  <tbody>
    {% for property in site.data.schema_properties_ja %}
      <tr>
        <td>
          <a href="https://schema.org/{{ property.label }}" class="schema-link">{{ property.label }}</a>
        </td>
        <td>{{ property.comment | replace: 'href="/', 'href="https://schema.org/' }}</td>
        {% include html/property-meta.html property=property %}
      </tr>
    {% endfor %}
  </tbody>
</table>

<h2>タイプ</h2>

<table id="schema-type-table">
  <thead>
    <tr>
      <th>Type</th>
      <th>Description</th>
      <th>Meta information</th>
    </tr>
  </thead>
  <tbody>
    {% for type in site.data.schema_types_ja %}
      <tr>
        <td>
          <a href="https://schema.org/{{ type.label }}" class="schema-link">{{ type.label }}</a>
        </td>
        <td>{{ type.comment | replace: 'href="/', 'href="https://schema.org/' }}</td>
        {% include html/type-meta.html type=type %}
      </tr>
    {% endfor %}
  </tbody>
</table>



# 推奨セマンティック用語

## 概要

このドキュメントは[Schema.org](https://schema.org)で定義されている語彙から、ALPSプロファイルのセマンティックディスクリプタ(id)として使用できる用語の完全な一覧です。

### 使い方

1. APIの設計を始める際は、まず 🔵 Core Terms から適切な用語を選択します。
2. より詳細な表現が必要な場合は、🟡 Extended Terms を検討します。
3. 特殊なユースケースでは、⚪ Full Terms まで視野に入れて検討します。
4. カテゴリインデックスから必要な分野の用語を探せます。
5. ドメイン固有の用語について:
- 業界やビジネス固有の用語は、独自のセマンティックディスクリプタとして定義します。
- 命名規則: domainName + PropertyName （例：orderShippingStatus, medicalDiagnosisCode）
- できるだけSchema.orgの用語を基盤としつつ、必要な拡張を行うことを推奨します。
- ドメイン固有の用語を定義する際は、その意味と用途を明確にドキュメント化することが重要です。

### カテゴリインデックス

1. [基本プロパティ](#基本プロパティ)
2. [識別子・参照](#識別子参照)
3. [メタデータ](#メタデータ)
4. [日時・期間](#日時期間)
5. [テキスト・コンテンツ](#テキストコンテンツ)
6. [メディア・ファイル](#メディアファイル)
7. [人物・個人](#人物個人)
8. [組織・団体](#組織団体)
9. [住所・位置](#住所位置)
10. [商品・サービス](#商品サービス)
11. [価格・支払い](#価格支払い)
12. [イベント・活動](#イベント活動)
13. [レビュー・評価](#レビュー評価)
14. [教育・学習](#教育学習)
15. [医療・健康](#医療健康)
16. [金融・取引](#金融取引)
17. [予約・スケジュール](#予約スケジュール)
18. [コミュニケーション](#コミュニケーション)
19. [セキュリティ・アクセス制御](#セキュリティアクセス制御)
20. [ワークフロー・プロセス](#ワークフロープロセス)
21. [技術・システム](#技術システム)
22. [法務・規約](#法務規約)
23. [その他の属性](#その他の属性)

---|
| status | 🔵 | 状態 |
| type | 🔵 | タイプ |
| category | 🔵 | カテゴリ |
| order | 🔵 | 順序 |
| priority | 🔵 | 優先度 |
| tag | 🔵 | タグ |
| group | 🔵 | グループ |
| relation | 🔵 | 関係 |
| source | 🔵 | ソース |
| target | 🔵 | ターゲット |
| origin | 🟡 | 起源 |
| destination | 🟡 | 目的地 |
| sortOrder | 🟡 | ソート順 |
| rank | 🟡 | ランク |
| score | 🟡 | スコア |
| level | 🟡 | レベル |
| theme | 🟡 | テーマ |
| style | 🟡 | スタイル |
| layout | 🟡 | レイアウト |
| template | 🟡 | テンプレート |
| format | 🟡 | フォーマット |
| mode | 🟡 | モード |
| state | 🟡 | 状態 |
| phase | 🟡 | フェーズ |
| context | 🟡 | コンテキスト |
| scope | 🟡 | スコープ |
| flags | ⚪ | フラグ |
| options | ⚪ | オプション |
| settings | ⚪ | 設定 |
| preferences | ⚪ | 環境設定 |
| configuration | ⚪ | 構成 |
| customization | ⚪ | カスタマイズ |
| variant | ⚪ | バリアント |
| alternative | ⚪ | 代替 |
| fallback | ⚪ | フォールバック |
| override | ⚪ | 上書き |
| default | ⚪ | デフォルト |
| custom | ⚪ | カスタム |
| external | ⚪ | 外部 |
| internal | ⚪ | 内部 |
| public | ⚪ | 公開 |
| private | ⚪ | 非公開 |
| hidden | ⚪ | 非表示 |
| visible | ⚪ | 表示 |
| enabled | ⚪ | 有効 |
| disabled | ⚪ | 無効 |
| locked | ⚪ | ロック済み |
| archived | ⚪ | アーカイブ済み |
| deleted | ⚪ | 削除済み |
| deprecated | ⚪ | 非推奨 |

## おわりに

このドキュメントは継続的に更新され、新しい用語や使用パターンが追加される可能性があります。

### 重要度レベル

すべての用語は、重要度と使用頻度に基づいて3段階にレベル分けされています：

- 🔵 **Core Terms**: 基本的なAPIに必須の主要用語（全体の約10-15%）
  - ほとんどのアプリケーションで使用される基礎的な語彙
  - シンプルなAPIを作る際の最初の選択肢
  - 一般的なCRUD操作に必要な用語

- 🟡 **Extended Terms**: よく使用される拡張用語（全体の約30-35%）
  - 特定のドメインやより詳細な表現に必要な語彙
  - 一般的なビジネスアプリケーションでよく使用される用語
  - より豊かな表現力が必要な場合の選択肢

- ⚪ **Full Terms**: 特殊用途の用語（全体の約50-55%）
  - 特定の業界や特殊なユースケースで必要となる語彙
  - 完全な互換性が必要な場合の選択肢
  - 非常に専門的な表現のための用語


### 使用上の注意


2. **命名規則**:
  - lowerCamelCase形式を使用
  - 略語は避け、完全な単語を使用
  - 一貫性のある命名パターンを維持

3. **カスタマイズ**:
  - 必要に応じて独自の用語を追加可能
  - 業界固有の用語は適切なプレフィックスを付けることを推奨
  - 組織内で統一した用語の使用を心がける

4. **相互運用性**:
  - Schema.orgとの互換性を意識
  - 標準的な用語を優先的に使用
  - 独自拡張する場合は明確な文書化を行う

### 参考リソース

- [Schema.org](https://schema.org)
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
- [ALPS Specification](http://alps.io/spec/)



# 共有ボキャブラリ

アプリケーションを設計する際に共有ボキャブラリ(共通語彙)サイトに登録された標準化された語句を利用することを推奨します。

## IANA リンクリレーション

リンクリレーションとは、2つのリソース間の関係性を示す標準化された識別子です。主な目的は、リソース間の意味的な関係を明確にすることです。

例) IANAに登録されている`author`
```xml
<descriptor id="goBookAuthor" type="safe" rt="#BookAuthor" rel="author">
```

[IANAリンクリレーション](iana_rels.html)をご覧ください。

## Schema.org

Schema.orgは、Google、Microsoft、Yahoo、Yandexが共同で開発した構造化データの語彙（ボキャブラリー）です。

[セマンティック用語](semantic-terms.html)をご覧ください。

[Schema.org](https://schema.org)のセマンティックをインポートしたALPSファイルが利用できます。

* [Schema.org ALPS Index](https://alps-io.github.io/imports/schema.org)

セマンティックに`href`でリンクします。

例）`givenName`と`familynName`

```xml
<decriptor id="Person">
    <descriptor href="https://alps-io.github.io/imports/schema.org/properties/givenName.json" />
    <descriptor href="https://alps-io.github.io/imports/schema.org/properties/familyName.json" />
</decriptor>
```
## 狭くする

共有ボキャブラリからセマンティックを狭くしたディスクリプタを作成できます。

例）
```xml
<descriptor id="bankAccountId" href="https://alps-io.github.io/imports/schema.org/properties/accountId.json" />
```



<style>

.description {
    font-size: 24px;
    line-height: 1.5;
    color: #333;
    margin: 0;
    text-align: center;
    margin-top: 50px;
    margin-bottom: 50px;

    font-family: "Noto Sans JP", "Yu Gothic", "游ゴシック", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", sans-serif;
}
</style>

<img class="crop-image" src="/images/slide/app-state-diagram.001.jpeg" alt="家の外観写真、内観写真、パース図を並べた画像。完成予想図だけでは不十分なことを示している">
<p class="description">家を建てるとき、外観写真やパース図だけでは不十分です。</p>



<img src="/images/slide/app-state-diagram.003.jpeg" alt="ALPSの状態遷移図と、それに関連するセマンティックデスクリプターの一覧。Webサイト構築における共通言語としてのALPSを示している">
<p class="description">Webサイトを作る時の共通言語が、ALPSドキュメントです。</p>



<a class="intl btn btn-light" id="learn" href="/manuals/1.0/en/index.html">
    Learn More &raquo;
</a>
<script src="/js/switch_intl.js"></script>
<script src="/js/speech.js"></script>




# ALPS チュートリアル

ALPSのチュートリアルは2部構成になっています：

1. **基本チュートリアル**（このページ）
   - 実践的なハンズオン形式で、ALPSの基本的な使い方を学びます
   - ツールの使用方法から始めて、段階的にALPSの機能を理解していきます
   - ALPSを使い始めるための最初のステップとして最適です

2. **[応用チュートリアル](./tutorial_rest.html)**
   - ALPSの理論的な基盤と設計パターンについて学びます
   - REST/HTTPアプリケーションの状態遷移システムとしての本質を理解します
   - より深い理解を得たい方や、大規模なアプリケーション設計に携わる方向けです

まずはこの基本チュートリアルから始めることをお勧めします。

---

## 始める

このチュートリアルでは、ブラウザベースのALPSエディタを使用します：

1. [ALPS Editor]( https://editor.app-state-diagram.com/) を開きます
2. 左側のエディターペインに表示されているデモコードを全て削除します

注：ローカル環境でASDアプリケーションを使用することもできますが、このチュートリアルではオンラインエディタの使用を推奨しています。

## 最初のステップ：空のファイルを用意する

ALPSドキュメントを作成するための最初のステップとして、基本となる空のファイルを用意します。これは、すべてのALPSドキュメントの出発点となる最小限の構造を持つファイルです。

ALPSドキュメントは、XMLまたはJSON形式で記述できます。それぞれの形式には対応するスキーマ（XMLはXSD、JSONはJson-Schema）があり、これを参照することでドキュメントの構造が正しく、ALPS仕様に沿っているかをチェックできます。どちらの形式を使っても機能的な違いはないので、チームの好みや普段使っているツールに合わせて選んでください。

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
        ]
    }
}
```

## 意味をIDとして登録する

ALPSではアプリケーションが扱う特定の語句をIDとして定義します。最初に`dateCreated`（作成日付）という語句を加えてみましょう。

XMLの場合：
```diff
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
+    <descriptor id="dateCreated"/>
</alps>
```

JSONの場合：
```diff
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
+            {"id": "dateCreated"}
        ]
    }
}
```

## 語句を説明する

`title`や`doc`で説明を加えられます。

XMLの場合：
```diff
<?xml version="1.0" encoding="UTF-8"?>
<alps
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
-    <descriptor id="dateCreated"/>
+   <descriptor id="dateCreated" title="作成日付">
+      <doc format="text">ISO8601フォーマットで記事の作成日付を表します</doc>
+   </descriptor>
</alps>
```

JSONの場合：
```diff
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
-            {"id": "dateCreated"}
+            {"id": "dateCreated", "title": "作成日付", "doc": {"format": "text", "value": "ISO8601フォーマットで記事の作成日付を表します"}}
        ]
    }
}
```

titleは見出しのような簡潔な表現、docはより長いテキストでの説明です。

この意味に紐づけられたIDを**セマンティックディスクリプタ**（意味的記述子）といいます。`dateCreated`は「作成日付」という意味を紐づけたセマンティックディスクリプタです。このような意味や概念の定義を**オントロジー**といいます。

### ボキャブラリ

ALPSの重要な役割の１つはアプリケーションの語句の辞書になることです。利用者が同じ意味を指し示すときは同じ語句を使い、表現の揺れを防いだり、利用者が違った認識を持つことを防止します。

## 情報は情報を含む

セマンティックディスクリプタはセマンティックディスクリプタを含むことがあります。

例えば、`BlogPosting`（ブログ記事）は`articleBody`（本文）と`dateCreated`（作成日付）を含みます。descriptorの中にdescriptorを記述することで情報の階層を表します。このような情報の構成や配置が**タクソノミー**です。

XMLの場合：
```xml
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    
    <!-- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="本文"/>
    <descriptor id="dateCreated" title="作成日付"/>

    <!-- Taxonomy -->
    <descriptor id="BlogPosting" title="記事" >
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="Blog" title="記事リスト">
        <descriptor href="#BlogPosting"/>
    </descriptor>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "id", "title": "id"},
            {"id": "articleBody", "title": "本文"},
            {"id": "dateCreated", "title": "作成日付"},
            {"id": "BlogPosting", "title": "記事", "descriptor": [
                {"href": "#id"},
                {"href": "#dateCreated"},
                {"href": "#articleBody"}
            ]},
            {"id": "Blog", "title": "記事リスト", "descriptor": [
                {"href": "#BlogPosting"}
            ]}
        ]
    }
}
```

`#`を使って他のdescriptorを参照する事ができます。これを**インラインリンク**と呼び１つのdescriptorを複数の箇所から参照する事ができます。

## 情報の閲覧と操作

Webのページは情報だけでなく他のページへのリンクやアクションのフォームを含み、関連する情報の閲覧や操作ができます。以下の３種類の操作が出来ます。

### safe

関連する情報の閲覧。HTMLで言うとAタグ、HTTPではGETです。リソースの状態を変更しない**安全な遷移**です。ユーザーが何を見ているかという**アプリケーション状態**が変化します。つまり閲覧しているURLが変わります。

### idempotent

リソース状態を変更します。冪等性（べきとうせい）があり、何度繰り返しても同じ結果になります。ファイルの上書きをイメージしてください。何度実行しても結果は変わりません。

### unsafe

idempotentと同じようにリソース状態は変更しますが冪等性がありません。ファイルの追記をイメージしてください。繰り返し実行しただけ結果が異なってきます。

### HTTPメソッドとの対応

safeは`GET`、idempotentは`PUT`または`DELETE`、unsafeは`POST`とそれぞれのHTTPのメソッドに対応します。

### リンク

`type`で操作の種類、`rt`で遷移先を指定してリンクを作成します。
この例は`Blog`を閲覧するリンクです。

XMLの場合：
```xml
<descriptor type="safe" id="goBlog" rt="#Blog" title="ブログ記事リストを見る" />
```

JSONの場合：
```json
{"type": "safe", "id": "goBlog", "rt": "#Blog", "title": "ブログ記事リストを見る"}
```

この例はブログ記事からブログ記事リストに戻る操作を追加しています。

XMLの場合：
```xml
<descriptor id="BlogPosting" title="記事">
    <descriptor href="#id"/>
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
    <descriptor href="#goBlog" />
</descriptor>
```

JSONの場合：
```json
{"id": "BlogPosting", "title": "記事", "descriptor": [
    {"href": "#id"},
    {"href": "#dateCreated"},
    {"href": "#articleBody"},
    {"href": "#goBlog"}
]}
```

遷移や操作に必要なdescriptorはdescriptorに含めます。

XMLの場合：
```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="記事を見る">
    <!-- 記事を見るにはIDが必要 -->
    <descriptor href="#id"/>
</descriptor>
```

JSONの場合：
```json
{"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "記事を見る", "descriptor": [
   {"href": "#id"}
]}
```

ブログ記事リストとブログ記事双方のリンクを追加してみましょう。

XMLの場合：
```xml
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    
    <!-- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="本文"/>
    <descriptor id="dateCreated" title="作成日付"/>

    <!-- Taxonomy -->
    <descriptor id="BlogPosting" title="記事" >
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
        <descriptor href="#goBlog" />
    </descriptor>
    <descriptor id="Blog" title="記事リスト">
        <descriptor href="#BlogPosting"/>
        <descriptor href="#goBlogPosting" />
    </descriptor>

    <!-- Choreography -->
    <descriptor type="safe" id="goBlog" rt="#Blog" title="記事リストを見る" />
    <descriptor type="safe" id="goBlogPosting" rt="#BlogPosting" title="記事を見る">
        <descriptor href="#id"/>
    </descriptor>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "id", "title": "id"},
            {"id": "articleBody", "title": "本文"},
            {"id": "dateCreated", "title": "作成日付"},
            {"id": "BlogPosting", "title": "記事", "descriptor": [
                {"href": "#id"},
                {"href": "#dateCreated"},
                {"href": "#articleBody"},
                {"href": "#goBlog"}
            ]},
            {"id": "Blog", "title": "記事リスト", "descriptor": [
                {"href": "#BlogPosting"},
                {"href": "#goBlogPosting"}
            ]},
            {"type": "safe", "id": "goBlog", "rt": "#Blog", "title": "記事リストを見る"},
            {"type": "safe", "id": "goBlogPosting", "rt": "#BlogPosting", "title": "記事を見る", "descriptor": [
               {"href": "#id"}
            ]}
        ]
    }
}
```

## アプリケーション状態遷移図

記事リスト、記事、双方からリンクされた状態遷移図が表示されます。四角のボックスのはユーザーがどこを見ているかというアプリケーション状態、つまり閲覧中のWebページです。矢印は情報の閲覧や変更などの操作を表します。HTMLでのAタグやFORMタグの遷移に該当します。ボックスや矢印をクリックすると詳しい情報が見られます。確認してみましょう。

Webサイトの情報が相互にリンクされているように、ASDドキュメントページも相互にリンクされています。アプリケーション状態遷移図はサイトの情報設計を俯瞰することができ、情報の意味や構造、接続といった情報設計の詳細にリンクしています。



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

これら3つの要素が状態遷移システムの基本です。

### RESTの２つの状態

状態遷移で用いられる状態以外に、RESTには2種類の重要な状態があります：

1. **アプリケーション状態**
   - クライアント（ブラウザ）側での現在の位置を示し、URLで表現されます

2. **リソース状態**
   - サーバー側で管理されるデータの状態です

クライアントはアプリケーション状態の変更によってリソース状態にアクセスし、
サーバーはリソース状態とともに、次の状態への遷移情報（ネットワークアフォーダンス）も返します。

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

1. ブラウザで [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/) を開きます
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
            {"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
               {"href": "#dateCreated"},
               {"href": "#articleBody"}
            ]}
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
|||| 
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
            {"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
               {"href": "#dateCreated"},
               {"href": "#articleBody"}
            ]},
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "ブログ記事を見る", "descriptor": [
               {"href": "#dateCreated"}
            ]}
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
{"id": "doCreateBlogPosting", "type": "unsafe", "rt": "#BlogPosting", "title": "ブログ記事を作成する", "descriptor": [
    {"href": "#articleBody"}
]}
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
- unsafe：作成操作（prefixは`doCreate`）
- idempotent：更新・削除操作（prefixは`update`/`delete`）

### リンク関係の指定

これらの遷移の種類に加えて、標準的なリンク関係を`rel`属性で指定できます：

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
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "rel": "item", "title": "記事を見る", "descriptor": [
               {"href": "#id"}
            ]},
            {"id": "returnToBlog", "type": "safe", "rt": "#Blog", "rel": "collection", "title": "記事リストに戻る"}
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
        {"href": "#dateCreated", "tag": "metadata"},
        {"href": "#articleBody", "tag": "content"},
        {"href": "#goBlogPosting", "tag": "navigation"},
        {"href": "#doCreateBlogPosting", "tag": "action"}
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

