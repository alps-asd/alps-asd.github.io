---
layout: docs-en
title: Shared Vocabulary
category: Manual
permalink: /manuals/1.0/en/shared_vocabulary.html
---

# Shared Vocabulary

When designing applications, it is recommended to use standardized terms registered in shared vocabulary sites.

## IANA Link Relations

Link relations are standardized identifiers that indicate the relationship between two resources. The main purpose is to clarify the semantic relationship between resources.

Example) `author` registered in IANA
```xml
<descriptor id="goBookAuthor" type="safe" rt="#BookAuthor" rel="author">
```

Please refer to [IANA Link Relations](iana_rels.html).

## Schema.org

Schema.org is a vocabulary for structured data jointly developed by Google, Microsoft, Yahoo, and Yandex.

Please refer to [Semantic Terms](semantic-terms.html).

ALPS files that import semantics from [Schema.org](https://schema.org) are available.

* [Schema.org ALPS Index](https://alps-io.github.io/imports/schema.org)

Link to semantics using `href`.

Example) `givenName` and `familyName`

```xml
<descriptor id="Person">
    <descriptor href="https://alps-io.github.io/imports/schema.org/properties/givenName.json" />
    <descriptor href="https://alps-io.github.io/imports/schema.org/properties/familyName.json" />
</descriptor>
```

## Narrowing Down

You can create descriptors that narrow down semantics from shared vocabulary.

Example)
```xml
<descriptor id="bankAccountId" href="https://alps-io.github.io/imports/schema.org/properties/accountId.json" />
```
