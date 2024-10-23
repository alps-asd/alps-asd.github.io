---
layout: docs-ja
title: 高度な実装ガイド
category: Manual
permalink: /manuals/1.0/ja/adavanced_guide.html
---

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
    "self": { "href": "/posts/1" },
    "add-comment": { "href": "/posts/1/comments" }
  },
  "title": "記事タイトル",
  "content": "本文...",
  "_embedded": {
    "comments": [
      {
        "_links": {
          "self": { "href": "/comments/1" }
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


