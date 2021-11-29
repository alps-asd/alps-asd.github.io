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
<descriptor id="goBookAuthor" rt="BookAuthor" rel="author">
```
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
