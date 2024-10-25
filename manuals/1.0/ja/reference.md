---
layout: docs-ja
title: リファレンス
category: Manual
permalink: /manuals/1.0/ja/reference.html
---

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
            {"id": "blogPost", "doc": {"value": "ブログ記事"}, "descriptor": [
                {"href": "#title"}
            ]}
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

### descriptor属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--------|------|-----|------|-----|
| id | ※1 | string | 要素の一意識別子 | `"blogPost"` |
| href | ※1 | string | 他要素への参照 | `"#title"` |
| type | 任意 | enum | 要素の型 | `"safe"` |
| rt | 任意 | string | 遷移先リソース | `"#BlogPost"` |
| rel | 任意 | string | リレーション | `"item"` |
| title | 任意 | string | 表示名 | `"ブログ投稿"` |
| tag | 任意 | string | 分類タグ | `"blog post"` |
| doc | 任意 | object/string | 詳細説明 | `"詳細な説明"` |

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

* **doc**: 詳細説明
  - descriptorの詳細な説明
  - doc要素として子要素にも定義可能
  - フォーマットの指定が可能

### doc

要素の詳細な説明を提供します。

#### doc属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--------|------|-----|------|-----|
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

関連ドキュメントへの参照を定義します。

属性：
- href: リンク先URL（必須）
- rel: リレーション（必須）
  - self: 自身へのリンク
  - profile: プロファイルドキュメント
  - help: ヘルプドキュメント
  - related: 関連ドキュメント
  - その他の[IANAリンクリレーション](iana_rels.html)


## バリデーション

1. descriptorにはidまたはhrefのいずれかが必要です
2. href参照先は解決可能なURLでなければならず、フラグメント識別子が必須です
3. rt遷移先は文書内に実在する必要があります
4. type属性は定義された4値（semantic、safe、idempotent、unsafe）のいずれかである必要があります
5. 操作系descriptorには以下のプレフィックスの使用を推奨します：
  - safe: `go`（例：`goBlog`）
  - unsafe: `do`（例：`doCreateBlog`）
  - idempotent: `do`（例：`doUpdateBlog`）
