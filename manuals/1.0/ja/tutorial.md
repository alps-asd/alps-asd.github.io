---
layout: docs-ja
title: チュートリアル
category: Manual
permalink: /manuals/1.0/ja/tutorial.html
---
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

1. [ALPS Editor](https://app-state-diagram.free.nf/) を開きます
2. 左側のエディターペインに表示されているデモコードを全て削除します

注：ローカル環境でASDアプリケーションを使用することもできますが、このチュートリアルではオンラインエディタの使用を推奨しています。

## 意味をIDとして登録する

ALPSではアプリケーションが扱う特定の語句をIDとして定義します。最初に`dateCreated`（作成日付）という語句を加えてみましょう。

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated"/>
</alps>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "dateCreated"}
        ]
    }
}
```

## 語句を説明する

`title`や`doc`で説明を加えることができます。

XMLの場合：
```xml
<descriptor id="dateCreated" title="作成日付">
    <doc format="text">ISO8601フォーマットで記事の作成日付を表します</doc>
</descriptor>
```

JSONの場合：
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "dateCreated", "title": "作成日付", "doc": {"format": "text", "value": "ISO8601フォーマットで記事の作成日付を表します"}}
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

記事リスト、記事、双方からリンクされた状態遷移図が表示されます。四角のボックスのはユーザーがどこを見ているかというアプリケーション状態、つまり閲覧中のWebページです。矢印は情報の閲覧や変更などの操作を表します。HTMLでのAタグやFORMタグの遷移に該当します。ボックスや矢印をクリックすると詳しい情報を見ることができます。確認してみましょう。

Webサイトの情報が相互にリンクされているように、ASDドキュメントページも相互にリンクされています。アプリケーション状態遷移図はサイトの情報設計を俯瞰することができ、情報の意味や構造、接続といった情報設計の詳細にリンクしています。
