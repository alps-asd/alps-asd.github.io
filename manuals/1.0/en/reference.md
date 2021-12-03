---
layout: docs-en
title: リファレンス
category: Manual
permalink: /manuals/1.0/en/reference.html
---
# ALPS Reference

## ALPS documentation

The set of **semantic descriptors** described below is the ALPS document, written in XML or JSON.

It can be written in XML or JSON. 

```xml
<alps>.
<descriptor ... >
<descriptor ... >
</alps>
```

### ALPS meta-information

You can add meta-information to ALPS documents, such as title, doc, link, and so on.

```xml
<alps>
  <title>ALPS Blog</title>.
  <doc>An ALPS profile example for ASD</doc>.
  <link href="https://github.com/koriym/app-state-diagram/issues" rel="issue"/>
  <descriptor ... >
  <descriptor ... >
</alps>
````



## Semantic descriptors

Semantic descriptors define **special words** used by the application.


```xml
<descriptor id="dateCreated" title="date created"/>
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="View blog post">
    <descriptor href="#id"/>
</descriptor>
````



## element

## descriptor element

descriptor is an element for semantic descriptors (semantic identifiers), describing words that are special to the application, such as API item names or link names.


| element | meaning | example |
| ---- | ---- | ---- |
| [descriptor](#descriptor) | semantic identifier | <descriptor id="dateCreated" /> |

### Elements for description

A doc or link element can be included to describe the descriptor.

| elements | meanings | examples
| ---- | ---- | ---- |
| [doc](#doc) | descriptive text | <doc format="markdown">Date the article was created</doc> |
| [link](#link) | link | <link href="https://example.com/issues" rel="issue"/> |

### <a name="doc">doc</a>

doc to explain the meaning in text

```xml
<descriptor id="dateCreated">
    <doc format="markdown">Date of creation of the article expressed in ISO8601 format</doc>.
</descriptor>
The ``.
The doc can be formatted (text|markdown|html|asciidoc) with format. If not specified, text is used.

### <a name="link">link</a>

A link that links to a description of another resource.

The ``xml
<descriptor id="dateCreated">
    <link rel="author" href="https://github.com/koriym">
</descriptor>
```

The rel is selected from IANA's [Link Relation] rel from IANA's [registered rel](https://www.iana.org/assignments/link-relations/link-relations.xhtml), and the href links to the URL. The URL is linked by href.



## <a name="descriptor">descriptor</a>

A descriptor has attributes such as ID, type, and tag.


| attribute | meaning | example |
| ---- | ---- | ---- |
| [id](#id) | identifier | createdDate |
| [type](#type) | type | semantic\|safe\|unsafe\|idemptent |
| [href](#href) | reference | #id |
| [rt](#rt) | transition destination | #User |
| [rel](#rel) | relationship | edit | [title](#title)
| [title](#title) | title | creation time | [tag](#tag)
| [tag](#tag) | tag | ontology | [title](#title)

## <a name="id">id</a>

ALPS assigns a unique ID to all information and all transitions (links); there are no specification constraints on the ID phrase, but there are best practices for adding `go` for safe transitions and `do` for unsafe transitions.

## <a name="type">type</a>

The descriptor has a type attribute. If unspecified, it is semantic.

| type | semantic
| ---- | ---- | 
| [semantic](#semantic) | meaning
| [safe](#safe) | safe and powerfull transition
| [idempotent](#idempotent) | unsafe and powerfull transitions
| [unsafe](#unsafe) | unsafe and powerless transitions


There is one type for semantics and three types for transitions.

### <a name="semantic">semantic</a>

List the words and phrases used in your application and create a vocabulary.

```xml
<descriptor id="dateCreated" type="semantic"/>
```


### <a name="safe">safe</a>

This is a transition for reading, where the state of the resource does not change.

Example: Get resource state by URL

```xml
<descriptor id="goBlog" type="safe" rt="#Blog" />
```

### <a name="idempotent">idempotent</a>

This is a transition where the state of the resource changes by power.

Example: Creating a resource with a URL, changing or deleting the target resource.

```xml
<descriptor id="doDeleteMenu" type="idempotent" rt="#Menu">
```

### <a name="unsafe">unsafe</a>

This is a transition where the state change of the resource is not powerless.

Example: Creating a resource without a URL or adding a target resource.

```xml
<descriptor id="doAppendRecord" type="unsafe" rt="#Record">
````

There are four types in total.

## Structure

A descriptor can be included to represent the nested structure of information or the information needed for a transition.

Example: A blog post contains body and date information.

```xml
<descriptor id="BlogPosting" title="Blog Posting" >
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
</descriptor>
```.

e.g.) To refer to a blog post, the post ID is required

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting">
    <descriptor href="#id"/>
</descriptor>
```

## <a name="href">href</a>

In order to reuse a single descriptor, you can link to it with a href. There are two types of links: inline links, which link from the same document, and outbound links, which link to a descriptor in another file.


```xml
<! -- inline link -->
<descriptor href="#articleBody">

<! -- outbound links --> <!
<descriptor href="Blog.xml#articleBody">

```

## <a name="rt">rt</a>

Specifies the transition destination ID.

```xml
<descriptor id="goBlog" type="safe" rt="#Blog">
```

## <a name="rel">rel</a>

Specifies a relation for transitions of type `safe`, `idempotent`, or `unsafe`.

```xml
<descriptor id="editBlogPosting" type="idempotent" rel="edit" rt="#Blog">
```
Rel is chosen from IANA's [Link Relation](https://www.iana.org/assignments/link-relations/link-relations.xhtml).

## <a name="title">title</a>

A one-line comment describing the content.

```xml
<descriptor id="editBlogPosting" type="idempotent" rt="#Blog" title="Edit Posting" />
```

## <a name="tag">tag</a>

```xml
<descriptor id="editBlogPosting" type="idempotent" rt="#Blog" tag="choreography" />
```

ASD allows you to specify whether to draw or not, and the color of each tag.
