---
layout: docs-en
title: ALPS Reference
category: Manual
permalink: /manuals/1.0/en/reference.html
---

# ALPS Reference

## Overview

Application-Level Profile Semantics (ALPS) is a document format for describing application semantics. This document explains the elements and attributes of ALPS.

## Document Structure

ALPS documents have the following hierarchical structure:

1. **Root Element (`alps`)**
- The document's root element containing version information
- All definitions are contained within this element

2. **Descriptor Element (`descriptor`)**
- The core element that defines the meaning of application functions and information
- There are four types:
   - semantic: Represents terms and information (default)
   - safe: Read operations (does not change resource state)
   - idempotent: Operations that produce the same result when executed multiple times (e.g., complete replacement with PUT or deletion with DELETE)
   - unsafe: Operations that produce different results when executed multiple times (e.g., creation with POST, numerical addition)

3. **Supplementary Elements**
- `doc`: Detailed explanations and supplementary information
- `link`: References to related documents
- `title`: Profile description

## Document Formats

ALPS documents can be written in two formats:

1. **XML Format**
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

2. **JSON Format**
```json
{
    "alps": {
        "version": "1.0",
        "title": "Blog API Profile",
        "doc": {"value": "API Profile for Blog System"},
        "descriptor": [
            { "id": "title", "title": "Title", "doc": {"value": "Article title. Maximum 100 characters."}},
            {
                "id": "blogPost",
                "doc": {"value": "Blog post"},
                "descriptor": [
                    {"href": "#title"}
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
- version: Document version (required)

### descriptor

Defines the semantics of application functions and information.
Either id or href is required; other attributes are optional.

### Descriptor Attributes

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| id | *1 | string | Unique identifier | `"blogPost"` |
| href | *1 | string | Reference to other elements | `"#title"` |
| type | optional | enum | Element type | `"safe"` |
| rt | optional | string | Target resource | `"#BlogPost"` |
| rel | optional | string | Relation | `"item"` |
| title | optional | string | Display name | `"Blog Post"` |
| tag | optional | string | Classification tag | `"blog post"` |
| doc | optional | object/string | Detailed description | `"Detailed explanation"` |

*1: Either id or href is required

Detailed attribute descriptions:

* **id**: Unique identifier (mutually exclusive with href)
   - String that uniquely identifies the descriptor
   - Must not duplicate within the same document
   - Can only use alphanumeric characters and hyphens (-)

* **href**: Reference (mutually exclusive with id)
   - Identifier to reference other descriptors
   - Fragment identifier starting with "#" (e.g., #user)
   - Can include path for external files (e.g., profile.xml#user)

* **type**: Descriptor type
   - semantic: Represents terms and information (default)
   - safe: Read operations (does not change resource state)
   - idempotent: Operations that produce the same result when executed multiple times (e.g., complete replacement with PUT or deletion with DELETE)
   - unsafe: Operations that produce different results when executed multiple times (e.g., creation with POST, numerical addition)

* **rt**: Return Type
   - Target resource after state transition
   - Specified with fragment identifier starting with "#"
   - Used when type attribute is `safe`/`idempotent`/`unsafe`

* **rel**: Relation
   - Indicates descriptor relationships
   - Uses [Link Relations defined by IANA](iana_rels.html) (item, collection, self, next, prev, etc.)
   - Custom relations should be specified with URI

* **title**: Display name
   - Human-readable display name
   - Used for UI and documentation display

* **tag**: Classification tag
   - Used for grouping descriptors
   - Multiple tags separated by spaces
   - Used for categorization and filtering

* **doc**: Detailed description
   - Detailed explanation of the descriptor
   - Can also be defined as a child element
   - Format can be specified

### doc

Provides detailed explanations of elements.

#### doc Attributes

| Attribute | Required | Type | Description | Example |
|-----------|----------|------|-------------|---------|
| href | optional | string | External document URL | `"http://example.com/doc"` |
| format | optional | string | Document format | `"markdown"` |
| tag | optional | string | Classification tag | `"api spec"` |
| value | optional | string | Description text | `"Detailed explanation"` |

### link

Defines references to related documents.

Attributes:
- href: Target URL (required)
- rel: Relation (required)
   - self: Link to self
   - profile: Profile document
   - help: Help document
   - related: Related document
   - Other [IANA link relations](iana_rels.html)

## Validation

1. Descriptors must have either id or href
2. href references must exist within the document
3. rt transition targets must exist within the document
4. type attribute must be one of the four defined values (semantic, safe, idempotent, unsafe)
5. The following prefixes are recommended for operation descriptors:
- safe: `go` (e.g., `goBlog`)
- unsafe: `do` (e.g., `doCreateBlog`)
- idempotent: `do` (e.g., `doUpdateBlog`)
