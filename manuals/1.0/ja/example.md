---
layout: docs-ja
title: 例
category: Manual
permalink: /manuals/1.0/ja/example.html
---

# 例

## 状態遷移図

* [オンライン書店](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) - 書籍カタログと購入フロー。タグによる分類、docやdefの活用例
* [Amazonショッピング](https://alps-asd.github.io/app-state-diagram/demo/amazon/alps.html) - 商品検索からレビュー、ウィッシュリスト、定期購入まで。大規模プロファイルの構成例
* [学習管理システム](https://alps-asd.github.io/app-state-diagram/demo/lms/alps.html) - コース管理、課題提出、成績評価。ネストされたdescriptorとhrefによる再利用の例

## HTMLモック

ALPSプロファイルから生成されたHTMLモック。ALPSの情報構造がそのままセマンティックHTMLとして現れます — すべてのCSSクラスはALPSディスクリプタIDであり、プレゼンテーションクラスは含まれません。このセマンティックな骨格に対してCSSが段階的に肉付けし、最小限の可読性からフルビジュアルデザインまで表現します。HTMLは3レベルすべて同一で、CSSだけが異なります。

* [オンライン書店モック](https://www.app-state-diagram.com/alps/mock/level2/) — 同一のセマンティックHTML上の3段階CSSフィデリティ:
  * [Level 1 - Bare](https://www.app-state-diagram.com/alps/mock/level1/) — 最小限の可読性、レイアウトなし
  * [Level 2 - Wireframe](https://www.app-state-diagram.com/alps/mock/level2/) — 情報スケルトン。要素にホバーするとALPSディスクリプタIDが表示されます
  * [Level 3 - Production](https://www.app-state-diagram.com/alps/mock/level3/) — タイポグラフィ、カラー、レスポンシブレイアウトを含むフルデザインシステムのデモ

Level 2から始めて、ビジュアルデザインに投資する前にステークホルダーと情報アーキテクチャをレビューしましょう。
