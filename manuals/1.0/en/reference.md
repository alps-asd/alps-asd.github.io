---
layout: docs-en
title: Reference
category: Manual
permalink: /manuals/1.0/en/reference.html
---
# Reference

## Overview

Application-Level Profile Semantics (ALPS) is a document format for describing application semantics. This document explains the elements and attributes of ALPS.

## Document Structure

ALPS documents have the following hierarchical structure:

1. **Root Element (`alps`)**
- The document's root element containing version information
- All definitions are contained within this element

2. **Descriptor Element (`descriptor`)**
- The central element that defines the meaning of application functions and information
- There are four types:
  - semantic: Represents terms and information (default)
  - safe: Read operations (does not change resource state)
  - idempotent: Operations that produce the same result when executed multiple times (complete replacement with PUT, deletion with DELETE, etc.)
  - unsafe: Operations that produce different results when executed multiple times (creation with POST, numerical addition operations, etc.)

3. **Supplementary Elements**
- `doc`: Detailed explanations and supplementary information
- `link`: References to related documents
- `title`: Profile description

## Description Formats

ALPS documents can be written in two formats:

**XML Format**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps version="1.0">
    <title>Blog API Profile</title>
    <doc>API Profile for Blog System</doc>
    
    <descriptor id="title" title="Title" doc="Article title. Maximum 100 characters."/>
    
    <descriptor id="blogPost">
        <doc>Blog post</doc>
        <descriptor href="#title"/>
    </descriptor>
</alps>
```

**JSON Format**

```json
{
    "alps": {
        "version": "1.0",
        "title": "Blog API Profile",
        "doc": {"value": "API Profile for Blog System"},
        "descriptor": [
            {"id": "title", "title": "Title", "doc": {"value": "Article title. Maximum 100 characters."}},
            {"id": "blogPost", "doc": {"value": "Blog post"}, "descriptor": [
                {"href": "#title"}
            ]}
        ]
    }
}
```

## Elements and Attributes in Detail

### alps

The root element of an ALPS document.

Attributes:
- version: Document version (required)

### descriptor

Defines the meaning (semantics) of application functions and information.
Either id or href is required; other attributes are optional.

### List of descriptor Attributes

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| id | *1 | string | Unique identifier | `"blogPost"` |
| href | *1 | string | Reference to other elements | `"#title"` |
| type | optional | enum | Element type | `"safe"` |
| rt | optional | string | Transition destination resource | `"#BlogPost"` |
| rel | optional | string | Relation | `"item"` |
| title | optional | string | Display name | `"Blog Post"` |
| tag | optional | string | Classification tag | `"blog post"` |
| doc | optional | object/string | Detailed explanation | `"Detailed description"` |

*1: Either id or href is required

Details of each attribute:

* **id**: Unique identifier (mutually exclusive with href)
  - String that uniquely identifies the descriptor
  - Cannot be duplicated within the same document
  - Can only use URL-safe characters (compliant with [RFC1738](https://www.rfc-editor.org/rfc/rfc1738))

* **href**: Reference (mutually exclusive with id)
  - Identifier to reference other descriptors
  - Fragment identifier starting with "#" (e.g., #user)
  - Include path for external files (e.g., profile.xml#user)
  - Must have a resolvable URL and fragment identifier (#)

* **type**: Descriptor type
  - semantic: Represents terms and information (default)
  - safe: Read operations (does not change resource state)
  - idempotent: Operations that produce the same result when executed multiple times (complete replacement with PUT, deletion with DELETE, etc.)
  - unsafe: Operations that produce different results when executed multiple times (creation with POST, numerical addition operations, etc.)

* **rt**: Return Type
  - Destination resource after state transition
  - Specified with fragment identifier starting with "#"
  - Used when type attribute is `safe`/`idempotent`/`unsafe`

* **rel**: Relation
  - Indicates relationship of descriptor
  - Uses [Link Relations defined by IANA](iana_rels.html) (item, collection, self, next, prev, etc.)
  - Specify with URI for custom relations

* **title**: Display name
  - Display name for human reading
  - Used for UI and documentation display

* **tag**: Classification tag
  - Used for grouping descriptors
  - Space-separated for multiple specifications
  - Used for category classification and filtering

* **doc**: Detailed explanation
  - Detailed explanation of descriptor
  - Can also be defined as child element
  - Format can be specified

### doc

Provides detailed explanation of elements.

#### List of doc Attributes

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| href | optional | string | External document URL | `"http://example.com/doc"` |
| format | optional | string | Document format | `"markdown"` |
| contentType | optional | string | Content type | `"text/html"` |
| tag | optional | string | Classification tag | `"api spec"` |
| value | optional | string | Explanation text | `"Detailed description"` |

Support levels for format attribute:

- text: Must support (MUST)
- html: Should support (SHOULD)
- asciidoc: May support (MAY)
- markdown: May support (MAY), compliant with [RFC7763]

Priority of contentType and format:

- Use contentType if it exists
- Ignore format if both contentType and format exist
- Treat as text/plain if neither exists

### link

Defines references to related documents.

Attributes:
- href: Link destination URL (required)
- rel: Relation (required)
  - self: Link to self
  - profile: Profile document
  - help: Help document
  - related: Related document
  - Other [IANA link relations](iana_rels.html)

## Validation

1. Descriptors must have either id or href
2. href reference destination must be a resolvable URL and must have a fragment identifier
3. rt transition destination must exist within the document
4. type attribute must be one of the four defined values (semantic, safe, idempotent, unsafe)
5. The following prefixes are recommended for operation descriptors:
- safe: `go` (e.g., `goBlog`)
- unsafe: `do` (e.g., `doCreateBlog`)
- idempotent: `do` (e.g., `doUpdateBlog`)
