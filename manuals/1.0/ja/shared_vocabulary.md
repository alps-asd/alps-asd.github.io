---
layout: docs-ja
title: 共有ボキャブラリ
category: Manual
permalink: /manuals/1.0/ja/shared_vocabulary.html
---

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
