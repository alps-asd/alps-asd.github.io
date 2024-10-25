---
layout: docs-en
title: Best practice
category: Manual
permalink: /manuals/1.0/en/best_practice.html
---

# Best Practices

## State

Application state semantic descriptors are represented in UpperCamelCase starting with a capital letter.

```json
"descriptor": [
  {"id": "BlogPosting", "type": "semantic", "def": "https://schema.org/BlogPosting", "descriptor": [
    {"href": "#id"},
    {"href": "#articleBody"},
    {"href": "#dateCreated"},
    {"href": "#blog"}
  ]}
]
```

## Safe State Transitions

Semantic descriptors with type `safe` add the prefix `go` to the destination descriptor.
([RFC8288](https://datatracker.ietf.org/doc/html/rfc8288#section-3.3))

```json
[
  {"id": "goHome", "type": "safe", "rt": "#Home"},
  {"id": "goFirst", "type": "safe", "rt": "#TodoList"},
  {"id": "goPrevious", "type": "safe", "rt": "#TodoList"}
]
```

Semantic descriptors that are not safe should use the prefix `do`.

```json
[
  {"id": "doEditUser", "type": "idempotent", "rt": "#UserList"},
  {"id": "doDeleteUser", "type": "idempotent", "rt": "#UserList"}
]
```

The rt (transition destination) ID is formed by adding the destination descriptor ID to the prefix `go` or `do`.

```json
[
  {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting"},
  {"id": "doEditBlogPosting", "type": "idempotent", "rt": "#Blog"}
]
```

## Elements

Semantic descriptors that are not defined as application states, i.e., elements, are written in lowerCamelCase starting with a lowercase letter.

```json
[
    {"id": "articleBody"},
    {"id": "dateCreated"}
]
```

## ALPS File Structure

The semantic descriptors in ALPS files are divided into three blocks in the following order:

1. Semantic descriptor groups with meaning definitions using `def` and `doc` (ontology)
2. Semantic descriptor groups with inclusion relationships (taxonomy)
3. State transition semantic descriptor groups (choreography)

```json
"descriptor" : [
    {"id" : "name", "type" : "semantic", "def": "http://schema.org/identifier"},
    {"id" : "age", "type" : "semantic", "def": "http://schema.org/title"},

    {"id" : "Person", "type": "semantic", "descriptor":[
      {"href": "#name"},
      {"href": "#age"}
    ]}
    
    {"id": "goPerson", "type": "safe", "rt": "#Person"},
]
```

## Hierarchical Structure Outside ALPS

In ALPS, hierarchical meanings can be expressed by position.

```json
"descriptor": [
    {"id": "name", "def": "https://schema.org/name"},
    {"id": "Product", "descriptor":[
      {"href": "#name"}
    ]}
    {"id": "Person", "descriptor":[
      {"href": "#name"}
    ]}
]
```

* In the example above, `name` is shared between `Product/name` and `Person/name`.
* When expressing such terms in formats with only flat hierarchies, it's basic practice to follow the conventions of each format.
* In HTML, they are expressed in lower camel case.

```html
<form>
    <input name="productName" type="text">
    <input name="personName" type="text">
</form>
```

## Adding Schema References

When creating ALPS profiles, it is recommended to add schema references.

```json
{
  "$schema": "https://alps-io.github.io/schemas/alps.json",
  "alps" : {
  }
}
```

```xml
<alps 
  version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>  
```

## Implementation Examples

### Semantic Elements

Basic element definitions:

```xml
<descriptor id="title" title="Title" doc="Article title. Maximum 100 characters."/>
<descriptor id="content" title="Content" doc="Article body. Supports Markdown format."/>
<descriptor id="publishedAt" title="Publication Date" doc="Article publication date and time. ISO 8601 format."/>
```

```json
{
    "descriptor": [
        {"id": "title", "title": "Title", "doc": {"value": "Article title. Maximum 100 characters."}},
        {"id": "content", "title": "Content", "doc": {"value": "Article body. Supports Markdown format."}},
        {"id": "publishedAt", "title": "Publication Date", "doc": {"value": "Article publication date and time. ISO 8601 format."}}
    ]
}
```

Reusing basic elements:

```xml
<descriptor id="blogPost">
    <doc>User-created article. After publication, visible to all users.</doc>
    <descriptor href="#title"/>
    <descriptor href="#content"/>
    <descriptor href="#publishedAt"/>
</descriptor>

<descriptor id="pagePost">
    <doc>Static page. Permanent content such as site basic information.</doc>
    <descriptor href="#title"/>
    <descriptor href="#content"/>
</descriptor>
```

```json
{
    "descriptor": [
        {"id": "blogPost", "doc": {"value": "User-created article. After publication, visible to all users."}, "descriptor": [
            {"href": "#title"},
            {"href": "#content"},
            {"href": "#publishedAt"}         
        ]},
        {"id": "pagePost", "doc": {"value": "Static page. Permanent content such as site basic information."}, "descriptor": [
            {"href": "#title"},
            {"href": "#content"}
        ]}
    ]
}
```

### Operation Definitions

```xml
<descriptor id="goBlog" type="safe" rt="#Blog" doc="Display blog homepage. Shows latest 10 articles."/>

<descriptor id="doCreateBlogPost" type="unsafe" rt="#BlogPost">
    <doc>Create new article. Saved in draft state.</doc>
    <descriptor href="#title"/>
    <descriptor href="#content"/>
</descriptor>

<descriptor id="doPublishBlogPost" type="idempotent" rt="#BlogPost">
    <doc>Publish article. Current time is set to publishedAt.</doc>
    <descriptor href="#id"/>
</descriptor>
```

```json
{
    "descriptor": [
        {"id": "goBlog", "type": "safe", "rt": "#Blog", "doc": {"value": "Display blog homepage. Shows latest 10 articles."}},
        {"id": "doCreateBlogPost", "type": "unsafe", "rt": "#BlogPost", "doc": {"value": "Create new article. Saved in draft state."}, "descriptor": [
            {"href": "#title"},
            {"href": "#content"}
        ]},
        {"id": "doPublishBlogPost", "type": "idempotent", "rt": "#BlogPost", "doc": {"value": "Publish article. Current time is set to publishedAt."}, "descriptor": [
            {"href": "#id"}
        ]}
    ]
}
```
