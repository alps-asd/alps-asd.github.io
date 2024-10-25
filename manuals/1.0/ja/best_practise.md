---
layout: docs-ja
title: ベストプラクティス
category: Manual
permalink: /manuals/1.0/ja/best_practice.html
---

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

ALPSでは、階層的な意味をポジションで表現することができます。

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
{
    "descriptor": [
        {
            "id": "blogPost",
            "doc": {"value": "ユーザーが作成した記事。公開後は全てのユーザーが閲覧可能。"},
            "descriptor": [
                {"href": "#title"},
                {"href": "#content"},
                {"href": "#publishedAt"}
            ]
        },
        {
            "id": "pagePost",
            "doc": {"value": "固定ページ。サイトの基本情報などの永続的なコンテンツ。"},
            "descriptor": [
                {"href": "#title"},
                {"href": "#content"}
            ]
        }
    ]
}
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
{
    "descriptor": [
        {"id": "goBlog", "type": "safe", "rt": "#Blog", "doc": {"value": "ブログのトップページを表示。最新10件の記事を一覧表示。"}},
        {"id": "doCreateBlogPost", "type": "unsafe", "rt": "#BlogPost", "doc": {"value": "新規記事を作成。下書き状態で保存される。"}, "descriptor":[
            {"href": "#title"},
            {"href": "#content"}
        ]},
        {"id": "doPublishBlogPost", "type": "idempotent", "rt": "#BlogPost", "doc": {"value": "記事を公開。publishedAtに現在時刻が設定される。"}, "descriptor": [
            {"href": "#id"}
        ]}
    ]
}
```
