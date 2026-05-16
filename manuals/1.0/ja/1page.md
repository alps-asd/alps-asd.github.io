---
layout: docs-ja
title: ALPS/ASD Complete Manual
category: Manual
permalink: /manuals/1.0/ja/1page.html
---

# ALPS/ASD Complete Manual

このページは、ALPS/ASDの主要ドキュメントを1ページにまとめた包括的なマニュアルです。参照、印刷、オフライン閲覧に便利です。

***
# イントロダクション

[![ALPS document](/alps/cart/alps.svg)](/alps/cart/)

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

***

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

***

# インストールと利用ガイド

ASD（app-state-diagram）は、アプリケーションの状態遷移図やボキャブラリリストを含んだALPSの包括的なドキュメントを作成するためのツールです。以下の方法で利用できます。

## 利用方法の選択

### 1. オンライン版

ローカルインストール不要で、すぐに利用できます：

- [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/)

特徴：
- JSON/XML/HTMLファイルをドラッグ＆ドロップで読み込み可能
- スニペットや高度なコード補完機能

### 2. Homebrew版（推奨）

[homebrew](https://brew.sh/ja/)がインストールされている環境では最も簡単に利用できます。また常に最新版に更新されます。

インストール:

```bash
brew install alps-asd/asd/asd
```

### 3. npm版

Node.js 20以上がインストールされている環境で利用できます。

インストール:

```bash
npm install -g @alps-asd/app-state-diagram
```

### 4. GitHub Actions版

CIでASD作成を行います。詳細は[マーケットプレイス](https://github.com/marketplace/actions/app-state-diagram)をご覧ください。

### 5. Language Server (experimental)

VimやVSCodeなどのエディタでリアルタイム検証、コード補完、ホバー情報を提供するLanguage Serverです。

[GitHub - alps-lsp](https://github.com/alps-asd/alps-lsp)

## 使用方法

### デモ実行
```bash
# デモファイルのダウンロードと実行
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### コマンドラインオプション
```text
asd [options] alps_file

オプション：
  -v, --version          バージョン表示
  -e, --echo             ファイルではなく標準出力に出力
  -f, --format <format>  出力形式 (html|svg|dot|mermaid)
  -o, --output <file>    出力ファイル (デフォルト: <入力>.html)
  --label <mode>         ラベルモード: id または title
  --validate             ALPSプロファイルを検証
  -w, --watch            ウォッチモード（ライブリロード）
  --port <port>          ウォッチモードのCDPポート (デフォルト: 9222)

コマンド：
  merge <base> <source>  ALPSプロファイルをマージ
```

## インストール確認

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## 選択の目安

- すぐに試したい、一時的な利用 → オンライン版
- ローカル利用（Mac/Linux） → Homebrew版
- Node.js環境での利用 → npm版
- CI/CD環境での利用 → GitHub Actions版

その他のインストール方法については[レガシーインストール](/manuals/1.0/ja/legacy-install.html)を参照してください。

***

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

***

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

***

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

ブログ記事（BlogPosting）は、ID、作成日時、本文を持つ情報の集まりとして定義できます。

XMLの場合：
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="id" title="ID">
        <doc format="text">記事を一意に識別するID</doc>
    </descriptor>
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="ブログ記事">
        <descriptor href="#id"/>
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
            {"id": "id", "title": "ID", "doc": {"format": "text", "value": "記事を一意に識別するID"}},
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}},
            {"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
               {"href": "#id"},
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
   - `BlogPosting`が`id`、`dateCreated`、`articleBody`を含む
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
|------------|------------|------------------------|
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
    <descriptor id="id" title="ID">
        <doc format="text">記事を一意に識別するID</doc>
    </descriptor>
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="ブログ記事">
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
        <descriptor href="#id"/>
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
            {"id": "id", "title": "ID", "doc": {"format": "text", "value": "記事を一意に識別するID"}},
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}},
            {"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
               {"href": "#id"},
               {"href": "#dateCreated"},
               {"href": "#articleBody"}
            ]},
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "ブログ記事を見る", "descriptor": [
               {"href": "#id"}
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
   - `descriptor href="#id"`で指定します
   - 記事を一意に特定するために必要な情報です

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
   - 閲覧：id（記事を特定）
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
    <descriptor id="id" title="ID">
        <doc format="text">記事を一意に識別するID</doc>
    </descriptor>
    <descriptor id="dateCreated" title="作成日時">
        <doc format="text">記事が作成された日時をISO8601形式で表します</doc>
    </descriptor>
    <descriptor id="articleBody" title="記事本文">
        <doc format="text">ブログ記事の本文</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="ブログ記事">
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="ブログ記事を見る">
        <descriptor href="#id"/>
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
            {"id": "id", "title": "ID", "doc": {"format": "text", "value": "記事を一意に識別するID"}},
            {"id": "dateCreated", "title": "作成日時", "doc": {"format": "text", "value": "記事が作成された日時をISO8601形式で表します"}},
            {"id": "articleBody", "title": "記事本文", "doc": {"format": "text", "value": "ブログ記事の本文"}},
            {"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
                {"href": "#id"},
                {"href": "#dateCreated"},
                {"href": "#articleBody"}
            ]},
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "ブログ記事を見る", "descriptor": [{"href": "#id"}]},
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
    <descriptor href="#id"/>
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
</descriptor>
```

JSONの場合：
```json
{"id": "BlogPosting", "title": "ブログ記事", "descriptor": [
    {"href": "#id"},
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
    <descriptor href="#id"/>
</descriptor>
```

JSONの場合：
```json
{"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "ブログ記事を見る",
 "descriptor": [{"href": "#id"}]}
```
- 操作の種類を定義します
- safe：閲覧操作（prefixは`go`）
- unsafe：作成操作（prefixは`doCreate`）
- idempotent：更新・削除操作（prefixは`doUpdate`/`doDelete`）

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
    <descriptor href="#id" tag="metadata"/>
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
        {"href": "#id", "tag": "metadata"},
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

***

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
|--------|------|-----|------|-----|
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
  - URL安全な文字のみ使用可能（[RFC3986](https://www.rfc-editor.org/rfc/rfc3986)に準拠）

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

関連ドキュメントへの参照を定義します。linkはalpsまたはdescriptor要素の子要素として使用できます。

#### link属性一覧

| 属性名 | 必須 | 型 | 説明 | 例 |
|--------|------|-----|------|-----|
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
|--------|------|-----|------|-----|
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

***

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

**重要: Safe遷移(`go*`)のIDには、遷移先の状態名を含めなければなりません。**

```json
[
  {"id": "goProductList", "type": "safe", "rt": "#ProductList"},
  {"id": "goUserProfile", "type": "safe", "rt": "#UserProfile"},
  {"id": "goCheckout", "type": "safe", "rt": "#Checkout"}
]
```

この規則により、一貫性が保たれ、図が自己文書化されます。遷移にソース状態がない場合(エントリーポイント)、図では`UnknownState`から発生するように表示されます。

❌ **間違った例:**

```json
[
  {"id": "goStart", "type": "safe", "rt": "#ProductList"},
  {"id": "goNext", "type": "safe", "rt": "#Checkout"}
]
```

- `goStart` → `goProductList` であるべき
- `goNext` → `goCheckout` であるべき

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

## タグの命名

タグはディスクリプタを複数の直交する軸で分類します。補助的なカテゴリにはプレフィックスを付け、最も基本的なカテゴリであるドメインにはプレフィックスを付けません。

| プレフィックス | カテゴリ | 例 |
|---------------|---------|-----|
| （なし） | ドメイン | `catalog`, `order`, `checkout` |
| `flow-` | ワークフロー | `flow-purchase`, `flow-register` |
| `actor-` | アクター | `actor-admin`, `actor-customer` |

ドメインカテゴリにプレフィックスが不要なのは、最も普遍的な分類軸だからです。ほぼすべてのディスクリプタが何らかのドメインに属するため、毎回 `domain-catalog` と書くのは情報量がなくノイズになります。プログラミング言語のデフォルト名前空間と同じ考え方です。

1つのディスクリプタに複数の軸のタグを付けることができます:

```json
{"id": "doAddCart", "type": "unsafe", "rt": "#Cart",
  "tag": "cart flow-purchase actor-customer"}
```

`cart` がドメイン、`flow-purchase` がワークフロー、`actor-customer` が操作の主体です。

タグの数が増えてきたら、タグ体系を別ファイル（例: `tag.md`）にまとめ、プロファイルからリンクします:

```json
{
  "alps": {
    "link": [
      {"rel": "describedby", "href": "tag.md", "title": "タグ分類体系"}
    ]
  }
}
```

タグの定義をプロファイル本体の外に置くことで、人間が読みやすくレビューしやすくなります。

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

***

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

***

# IANAリンクリレーション

このドキュメントはALPSプロファイルのrel属性で使用が推奨される、IANAリンクリレーションの一覧です。

## 状態遷移

| リレーション | 説明 |
|------------|------|
| edit | 対象の状態を編集できる遷移を表す |
| edit-form | 編集用のフォームを取得する遷移を表す |
| create-form | 作成用のフォームを取得する遷移を表す |
| collection | コレクション全体を表す状態への遷移 |
| item | コレクションの個別要素を表す状態への遷移 |

## 順序のある遷移

| リレーション | 説明 |
|------------|------|
| first | シリーズの最初の状態への遷移 |
| last | シリーズの最後の状態への遷移 |
| next | シリーズの次の状態への遷移 |
| prev | シリーズの前の状態への遷移 |

## 意味的記述

| リレーション | 説明 |
|------------|------|
| describedby | セマンティックディスクリプタの詳細な説明への参照 |
| describes | セマンティックディスクリプタが説明する対象への参照（describedbyの逆関係） |
| type | セマンティックディスクリプタの抽象的な型を示す |

## 文書構造

| リレーション | 説明 |
|------------|------|
| section | 文書内のセクションを示す |
| subsection | 文書内のサブセクションを示す |
| chapter | 文書内の章を示す |
| contents | 文書の目次を示す |

## メタデータ

| リレーション | 説明 |
|------------|------|
| author | 作成者情報への参照 |
| license | ライセンス情報への参照 |
| copyright | 著作権情報への参照 |

## バージョン管理

| リレーション | 説明 |
|------------|------|
| latest-version | 最新バージョンの状態への遷移 |
| predecessor-version | 前バージョンの状態への遷移 |
| successor-version | 次バージョンの状態への遷移 |
| version-history | バージョン履歴を示す状態への遷移 |

## 関連情報

| リレーション | 説明 |
|------------|------|
| help | ヘルプ情報への参照 |
| status | 状態に関する情報への参照 |
| alternate | 代替表現への参照 |

注意:
1. このリストはALPSプロファイルでよく使用される可能性のあるリレーションの抜粋です
2. 完全な一覧は[IANAのRegistry](https://www.iana.org/assignments/link-relations/link-relations.xhtml)を参照してください
3. カテゴリ分けは便宜上のものです
4. 実際の使用時は、アプリケーションの要件に応じて適切なリレーションを選択してください

***

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

***

## カテゴリ別用語一覧

### 基本プロパティ

| 用語 | レベル | 説明 |
|------|--------|------|
| name | 🔵 | 名前 |
| description | 🔵 | 説明 |
| url | 🔵 | URL |
| alternateName | 🔵 | 別名 |
| title | 🔵 | タイトル |
| text | 🔵 | テキスト |
| value | 🔵 | 値 |
| additionalValue | 🟡 | 追加の値 |
| defaultValue | 🟡 | デフォルト値 |
| maxValue | 🟡 | 最大値 |
| minValue | 🟡 | 最小値 |
| multipleValues | 🟡 | 複数の値 |
| propertyID | 🟡 | プロパティID |
| valueReference | 🟡 | 値の参照 |
| valueRequired | 🟡 | 必須値 |
| unitCode | ⚪ | 単位コード |
| unitText | ⚪ | 単位テキスト |
| propertyType | ⚪ | プロパティタイプ |
| propertyValue | ⚪ | プロパティ値 |
| measurementTechnique | ⚪ | 測定手法 |

### 識別子・参照

| 用語 | レベル | 説明 |
|------|--------|------|
| identifier | 🔵 | 識別子 |
| id | 🔵 | ID |
| sameAs | 🔵 | 同一参照 |
| mainEntity | 🔵 | 主要実体 |
| about | 🟡 | 参照対象 |
| mentions | 🟡 | 言及 |
| citation | 🟡 | 引用 |
| reference | 🟡 | 参照 |
| referencesOrder | 🟡 | 参照順序 |
| isBasedOn | 🟡 | 基づいている |
| isPartOf | 🟡 | 一部である |
| hasPart | 🟡 | 部分を持つ |
| itemListElement | 🟡 | リスト要素 |
| itemListOrder | 🟡 | リスト順序 |
| position | 🟡 | 位置 |
| isVersionOf | ⚪ | バージョンである |
| predecessorOf | ⚪ | 前任である |
| successorOf | ⚪ | 後任である |
| isRelatedTo | ⚪ | 関連している |
| isSimilarTo | ⚪ | 類似している |
| isVariantOf | ⚪ | バリエーションである |
| exampleOfWork | ⚪ | 作品の例 |
| workExample | ⚪ | 例となる作品 |
| isBasedOnUrl | ⚪ | 基づいているURL |

### メタデータ

| 用語 | レベル | 説明 |
|------|--------|------|
| version | 🔵 | バージョン |
| status | 🔵 | 状態 |
| category | 🔵 | カテゴリ |
| keywords | 🔵 | キーワード |
| type | 🔵 | タイプ |
| format | 🔵 | フォーマット |
| language | 🔵 | 言語 |
| source | 🔵 | ソース |
| license | 🟡 | ライセンス |
| creator | 🟡 | 作成者 |
| editor | 🟡 | 編集者 |
| publisher | 🟡 | 発行者 |
| contributor | 🟡 | 貢献者 |
| rights | 🟡 | 権利 |
| copyrightHolder | 🟡 | 著作権者 |
| copyrightYear | 🟡 | 著作権年 |
| creditText | 🟡 | クレジットテキスト |
| maintainer | 🟡 | メンテナー |
| schemaVersion | ⚪ | スキーマバージョン |
| usageInfo | ⚪ | 使用情報 |
| encoding | ⚪ | エンコーディング |
| isAccessibleForFree | ⚪ | 無料アクセス可能 |
| conditionsOfAccess | ⚪ | アクセス条件 |
| contentReferenceTime | ⚪ | コンテンツ参照時間 |

### 日時・期間

| 用語 | レベル | 説明 |
|------|--------|------|
| dateCreated | 🔵 | 作成日時 |
| dateModified | 🔵 | 更新日時 |
| datePublished | 🔵 | 公開日時 |
| startDate | 🔵 | 開始日 |
| endDate | 🔵 | 終了日 |
| startTime | 🔵 | 開始時刻 |
| endTime | 🔵 | 終了時刻 |
| duration | 🔵 | 期間 |
| validFrom | 🔵 | 有効開始日時 |
| validThrough | 🔵 | 有効終了日時 |
| dateDeleted | 🟡 | 削除日時 |
| dateRead | 🟡 | 読取日時 |
| dateReceived | 🟡 | 受信日時 |
| dateSent | 🟡 | 送信日時 |
| dateIssued | 🟡 | 発行日時 |
| scheduleTime | 🟡 | 予定時刻 |
| birthDate | 🟡 | 生年月日 |
| deathDate | 🟡 | 死亡日時 |
| foundingDate | 🟡 | 設立日 |
| dissolutionDate | 🟡 | 解散日 |
| previousStartDate | ⚪ | 前回開始日 |
| uploadDate | ⚪ | アップロード日時 |
| modifiedTime | ⚪ | 変更時刻 |
| expires | ⚪ | 有効期限 |
| temporalCoverage | ⚪ | 時間的範囲 |

### テキスト・コンテンツ

| 用語 | レベル | 説明 |
|------|--------|------|
| title | 🔵 | タイトル |
| text | 🔵 | テキスト |
| content | 🔵 | コンテンツ |
| articleBody | 🔵 | 記事本文 |
| headline | 🔵 | 見出し |
| abstract | 🔵 | 要約 |
| description | 🔵 | 説明 |
| comment | 🔵 | コメント |
| contentType | 🔵 | コンテンツタイプ |
| encodingFormat | 🟡 | エンコーディング形式 |
| wordCount | 🟡 | 単語数 |
| characterCount | 🟡 | 文字数 |
| pagination | 🟡 | ページ番号 |
| pageStart | 🟡 | 開始ページ |
| pageEnd | 🟡 | 終了ページ |
| section | 🟡 | セクション |
| chapter | 🟡 | 章 |
| articleSection | 🟡 | 記事セクション |
| speakable | ⚪ | 読み上げ可能テキスト |
| textTemplate | ⚪ | テキストテンプレート |
| cssSelector | ⚪ | CSSセレクタ |
| xpath | ⚪ | XPath |
| transcript | ⚪ | 文字起こし |
| translationOfWork | ⚪ | 翻訳元作品 |
| workTranslation | ⚪ | 翻訳作品 |

### メディア・ファイル

| 用語 | レベル | 説明 |
|------|--------|------|
| image | 🔵 | 画像 |
| audio | 🔵 | 音声 |
| video | 🔵 | 動画 |
| file | 🔵 | ファイル |
| fileSize | 🔵 | ファイルサイズ |
| fileFormat | 🔵 | ファイル形式 |
| contentUrl | 🔵 | コンテンツURL |
| thumbnailUrl | 🔵 | サムネイルURL |
| downloadUrl | 🔵 | ダウンロードURL |
| embedUrl | 🟡 | 埋め込みURL |
| height | 🟡 | 高さ |
| width | 🟡 | 幅 |
| duration | 🟡 | 長さ |
| bitrate | 🟡 | ビットレート |
| encodingFormat | 🟡 | エンコーディング形式 |
| playerType | 🟡 | プレーヤータイプ |
| productionCompany | 🟡 | 制作会社 |
| thumbnail | 🟡 | サムネイル |
| uploadDate | 🟡 | アップロード日 |
| contentSize | 🟡 | コンテンツサイズ |
| encodesCreativeWork | ⚪ | エンコード対象作品 |
| associatedMedia | ⚪ | 関連メディア |
| requiresSubscription | ⚪ | 購読要件 |
| videoFrameSize | ⚪ | 動画フレームサイズ |
| videoQuality | ⚪ | 動画品質 |
| hasDigitalDocumentPermission | ⚪ | デジタル文書権限 |

### 人物・個人

| 用語 | レベル | 説明 |
|------|--------|------|
| givenName | 🔵 | 名 |
| familyName | 🔵 | 姓 |
| email | 🔵 | メールアドレス |
| telephone | 🔵 | 電話番号 |
| gender | 🔵 | 性別 |
| birthDate | 🔵 | 生年月日 |
| nationality | 🔵 | 国籍 |
| address | 🔵 | 住所 |
| jobTitle | 🔵 | 役職 |
| additionalName | 🟡 | ミドルネーム |
| honorificPrefix | 🟡 | 敬称（前） |
| honorificSuffix | 🟡 | 敬称（後） |
| birthPlace | 🟡 | 出生地 |
| deathDate | 🟡 | 死亡日 |
| deathPlace | 🟡 | 死亡地 |
| height | 🟡 | 身長 |
| weight | 🟡 | 体重 |
| worksFor | 🟡 | 勤務先 |
| alumniOf | 🟡 | 卒業校 |
| awards | 🟡 | 受賞歴 |
| knows | ⚪ | 知人 |
| colleagues | ⚪ | 同僚 |
| follows | ⚪ | フォロー |
| parent | ⚪ | 親 |
| children | ⚪ | 子 |
| sibling | ⚪ | 兄弟姉妹 |
| spouse | ⚪ | 配偶者 |
| homeLocation | ⚪ | 居住地 |
| workLocation | ⚪ | 勤務地 |

### 組織・団体

| 用語 | レベル | 説明 |
|------|--------|------|
| organizationName | 🔵 | 組織名 |
| legalName | 🔵 | 正式名称 |
| department | 🔵 | 部署 |
| address | 🔵 | 所在地 |
| telephone | 🔵 | 電話番号 |
| email | 🔵 | メールアドレス |
| url | 🔵 | ウェブサイト |
| foundingDate | 🟡 | 設立日 |
| founder | 🟡 | 設立者 |
| numberOfEmployees | 🟡 | 従業員数 |
| parentOrganization | 🟡 | 親組織 |
| subOrganization | 🟡 | 子組織 |
| member | 🟡 | メンバー |
| memberOf | 🟡 | 所属組織 |
| taxID | 🟡 | 税務ID |
| vatID | 🟡 | VAT番号 |
| globalLocationNumber | ⚪ | GLN |
| duns | ⚪ | DUNS番号 |
| funder | ⚪ | 出資者 |
| sponsor | ⚪ | スポンサー |
| ownershipFundingInfo | ⚪ | 所有権・資金情報 |
| slogan | ⚪ | スローガン |
| brand | ⚪ | ブランド |
| dissolutionDate | ⚪ | 解散日 |

### 住所・位置

| 用語 | レベル | 説明 |
|------|--------|------|
| streetAddress | 🔵 | 町名・番地 |
| addressLocality | 🔵 | 市区町村 |
| addressRegion | 🔵 | 都道府県 |
| addressCountry | 🔵 | 国 |
| postalCode | 🔵 | 郵便番号 |
| location | 🔵 | 場所 |
| latitude | 🔵 | 緯度 |
| longitude | 🔵 | 経度 |
| elevation | 🟡 | 標高 |
| postOfficeBoxNumber | 🟡 | 私書箱番号 |
| floor | 🟡 | 階 |
| room | 🟡 | 部屋 |
| landmark | 🟡 | 目印 |
| areaServed | 🟡 | サービス提供地域 |
| serviceArea | 🟡 | サービスエリア |
| geo | 🟡 | 地理情報 |
| geoRadius | ⚪ | 地理的半径 |
| geoCoveredBy | ⚪ | 地理的包含関係 |
| geoCovers | ⚪ | 地理的範囲 |
| geoDisjoint | ⚪ | 地理的分離 |
| geoIntersects | ⚪ | 地理的交差 |
| geoTouches | ⚪ | 地理的接触 |
| containsPlace | ⚪ | 包含する場所 |
| containedInPlace | ⚪ | 包含される場所 |

### 商品・サービス

| 用語 | レベル | 説明 |
|------|--------|------|
| productID | 🔵 | 商品ID |
| sku | 🔵 | SKU（在庫管理番号） |
| name | 🔵 | 商品名 |
| description | 🔵 | 商品説明 |
| brand | 🔵 | ブランド |
| manufacturer | 🔵 | 製造元 |
| category | 🔵 | カテゴリ |
| price | 🔵 | 価格 |
| availability | 🔵 | 在庫状況 |
| color | 🟡 | 色 |
| size | 🟡 | サイズ |
| weight | 🟡 | 重量 |
| material | 🟡 | 素材 |
| model | 🟡 | モデル |
| gtin | 🟡 | GTIN（商品コード） |
| mpn | 🟡 | MPN（製造番号） |
| countryOfOrigin | 🟡 | 原産国 |
| productionDate | 🟡 | 製造日 |
| releaseDate | 🟡 | 発売日 |
| itemCondition | 🟡 | 商品状態 |
| width | ⚪ | 幅 |
| height | ⚪ | 高さ |
| depth | ⚪ | 奥行き |
| additionalProperty | ⚪ | 追加属性 |
| hasMerchantReturnPolicy | ⚪ | 返品ポリシー |
| hasWarranty | ⚪ | 保証情報 |
| isFamilyFriendly | ⚪ | 家族向け |
| isAccessoryOrSparePartFor | ⚪ | 付属品・交換部品 |
| isConsumableFor | ⚪ | 消耗品 |

### 価格・支払い

| 用語 | レベル | 説明 |
|------|--------|------|
| price | 🔵 | 価格 |
| priceCurrency | 🔵 | 通貨 |
| paymentMethod | 🔵 | 支払方法 |
| paymentStatus | 🔵 | 支払状態 |
| paymentDue | 🔵 | 支払期限 |
| validFrom | 🔵 | 価格適用開始日 |
| validThrough | 🔵 | 価格適用終了日 |
| minPrice | 🟡 | 最低価格 |
| maxPrice | 🟡 | 最高価格 |
| priceValidUntil | 🟡 | 価格有効期限 |
| discount | 🟡 | 割引 |
| discountCode | 🟡 | 割引コード |
| valueAddedTaxIncluded | 🟡 | 税込表示 |
| priceType | 🟡 | 価格タイプ |
| paymentAccepted | 🟡 | 利用可能な支払方法 |
| paymentUrl | 🟡 | 支払URL |
| billingPeriod | ⚪ | 請求期間 |
| billingDuration | ⚪ | 請求期間長 |
| billingIncrement | ⚪ | 請求増分 |
| billingStart | ⚪ | 請求開始日 |
| downPayment | ⚪ | 頭金 |
| installment | ⚪ | 分割払い |
| loanTerm | ⚪ | ローン期間 |
| monthlyMinimumPayment | ⚪ | 最低月払い額 |

### イベント・活動

| 用語 | レベル | 説明 |
|------|--------|------|
| eventName | 🔵 | イベント名 |
| eventStatus | 🔵 | イベント状態 |
| startDate | 🔵 | 開始日 |
| endDate | 🔵 | 終了日 |
| location | 🔵 | 開催場所 |
| organizer | 🔵 | 主催者 |
| performer | 🔵 | 出演者 |
| eventAttendanceMode | 🔵 | 参加形式 |
| maximumAttendeeCapacity | 🟡 | 最大参加人数 |
| remainingAttendeeCapacity | 🟡 | 残席数 |
| offers | 🟡 | チケット情報 |
| doorTime | 🟡 | 開場時間 |
| duration | 🟡 | 所要時間 |
| inLanguage | 🟡 | 使用言語 |
| sponsor | 🟡 | スポンサー |
| superEvent | ⚪ | 親イベント |
| subEvent | ⚪ | サブイベント |
| recordedIn | ⚪ | 記録メディア |
| workFeatured | ⚪ | 特集作品 |
| workPerformed | ⚪ | 上演作品 |
| contributor | ⚪ | 協力者 |

### レビュー・評価

| 用語 | レベル | 説明 |
|------|--------|------|
| review | 🔵 | レビュー |
| rating | 🔵 | 評価 |
| ratingValue | 🔵 | 評価値 |
| reviewBody | 🔵 | レビュー本文 |
| author | 🔵 | 評価者 |
| datePublished | 🔵 | 投稿日 |
| reviewRating | 🟡 | レビュー評価 |
| bestRating | 🟡 | 最高評価 |
| worstRating | 🟡 | 最低評価 |
| ratingCount | 🟡 | 評価数 |
| reviewAspect | 🟡 | レビュー観点 |
| positiveNotes | 🟡 | 良い点 |
| negativeNotes | 🟡 | 改善点 |
| aggregateRating | 🟡 | 総合評価 |
| itemReviewed | 🟡 | レビュー対象 |
| recommendationStrength | ⚪ | 推奨強度 |
| associatedReview | ⚪ | 関連レビュー |
| reviewBody | ⚪ | レビュー本文 |
| reviewRating | ⚪ | レビュー評価 |
| abridged | ⚪ | 要約版 |

### 教育・学習

| 用語 | レベル | 説明 |
|------|--------|------|
| educationalLevel | 🔵 | 教育レベル |
| learningResourceType | 🔵 | 学習リソースタイプ |
| teaches | 🔵 | 教育内容 |
| courseCode | 🔵 | コース番号 |
| instructor | 🔵 | 講師 |
| courseWorkload | 🔵 | 学習量 |
| competencyRequired | 🟡 | 必要な能力 |
| educationalUse | 🟡 | 教育用途 |
| timeRequired | 🟡 | 所要時間 |
| typicalAgeRange | 🟡 | 対象年齢層 |
| assesses | 🟡 | 評価対象 |
| educationalAlignment | 🟡 | 教育的整合性 |
| educationalFramework | 🟡 | 教育フレームワーク |
| proficiencyLevel | ⚪ | 習熟度レベル |
| coursePrerequisites | ⚪ | 前提条件 |
| educationalProgramMode | ⚪ | 教育プログラム形式 |
| occupationalCredentialAwarded | ⚪ | 取得可能資格 |
| numberOfCredits | ⚪ | 単位数 |

### 医療・健康

| 用語 | レベル | 説明 |
|------|--------|------|
| medicalCondition | 🔵 | 病状 |
| diagnosis | 🔵 | 診断 |
| treatment | 🔵 | 治療 |
| medication | 🔵 | 薬剤 |
| symptoms | 🔵 | 症状 |
| healthcareProvider | 🔵 | 医療提供者 |
| medicalSpecialty | 🟡 | 専門分野 |
| procedure | 🟡 | 処置 |
| dosageSchedule | 🟡 | 投薬スケジュール |
| adverseOutcome | 🟡 | 有害結果 |
| contraindication | 🟡 | 禁忌 |
| indication | 🟡 | 適応 |
| sideEffect | 🟡 | 副作用 |
| warning | 🟡 | 警告 |
| activeIngredient | ⚪ | 有効成分 |
| administrationRoute | ⚪ | 投与経路 |
| recommendedIntake | ⚪ | 推奨摂取量 |
| maximumIntake | ⚪ | 最大摂取量 |
| drugClass | ⚪ | 薬剤分類 |
| prescribingInfo | ⚪ | 処方情報 |

### 金融・取引

| 用語 | レベル | 説明 |
|------|--------|------|
| accountId | 🔵 | 口座ID |
| accountName | 🔵 | 口座名 |
| accountType | 🔵 | 口座種別 |
| amount | 🔵 | 金額 |
| currency | 🔵 | 通貨 |
| transactionId | 🔵 | 取引ID |
| transactionDate | 🔵 | 取引日 |
| balance | 🔵 | 残高 |
| bankAccount | 🟡 | 銀行口座 |
| creditCard | 🟡 | クレジットカード |
| interestRate | 🟡 | 金利 |
| paymentDueDate | 🟡 | 支払期限 |
| paymentStatus | 🟡 | 支払状態 |
| minimumPayment | 🟡 | 最低支払額 |
| creditLimit | 🟡 | 与信限度額 |
| exchangeRate | 🟡 | 為替レート |
| accountMinimumInflow | ⚪ | 最低入金額 |
| accountOverdraftLimit | ⚪ | 当座貸越限度額 |
| annualPercentageRate | ⚪ | 年率 |
| beneficiaryBank | ⚪ | 受取銀行 |
| cashBack | ⚪ | キャッシュバック |
| loanType | ⚪ | ローン種別 |

### 予約・スケジュール

| 用語 | レベル | 説明 |
|------|--------|------|
| reservationId | 🔵 | 予約ID |
| reservationStatus | 🔵 | 予約状態 |
| reservationFor | 🔵 | 予約対象 |
| underName | 🔵 | 予約者名 |
| reservationDate | 🔵 | 予約日 |
| startTime | 🔵 | 開始時刻 |
| endTime | 🔵 | 終了時刻 |
| partySize | 🟡 | 人数 |
| bookingTime | 🟡 | 予約時刻 |
| bookingAgent | 🟡 | 予約代理店 |
| programMembershipUsed | 🟡 | 利用会員権 |
| modifiedTime | 🟡 | 変更時刻 |
| cancelationPolicy | 🟡 | キャンセルポリシー |
| advanceBookingRequirement | ⚪ | 事前予約要件 |
| lodgingUnitType | ⚪ | 宿泊ユニットタイプ |
| lodgingUnitDescription | ⚪ | 宿泊ユニット説明 |
| checkInTime | ⚪ | チェックイン時刻 |
| checkOutTime | ⚪ | チェックアウト時刻 |
| amenityFeature | ⚪ | 設備特徴 |

### コミュニケーション

| 用語 | レベル | 説明 |
|------|--------|------|
| sender | 🔵 | 送信者 |
| recipient | 🔵 | 受信者 |
| messageText | 🔵 | メッセージ本文 |
| subject | 🔵 | 件名 |
| dateSent | 🔵 | 送信日時 |
| dateReceived | 🔵 | 受信日時 |
| messageStatus | 🔵 | メッセージ状態 |
| messageType | 🟡 | メッセージタイプ |
| inReplyTo | 🟡 | 返信対象 |
| ccRecipient | 🟡 | CCの受信者 |
| bccRecipient | 🟡 | BCCの受信者 |
| messageAttachment | 🟡 | 添付ファイル |
| replyToUrl | 🟡 | 返信URL |
| discussionUrl | 🟡 | 討議URL |
| toRecipient | ⚪ | 宛先 |
| aboutPerson | ⚪ | 対象者 |
| aboutOrganization | ⚪ | 対象組織 |
| mentions | ⚪ | 言及 |

### セキュリティ・アクセス制御

| 用語 | レベル | 説明 |
|------|--------|------|
| accessibilityControl | 🔵 | アクセス制御 |
| permission | 🔵 | 権限 |
| permissionType | 🔵 | 権限タイプ |
| authenticator | 🔵 | 認証者 |
| securityClearance | 🔵 | セキュリティクリアランス |
| accessCode | 🟡 | アクセスコード |
| accessModeSufficient | 🟡 | 十分なアクセスモード |
| accessibilityAPI | 🟡 | アクセシビリティAPI |
| accessibilityFeature | 🟡 | アクセシビリティ機能 |
| accessibilityHazard | 🟡 | アクセシビリティ上の危険 |
| conditionsOfAccess | 🟡 | アクセス条件 |
| hasDigitalDocumentPermission | 🟡 | デジタル文書権限 |
| permissionAssertion | ⚪ | 権限アサーション |
| securityScreening | ⚪ | セキュリティスクリーニング |
| accessibilityControl | ⚪ | アクセシビリティ制御 |
| accessModeSufficient | ⚪ | 十分なアクセスモード |

### ワークフロー・プロセス

| 用語 | レベル | 説明 |
|------|--------|------|
| status | 🔵 | 状態 |
| stage | 🔵 | ステージ |
| processType | 🔵 | プロセスタイプ |
| currentStatus | 🔵 | 現在の状態 |
| action | 🔵 | アクション |
| actionStatus | 🔵 | アクション状態 |
| workflowStep | 🟡 | ワークフローステップ |
| predecessor | 🟡 | 前工程 |
| successor | 🟡 | 次工程 |
| approver | 🟡 | 承認者 |
| assignee | 🟡 | 担当者 |
| dueDate | 🟡 | 期限 |
| priority | 🟡 | 優先度 |
| escalationLevel | ⚪ | エスカレーションレベル |
| workflowTemplate | ⚪ | ワークフローテンプレート |
| decisionPoint | ⚪ | 決定ポイント |
| conditionalStep | ⚪ | 条件付きステップ |
| parallelStep | ⚪ | 並列ステップ |

### 技術・システム

| 用語 | レベル | 説明 |
|------|--------|------|
| softwareVersion | 🔵 | ソフトウェアバージョン |
| operatingSystem | 🔵 | オペレーティングシステム |
| applicationCategory | 🔵 | アプリケーションカテゴリ |
| programmingLanguage | 🔵 | プログラミング言語 |
| systemRequirements | 🔵 | システム要件 |
| softwareRequirements | 🟡 | ソフトウェア要件 |
| processorRequirements | 🟡 | プロセッサ要件 |
| memoryRequirements | 🟡 | メモリ要件 |
| storageRequirements | 🟡 | ストレージ要件 |
| installUrl | 🟡 | インストールURL |
| downloadUrl | 🟡 | ダウンロードURL |
| codeRepository | 🟡 | コードリポジトリ |
| applicationSubCategory | ⚪ | アプリケーションサブカテゴリ |
| applicationSuite | ⚪ | アプリケーションスイート |
| availableOnDevice | ⚪ | 利用可能デバイス |
| browserRequirements | ⚪ | ブラウザ要件 |

### 法務・規約

| 用語 | レベル | 説明 |
|------|--------|------|
| termsOfService | 🔵 | 利用規約 |
| privacyPolicy | 🔵 | プライバシーポリシー |
| license | 🔵 | ライセンス |
| copyright | 🔵 | 著作権 |
| legalStatus | 🔵 | 法的状態 |
| jurisdiction | 🟡 | 管轄区域 |
| legislationType | 🟡 | 法制度タイプ |
| regulations | 🟡 | 規制 |
| disclaimer | 🟡 | 免責事項 |
| compliance | 🟡 | コンプライアンス |
| legalName | 🟡 | 法人名 |
| legislationDate | ⚪ | 法制定日 |
| legislationIdentifier | ⚪ | 法制度識別子 |
| legislationPassedBy | ⚪ | 法制定者 |
| legislationResponsible | ⚪ | 法的責任者 |
| governmentBenefitsInfo | ⚪ | 政府給付情報 |

### その他の属性

| 用語 | レベル | 説明 |
|------|--------|------|
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


1. **命名規則**:
  - lowerCamelCase形式を使用
  - 略語は避け、完全な単語を使用
  - 一貫性のある命名パターンを維持

2. **カスタマイズ**:
  - 必要に応じて独自の用語を追加可能
  - 業界固有の用語は適切なプレフィックスを付けることを推奨
  - 組織内で統一した用語の使用を心がける

3. **相互運用性**:
  - Schema.orgとの互換性を意識
  - 標準的な用語を優先的に使用
  - 独自拡張する場合は明確な文書化を行う

### 参考リソース

- [Schema.org](https://schema.org)
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
- [ALPS Specification](http://alps.io/spec/)

***

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

***

# 例

## 状態遷移図

* [オンライン書店](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) - 書籍カタログと購入フロー。タグによる分類、docやdefの活用例
* [Amazonショッピング](https://alps-asd.github.io/app-state-diagram/demo/amazon/alps.html) - 商品検索からレビュー、ウィッシュリスト、定期購入まで。大規模プロファイルの構成例
* [学習管理システム](https://alps-asd.github.io/app-state-diagram/demo/lms/alps.html) - コース管理、課題提出、成績評価。ネストされたdescriptorとhrefによる再利用の例

## HTMLモック

ALPSプロファイルから生成された[セマンティックワイヤーフレーム](semantic-wireframe.html)のデモです。

* [オンライン書店モック](https://www.app-state-diagram.com/alps/mock/level2/) — 同一のセマンティックHTML上の3段階CSSフィデリティ:
  * [Level 1 - Bare](https://www.app-state-diagram.com/alps/mock/level1/) — 最小限の可読性、レイアウトなし
  * [Level 2 - Wireframe](https://www.app-state-diagram.com/alps/mock/level2/) — 情報スケルトン。要素にホバーするとALPSのセマンティックディスクリプタIDが表示されます
  * [Level 3 - Production](https://www.app-state-diagram.com/alps/mock/level3/) — タイポグラフィ、カラー、レスポンシブレイアウトを含むフルデザインシステムのデモ

***

# セマンティックワイヤーフレーム

<figure style="max-width: 45%; margin-bottom: 1em;">
<img src="/images/semantic-wireframe.png" alt="セマンティックワイヤーフレーム" style="width: 100%;">
<figcaption style="font-size: 0.85em; color: #666; margin-top: 0.5em;">レイアウトやUI部品ではなく、意味構造 — どんな情報があり、どう遷移するか — を可視化するワイヤーフレーム。ホバーするとALPSディスクリプタIDが表示される</figcaption>
</figure>

## なぜセマンティックワイヤーフレームか

ALPSによる設計では、同じ情報構造を複数の形式で可視化できます。

- **ALPSプロファイル**（JSON/XML）はアプリケーションの意味構造を正確に定義しますが、開発者向けです
- **ASD**（状態遷移図）はアプリケーション全体の状態遷移をグラフとして可視化します
- **セマンティックワイヤーフレーム**は同じ情報構造を、従来のワイヤーフレームの延長で — HTMLページとして可視化します

ビジュアルデザインに投資する前に、ステークホルダーと情報アーキテクチャについて合意を取ることができます。

## 仕組み

同一のHTMLに対してCSSだけを差し替える — [CSS Zen Garden](http://www.csszengarden.com/)（2003）と同じ考え方です。違いは目的にあります。CSS Zen Gardenは「意味とデザインの分離」というCSS技術のデモンストレーションでしたが、セマンティックワイヤーフレームはその分離を活かして、**ビジュアルデザイン前にステークホルダーと情報アーキテクチャの合意を取る**ための設計ツールです。

HTMLのCSS classにはALPSのセマンティックディスクリプタIDだけを使用し、プレゼンテーション用のclassは含みません。

```html
<article class="Book">
  <h2 class="bookTitle">The Art of Web Design</h2>
  <span class="price">$29.99</span>
  <a href="cart.html" class="doAddToCart">Add to Cart</a>
</article>
```

`container`や`btn-primary`のようなプレゼンテーション用classはありません。HTMLには意味構造だけが残ります。このセマンティックなclassに対してCSSを適用し、CSSだけを差し替えることで3段階のフィデリティを実現します。

- **Level 1** — 最小限の可読性、レイアウトなし
- **Level 2** — 情報スケルトン（ワイヤーフレーム）
- **Level 3** — タイポグラフィ、カラー、レスポンシブレイアウトを含むフルデザイン

AIスキル（[alps-to-mock](ai-assistant.html#skill-claude-code)）やMCPツール（[alps2mock](ai-assistant.html#利用可能なツール)）で自動生成できます。

## 視覚記法

[Level 2ワイヤーフレーム](example.html#htmlモック)は以下の視覚記法を使います。

### ホバーラベル

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <span title=".Book" style="border: 1px solid #ccc; padding: 4px 12px; background: #f9f9f9; font-size: 14px; cursor: default; position: relative;">Book<span style="position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 2px 8px; border-radius: 3px; font-size: 12px; white-space: nowrap;">.Book</span></span>
  <span style="align-self: center; color: #666; font-size: 14px;">要素にホバーするとALPSのセマンティックディスクリプタIDがツールチップで表示されます</span>
</div>

### 破線の枠

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <div style="border: 1px dashed #999; padding: 8px 16px; font-size: 14px; color: #333;">section</div>
  <span style="align-self: center; color: #666; font-size: 14px;"><code>section</code>、<code>article</code>、<code>aside</code>は破線で囲まれ、ブロック構造が見えるようになります</span>
</div>

### 下線リンク

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <span style="text-decoration: underline; color: #00A86B; font-size: 14px;">Book Details</span>
  <span style="align-self: center; color: #666; font-size: 14px;">safe遷移（<code>go*</code>） — 副作用のない読み取り専用ナビゲーション</span>
</div>

### 遷移タイプと左ボーダー色

ボタンの左ボーダーの色で遷移タイプを区別します。状態遷移図のエッジカラーと同じ色を使います。

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #00A86B; padding: 6px 16px; background: white; font-size: 14px;" disabled>Search</button>
  <span style="align-self: center; color: #666; font-size: 14px;">safe — 読み取り専用、副作用なし</span>
</div>
<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #FF4136; padding: 6px 16px; background: white; font-size: 14px;" disabled>Add to Cart</button>
  <span style="align-self: center; color: #666; font-size: 14px;">unsafe — 状態変更、非冪等</span>
</div>
<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #D4A000; padding: 6px 16px; background: white; font-size: 14px;" disabled>Update Quantity</button>
  <span style="align-self: center; color: #666; font-size: 14px;">idempotent — 状態変更、冪等</span>
</div>

### ×ボックス画像

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <svg width="60" height="40" style="border: 1px solid #ccc; background: #f0f0f0;"><line x1="0" y1="0" x2="60" y2="40" stroke="#999" stroke-width="1"/><line x1="60" y1="0" x2="0" y2="40" stroke="#999" stroke-width="1"/></svg>
  <span style="align-self: center; color: #666; font-size: 14px;">画像プレースホルダー — 「ここに画像」を示すワイヤーフレームの標準記法</span>
</div>

## デモ

同じオンライン書店の情報構造を3つの形式で確認できます:

- [ALPS](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.xml) — プロファイル
- [ASD](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) — 状態遷移図
- [ワイヤーフレーム](https://www.app-state-diagram.com/alps/mock/level2/) — セマンティックワイヤーフレーム

ワイヤーフレームからCSSを差し替えるだけで、スケルトン表示やプロダクションに近いデザインに切り替えられます。[3段階のフィデリティを比較](example.html#htmlモック)できます。

## AIとの親和性

セマンティックワイヤーフレームのHTMLは意味構造が自己記述されているため、AIは純粋な形で情報構造を取得できます。通常のHTMLでは`flex`, `md:grid-cols-3`, `shadow-lg`といったレイアウト・装飾のノイズに埋もれた意味を推測する必要がありますが、セマンティックHTMLではその推測が不要です。より少ないトークンで、より正確に理解できます。

***

# リソース

* [ALPS 公式](http://alps.io/)
* [RFC](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07)
* スケルトン
  * [json](https://github.com/alps-asd/alps-skeleton-json)
  * [xml](https://github.com/alps-asd/alps-skeleton-xml)
* [GitHub Action](https://github.com/marketplace/actions/app-state-diagram)
* [app-state-diagram](https://github.com/alps-asd/app-state-diagram)

***

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

***

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

***

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
