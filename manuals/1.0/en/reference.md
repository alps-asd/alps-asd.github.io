---
layout: docs-en
title: Reference
category: Manual
permalink: /manuals/1.0/en/reference.html
---

# ALPS Reference

## Overview

Application-Level Profile Semantics (ALPS) is a document format for describing application semantics. This document explains the elements and attributes of ALPS.

## Document Structure

ALPS documents have the following hierarchical structure:

1. **Root Element (`alps`)**
- The root element of the document containing version information
- All definitions are contained within this element

2. **Descriptor Element (`descriptor`)**
- The central element that defines the meaning of application features and information
- There are four types:
  - semantic: Represents information or terminology (default)
  - safe: Read operations (does not change resource state)
  - idempotent: Operations that produce the same result when executed multiple times (e.g., complete replacement with PUT or removal with DELETE)
  - unsafe: Operations that produce different results when executed multiple times (e.g., creation with POST, numeric addition, etc.)
- Can contain other descriptor elements as child elements
- Can contain link elements as child elements

3. **Supplementary Elements**
- `doc`: Detailed explanations or supplementary information
- `link`: References to related documents
- `title`: Description of the profile

## Representation Formats

ALPS documents can be written in the following two formats:

**XML Format**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps version="1.0">
    <title>Blog API Profile</title>
    <doc>API profile for a blog system</doc>
    
    <descriptor id="title" title="Title" doc="Article title. Maximum 100 characters."/>
    
    <descriptor id="blogPost">
        <doc>Blog post</doc>
        <descriptor href="#title"/>
        <link rel="related" href="http://example.org/related-docs/blog.html" />
    </descriptor>
