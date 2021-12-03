---
layout: docs-en
title: Shared vocabularies
category: Manual
permalink: /manuals/1.0/en/shared_vocabulary.html
---
# Shared vocabularies

Standardize words and phrases using semantics registered in the Shared Vocabulary site.

## IANA

IANA's [Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml) can be used without linking. It is used for `rel`.

Example) IANA-registered `author`.

```xml
<descriptor id="goBookAuthor" type="safe" rt="#BookAuthor" rel="author">
```

## Schema.org

ALPS files importing the semantics of [Schema.org](https://schema.org) are available.

* [Schema.org ALPS Index](https://alps-io.github.io/imports/schema.org)

Link to the semantic with `href`.

Example: `givenName` and `familynName`.

```xml
<decriptor id="Person">
    <descriptor href="https://alps-io.github.io/imports/schema.org/properties/givenName.json" />
    <descriptor href="https://alps-io.github.io/imports/schema.org/properties/familyName.json" />
</decriptor>
```

## Narrow down

You can create descriptors with narrower semantics from shared vocabularies.

For example)

```xml
<descriptor id="bankAccountId" href="https://schema.org/accountId" />
````
