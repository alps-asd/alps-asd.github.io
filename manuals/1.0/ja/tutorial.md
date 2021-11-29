---
layout: docs-ja
title: チュートリアル
category: Manual
permalink: /manuals/1.0/ja/tutorial.html
---
# ALPS チュートリアル

## 始める

スケルトンファイル`profile.xml`を作成します。

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
```


スキーマをサポートするエディターが便利です。補完が効き、バリデーションも行われます。フリーの[WebStorm](https://www.jetbrains.com/ja-jp/webstorm/nextversion/)があります。


まずは、WebStormで[スケルトンファイルを作成](https://hackmd.io/@koriym/webstorm-for-alps#%E3%82%B9%E3%82%B1%E3%83%AB%E3%83%88%E3%83%B3%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%AE%E4%BD%9C%E6%88%90)してみましょう。


## オントロジー

ALPSでは意味をIDとして定義します。

`dateCreated`（作成日付）を追記してみましょう。

```diff
<?xml version="1.0" encoding="UTF-8"?>
<alps
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
+    <descriptor id="dateCreated"/>
</alps>
```

### 初めてのASD

では早速ALPSファイルをASDで表示してみましょう。

以下のコマンドでASDを実行してASDドキュメントを作成しましょう。

```
asd --watch ./profile.xml 
```

[http://localhost:3000](http://localhost:3000)を開いて確認してください。１つ単語が登録されたのが確認できます。


以後はファイルを保存するとASDドキュメントが再描画され、ASDツールの操作の必要はありません。


![](https://i.imgur.com/TxHvBpy.png)


### 語句を説明する


`title`や`doc`で説明を加えることができます。

```xml
<descriptor id="dateCreated" title="作成日付"/>
```

```xml
<descriptor id="dateCreated">
    <doc format="markdown">ISO8601フォーマットで記事の作成日付を表します</doc>
</descriptor>
```

ALPSドキュメントはアプリケーションで使う用語の辞書になります。このALPSアプリケーションでは作成日付を表す時は`created_date`でも、`created`でもなく`dateCreated`と表します。

この意味に紐づけられたIDを**セマンティックディスクリプタ**（意味的記述子）といいます。ALPSドキュメントはその集合です。

### 語句の定義にリンクする


言葉による説明よりもっと良い方法は`def`でスタンダードな語句定義へリンクすることです。車輪の再発明を防ぎます。


```xml
<descriptor id="dateCreated" def="https://schema.org/dateCreated" />
```

有名なボキャブラリサイトには以下のものがあります。

* [schema.org](https://schema.org/docs/schemas.html)
* [IANA](https://www.iana.org/assignments/link-relations/link-relations.xml)

### ボキャブラリ

ALPSの重要な役割の１つはアプリケーションのボキャブラリ辞書になることです。利用者が同じID、同じ意味を使います。

## タクソノミー

セマンティクディスクリプタはセマンティックディスクリプタを含むことがあります。

例えば、`BlogPosting`（ブログ記事）は`articleBody`（本文）と`dateCreated`を含みます。 情報は情報を含み、その含んだ情報も他の情報に含まれます。このような情報のアレンジがタクソノミーです。<descriptor>の中に<descriptor>を記述することで階層を表します。


```xml
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
     
    <!-- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="本文"/>
    <descriptor id="dateCreated" title="作成日付"/>

    <!-- Taxonomy -->
    <descriptor id="BlogPosting" title="ブログ記事" >
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="Blog" title="ブログ記事リスト">
        <descriptor href="#BlogPosting"/>
    </descriptor>
</alps>
```

* 上記は、記事の本文(`articleBody`)を含んだブログ記事(`BlogPosting`)、その記事を含んだブログ記事リスト(`Blog`)を表しています。

* ALPSファイルの`<!-- Taxonomy -->`ブロックでは他のセマンティックディスクリプタを`href`でインラインリンクして利用しています。

* 他にローカルやWeb上の他のファイルをリンクすることもできます。


```xml
<descriptor href="definition.xml#dateCreated"/>
```

```xml
<descriptor href="http://example.com/dateCreated.xml#dateCreated"/>
```

ファイルを保存してASDドキュメントを確認してみましょう。


## コレオグラフィー

Webページは情報だけでなく他のページへのリンクやアクションのフォームを含むことができますが、このような情報の相互作用をコレオグラフィーと呼びます。

以下の３つのタイプがあります。

### タイプ

#### safe

`safe`はHTMLで言うとAタグ、HTTPではGETです。安全な遷移で、サーバー側のリソース状態は変化しません。

#### idempotent

`idempotent`（アイデムポテント）はリソース状態は変更されますが冪等性があり、何度繰り返しても同じ結果になります。

#### unsafe

`unsafe`も同じようにリソース状態は変更されますが冪等性がありません。繰り返し実行には注意が必要です。

safeは`GET`、idempotentidempotentは`PUT`または`DELETE`、unsafeは`POST`とそれぞれのHTTPのメソッドに対応します。


### リンク

下記のように他の`descriptor`に含めます。

```xml
<descriptor id="BlogPosting" " title="ブログ記事">
    <descriptor href="#id"/>
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
    <descriptor id="goBlog" type="safe" rt="#Blog" title="ブログ記事リストを見る"/>
</descriptor>
```

### 引数

遷移に必要なdescriptorは含めます。

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
    <descriptor href="#id"/>
</descriptor>
```


## アトリビュート

以下のアトリビュートはタイプに関わらず利用することができます。

### tag

属性を加えます。


```xml
<descriptor id="ticketList" tag="ontology collection" />
```

属性をフィルターしてASDを描画することができます。やってみましょう。

[スクリーンショット]

### link

メタ情報とリンクします。

```xml
<descriptor id="dateCreated">
  <link href="https://github.com/koriym/app-state-diagram/issues" rel="issue" title="Issue list"/>
</descriptor>
```

## リンク

`href`を使って、他のALPSドキュメントへリンクすることもできます。

```xml
<descriptor href="definition.xml#dateCreated"/>
<descriptor href="http://example.com/dateCreated.xml#dateCreated"/>
```

## ALPSのメタ情報

アルプスのファイルにメタ情報を付け加えるにはこのようにします。


```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps>
    <title>ALPS Blog</title>
    <doc>An ALPS profile example for ASD</doc>
    <link rel="issue" href="https://github.com/koriym/app-state-diagram/issues"/>
</alps>
```
