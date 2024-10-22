---
layout: docs-ja
title: リファレンス
category: Manual
permalink: /manuals/1.0/ja/reference.html
---

# ALPSリファレンス

# alps

後述の**セマンティックディスクリプタ**の集合がALPSドキュメントです。XMLまたはJSONで記述し\<alps\>タグで全体を囲みます。

```xml
<alps>
  <descriptor ...>
  <descriptor ...>
</alps>
```

```json
{
    "alps": {
        "descriptor": [
            {},
            {}
        ]
    }
}
```

セマンティックディスクリプタはアプリケーションで使われる**特別な語句**を定義します。

```xml
<descriptor id="dateCreated" title="作成日付"/>
```

```json
{"id": "dateCreated", "title": "作成日付"}
```

## title, doc, link

ALPSドキュンメントにはtitle、doc、linkなどのメタ情報を付加できます。

```xml
<alps>
  <title>ALPS Blog</title>
  <doc>An ALPS profile example for ASD</doc>
  <link href="https://github.com/koriym/app-state-diagram/issues" rel="issue"/>
  <descriptor ...>
  <descriptor ...>
</alps>
```

```json
{
  "alps": {
     "title": "ALPS Blog",
     "doc": {"value": "An ALPS profile example for ASD"},
     "link": {"rel": "issue", "href": "https://github.com/koriym/app-state-diagram/issues"}, "descriptor": [
    {},
    {}
  ]}
}
```

# descriptor

descriptorはセマンティックディスクリプタ(意味的識別子)のための要素です。APIの項目名やリンクの名前など、アプリケーションのとって特別な語句を説明します。

例）ブログ記事は本文や日付の情報を含んでいる

```xml
<descriptor id="BlogPosting" title="ブログ記事" >
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
</descriptor>
```

```json
{
  "id": "BlogPosting", "title": "ブログ記事", "descriptor": [
    {"href": "#dateCreated"},
    {"href": "#articleBody"}
  ]
}
```

例）ブログ記事を参照するには記事IDが必要

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting">
    <descriptor href="#id"/>
</descriptor>
```

```json
{
  "id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "descriptor": [
    {"href": "#id"}
  ]
}
```

### doc

文章で意味を説明するdoc

```xml
<descriptor id="dateCreated">
    <doc format="markdown">ISO8601フォーマットで表された記事の作成日付</doc>
</descriptor>
```

```json
{
  "id": "dateCreated", "doc": {"format": "markdown", "value": "ISO8601フォーマットで表された記事の作成日付"}
}
```

### link

他のリソースの説明をリンクするlink

```xml
<descriptor id="dateCreated">
    <link rel="author" href="https://github.com/koriym">
</descriptor>
```

```json
{
  "id": "dateCreated", "link": {"rel": "author", "href": "https://github.com/koriym"}
}
```

# Descriptor要素

descriptorにIDや、タイプ、タグと行った属性を付与できます。

|  属性  |  意味  | 例 |
| ---- | ---- | ---- |
|  id  |  識別子  | createdDate  |
|  type | 型 | semantic \| safe \| unsafe \| idempotent |
|  href   |  参照  |　#id |
|  rt   |  遷移先  | #User |
|  rel  |  関係  | edit |
|  title   |  タイトル  | 作成時刻  |
|  tag   |  タグ  | ontology |

## type

typeはdescriptorの性質を表します。

### semantic

アプリケーションで使う語句をリストアップし、ボキャブラリを作成します。

```xml
<descriptor id="dateCreated" type="semantic"/>
```

```json
{"id": "dateCreated", "type": "semantic"}
```

### safe

状態が変化しない、読み取りのための遷移です。

```xml
<descriptor id="goBlog" type="safe" rt="#Blog" />
```

```json
{"id": "goBlog", "type": "safe", "rt": "#Blog"}
```

### idempotent

状態が冪等で変化する遷移です。

```xml
<descriptor id="doDeleteMenu" type="idempotent" rt="#Menu">
```

```json
{"id": "doDeleteMenu", "type": "idempotent", "rt": "#Menu"}
```

### unsafe

状態変化が冪等ではない遷移です。

```xml
<descriptor id="doAppendRecord" type="unsafe" rt="#Record">
```

```json
{"id": "doAppendRecord", "type": "unsafe", "rt": "#Record"}
```

## href

１つのdescriptorを再利用するためにhrefでリンクをする事ができます。リンクには同じドキュメントからリンクするインラインリンクと、他のファイルのdescriptorにリンクするアウトバウンドリンクの２つがあります。

```xml
<!-- インラインリンク -->
<descriptor href="#articleBody">

<!-- アウトバウンドリンク -->
<descriptor href="Blog.xml#articleBody">
```

```json
{"href": "#articleBody"}

{"href": "Blog.xml#articleBody"}
```

## rel

状態遷移の関係性を表します。値として以下のいずれかを指定できます：

1. IANAで定義されているLink Relationsの値（[推奨リレーション一覧](recommended_iana_rels.html)を参照）
    - 例：`edit`, `create`, `next`, `prev` など

2. カスタムの関係性を表すURL
    - 例：`https://example.com/rels/custom-relation`

```xml
<!-- IANAで定義された関係性を使用 -->
<descriptor id="editBlogPosting" type="idempotent" rel="edit" rt="#Blog">

<!-- カスタムの関係性を使用 -->
<descriptor id="customAction" type="safe" rel="https://example.com/rels/custom-relation" rt="#Blog">
```

```json
{"id": "editBlogPosting", "type": "idempotent", "rel": "edit", "rt": "#Blog"}

{"id": "customAction", "type": "safe", "rel": "https://example.com/rels/custom-relation", "rt": "#Blog"}
```

## title

内容を一行で表すコメントです。

```xml
<descriptor id="editBlogPosting" type="idempotent" rt="#Blog" title="記事の編集" />
```

```json
{"id": "editBlogPosting", "type": "idempotent", "rt": "#Blog", "title": "記事の編集"}
```

## tag

タグでグループを作ります。描画ツールはタグ単位で描画の有無や色を指定できます。

```xml
<descriptor id="editBlogPosting" type="idempotent" rt="#Blog" tag="choreography" />
```

```json
{"id": "editBlogPosting", "type": "idempotent", "rt": "#Blog", "tag": "choreography"}
```
