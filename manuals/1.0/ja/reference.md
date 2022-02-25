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

セマンティックディスクリプタはアプリケーションで使われる**特別な語句**を定義します。


```xml
<descriptor id="dateCreated" title="作成日付"/>
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
    <descriptor href="#id"/>
</descriptor>
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

# descriptor

descriptorはセマンティックディスクリプタ(意味的識別子)のための要素です。APIの項目名やリンクの名前など、アプリケーションのとって特別な語句を説明します。


|  要素  |  意味  | 例 |
| ---- | ---- | ---- |
|  [descriptor](#descriptor) |  意味的識別子  | <descriptor id="dateCreated" />  |


descriptorの説明のために、docやlink要素を含むことができます。

|  要素  |  意味  | 例 |
| ---- | ---- | ---- |
|  [doc](#doc) |  説明テキスト  | <doc format="markdown">記事の作成日付</doc>  |
|  [link](#link)  |  リンク  |   <link href="https://example.com/issues" rel="issue"/>  |

また、情報の入れ子構造や、遷移に必要な情報を表すためにdescriptorを含むことができます。

例） ブログ記事は本文や日付の情報を含んでいる

```xml
<descriptor id="BlogPosting" title="ブログ記事" >
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
</descriptor>
```

例) ブログ記事を参照するには記事IDが必要

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting">
    <descriptor href="#id"/>
</descriptor>
```


### <a name="doc">doc</a>

文章で意味を説明するdoc

```xml
<descriptor id="dateCreated">
    <doc format="markdown">ISO8601フォーマットで表された記事の作成日付</doc>
</descriptor>
```
docはformatでフォーマット（text|markdown|html|asciidoc）を指定できます。無指定の時はtextです。

### <a name="link">link</a>

他のリソースの説明をリンクするlink

```xml
<descriptor id="dateCreated">
    <link rel="author" href="https://github.com/koriym">
</descriptor>
```

relはIANAの[Link Relation]relをIANAの[登録されたrel](https://www.iana.org/assignments/link-relations/link-relations.xhtml)から選び、hrefでURLにリンクします。

# <a name="descriptor">Descriptor</a>要素

descriptorにIDや、タイプ、タグと行った属性を付与できます。


|  属性  |  意味  | 例 |
| ---- | ---- | ---- |
|  [id](#id)  |  識別子  | createdDate  |
| [type](#type) | 型 | [semantic](#semantic) \| [safe](#safe) \| [unsafe](#unsafe) \| [idempotent](#idempotent) |
|  [href](#href)   |  参照  |　#id |
|  [rt](#rt)   |  遷移先  | #User |
|  [rel](#rel)  |  関係  | edit |
|  [title](#title)   |  タイトル  | 作成時刻  |
|  [tag](#tag)   |  タグ  | ontology |

## <a name="id">id</a>

ALPSでは全ての情報、全ての遷移（リンク）に対してユニークなIDを割り当てます。ID語句に仕様制約はありませんが、安全な遷移の時は`go`、安全ではない時の遷移は`do`を付けるベストプラクティスがあります。

## <a name="type">type</a>

descriptorはtype属性を持ちます。無指定の場合はsemanticです。

|  タイプ  |  意味  |
| ---- | ---- | 
|  [semantic](#semantic)  |  意味  | 
|  [safe](#safe)   |  安全で冪等な遷移  | 
|  [idempotent](#idempotent)   | 安全でなく冪等な遷移  | 
|  [unsafe](#unsafe)   |  安全でなく冪等でない遷移  | 


意味を表す１つのタイプと、遷移を表す３つのタイプがあります。

### <a name="semantic">semantic</a>

アプリケーションで使う語句をリストアップし、ボキャブラリを作成します。

```xml
<descriptor id="dateCreated" type="semantic"/>
```


### <a name="safe">safe</a>

リソースの状態が変化しない、読み取りのための遷移です。

例） URLを指定してリソース状態を取得

```xml
<descriptor id="goBlog" type="safe" rt="#Blog" />
```

### <a name="idempotent">idempotent</a>

リソースの状態が冪等で変化する遷移です。

例） URLを指定したリソース作成、対象リソースの変更や削除

```xml
<descriptor id="doDeleteMenu" type="idempotent" rt="#Menu">
```

### <a name="unsafe">unsafe</a>

リソースの状態変化が冪等ではない遷移です。

例） URLを指定しないリソース作成や対象リソースの追記

```xml
<descriptor id="doAppendRecord" type="unsafe" rt="#Record">
```

以上、計４つのタイプがあります。

> 冪等とは
>
> ある操作を1回行っても複数回行っても結果が同じであることです。たとえばリソースの追加は冪等性がありませんが、リソースの変更や消去には冪等性があります。

## <a name="href">href</a>

１つのdescriptorを再利用するためにhrefでリンクをする事ができます。リンクには同じドキュメントからリンクするインラインリンクと、他のファイルのdescriptorにリンクするアウトバウンドリンクの２つがあります。


```xml
<!-- インラインリンク -->
<descriptor href="#articleBody">

<!-- アウトバウンドリンク -->
<descriptor href="Blog.xml#articleBody">

```

## <a name="rt">rt</a>

遷移先IDを指定します。

```xml
<descriptor id="goBlog" type="safe" rt="#Blog">
```

## <a name="rel">rel</a>

typeが`safe`, `idempotent`, `unsafe`の遷移の時に関係性を指定します。

```xml
<descriptor id="editBlogPosting" type="idempotent" rel="edit" rt="#Blog">
```
relはIANAの[Link Relation](https://www.iana.org/assignments/link-relations/link-relations.xhtml)から選びます。

## <a name="title">title</a>

内容を一行で表すコメントです。

```xml
<descriptor id="editBlogPosting" type="idempotent" rt="#Blog" title="記事の編集" />
```

## <a name="tag">tag</a>

```xml
<descriptor id="editBlogPosting" type="idempotent" rt="#Blog" tag="choreography" />
```

タグでグループを作ります。ASDはタグ単位で描画の有無や色を指定できます。
