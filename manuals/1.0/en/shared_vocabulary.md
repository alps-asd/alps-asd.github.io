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

### Well-known IANA REL

* **[about](https://www.iana.org/go/rfc6903)**
* [alternate](https://html.spec.whatwg.org/multipage/links.html#link-type-alternate)
* [appendix](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [archives](http://www.w3.org/TR/2011/WD-html5-20110113/links.html#rel-archives)
* [author](https://html.spec.whatwg.org/multipage/links.html#link-type-author)
* [chapter](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* **[collection](https://www.iana.org/go/rfc6573)**
* [contents](https://www.w3.org/TR/html401/types.html#type-links)  (HTML)
* [copyright](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* **[create-form](https://www.iana.org/go/rfc6861)** create form page
* [current](https://www.iana.org/go/rfc5005)
* [describedby](http://www.w3.org/TR/powder-dr/#assoc-linking)
* [describes](https://www.iana.org/go/rfc6892) 
* **[edit](https://www.iana.org/go/rfc5023)** 
* **[edit-form](https://www.iana.org/go/rfc6861)** edit form page
* [external](https://html.spec.whatwg.org/multipage/links.html#link-type-external) external site
* [first](https://www.iana.org/go/rfc8288)
* [glossary](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [help](https://html.spec.whatwg.org/multipage/links.html#link-type-help)
* [index](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* **[item](https://www.iana.org/go/rfc6573)**
* [last](https://www.iana.org/go/rfc8288)
* [license](https://www.iana.org/go/rfc4946)
* **[next](https://html.spec.whatwg.org/multipage/links.html#link-type-next)**　Pagination
* [original](https://www.iana.org/go/rfc7089)
* [payment](https://www.iana.org/go/rfc8288)
* **[prev](https://html.spec.whatwg.org/multipage/links.html#link-type-prev)** Pagination
* [preview](https://www.iana.org/go/rfc6903)
* [privacy-policy](https://www.iana.org/go/rfc6903)
* [profile](https://www.iana.org/go/rfc6906) RFC6906 profile
* [related](https://www.iana.org/go/rfc4287)
* [search](http://www.opensearch.org/Specifications/OpenSearch/1.1)
* [section](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [subsection](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [start](https://www.w3.org/TR/html401/types.html#type-links) (HTML)
* [tag](https://html.spec.whatwg.org/multipage/links.html#link-type-tag)
* [up](https://www.iana.org/go/rfc8288) higher hierarchical structure
* [version-history](https://www.iana.org/go/rfc5829)


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
