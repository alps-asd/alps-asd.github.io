---
layout: docs-ja
title: チュートリアル
category: Manual
permalink: /manuals/1.0/ja/tutorial.html
---
# ALPS チュートリアル

## 始める
最初に空のALPSファイル`profile.xml`を作成します。[^webstorm]

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
```


[^webstorm]: スキーマをサポートするエディターが便利です。補完が効き、バリデーションも行われます。[WebStormでの例](https://hackmd.io/@koriym/webstorm-for-alps#%E3%82%B9%E3%82%B1%E3%83%AB%E3%83%88%E3%83%B3%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%AE%E4%BD%9C%E6%88%90)もご覧ください。


## 意味をIDとして登録する

ALPSではアプリケーションが扱う特定の語句をIDとして定義します。最初に`dateCreated`（作成日付）という語句を加えてみましょう。

```diff
 <?xml version="1.0" encoding="UTF-8"?>
 <alps
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
+    <descriptor id="dateCreated"/>
 </alps>
```

## 初めてのASD

早速ALPSファイルをASDで表示してみましょう。 以下のコマンドで実行するか、MacのASDアプリケーションで`profile.xml`を開きます。

```
asd --watch ./profile.xml 
```

[http://localhost:3000](http://localhost:3000)を開いて確認してください。`dateCreated`という語が登録されたのが確認できます。

## 語句を説明する

`title`や`doc`で説明を加えることができます。

```xml
<descriptor id="dateCreated" title="作成日付"/>
```

```xml
<descriptor id="dateCreated">
    <doc format="markdown">ISO8601フォーマットで記事の作成日付を表します</doc>
</descriptor>
```

titleは見出しのような簡潔な表現、docはより長いテキストでの説明です。

この意味に紐づけられたIDを**セマンティックディスクリプタ**（意味的記述子）といいます。`dateCreated`は「作成日付」という意味を紐づけたセマンティックディスクリプタです。このような意味や概念の定義を**オントロジー**といいます。

### ボキャブラリ

ALPSの重要な役割の１つはアプリケーションの語句の辞書になることです。利用者が同じ意味を指し示すときは同じ語句を使い、表現の揺れを防いだり、利用者が違った認識を持つことを防止します。

## 情報は情報を含む

セマンティックディスクリプタはセマンティックディスクリプタを含むことがあります。

例えば、`BlogPosting`（ブログ記事）は`articleBody`（本文）と`dateCreated`（作成日付）を含みます。 descriptorの中にdescriptorを記述することで情報の階層を表します。このような情報の構成や配置が**タクソノミー**です。


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

`#`を使って他のdescriptorを参照する事ができます。これを**インラインリンク**と呼び１つのdescriptorを複数の箇所から参照する事ができます。

ファイルを保存してASDドキュメントを確認してみましょう。
`articleBody`など登録した語句がページに現れましたか？ `BlogPosting`をクリックしてブログ記事に何の情報が含まれているかを確認してみましょう。

## 情報の閲覧と操作

Webのページは情報だけでなく他のページへのリンクやアクションのフォームを含み、関連する情報の閲覧や操作ができます。 以下の３種類の操作が出来ます。

### safe

関連する情報の閲覧。HTMLで言うとAタグ、HTTPではGETです。リソースの状態[^resource_state]を変更しない**安全な遷移**です。ユーザーが何を見ているかという**アプリケーション状態**が変化します。つまり閲覧しているURLが変わります。

[^resource_state]: URLで示されるサーバーサイドが保持する情報。

### idempotent

リソース状態を変更します。冪等性（べきとうせい）[^idempotent] があり、何度繰り返しても同じ結果になります。ファイルの上書きをイメージしてください。何度実行しても結果は変わりません。

[^idempotent]: [https://ja.wikipedia.org/wiki/冪等](https://ja.wikipedia.org/wiki/冪等)

### unsafe

idempotentと同じようにリソース状態は変更しますが冪等性がありません。ファイルの追記をイメージしてください。繰り返し実行しただけ結果が異なってきます。

### HTTPメソッドとの対応

safeは`GET`、idempotentは`PUT`または`DELETE`、unsafeは`POST`とそれぞれのHTTPのメソッドに対応します。


### リンク

`type`で操作の種類、`rt`で遷移先を指定してリンクを作成します。
この例は`Blog`を閲覧するリンクです。

```xml
<descriptor type="safe" id="goBlog" rt="#Blog" title="ブログ記事リストを見る" />
```

この例はブログ記事からブログ記事リストに戻る操作を追加しています。

```diff
 <descriptor id="BlogPosting" title="記事">
     <descriptor href="#id"/>
     <descriptor href="#dateCreated"/>
     <descriptor href="#articleBody"/>
+    <descriptor id="goBlog" type="safe" rt="#Blog" title="記事リストを見る"/>
 </descriptor>
```

遷移や操作に必要なdescriptorはdescriptorに含めます。

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="記事を見る">
    <!-- 記事を見るにはIDが必要 -->
    <descriptor href="#id"/>
</descriptor>
```

ブログ記事リストとブログ記事双方のリンクを追加してみましょう。

```diff
 <alps
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
     
     <!-- Ontology -->
     <descriptor id="id" title="id"/>
     <descriptor id="articleBody" title="本文"/>
     <descriptor id="dateCreated" title="作成日付"/>

     <!-- Taxonomy -->
     <descriptor id="Blog" title="記事リスト">
         <descriptor href="#BlogPosting"/>
+        <descriptor href="#goBlogPosting" />
     </descriptor>

     <descriptor id="BlogPosting" title="記事" >
         <descriptor href="#id"/>
         <descriptor href="#dateCreated"/>
         <descriptor href="#articleBody"/>
+        <descriptor href="#goBlog" />
     </descriptor>

+    <!-- Taxonomy -->
+    <descriptor type="safe" id="goBlogPosting" rt="#BlogPosting" title="ブログ記事を見る">
+        <descriptor href="#id"/>
+    </descriptor>
+    <descriptor type="safe" id="goBlog" rt="#Blog" title="ブログ記事一覧を見る" />
 </alps>
```

## アプリケーション状態遷移図

[http://localhost:3000](http://localhost:3000)の**Application State Diagram**をクリックすると、 記事リスト、記事、双方からリンクされた状態遷移図が表示されます。
四角のボックスのはユーザーがどこを見ているかというアプリケーション状態、つまり閲覧中のWebページです。
矢印は情報の閲覧や変更などの操作を表します。HTMLでのAタグやFORMタグの遷移に該当します。
ボックスや矢印をクリックすると詳しい情報を見ることができます。確認してみましょう。

Webサイトの情報が相互にリンクされているように、ASDドキュメントページも相互にリンクされています。アプリケーション状態遷移図はサイトの情報設計を俯瞰することができ、情報の意味や構造、接続といった情報設計の詳細にリンクしています。

---
