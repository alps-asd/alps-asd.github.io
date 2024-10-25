---
layout: docs-en
title: Advanced Implementation Guide
category: Manual
permalink: /manuals/1.0/en/advanced-guide.html
---

# Advanced Implementation Guide

## Overview

This document describes more advanced implementation topics for Application-Level Profile Semantics (ALPS). For a description of basic elements and attributes, please refer to the [ALPS Reference](reference.html).

## Descriptors and Link Relation Types

When including state transitions in representations, valid values for link relation types can be any of the following:

1. **Standard Link Relation Types**
   - Short strings registered in registries like IANA or Microformats.org
   - Example: `rel="edit"`, `rel="next"`, `rel="collection"`
   - See [IANA Link Relations](https://www.iana.org/assignments/link-relations/)

2. **Extended Link Relation Types** ([RFC8288])
   - Fully qualified URI for a document describing the relation type
   - Contains a URI fragment identifier for an ALPS descriptor
   - Example: `rel="http://alps.io/profiles/item#purchased-by"`
   - Example: `rel="http://alps.io/profiles/blog#comment"`

3. **ALPS Descriptor ID**
   - `id` attribute value of a state transition descriptor in an ALPS document
   - Usable only if the representation includes an ALPS profile
   - Example: `rel="purchased-by"`
   - Example: `rel="create-comment"`

### Resolving Link Relation Conflicts

1. **Conflicts with Standard Relations**
   - If a state transition descriptor has the same meaning as a standard link relation, do not change its meaning
   - Example: When creating a descriptor named `edit`, it must match the meaning of the `edit` relation registered with IANA

2. **Resolving ID Conflicts**
   - When conflicts occur between multiple descriptors with the same ID:
      - Define a unique ID
      - Use the `name` attribute to retain the original name if necessary
   - Example:
     ```xml
     <descriptor id="user-edit" name="edit" type="safe">
       <doc>Edit user information</doc>
     </descriptor>
     ```

## Integration with Existing Media Types

ALPS can be used in combination with various existing media types. Below, we explain how to integrate with major media types.

### HTML

In HTML, ALPS descriptors are primarily represented using the `class` attribute:

```html
<div class="blog-post">
  <h1 class="title">Article Title</h1>
  <div class="content">Content...</div>
  <form class="add-comment" method="post">
    <input name="comment-text" class="comment-text">
    <button type="submit">Add Comment</button>
  </form>
</div>
```

Corresponding ALPS profile:
```xml
<alps version="1.0">
  <descriptor id="blog-post" type="semantic">
    <descriptor id="title" type="semantic"/>
    <descriptor id="content" type="semantic"/>
    <descriptor id="add-comment" type="unsafe">
      <descriptor id="comment-text" type="semantic"/>
    </descriptor>
  </descriptor>
</alps>
```

### HAL (Hypertext Application Language)

In HAL, state transitions are expressed as link relations and semantic descriptors as properties:

```json
{
  "_links": {
    "self": {"href": "/posts/1"},
    "add-comment": {"href": "/posts/1/comments"}
  },
  "title": "Article Title",
  "content": "Content...",
  "_embedded": {
    "comments": [
      {
        "_links": {
          "self": {"href": "/comments/1"}
        },
        "text": "Comment content..."
      }
    ]
  }
}
```

### Collection+JSON

In Collection+JSON, descriptors are expressed as queries and data elements:

```json
{
  "collection": {
    "version": "1.0",
    "href": "/posts/1",
    "items": [
      {
        "data": [
          {"name": "title", "value": "Article Title"},
          {"name": "content", "value": "Content..."}
        ]
      }
    ],
    "template": {
      "data": [
        {"name": "comment-text", "value": "", "prompt": "Enter a comment"}
      ]
    }
  }
}
```

## Referencing ALPS Documents

This section describes how to reference ALPS profiles when applying them.

### Referencing by Link

1. **Referencing in HTML**
   ```html
   <link rel="profile" href="http://example.com/alps/blog" />
   ```

2. **Referencing in HTTP Link Header**
   ```http
   Link: <http://example.com/alps/blog>; rel="profile"
   ```

3. **Referencing in Media Type Parameter**
   ```http
   Content-Type: application/json; profile="http://example.com/alps/blog"
   ```

### Applying Multiple Profiles

Multiple ALPS profiles can be applied to a single representation:

```http
Link: <http://example.com/alps/blog>; rel="profile",
      <http://example.com/alps/comments>; rel="profile"
```

### Profile Priority

Priority when multiple profiles conflict:

1. Profiles specified in the `profile` parameter of the media type
2. Profiles specified in the HTTP `Link` header
3. Profiles specified in the representation itself (priority given to those specified first)

## Error Handling and Validation

This section describes common error cases and how to handle them during implementation.

### Common Errors

1. **Invalid Descriptor Reference**
   - URLs or fragment identifiers that cannot be resolved
   - References to non-existent descriptors

2. **Link Relation Conflict**
   - Conflicts in meaning with standard relations
   - Conflicts between relation definitions in multiple profiles

3. **Media Type Constraints**
   - Presence of elements that cannot be expressed in a particular media type
   - Lack of support for link expressions
