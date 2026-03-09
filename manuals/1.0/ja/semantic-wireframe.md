---
layout: docs-ja
title: セマンティックワイヤーフレーム
category: Manual
permalink: /manuals/1.0/ja/semantic-wireframe.html
image: /images/semantic-wireframe.png
---

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
