---
layout: docs-ja
title: asd
category: Manual
permalink: /manuals/1.0/ja/rfc-draft-7.html
---

# アプリケーションレベルプロファイルセマンティクス (ALPS)

このページは[Application-Level Profile Semantics (ALPS)
draft-amundsen-richardson-foster-alps-07](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07) を日本語に翻訳したものです。

## 概要

このドキュメントは、HTMLマイクロフォーマットと同程度の複雑さで、アプリケーションレベルのセマンティクスの簡単な記述を定義するデータフォーマットであるALPSについて説明しています。ALPSドキュメントは、アプリケーションに依存しないメディアタイプ（HTML、HAL、Collection+JSON、Sirenなど）を持つドキュメントのアプリケーションセマンティクスを説明するプロファイルとして使用できます。これにより、プロファイルドキュメントのメディアタイプ間での再利用性が高まります。


## 目次
# ALPS ドキュメント目次

## 1. はじめに
- [1.1. 表記規則](#11-表記規則)
- [1.2. 動機](#12-動機)
    - [1.2.1. ドメイン固有のセマンティクスの説明](#121-ドメイン固有のセマンティクスの説明)
    - [1.2.2. ALPSベースのサーバー実装](#122-alpsベースのサーバー実装)
    - [1.2.3. ALPSベースのクライアント実装](#123-alpsベースのクライアント実装)
- [1.3. 簡単なALPSの例](#13-簡単なalpsの例)
- [1.4. ALPSドキュメントの識別](#14-alpsドキュメントの識別)

## 2. ALPSドキュメント
- [2.1. 準拠](#21-準拠)
- [2.2. ALPSドキュメントのプロパティ](#22-alpsドキュメントのプロパティ)
    - [2.2.1. 'alps'](#221-alps)
    - [2.2.2. 'contentType'](#222-contenttype)
    - [2.2.3. 'def'](#223-def)
    - [2.2.4. 'descriptor'](#224-descriptor)
    - [2.2.5. 'doc'](#225-doc)
    - [2.2.6. 'ext'](#226-ext)
    - [2.2.7. 'format'](#227-format)
    - [2.2.8. 'href'](#228-href)
    - [2.2.9. 'id'](#229-id)
    - [2.2.10. 'link'](#2210-link)
    - [2.2.11. 'name'](#2211-name)
    - [2.2.12. 'rel'](#2212-rel)
    - [2.2.13. 'rt'](#2213-rt)
    - [2.2.14. 'tag'](#2214-tag)
    - [2.2.15. 'title'](#2215-title)
    - [2.2.16. 'type'](#2216-type)
    - [2.2.17. 'value'](#2217-value)
    - [2.2.18. 'version'](#2218-version)
- [2.3. ALPS表現](#23-alps表現)
    - [2.3.1. サンプルHTML](#231-サンプルhtml)
    - [2.3.2. XML表現例](#232-xml表現例)
    - [2.3.3. JSON表現例](#233-json表現例)

## 既存のメディアタイプへのALPSドキュメントの適用
- [3.1. ALPSドキュメントへのリンク](#31-alpsドキュメントへのリンク)

## IANA考慮事項
- [4.1. application/alps+xml](#41-applicationalpsxml)
- [4.2. application/alps+json](#42-applicationalpsxml)

5. 国際化に関する考慮事項

6. 謝辞

7. 規範的参考文献

付録A. よくある質問
A.1. ALPSにURLが含まれていないのはなぜですか？
A.2. ALPS仕様にワークフローコンポーネントがないのはなぜですか？
A.3. セマンティック記述子の範囲を示す方法がないのはなぜですか？

著者のアドレス

## 1. はじめに

このドキュメントでは、HTMLマイクロフォーマットと同程度の複雑さで、アプリケーションレベルのセマンティクスの簡単な記述を定義するメディアタイプであるALPSについて説明します。これらの記述には、セマンティクスの人間が読める説明と機械が読める説明の両方が含まれています。ALPSドキュメントは、アプリケーションに依存しないメディアタイプ（HTML、HAL、Collection+JSON、Sirenなど）を持つドキュメントのアプリケーションセマンティクスを説明するプロファイルとして使用できます。

このドキュメントは、ALPSドキュメントのレジストリ（ALPS Profile Registry、APR）を識別します。このレジストリの詳細、その目標、および運用については、別のドキュメント（TBD）で説明されています。

このドキュメントでは、ALPSドキュメントを特定のメディアタイプのレスポンスにプロファイルとして適用する方法に関する規範的な人間が読める指示を作成、公開、共有するプロセスも識別します。例えば、ALPSプロファイルのセマンティクスをHTMLドキュメントに適用する方法を説明するドキュメントなどです。

このドキュメントでは、2つのメディアタイプ識別子をIANAに登録します：'application/alps+xml'（'ALPS+XML'）と'application/alps+json'（'ALPS+JSON'）です。

### 1.1. 表記規則

このドキュメントのキーワード「MUST」、「MUST NOT」、「REQUIRED」、「SHALL」、「SHALL NOT」、「SHOULD」、「SHOULD NOT」、「RECOMMENDED」、「MAY」、および「OPTIONAL」は、[RFC2119]で説明されているように解釈されます。

### 1.2. 動機

一般的なメディアタイプ（HTML、Atom、Collection+JSONなど）を使用してハイパーメディアクライアント/サーバーアプリケーションを実装する場合、クライアントとサーバーのインスタンスは、データ要素名、リンク関係の値、状態遷移パラメータなどのドメイン固有の情報の理解を共有する必要があります。この情報は、使用されるメディアタイプではなく、実装されているアプリケーション（例：会計、連絡先管理など）に直接関連しています。

#### 1.2.1. ドメイン固有のセマンティクスの説明

全く新しいメディアタイプ（つまり'application/accounting'）を作成して登録する代わりに、表現の作成者は、ターゲットドメインの'プロファイル'を説明するALPSドキュメントを作成できます。このプロファイルは、重要なドメイン固有のセマンティック記述子と状態遷移を説明します。このプロファイルは、サーバー実装者によって幅広いメディアタイプに一貫して適用され、クライアントアプリケーションによって正常に消費されることができます。転送プロトコルやメディアタイプに依存しないアプリケーションレベルのセマンティクスの定義に焦点を当てることで、アプリケーションに依存しないメディアタイプを使用してアプリケーション固有の表現を提供することが可能になります。

#### 1.2.2. ALPSベースのサーバー実装

サーバー実装者は、独自のカスタムメディアタイプを作成したり、一般的なドメイン（例：会計、マイクロブログなど）の語彙や遷移セットを再発明したりすることなく、ドメイン固有のソリューションを構築するための基礎としてALPSドキュメントを使用できます。既存のALPSプロファイルをガイドとして使用することで、サーバーは内部データを一般的に理解されるセマンティック記述子と状態遷移にマッピングでき、既存のクライアントアプリケーション（同じALPSドキュメントの理解を共有するもの）がそのサーバーと正常に対話できる可能性が高まります。

#### 1.2.3. ALPSベースのクライアント実装

ドキュメントのALPSプロファイルを備えることで、クライアントアプリケーションはALPS記述子の'id'および/または'name'属性値をドキュメント内の適切な要素に関連付けることができます。クライアントアプリケーションは'プロファイルに合わせてコーディング'し、レスポンスレイアウトの詳細な変更や、さらには1つのメディアタイプから別のメディアタイプへの完全な置き換えにも適応しやすくなります。

### 1.3. 簡単なALPSの例

以下は、連絡先管理アプリケーションの簡単なリクエスト/レスポンス対話の要素を説明するALPSドキュメントです。このプロファイルは、'contact'という名前のセマンティック記述子と、3つの従属記述子（'fullName'、'email'、'phone'）を定義しています。

ALPSドキュメントはまた、'id'値が'collection'であるハイパーメディアコントロール（例：HTML.GETフォーム）で表される単一の安全な状態遷移を定義しています。このハイパーメディアコントロールには1つの入力値（'nameSearch'）があります。実行されると、レスポンスには1つ以上の'contact'タイプのアイテムが含まれます。

```xml
<alps version="1.0">
 <doc format="text">A contact list.</doc>
 <link rel="help" href="http://example.org/help/contacts.html" />

 <!-- a hypermedia control for returning contacts -->
 <descriptor id="collection" type="safe" rt="contact">
   <doc>
     A simple link/form for getting a list of contacts.
   </doc>
   <descriptor id="nameSearch" type="semantic">
     <doc>Input for a search form.</doc>
   </descriptor>
 </descriptor>

 <!--  a contact: one or more of these may be returned -->
 <descriptor id="contact" type="semantic">
   <descriptor id="item" type="safe">
     <doc>A link to an individual contact.</doc>
   </descriptor>
   <descriptor id="fullName" type="semantic" />
   <descriptor id="email"    type="semantic" />
   <descriptor id="phone"    type="semantic" />
 </descriptor>
</alps>
```

ALPS連絡先プロファイルドキュメント

上記のALPSプロファイルを実装するには、ALPSドキュメントで定義された記述子を実装する必要があります。この場合、2つの'トップレベル'記述子があります：安全な状態遷移（'collection'）とセマンティック記述子'contact'です。以下は、これら両方の要素を表現で示す単一のHTMLドキュメントです。

```html
<html>
 <head>
   <link href="http://alps.io/profiles/contact"
     rel="profile" />
   <link href="http://alps.io/profiles/contact#contact"
     rel="type" />
   <link href="http://example.org/help/contacts.html"
     rel="help" />
 </head>
 <body>
   <form class="collection"
     method="get"
     action="http://example.org/contacts/">
     <label>Name:</label>
     <input name="nameSearch" value="" />
     <input type="submit" value="Search" />
   </form>

   <table>
     <tr class="contact">
       <td>
         <a href="http://example.org/contacts/1"
           rel="item">
           <span class="fullName">Ann Arbuckle</span>
         </a>
       </td>
       <td>
         <span class="email">aa@example.org</span>
       </td>
       <td>
         <span class="phone">123.456.7890</span>
       </td>
     </tr>

     <tr>
       <td>
         <a href="http://example.org/contacts/100"
           rel="item">
           <span class="fullName">Zelda Zackney</span>
         </a>
       </td>
       <td>
         <span class="email">zz@example.org</span>
       </td>
       <td>
         <span class="phone">098.765.4321</span>
       </td>
     </tr>
   </table>
 </body>
</html>
```

HTML ALPS連絡先表現

HTML表現では、ほとんどのALPS要素をHTMLの'class'属性を使用して実装しています。'collection' IDはHTMLフォームの送信ボタンのCSSクラスになっています。'contact' IDはHTMLテーブルのTR要素のCSSクラスになっています。従属記述子'fullname'、'email'、'phone'は各TRのTD要素としてレンダリングされています。

このHALドキュメントは、HTMLドキュメントと同じアプリケーションレベルのセマンティクスを表現するために同じプロファイルを使用しています。

```xml
<resource href="http://example.org/contacts/">
 <link href="http://alps.io/profiles/contacts#contact"
   rel="type" />
 <link href="http://example.org/help-file/contacts.html"
   rel="help" />
 <link rel="collection"
   href="http://example.org/contacts/{?nameSearch}"
   templated="true" />
 <resource rel="item" href="http://example.org/contacts/1">
   <link href="http://alps.io/profiles/contacts#contact"
     rel="type" />
   <fullName>Ann Arbuckle</fullName>
   <email>aa@example.org</email>
   <phone>123.456.7890</phone>
 </resource>
 <resource rel="item" href="http://example.org/contacts/100">
   <link href="http://alps.io/profiles/contacts#contact"
     rel="type" />
   <fullName>Zelda Zackney</fullName>
   <email>zz@example.org</email>
   <phone>987.664.3210</phone>
 </resource>
</resource>
```

HAL XML連絡先表現

HAL表現では、すべての状態遷移（この場合は'collection'と'item'）がリンク関係として表現されています。すべてのデータ記述子（'fullName'、'email'、'phone'）は、記述子の名前を付けたXMLタグとして表現されています。

このCollection+JSONドキュメントは、HTMLおよびHALドキュメントと同じアプリケーションレベルのセマンティクスを表現するためにALPSプロファイルを使用しています。

```json
{
 "collection" : {
   "version" : "1.0",
   "href" : "http://example.org/contacts/",

   "links" : [
     {
       "rel" : "profile",
       "href" : "http://alps.io/profiles/contacts"
     },
     {
       "rel" : "help",
       "href" : "http://example.org/help/contacts.html"
     },
     {
       "rel" : "type",
       "href" : "http://alps.io/profiles/contacts#contact"
     }
   ],

   "queries" : [
     {
       "rel" : "collection",
       "rt" : "contact",
       "href" : "http://example.org/contacts/",
       "data" : [
         {
           "name" : "nameSearch",
           "value" : "",
           "prompt" :  "Search Name"
         }
       ]
     }
   ],

   "items" : [
     {
       "href" : "http://example.org/contacts/1",
       "rel" : "item",
       "rt" : "contact",
       "data" : [
         {"name" : "fullName", "value" : "Ann Arbuckle"},
         {"name" : "email", "value" : "aa@example.org"},
         {"name" : "phone", "value" : "123.456.7890"}
       ],
       "links" : [
         {
           "rel" : "type",
           "href" : "http://alps.io/profiles/contacts#contact"
         }
       ]
     },
     {
       "href" : "http://example.org/contacts/100",
       "rel" : "item",
       "rt" : "contact",
       "data" : [
         {
           "name" : "fullName",
           "value" : "Zelda Zackney"
         },
         {
           "name" : "email",
           "value" : "zz@example.org"
         },
         {
           "name" : "phone",
           "value" : "987.654.3210"
         }
       ],
       "links" : [
         {
           "rel" : "type",
           "href" : "http://alps.io/profiles/contacts#contact"
         }
       ]
     }
   ]
 }
}
```

Collection+JSON連絡先表現

記述子'collection'は、Collection+JSONクエリに関連付けられたリンク関係になっています。記述子'fullName'、'email'、'phone'は、Collection+JSONコレクション内のアイテムのキーと値のペアの名前になっています。

### 1.4. ALPSドキュメントの識別

ALPS語彙は、一意のURLによって識別されます。これはデリファレンス可能なURLである必要があります（SHOULD）。すべてのALPS URLは一意でなければならず（MUST）、公共消費を目的としたすべてのALPSドキュメントはALPSレジストリに登録されるべきです（SHOULD）[TK: レジストリの場所と検索方法に関するテキストを追加する -mamund]。

ALPSドキュメントリクエストに応答するサーバーの負荷を減らすために、サーバーはクライアントアプリに結果をローカルにキャッシュするよう指示するキャッシュ制御ディレクティブを使用することが推奨されます（RECOMMENDED）。これらのALPSドキュメントリクエストを行うクライアントは、サーバーのキャッシュディレクティブを尊重すべきです（SHOULD）。

# ALPS文書

ALPSドキュメントは、識別文字列とその人間が読める説明の機械可読なコレクションを含みます。ALPSドキュメントはXMLまたはJSON形式で表現できます。このセクションでは、ALPSドキュメントの一般的な要素とプロパティ、その意味と使用方法を、ドキュメントの表現方法に関係なく識別します。セクション2.3では、XMLおよびJSON形式で有効なALPSドキュメントを構築する具体的な詳細を提供します。

## 2.1. コンプライアンス

実装は、MUSTまたはREQUIREDレベルの要件の1つ以上を満たさない場合、準拠していません。MUSTまたはREQUIREDレベルのすべての要件とSHOULDレベルのすべての要件を満たす実装は、「無条件に準拠している」と言われます。MUSTレベルのすべての要件を満たしているが、SHOULDレベルのすべての要件を満たしていない実装は、「条件付きで準拠している」と言われます。

## 2.2. ALPSドキュメントのプロパティ

ALPSメディアタイプは、小さなプロパティのセットを定義します。これらのプロパティは、XMLとJSON形式の両方に表示されます。以下は、ALPSドキュメントに表示できるプロパティのリストです。

### 2.2.1. 'alps'

ALPSドキュメントのルートを示します。このプロパティは必須であり、1つ以上の'descriptor'子プロパティを持つべきです。

例：
XML: `<alps>...</alps>`
JSON: `{"alps" : ... }`

### 2.2.2. 'contentType'

これは'doc'要素のプロパティです。'doc'要素に含まれるコンテンツのメディアタイプを示します。これはオプションのプロパティであり、ドキュメントパーサーによって無視される場合があります。その値はインターネットメディアタイプ（[RFC2045]を参照）であるべきです。

注：メディアタイプの値はInternet Assigned Number Authority（[RFC2045]を参照）に登録されています。未登録のメディアタイプの使用は推奨されません。

'contentType'プロパティと'format'プロパティは同じ目的を果たします。'contentType'プロパティが表示される場合、それを使用すべきです。'format'と'contentType'プロパティの両方が表示される場合、'format'は無視されるべきです。'contentType'プロパティが表示されず、'format'も表示されない場合、ドキュメントパーサーは'contentType'値がtext/plainに設定されていると仮定すべきです。一部のALPSドキュメントパーサーは'format'プロパティのみを理解する可能性があるため、ドキュメント作成者が'contentType'プロパティを含める場合でも、既存の'format'が提供された'contentType'プロパティと矛盾しないようにする必要があります。

例：
XML: `<doc contentType="text/html"> <![CDATA[ <h1>Help File</h1> <p>...</p> ]]> </doc>`
JSON: `{"doc" : {"contentType" : "text/html", "value" : "<h1>Help File</h1><p>...</p>"} }`

### 2.2.3. 'def'

記述子のソース定義を識別する有効なIRI（[RFC3987]を参照）値を含みます。これは'descriptor'要素のプロパティであり、オプションです。参照可能なIRIである場合とそうでない場合があります。

例：
XML: `<descriptor id="title" def="http://schema.org/title" />`
JSON: `{"descriptor" : [ {"id" : "title", "def":"http://schema.org/title"} ]}`

### 2.2.4. 'descriptor'

'descriptor'要素は、関連する表現に存在する可能性のある特定のデータ要素または状態遷移のセマンティクスを定義します。

1つ以上の'descriptor'要素が'alps'の子として表示されるべきです。また、自身の子としても表示される場合があります。つまり、'descriptor'プロパティはネストされる可能性があります。

'descriptor'要素は単一の要素として表現されるか、単一の要素の配列として表現される場合があります。

'descriptor'プロパティは'id'または'href'属性のいずれかを持つべきです。両方を持つ場合もあります。さらに、'descriptor'は以下の属性のいずれかを持つ場合があります：

1. 'def'
2. 'doc'
3. 'href'
4. 'name'
5. 'title'
6. 'type'
7. 'rel'
8. 'tag'

'def'プロパティが存在する場合、有効なIRI（[RFC3987]を参照）を含むべきです。このIRIは参照可能な場合とそうでない場合があります。

'href'プロパティが存在する場合、現在のALPSドキュメント内または別のALPSドキュメント内の別の'descriptor'を指す、参照可能なURLを含む必要があります。

'descriptor'が'href'属性を持つ場合、'descriptor'は'href'が指す記述子のすべての属性とサブプロパティを継承します。'descriptor'がローカルに定義されたプロパティを持つ場合、そのプロパティ値は継承されたプロパティ値よりも優先されます。要素のネストに制限がなく、リモートにリンクされたものも含まれるため、利用可能なすべてのプロパティを収集し、それぞれの正しい値を確立するために、'すべての記述子'チェーンを下から処理することが重要です。

'descriptor'がALPSドキュメントのトップレベルで宣言されている場合、クライアントはその'descriptor'がランタイムメッセージのどこにでも表示される可能性があると仮定すべきです。

'descriptor'がネストされている場合、つまり別の記述子の子として宣言されている場合：

1. クライアントは、それらが任意の兄弟'descriptor'要素に表示され、再帰的にその子記述子に表示されると仮定すべきです。

2. クライアントは、親記述子の外部のどこにでも表示されると仮定すべきではありません。ただし、'href'属性で別の記述子によって明示的に参照されている場合を除きます。その場合、'href'属性を含む'descriptor'に同じルールが適用されます。

#### 2.2.4.1. 記述子とリンク関係タイプ

状態遷移を含む表現が生成される場合、リンク関係タイプの有効な値は次のとおりです：

1. IANA、Microformats.org、またはその他のレジストリからの登録済みリンク関係タイプ（例：rel="edit"、短い文字列）。

2. [RFC8288]で定義されている拡張リンク関係タイプ。その値は、関係タイプを説明する関連文書の完全修飾URIです。これには、セクション2.2.9.2の規則に従って、ALPS記述子のURIフラグメント識別子（例：rel="http://alps.io/profiles/item#purchased-by"、URI）が含まれます。

3. 表現にALPSプロファイルが含まれている場合、セクション2.2.9.1およびセクション2.2.9.3の規則に従って、関連するALPSドキュメントの状態遷移記述子の'id'プロパティ（例：rel="purchased-by"、短い文字列）。

### 2.2.5. 'doc'

通常は人間が読める形式の自由形式のテキストを含むテキストフィールドです。'doc'要素は単一の要素として表現されるか、単一の要素の配列として表現される場合があります。

'doc'要素は以下のプロパティを持つ場合があります：'href'、'format'、'tag'。

'href'プロパティが表示される場合、人間が読めるテキストを指す参照可能なURLを含むべきです。'format'プロパティが表示される場合、次のいずれかの値を含むべきです：'text'、'html'、'asciidoc'、または'markdown'。'doc'要素を処理するプログラムは'format'ディレクティブを尊重し、コンテンツを適切に解析/レンダリングすべきです。'format'プロパティの値が認識されない、またはサポートされていない場合、処理プログラムはコンテンツをプレーンテキストとして扱わなければなりません。'format'プロパティが存在しない場合、コンテンツはプレーンテキストとして扱われるべきです。

注：ALPSドキュメントのXML表現では、'doc'要素の内容は<!CDATA[と]]>で囲むべきです。囲まれていない場合でも、XML 'doc'要素の内容はALPSドキュメントを解析する際に文字列として扱われなければなりません。

XML: `<doc format="html"> <![CDATA[ <h1>Date of Birth</h1> <p>...</p> ]]> </doc>`
JSON: `{"doc" : {"format" : "text" , "value" : "Date of Birth ..."} }`

'doc'要素は'descriptor'の子として表示されるべきです。存在する場合、関連する'descriptor'の意味と使用法を説明します。

XML: `<descriptor ... > <doc><![CDATA[...]]></doc> </descriptor>`
JSON: `{"descriptor" : [ {"doc" : {"value" : "..."} ...  ] }`

'doc'要素は'alps'の子として表示される場合があります。存在する場合、ALPSドキュメント全体の目的を説明します。

XML: `<alps> <doc><![CDATA[...]]></doc> ... >/alps>`
JSON: `{"alps : {"doc" : {"value" : "..."} } ... }`

### 2.2.6. 'ext'

'ext'要素は、著者固有の情報でALPSドキュメントを拡張するために使用できます。この仕様で扱われていない追加のプロパティでALPSドキュメントをカスタマイズする方法を提供します。これはオプションの要素です。

'ext'要素は単一の要素として表現されるか、単一の要素の配列として表現される場合があります。

'ext'要素は以下のプロパティを持ちます：

1. 'id'
2. 'href'
3. 'value'
4. 'tag'

'id'プロパティは必須です。'href'は推奨され、この'ext'要素の使用と意味を説明するドキュメントを指すべきです。'value'プロパティはオプションです。コンテンツは未定義です。その意味と使用法は、'href'プロパティを参照解除して見つかるドキュメントによって説明されるべきです。

例：
XML: `<ext id="directions" href="http://alps.io/ext/directions" value="north south east west" >`
JSON: `{"ext" : {"id" : "directions", "href" : "http://alps.io/ext/directions", value="north south east west"} }`

'ext'要素は以下の要素の子として表示される場合があります：

1. 'alps'
2. 'descriptor'

'ext'要素はこの仕様内で特定の意味を持たないため、その意味を理解しないアプリケーションによって無視されなければなりません。

### 2.2.7. 'format'

テキストコンテンツをどのように解析および/またはレンダリングすべきかを示します。この仕様は'format'の可能な値の範囲を識別します：

- 'text'：プレーンテキスト用、必須でサポートされなければなりません。
- 'html'：HTML用、サポートされるべきです。
- 'asciidoc'：AsciiDoc用、サポートされる場合があります。
- 'markdown'：[RFC7763]に従って、サポートされる場合があります。

この属性のその他の値は未定義であり、プレーンテキストとして扱われるべきです。プログラムが'format'プロパティの値を認識しない、および/または'format'プロパティが欠落している場合、コンテンツはプレーンテキストとして扱われるべきです。

このプロパティは'doc'要素の属性として表示される場合があります。

注：'format'プロパティは'contentType'プロパティと同じ情報（異なる形式で）を含みます。両方のプロパティが同じ'doc'に表示される場合、'contentType'プロパティの値が'format'プロパティの値よりも優先されます。

### 2.2.8. 'href'

解決可能なURLを含みます。

'descriptor'の属性として表示される場合、'href'は既存のALPSドキュメント内のフラグメントとして、または別のALPSドキュメント内の絶対URLとして、別の'descriptor'を指します。URLはセクション2.2.9.2に従って、関連する'descriptor'を参照するフラグメントを含まなければなりません。

'ext'の属性として表示される場合、'href'は拡張の定義を提供する外部ドキュメントを指します。

'link'の属性として表示される場合、'href'は関連する'rel'プロパティによって記述される現在のドキュメントまたは'descriptor'との関係を持つ外部ドキュメントを指します。

'doc'の属性として表示される場合、'href'は関連する'descriptor'またはALPSドキュメントを説明する人間が読めるテキストを含むドキュメントを指します。

### 2.2.9. 'id'

関連する要素のドキュメント全体で一意の識別子です。これは'descriptor'の属性として表示されるべきです。これは[RFC1738]に従ってURL安全でない文字を含まない不透明な文字列であるべきです。

この属性の値は、関連するランタイムハイパーメディア表現内の識別子として使用される場合があります。以下の例では、'q'という'id'を持つALPS記述子がHTML入力要素を識別するために使用されています：

ALPSの'id'...  `<descriptor id="q" type="semantic" />`

...HTMLの'class'になります  `<input class="q" type="text" value="" />`

ALPS要素（例：'id'）から特定のメディアタイプ（HTML、Collection+JSON等）内の要素への正確なマッピングは、別のドキュメント（指定予定）で扱われることに注意してください。

#### 2.2.9.1. ALPSの'id'と'name'プロパティ

場合によっては、メディアタイプが一意でない識別子（例：HTMLの'name'プロパティ）をサポートしたり、同じ表現内の複数の要素に同じ識別子値を許可したりします（例：`<div id="search" ... />`と`<input type="submit" class="search" .../>`と`<input name="search" ... />`）。そのような場合、その表現をALPSドキュメントに変換すると、同じ値を持つ複数の'id'プロパティが生じる可能性があります。

これを避けるために、ALPSドキュメント設計者は'descriptor'に'name'プロパティを追加して共通の値（'search'）を保持し、'id'プロパティにはドキュメント全体で一意の値を保持することができます。例：

```html
<!-- HTML -->
<div id="search">
  <form action="..." method="get">
    <input name="search" value="..." type="text" />
    <input type="submit" class="search" />
  </form>
</div>
```

検索遷移のHTML表現

```xml
<!-- ALPS -->
<descriptor id="search-block" type="semantic" name="search">
  <descriptor id="search-form" type="safe" name="search">
    <descriptor id="search-data" type="semantic" name="search" />
  </descriptor>
</descriptor>
```

同じ検索遷移のALPS記述

#### 2.2.9.2. フラグメント識別子と'id'

ALPSドキュメントに適用される場合、URIフラグメント識別子は、'id'がフラグメントの値に設定されている'descriptor'を指します。例えば、URI http://example.com/my-alps-document#customer のフラグメント識別子'customer'は、'id'が'customer'に設定されたALPS 'descriptor'を指します。'id'に[RFC1738]に従ってURL安全でない文字が含まれている場合、'id'を参照するフラグメントはURLエスケープされなければなりません。

ALPSドキュメント内のフラグメント識別子を持つ相対URL（例：href="#customer"）は、参照を含むドキュメント内のローカルな'descriptor'を指します。

ALPS 'descriptor'への完全なURI（フラグメントを含む）は「抽象的意味タイプ」識別子を形成します。これはリソースのタイプを示すために使用できる解決可能なURI（URL）です。例えば、IANA登録関係タイプ'type'の値として使用できます。

#### 2.2.9.3. リンク関係値と'id'または'name'

状態遷移'descriptor'が関係タイプ値を定義する可能性があるため、既存のIANA登録値との競合を避けることが重要です。結果として生じるリンク関係タイプが登録済みの関係タイプと同じである場合、記述子はIANA関係タイプの意味を変更してはいけません。

さらに、'descriptor'の'id'がセクション2.2.4.1に従ってリンク関係値を定義する可能性があるため、そのような記述子のドキュメント全体で一意の'id'を定義する際に別の'descriptor'との競合が存在する場合、競合する'descriptor'は一意の'id'を定義しなければならず、競合を解決するために'name'プロパティを指定する場合があります。

表現ドキュメント内の登録済みリンク関係タイプがIANAに登録された関係を指すのか、ALPSプロファイルに登録された関係を指すのか不明確な場合、そのリンクのセマンティクスは未定義です。

### 2.2.10. 'link'

現在のALPS要素と他の（おそらく外部の）リソースとのリンクを識別する要素です。'alps'および'descriptor'要素の子要素である場合があります。

'link'要素は単一の要素として表現されるか、単一の要素の配列として表現される場合があります。

'link'要素は'href'と'rel'の2つの属性を定義しなければなりません。

'link'要素は'title'と'tag'属性を持つ場合があります。

### 2.2.11. 'name'

一般的な表現で見つかる'descriptor'の名前を示します。'descriptor'のプロパティとして表示される場合があります。

これは、'descriptor'の名前がALPSドキュメント内の他の場所で'id'値として使用される場合に使用されます。例えば、単一のALPSドキュメントが'customer'と呼ばれる意味的記述子（データ要素）と'customer'と呼ばれる安全な記述子（遷移要素）の両方を定義する場合、両方が'id="customer"'をALPSドキュメント内で持つことはできません。一方は別の'id'を持ち、'name="customer"'を設定する必要があります。

'name'プロパティの使用は通常、アプリケーションのセマンティクスにあいまいさがあることを示します。したがって、既存の設計を記述するALPSプロファイルを作成する場合にのみ使用すべきです。

### 2.2.12. 'rel'

有効なリンク関係値（[RFC8288]に従って）を含むべきです。これは、a）拡張関係タイプ（URI）または b）登録済み関係タイプ（短い文字列）のいずれかです。

リンク関係値は、IANA、Microformats.org、または他のソースを含む様々な場所で登録される場合があります。

'link'および'descriptor'のプロパティとして表示されます。

### 2.2.13. 'rt'

指定されたネットワークリクエストを実行する際に返されるリソースの種類を示します。'rt'属性は'type'値が'safe'、'unsafe'、または'idempotent'である'descriptor'にのみ表示されるべきです。

'rt'属性はオプションであり、表示される場合は以下の2つの方法のいずれかを使用して既存の'descriptor'の'id'を指す必要があります：

1. フラグメント識別子（例：rt="#friend"）。現在のALPSドキュメント内の既存の'descriptor'の'id'を指します。

2. フラグメント識別子を持つ解決可能なURL（例：rt="http://example.org/profiles/people#friend"）。任意の有効なALPSドキュメント内の既存の'descriptor'の'id'を指します。

### 2.2.14. 'tag'

'tag'プロパティは、空白で区切られた一意でないプライベート値のリストを保持するように設計されています。このプロパティの値は通常、ドキュメント作成者がALPSドキュメントの1つ以上の要素を共有IDでマークするために使用され、パーサーやその他のドキュメント消費者がALPSドキュメントの部分をグループ化および/または処理するために使用できます。

'tag'は'descriptor'、'doc'、'ext'、'link'要素のプロパティになることができます。これはオプションのプロパティであり、ドキュメント読者はこれを無視する場合があります。

注意：ALPSドキュメントで'tag'値が使用される場合、作成者はALPSドキュメントのルートに'rel'値が"tag-doc"に設定され、使用される'tag'値を定義する人間が読めるドキュメントを指す'href'を持つ1つ以上の'link'要素を含めるべきです。

```xml
<?xml version="1.0"?>
  <alps version="1.0">
  <link rel="tag-doc" href="http://example.org/tags/index.html" />
  <title>Search Profile</title>
  <doc href="http://example.org/samples/full/doc.html" />
  <doc href="http://example.org/samples/profile/doc.html"
    tag="profile"/>

  <descriptor id="search" type="safe"
      rt="#profile-results"
      title="Search for a profile."
      tag="profile">
    ...
  </descriptor>
  <descriptor id="profile-results"
      type="semantic"
      tag="profile">
      ...
  </descriptor>
</alps>
```

XML例

```json
{
  "alps" : {
    "version" : "1.0",
    "link" : {
      "rel" : "tag-doc",
      "href" : "http://example.org/tags/index.html"
    },
    "doc" : [
      {"href" : "http://example.org/samples/full/doc.html"},
      {"href" : "http://example.org/samples/profile/doc.html",
        "tag" : "profile"},
    ],
    "descriptor" : [
      {
        "id" : "search",
        "type" : "safe",
        "rt" : "#profile-results",
        "title" : "Search for a profile.",
        "tag" : "profile"
        "descriptor" : [ ... ]
      },
      {
        "id" : "profile-results",
        "type" : "semantic",
        "tag" : "profile",
        "descriptor" : [ ... ]
      }
    ]
  }
}
```

JSON例

### 2.2.15. 'title'

'title'はルート要素（'alps'の子として）または'descriptor'または'link'のプロパティとして表示できます。

'title'の値には、単一の人間が読めるテキスト文字列が含まれます。

```xml
<?xml version="1.0"?>
  <alps version="1.0">
  <title>Search Profile</title>
  <doc href="http://example.org/samples/full/doc.html" />

  <descriptor id="search" type="safe" title="Search for a profile.">
    ...
  </descriptor>
</alps>
```

XML例

### 2.2.16. 'type'

結果の表現内で要素に適用されるハイパーメディア制御のタイプを示します。これは各'descriptor'要素に表示されるべきです。有効な4つの値は以下の通りです：

'semantic'：状態要素（例：HTML.SPAN、HTML.INPUTなど）。

'safe'：安全で冪等な状態遷移をトリガーするハイパーメディア制御（例：HTTP.GETまたはHTTP.HEAD）。

'idempotent'：安全でない冪等な状態遷移をトリガーするハイパーメディア制御（例：HTTP.PUTまたはHTTP.DELETE）。

'unsafe'：安全でない非冪等な状態遷移をトリガーするハイパーメディア制御（例：HTTP.POST）。

要素に'type'属性が関連付けられていない場合、'type="semantic"'が暗示されます。

### 2.2.17. 'value'

文字列値を含みます。'doc'および'ext'要素の属性として表示される場合があります。

### 2.2.18. 'version'

ドキュメントで使用されるALPS仕様のバージョンを示します。これは'alps'要素のプロパティとして表示されるべきです。現在、唯一の有効な値は'1.0'です。値が表示されない場合、'1.0'が暗示されます。

## 2.3. ALPS表現

ALPSドキュメントはXMLまたはJSON形式のいずれかで表現できます。このセクションには、ALPSの要素と属性が各形式でどのように表示されるかに関する注記と、ALPSドキュメント作成者をガイドする例が含まれています。

### 2.3.1. サンプルHTML

以下は、いくつかの意味的記述子と遷移指示を含む簡単なHTMLドキュメントです。このドキュメントは、以下のXMLとJSONのALPSドキュメントから生成されました。このHTMLドキュメントを、XMLとJSONの例を評価する際のガイドとして使用してください。

```html
<!-- サンプルHTMLドキュメント -->
<html>
  <head>
    <link rel="profile" href="http://alps.io/documents/search" />
  </head>
  <body>
    <form class="search" action="..." method="get">
      <input type="text" name="search" value="..." />
        <select name="resultType">
          <option value="summary" />
          <option value="detailed" />
        </select>
      <input type="submit" />
    </form>
  </body>
</html>
```

HTMLサンプル

### 2.3.2. XML表現例

ALPSドキュメントのXMLバージョンでは、以下のALPSプロパティは常にXML要素として表示されます：'alps'、'doc'、'descriptor'、'ext'。他のすべてのALPSプロパティはXML属性として表示されます。

#### 2.3.2.1. 完全なXML表現

以下は、application/alps+xml表現の例です。

```xml
<?xml version="1.0"?>
<alps version="1.0">
  <doc href="http://example.org/samples/full/doc.html" />

  <descriptor id="search" type="safe">
    <doc format="text">2つの入力を持つ検索フォーム。</doc>
    <descriptor href="#resultType" />
    <descriptor id="value" name="search" type="semantic">
      <doc>検索用の入力</doc>
    </descriptor>
  </descriptor>

  <descriptor id="resultType" type="semantic">
    <doc>結果フォーマット</doc>
    <ext
      href="http://alps.io/ext/range"
      value="summary,detail" />
  </descriptor>
</alps>
```

完全なXML表現

### 2.3.3. JSON表現例

ALPSドキュメントをJSON形式で表現する場合、'descriptor'と'ext'プロパティは常に匿名オブジェクトの配列として表現されます - 配列に1つのメンバーしかない場合でも同様です。

例：

```json
"descriptor" : [
  {
    "id" : "value",
    "name" : "search",
    "type" : "semantic",
    "doc" : {"value" : "検索用の入力"}
  },
  {"href" : "#resultType"}
]
```

ALPS+JSONの配列

'doc'プロパティは常に名前付きオブジェクトとして表現されます。

例：

```json
{
  "doc" : {
    "format" : "text",
    "value" : "ルールは重要です"
  }
}
```

ALPS+JSONの説明

#### 2.3.3.1. 完全なJSON表現

以下は、ALPSドキュメントのapplication/alps+json表現の例です。

```json
{
  "alps" : {
    "version" : "1.0",
    "doc" : {
      "href" : "http://example.org/samples/full/doc.html"
    },
    "descriptor" : [
      {
        "id" : "search",
        "type" : "safe",
        "doc" : {"value" :
          "2つの入力を持つ検索フォーム"
        },
        "descriptor" : [
          {
            "id" : "value",
            "name" : "search",
            "type" : "semantic",
            "doc" : {"value" : "検索用の入力"}
          },
          {"href" : "#resultType"}
        ]
      },
      {
        "id" : "resultType",
        "type" : "semantic",
        "doc" : {"value" : "結果フォーマット"},
        "ext" : [
          {
            "href" : "http://alps.io/ext/range",
            "value" : "summary,detail"
          }
        ]
      }
    ]
  }
}
```

完全なALPS+JSON表現

## 3. 既存のメディアタイプへのALPSドキュメントの適用

ALPSドキュメントは、ALPSと対象のメディアタイプの間に合意されたマッピングが存在する限り、多くの既存のメディアタイプに適用できます。セクション1.3ではこれに関する情報的な例を示しました。既存のメディアタイプにALPSドキュメントを適用するための規範的で最新のガイダンスは、ALPSの公式Webサイト（http://alps.io/docs/mapping）で入手できます。[TK：このページはまだ存在しません。-mamund]

すべてのメディアタイプがすべてのALPS記述子を忠実に表現できるわけではありません。例えば、'application/json'メディアタイプにはハイパーリンクを表現する標準的な方法がありません。そのようなメディアタイプにALPSを適用する詳細は必然的に不完全であり、ALPSプロファイルのいくつかの側面をそのメディアタイプのドキュメントで表現することは不可能になります。

### 3.1. ALPSドキュメントへのリンク

ALPSプロファイルが何らかの表現ドキュメントのセマンティクスを記述していることを示すために、表現ドキュメントはALPSドキュメントにリンクされるべきです。このリンクを作成する際には、'profile'リンク関係[RFC6906]を使用しなければなりません。表現ドキュメントのメディアタイプに他のリソースへのリンクを作成する機能がない場合、またはリンク関係を表現する機能がない場合、HTTP 'Link'ヘッダー[RFC8288]を使用して表現ドキュメントとALPSプロファイルを接続する場合があります。表現ドキュメントのメディアタイプがドキュメントをプロファイルにリンクするためのパラメータを定義している場合、そのパラメータを使用して表現ドキュメントとALPSプロファイルを接続する場合があります。

単一の表現ドキュメントは、複数のALPSプロファイルによって記述される場合があります。2つのALPSプロファイルが同じ要素に対して矛盾するセマンティクスを与える場合、表現内でより早くリンクされたドキュメントが優先されるべきです。'Link'ヘッダーを使用してリンクされたプロファイルは、表現ドキュメント自体内でリンクされたプロファイルよりも優先されます。メディアタイプパラメータを使用してリンクされたプロファイルは、'Link'ヘッダーを使用してリンクされたプロファイルと表現ドキュメント自体内でリンクされたプロファイルよりも優先されます。

## 4. IANAの考慮事項

この仕様は2つのメディアタイプを確立します：'application/alps+xml'と'application/alps+json'

### 4.1. application/alps+xml

タイプ名: application

サブタイプ名: alps+xml

必須パラメータ: なし

オプションパラメータ:

charset: このパラメータは、[RFC3023]で指定されている'application/xml'メディアタイプのcharsetパラメータと同じセマンティクスを持ちます。

profile: ALPSドキュメントに適用される特定の制約または規則を識別するIRIのスペース区切りリスト。プロファイルは、プロファイルの知識なしに処理される場合にリソース表現のセマンティクスを変更してはならないため、プロファイルの知識を持つクライアントと持たないクライアントの両方が同じ表現を安全に使用できます。プロファイルパラメータは、コンテンツネゴシエーションプロセスでクライアントが好みを表現するためにも使用される場合があります。ドキュメント作成者は、参照解除可能なプロファイルIRIを使用し、そのIRIで有用なドキュメントを提供することが推奨されます。

エンコーディングの考慮事項:

バイナリ: [RFC3023]で指定されているapplication/xmlのエンコーディングの考慮事項と同じです。

セキュリティの考慮事項: このフォーマットは、すべてのXMLコンテンツタイプに共通するセキュリティ問題を共有します。実行可能なコンテンツは提供しません。ALPSドキュメントに含まれる情報はプライバシーや完全性サービスを必要としません。

相互運用性の考慮事項: ALPSはDTDによって記述されておらず、XMLの整形式ルールのみを適用します。非検証パーサーによってのみ解析されるべきです。

フラグメント識別子の考慮事項: application/alps+xmlリソースで使用されるフラグメント識別子は、ドキュメント内の既存の'descriptor'の'id'と一致する[RFC1738]に従ってURL安全でない文字を含まない単純な不透明な文字列です。例えば、フラグメント識別子"#user"は、id値が"user"に設定されたドキュメント内の記述子を参照します。

公開された仕様: このドキュメント

このメディアタイプを使用するアプリケーション: 様々

追加情報:

マジックナンバー: なし

ファイル拡張子: .xml

Macintoshファイルタイプコード: TEXT

オブジェクト識別子: なし

詳細情報の連絡先:

名前: Mike Amundsen

電子メール: mca@amundsen.com

意図された使用: 一般

作成者/変更管理者: Mike Amundsen

### 4.2. application/alps+json

タイプ名: application

サブタイプ名: alps+json

必須パラメータ: なし

オプションパラメータ:

profile: ALPSドキュメントに適用される特定の制約または規則を識別するIRIのスペース区切りリスト。プロファイルは、プロファイルの知識なしに処理される場合にリソース表現のセマンティクスを変更してはならないため、プロファイルの知識を持つクライアントと持たないクライアントの両方が同じ表現を安全に使用できます。プロファイルパラメータは、コンテンツネゴシエーションプロセスでクライアントが好みを表現するためにも使用される場合があります。ドキュメント作成者は、参照解除可能なIRIを使用し、そのIRIで有用なドキュメントを提供することが推奨されます。

エンコーディングの考慮事項: バイナリ

セキュリティの考慮事項: このメディアタイプは、すべてのJSONコンテンツタイプに共通するセキュリティ問題を共有します。追加情報については[RFC4627]のセクション#6を参照してください。ALPS+JSONは実行可能なコンテンツを提供しません。ALPS+JSONドキュメントに含まれる情報はプライバシーや完全性サービスを必要としません。

相互運用性の考慮事項: なし

フラグメント識別子の考慮事項: application/alps+jsonリソースで使用されるフラグメント識別子は、ドキュメント内の既存の'descriptor'の'id'と一致する[RFC1738]に従ってURL安全でない文字を含まない単純な不透明な文字列です。例えば、フラグメント識別子"#user"は、id値が"user"に設定されたドキュメント内の記述子を参照します。

公開された仕様: このドキュメント

このメディアタイプを使用するアプリケーション: 様々

追加情報:

マジックナンバー: なし

ファイル拡張子: .json

Macintoshファイルタイプコード: TEXT

オブジェクト識別子: なし

詳細情報の連絡先:

名前: Mike Amundsen

電子メール: mca@amundsen.com

意図された使用: 一般

作成者/変更管理者: Mike Amundsen

## 5. 国際化の考慮事項

[TK]

[[CREF1: テキストを挿入（rfc 5987を考慮）]]

## 6. 謝辞

著者は、この仕様に貢献した以下の人々に感謝の意を表します：

Glenn Block、Christopher Harrison、Steve Klabnik、Filip Kolarik、Akihito Koriyama、Graham Klyne、Mike Levy、Stephen Mizell、Dmitry Pavlov、Remon (Ray) Sinnema。

## 7. 規範的参考文献

[RFC1738] Berners-Lee, T., Masinter, L., and M. McCahill, "Uniform Resource Locators (URL)", RFC 1738, DOI 10.17487/RFC1738, December 1994, <https://www.rfc-editor.org/info/rfc1738>.

[RFC2045] Freed, N. and N. Borenstein, "Multipurpose Internet Mail Extensions (MIME) Part One: Format of Internet Message Bodies", RFC 2045, DOI 10.17487/RFC2045, November 1996, <https://www.rfc-editor.org/info/rfc2045>.

[RFC2119] Bradner, S., "Key words for use in RFCs to Indicate Requirement Levels", BCP 14, RFC 2119, DOI 10.17487/RFC2119
