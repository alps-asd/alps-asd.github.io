---
layout: docs-ja
title: 共有ボキャブラリ
category: Manual
permalink: /manuals/1.0/ja/shared_vocabulary.html
---

# 共有ボキャブラリ

共有ボキャブラリ(共通語彙)サイトに登録されたセマンティックを利用し語句を標準化します。

## IANA

IANAの[Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml) はリンクをすることなしに使うことができます。`rel`に使います。

例) IANAに登録されている`author`
```xml
<descriptor id="goBookAuthor" type="safe" rt="#BookAuthor" rel="author">
```

### よく知られた IANA REL

* **[about](https://www.iana.org/go/rfc6903)**
* [alternate](https://html.spec.whatwg.org/multipage/links.html#link-type-alternate)
* [appendix](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [archives](http://www.w3.org/TR/2011/WD-html5-20110113/links.html#rel-archives)
* [author](https://html.spec.whatwg.org/multipage/links.html#link-type-author)
* [chapter](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* **[collection](https://www.iana.org/go/rfc6573)**
* [contents](https://www.w3.org/TR/html401/types.html#type-links) 目次 (HTML)
* [copyright](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* **[create-form](https://www.iana.org/go/rfc6861)** 作成フォームページ
* [current](https://www.iana.org/go/rfc5005)
* [describedby](http://www.w3.org/TR/powder-dr/#assoc-linking) 説明される
* [describes](https://www.iana.org/go/rfc6892) 説明する
* **[edit](https://www.iana.org/go/rfc5023)** 編集
* **[edit-form](https://www.iana.org/go/rfc6861)** 編集フォームページ
* [external](https://html.spec.whatwg.org/multipage/links.html#link-type-external) 外部サイト
* [first](https://www.iana.org/go/rfc8288)
* [glossary](https://www.w3.org/TR/html401/types.html#type-links) ターミノロジー (HTML)
* [help](https://html.spec.whatwg.org/multipage/links.html#link-type-help)
* [index](https://www.w3.org/TR/html401/types.html#type-links) 索引 (HTML)
* **[item](https://www.iana.org/go/rfc6573)**
* [last](https://www.iana.org/go/rfc8288)
* [license](https://www.iana.org/go/rfc4946)
* **[next](https://html.spec.whatwg.org/multipage/links.html#link-type-next)**　ページネーション
* [original](https://www.iana.org/go/rfc7089)
* [payment](https://www.iana.org/go/rfc8288)
* **[prev](https://html.spec.whatwg.org/multipage/links.html#link-type-prev)** ページネーション
* [preview](https://www.iana.org/go/rfc6903)
* [privacy-policy](https://www.iana.org/go/rfc6903)
* [profile](https://www.iana.org/go/rfc6906) RFC6906 プロファイル
* [related](https://www.iana.org/go/rfc4287)
* [search](http://www.opensearch.org/Specifications/OpenSearch/1.1)
* [section](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [subsection](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [start](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [tag](https://html.spec.whatwg.org/multipage/links.html#link-type-tag)
* [up](https://www.iana.org/go/rfc8288) 階層構造上位
* [version-history](https://www.iana.org/go/rfc5829)

## Schema.org

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
