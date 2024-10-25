---
layout: docs-en
title: Tutorial
category: Manual
permalink: /manuals/1.0/en/tutorial.html
---
# ALPS Basic Tutorial

The ALPS tutorial consists of two parts:

1. **Basic Tutorial** (this page)
   - Learn the basic usage of ALPS through hands-on practice
   - Start with tool usage and gradually understand ALPS features
   - Ideal as the first step to getting started with ALPS

2. **[Advanced Tutorial](./tutorial_rest.html)**
   - Learn about the theoretical foundation and design patterns of ALPS
   - Understand the essence of REST/HTTP applications as state transition systems
   - For those who want a deeper understanding or are involved in large-scale application design

We recommend starting with this basic tutorial.

---

## Getting Started

In this tutorial, we'll use the browser-based ALPS editor:

1. Open [ALPS Editor](https://app-state-diagram.com/)
2. Delete all demo code displayed in the left editor pane

Note: While you can use the ASD application in a local environment, we recommend using the online editor for this tutorial.

## Register Meanings as IDs

In ALPS, specific terms handled by the application are defined as IDs. Let's start by adding the term `dateCreated`.

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated"/>
</alps>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "dateCreated"}
        ]
    }
}
```

## Describe Terms

You can add descriptions using `title` and `doc`.

In XML:
```xml
<descriptor id="dateCreated" title="Creation Date">
    <doc format="text">Represents the article creation date in ISO8601 format</doc>
</descriptor>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the article creation date in ISO8601 format"}}
        ]
    }
}
```

The title is a concise expression like a heading, while doc provides a longer text explanation.

This ID bound to a meaning is called a **semantic descriptor**. `dateCreated` is a semantic descriptor tied to the meaning "creation date". Such definition of meanings and concepts is called an **ontology**.

### Vocabulary

One of ALPS's important roles is to serve as a dictionary of application terms. It helps users use the same terms when referring to the same meaning, preventing expression variations and misunderstandings among users.

## Information Contains Information

Semantic descriptors can contain other semantic descriptors.

For example, `BlogPosting` contains `articleBody` and `dateCreated`. By describing descriptors within descriptors, we represent information hierarchy. Such information structure and arrangement is called **taxonomy**.

In XML:
```xml
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    
    <!-- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="Content"/>
    <descriptor id="dateCreated" title="Creation Date"/>

    <!-- Taxonomy -->
    <descriptor id="BlogPosting" title="Article" >
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="Blog" title="Article List">
        <descriptor href="#BlogPosting"/>
    </descriptor>
</alps>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "id", "title": "id"},
            {"id": "articleBody", "title": "Content"},
            {"id": "dateCreated", "title": "Creation Date"},
            {"id": "BlogPosting", "title": "Article", "descriptor": [
                {"href": "#id"},
                {"href": "#dateCreated"},
                {"href": "#articleBody"}
            ]},
            {"id": "Blog", "title": "Article List", "descriptor": [
                {"href": "#BlogPosting"}
            ]}
        ]
    }
}
```

You can use `#` to reference other descriptors. This is called an **inline link** and allows referencing one descriptor from multiple locations.

## Viewing and Manipulating Information

Web pages contain not just information but also links to other pages and action forms, allowing viewing and manipulation of related information. There are three types of operations:

### safe

Viewing related information. In HTML, this corresponds to anchor elements (<a>), and in HTTP, to GET. This is a **safe transition** that doesn't change the resource state. What changes is the **application state**, i.e., which URL the user is viewing.

### idempotent

Changes the resource state. Has idempotency, meaning repeated execution yields the same result. Think of overwriting a file - the result doesn't change no matter how many times you execute it.

### unsafe

Like idempotent, it changes the resource state but lacks idempotency. Think of appending to a file - the result differs with each execution.

### HTTP Method Correspondence

safe corresponds to `GET`, idempotent to `PUT` or `DELETE`, and unsafe to `POST` HTTP methods.

### Links

Create links by specifying the operation type with `type` and the destination with `rt`.
This example is a link to view `Blog`:

In XML:
```xml
<descriptor type="safe" id="goBlog" rt="#Blog" title="View Blog Post List" />
```

In JSON:
```json
{"type": "safe", "id": "goBlog", "rt": "#Blog", "title": "View Blog Post List"}
```

This example adds an operation to return to the blog post list from a blog post:

In XML:
```xml
<descriptor id="BlogPosting" title="Article">
    <descriptor href="#id"/>
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
    <descriptor href="#goBlog" />
</descriptor>
```

In JSON:
```json
{"id": "BlogPosting", "title": "Article", "descriptor": [
    {"href": "#id"},
    {"href": "#dateCreated"},
    {"href": "#articleBody"},
    {"href": "#goBlog"}
]}
```

Include descriptors needed for transitions and operations in the descriptor:

In XML:
```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="View Article">
    <!-- ID is needed to view an article -->
    <descriptor href="#id"/>
</descriptor>
```

In JSON:
```json
{"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "View Article", "descriptor": [
   {"href": "#id"}
]}
```

Let's add links for both blog post list and blog post:

In XML:
```xml
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    
    <!-- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="Content"/>
    <descriptor id="dateCreated" title="Creation Date"/>

    <!-- Taxonomy -->
    <descriptor id="BlogPosting" title="Article" >
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
        <descriptor href="#goBlog" />
    </descriptor>
    <descriptor id="Blog" title="Article List">
        <descriptor href="#BlogPosting"/>
        <descriptor href="#goBlogPosting" />
    </descriptor>

    <!-- Choreography -->
    <descriptor type="safe" id="goBlog" rt="#Blog" title="View Article List" />
    <descriptor type="safe" id="goBlogPosting" rt="#BlogPosting" title="View Article">
        <descriptor href="#id"/>
    </descriptor>
</alps>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
            {"id": "id", "title": "id"},
            {"id": "articleBody", "title": "Content"},
            {"id": "dateCreated", "title": "Creation Date"},
            {"id": "BlogPosting", "title": "Article", "descriptor": [
                {"href": "#id"},
                {"href": "#dateCreated"},
                {"href": "#articleBody"},
                {"href": "#goBlog"}
            ]},
            {"id": "Blog", "title": "Article List", "descriptor": [
                {"href": "#BlogPosting"},
                {"href": "#goBlogPosting"}
            ]},
            {"type": "safe", "id": "goBlog", "rt": "#Blog", "title": "View Article List"},
            {"type": "safe", "id": "goBlogPosting", "rt": "#BlogPosting", "title": "View Article", "descriptor": [
               {"href": "#id"}
            ]}
        ]
    }
}
```