</alps>
```

**JSON Format**

```json
{
    "alps": {
        "version": "1.0",
        "title": "Blog API Profile",
        "doc": {"value": "API profile for a blog system"},
        "descriptor": [
            {"id": "title", "title": "Title", "doc": {"value": "Article title. Maximum 100 characters."}},
            {"id": "blogPost", "doc": {"value": "Blog post"}, 
             "descriptor": [
                {"href": "#title"}
             ],
             "link": [
                {"rel": "related", "href": "http://example.org/related-docs/blog.html"}
             ]
            }
        ]
    }
}
```

## Elements and Attributes in Detail

### alps

The root element of an ALPS document.

Attributes:
- version: The document version (required)

### descriptor

Defines the semantics (meaning) of application features or information.
Either id or href is required, and other attributes are optional.

A descriptor can have the following child elements:
- descriptor: Other descriptor elements can be nested to represent hierarchical structures
- doc: Detailed description
- link: Links to related resources
- ext: Extension information

### descriptor attributes list

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| id | *1 | string | Unique identifier for the element | `"blogPost"` |
| href | *1 | string | Reference to other elements | `"#title"` |
| type | optional | enum | Element type | `"safe"` |
| rt | optional | string | Target resource for transitions | `"#BlogPost"` |
| rel | optional | string | Relation | `"item"` |
| title | optional | string | Display name | `"Blog Post"` |
| tag | optional | string | Classification tags | `"blog post"` |
| name | optional | string | Display name | `"blog"` |
| def | optional | string | Definition source URI | `"http://schema.org/BlogPosting"` |
| descriptor | optional | element | Child descriptor nesting | `<descriptor id="child">...</descriptor>` |
| link | optional | element | Link to related resources | `<link rel="help" href="..."/>` |

*1: Either id or href is required

Details for each attribute:

* **id**: Unique identifier (mutually exclusive with href)
  - String that uniquely identifies the descriptor
  - Cannot be duplicated within the same document
  - Must use URL-safe characters (compliant with [RFC1738](https://www.rfc-editor.org/rfc/rfc1738))

* **href**: Reference target (mutually exclusive with id)
  - Identifier for referencing other descriptors
  - Fragment identifier starting with "#" (e.g., #user)
  - If in an external file, includes the path (e.g., profile.xml#user)
  - Must be a resolvable URL with a fragment identifier (#)

* **type**: Descriptor type
  - semantic: Represents information or terminology (default)
  - safe: Read operations (does not change resource state)
  - idempotent: Operations that produce the same result when executed multiple times (e.g., complete replacement with PUT or removal with DELETE)
  - unsafe: Operations that produce different results when executed multiple times (e.g., creation with POST, numeric addition, etc.)

* **rt**: Return Type (target for transitions)
  - Target resource after state transition
  - Specified by a fragment identifier starting with "#"
  - Used when type attribute is `safe`/`idempotent`/`unsafe`

* **rel**: Relation
  - Indicates the relationship of the descriptor
  - Uses [Link Relations defined by IANA](iana_rels.html) (item, collection, self, next, prev, etc.)
  - Custom relations are specified by URI

* **title**: Display name
  - Human-readable display name
  - For UI and documentation display

* **tag**: Classification tags
  - Used for grouping descriptors
  - Multiple values are separated by spaces
  - For category classification and filtering

* **name**: Display name
  - Name used in actual representations
  - Used to specify a common name when id needs to be unique
  - Multiple descriptors can have the same name

* **def**: Definition source URI
  - URI indicating an external resource that defines the descriptor
  - Used for referencing standard definitions such as Schema.org

### doc

Provides detailed descriptions of elements.

#### doc attributes list

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| href | optional | string | External document URL | `"http://example.com/doc"` |
| format | optional | string | Document format | `"markdown"` |
| contentType | optional | string | Content type | `"text/html"` |
| tag | optional | string | Classification tags | `"api spec"` |
| value | optional | string | Description text | `"Detailed description"` |

Format attribute support levels:

- text: Required support (MUST)
- html: Recommended support (SHOULD)
- asciidoc: Optional support (MAY)
- markdown: Optional support (MAY), compliant with [RFC7763]

Priority of contentType and format:

- If contentType exists, it is used
- If both contentType and format exist, format is ignored
- If neither exists, text/plain is assumed

### link

Defines references to related documents. Link can be used as a child element of alps or descriptor elements.

#### link attributes list

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| href | required | string | Target URL | `"http://example.com/docs"` |
| rel | required | string | Relation | `"help"` |
| title | optional | string | Display name | `"Help Document"` |
| tag | optional | string | Classification tags | `"documentation"` |

Relation values:
- self: Link to itself
- profile: Profile document
- help: Help document
- related: Related document
- Other [IANA link relations](iana_rels.html)

### ext

Provides extension information. Used for including additional information not covered by the standard specification.

#### ext attributes list

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| id | required | string | Unique identifier for the extension | `"range"` |
| href | recommended | string | URL explaining the extension | `"http://alps.io/ext/range"` |
| value | optional | string | Extension value | `"0,100"` |
| tag | optional | string | Classification tags | `"validation"` |

## Validation

1. A descriptor requires either id or href
2. href reference targets must be resolvable URLs and must include a fragment identifier
3. rt transition targets must exist in the document
4. The type attribute must be one of the four defined values (semantic, safe, idempotent, unsafe)
5. The following prefixes are recommended for operation descriptors:
- safe: `go` (e.g., `goBlog`)
- unsafe: `do` (e.g., `doCreateBlog`)
- idempotent: `do` (e.g., `doUpdateBlog`)

## Hierarchical Structure Example

Below is a concise example of hierarchical structure using nested descriptor elements:

**XML Format**

```xml
<alps version="1.0">
  <descriptor id="user" type="semantic">
    <doc>User information</doc>
    <descriptor id="name" type="semantic" />
    <descriptor id="email" type="semantic" />
    <link rel="help" href="http://example.org/help/user.html" />
  </descriptor>
</alps>
```

**JSON Format**

```json
{
  "alps": {
    "version": "1.0",
    "descriptor": [
      {
        "id": "user",
        "type": "semantic",
        "doc": {"value": "User information"},
        "descriptor": [
          {"id": "name", "type": "semantic"},
          {"id": "email", "type": "semantic"}
        ],
        "link": [
          {"rel": "help", "href": "http://example.org/help/user.html"}
        ]
      }
    ]
  }
}
```
