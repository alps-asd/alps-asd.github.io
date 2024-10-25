---
layout: docs-ja
title: FAQ
category: Manual
permalink: /manuals/1.0/ja/faq.html
---
#  FAQ

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

A. ユーザー体験の質の向上のために情報中心でサイトを設計したい、制作メンバー間の認識を統一するための**信頼できる唯一の情報源**（SSOT)が欲しい、設計を俯瞰し再利用したい、情報設計を規格化されたドキュメントとして残したい、などの動機があれば役に立つでしょう。
