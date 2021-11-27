---
layout: docs-ja
title: イントロダクション
category: Manual
permalink: /manuals/1.0/ja/
---
# イントロダクション

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## ALPSとは

Application-Level Profile Semantics (ALPS)は、アプリケーションレベルのセマンティクス（語句の意味や構造）を表現するフォーマットです。JSON、HTMLなど汎用メディアにアプリケーション固有のセマンティックスを加え、情報の説明や操作の理解に役立てます。

## ASDとは

ASD(Application State Diagram)とはALPSドキュメントから生成されるアプリケーション状態遷移図、およびその遷移図を含む[ドキュメンテーション生成ツール](https://github.com/koriym/app-state-diagram)の名前です。RESTアプリケーションを純粋な情報設計の視点で俯瞰する事ができ、状態の詳細ドキュメントが遷移図からリンクされます。


## 用途

RESTアプリケーション(APIやWebサイト）からUI/UXを排した純粋な情報設計の視点で設計を書式化する事ができます。整理された情報でサイト設計を行う事や、開発やメンテナンスの時に情報定義の[SSOT](https://ja.wikipedia.org/wiki/%E4%BF%A1%E9%A0%BC%E3%81%A7%E3%81%8D%E3%82%8B%E5%94%AF%E4%B8%80%E3%81%AE%E6%83%85%E5%A0%B1%E6%BA%90)として用いる事ができます。

ALPSドキュメントは相互にリンク可能なハイパーメディアです。複数の部分設計をリンクする事で全体の設計を構成する等、設計の再利用が可能です。

## FAQ

<strong>Q. どのような人が利用できますか</strong>

A. サイト制作に関わる全ての人（エンジニア、デザイナー、PO）が利用することができます。

<strong>Q. どのような人がALPSを記述できますか</strong>

A. XMLやJSONを理解でき、簡単なHTMLのコーディングができる人ならALPSを記述することができます。

<strong>Q. どのように使いますか</strong>

A. 情報を最小限必要な要素に整理してサイト設計を行い、WebやAPIサービスの設計に使います。設計はJSONやXMLなどのフォーマットとして表し、遷移図やボキャブラリリストなどのドキュメントを生成することができます。また各制作者はその情報設計に基づいて情報の正確な言葉や意味、構造を知ることができます。

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

A. ユーザー体験の質の向上のために情報中心でサイトを設計したい、制作メンバー間の認識を統一するためのリファレンス（SSOT)が欲しい、設計を俯瞰し再利用したい、情報設計を規格化されたドキュメントとして残したい、などの動機があれば役に立つでしょう。
