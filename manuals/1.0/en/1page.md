---
layout: docs-en
title: 1 Page Manual
category: Manual
permalink: /manuals/1.0/en/1page.html
---
This page collects all BEAR.Sunday manuals in one place.




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
{"descriptor" : [
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
{"descriptor": [
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
{"descriptor": [
    {"id": "title", "title": "Title", "doc": {"value": "Article title. Maximum 100 characters."}},
    {"id": "content", "title": "Content", "doc": {"value": "Article body. Supports Markdown format."}},
    {"id": "publishedAt", "title": "Publication Date", "doc": {"value": "Article publication date and time. ISO 8601 format."}}
]}
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
{"descriptor": [
    {"id": "blogPost", "doc": {"value": "User-created article. After publication, visible to all users."}, "descriptor": [
        {"href": "#title"},
        {"href": "#content"},
        {"href": "#publishedAt"}         
    ]},
    {"id": "pagePost", "doc": {"value": "Static page. Permanent content such as site basic information."}, "descriptor": [
        {"href": "#title"},
        {"href": "#content"}
    ]}
]}
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
{"descriptor": [
    {"id": "goBlog", "type": "safe", "rt": "#Blog", "doc": {"value": "Display blog homepage. Shows latest 10 articles."}},
    {"id": "doCreateBlogPost", "type": "unsafe", "rt": "#BlogPost", "doc": {"value": "Create new article. Saved in draft state."}, "descriptor": [
        {"href": "#title"},
        {"href": "#content"}
    ]},
    {"id": "doPublishBlogPost", "type": "idempotent", "rt": "#BlogPost", "doc": {"value": "Publish article. Current time is set to publishedAt."}, "descriptor": [
        {"href": "#id"}
    ]}
]}
```



# Exmaple

* [todomvc](https://alps-asd.github.io/app-state-diagram/todomvc/)
* [mini amazon](/alps/en/amazon.html)
* [LMS](/alps/en/lms.html)


# FAQ

<strong>Q. Who can use the software</strong>?

A. It can be used by anyone involved in site creation (engineers, designers, POs).

<strong>Q. What kind of people can write ALPS</strong>?

A. Anyone who can understand XML and JSON and can do simple HTML coding can write ALPS.

<strong>Q. How do you use it?</strong>

A. It is used to design a site by organizing information into the minimum necessary elements, and to design web and API services. The design can be expressed in formats such as JSON and XML, and documents such as transition diagrams and vocabulary lists can be generated. In addition, each producer can know the exact words, meanings and structures of information based on the information design.

<strong>Q. What is information design</strong>?

A. Based on IA (Information Architecture), it defines the information (meta-information) of information in terms of ontology (meaning of words), taxonomy (classification of information), and choreography (links).

<strong>Q. Is it used for design clarification</strong>?

A. No, it is not. It can be used as a modeling tool from the very early stage of site design to organize information and formulate what kind of site it will be.

<strong>Q. What do I need to write ALPS</strong>?

A. You need an editor to edit JSON and XML.

<strong>Q. Isn't it hard to edit XML and JSON directly</strong>?

A. If you use an editor that supports schemas such as WebStorm, you can edit them comfortably with completion and validation.

<strong>Q. Which is better, XML or JSON</strong>?

A. There is no difference in functionality. There is also no need to unify them when using multiple ALPS files. Please compare them in practice. [XML](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.xml) / [JSON](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.xml) [JSON](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.json)

<strong>Q. Can it be used for APIs without links</strong>?

A. Yes. It cannot represent a transition diagram, but it can generate a vocabulary and documentation of the nature of the information.

<strong>Q. Are there any other technologies that are similar to ALPS?</strong>

A. There are no direct competitors. A similar technology is [Microformat](http://www.asahi-net.or.jp/~ax2s-kmtn/internet/rec-owl-features-20040210.html).

<strong>Q. What is the difference from IDL such as OpenAPI</strong>?

A. ALPS deals with REST abstractions that are higher than HTTP. Therefore, it can be used as a modeling and design language for OpenAPI implementations.

<strong>Q. Do I need it</strong>?

A. If you want to model information to improve the quality of user experience, or if you want a reference (SSOT) to unify the understanding among production members, or if you want to overview and reuse your design, or if you want to keep your information design as a standardized document, ALPS+ASD will be useful as your information design modeling tool or as a format to express it.


VERY IMPORTANT:

ALPS is pronounced ‘alps’, the same as the Swiss alps. It is not A-L-P-S. "ælps"

VERY IMPORTANT:

ALPS is pronounced ‘alps’, the same as the Swiss alps. It is not A-L-P-S. "ælps"

VERY IMPORTANT:

ALPS is pronounced ‘alps’, the same as the Swiss alps. It is not A-L-P-S. "ælps"

VERY IMPORTANT:

ALPS is pronounced ‘alps’, the same as the Swiss alps. It is not A-L-P-S. "ælps"




# Information Architecture and ALPS

Applying Information Architecture (IA) concepts to domain modeling in API design and system development enables systematic organization of business requirements. The elements of IA—"meaning," "structure," and "interaction"—originally developed in UX and content design, play a crucial role in structuring business domain knowledge. ALPS provides a standardized method to express these concepts.

## Applying Information Architecture

Information Architecture expert Dan Klyn defined IA as the interplay of `Ontology`, `Taxonomy`, and `Choreography`. [^uia] These concepts serve as a foundation not only for content design but also for system design. While OpenAPI focuses on technical API details (endpoints, HTTP methods, request/response structures), ALPS uses these IA concepts to structure the business domain.

[^uia]: [Understanding Information Architecture](https://understandinggroup.com/ia-theory/understanding-information-architecture)

## Role in the Design Process

ALPS bridges business requirements and system design from the early stages of development. Unlike traditional endpoint-centric design, which typically starts with documenting predetermined API specifications, ALPS can be utilized from the requirements definition phase. This enables early detection and correction of differences in business requirement interpretations. It also establishes a common language between technical and business teams, providing a framework for easily understanding the scope of design changes.

ALPS goes beyond API endpoint design to provide a means of systematizing and sharing business domain knowledge. As a Single Source of Truth (SSOT), it consistently models system structure and behavior. Using business terminology at its core, it clearly expresses complex business rules, visualizes workflows, and enables intuitive understanding of information interactions.

## Adapting to Technical Changes

ALPS offers flexibility in its application to various API styles. Even as technology evolves and architecture styles change, business domain design can be maintained. For example, whether transitioning from RESTful APIs to GraphQL, adopting microservice architecture, or implementing new communication protocols, domain models defined in ALPS remain valid. This is because ALPS focuses on abstracted business logic rather than implementation details.

## Building Knowledge Foundation

In the implementation of `Taxonomy`, relationships between business entities are defined, ensuring scalability through hierarchical structure. This establishes a common vocabulary across the organization, streamlining communication. `Choreography` defines business process flows and service coordination rules, enhancing system-wide consistency and reliability.

Applying IA concepts to domain modeling naturally connects technical implementation with business requirements. ALPS functions as a framework to achieve this bridge, serving as a foundation for systematically structuring and evolving organizational knowledge.

Through this approach, organizations can build a sustainable knowledge foundation that remains resilient to technological changes.



# IANA Link Relations

This document lists IANA link relations recommended for use in the rel attribute of ALPS profiles.

## State Transitions

| Relation | Description |
|-|-|
| first | Transition to the first state in a series |
| last | Transition to the last state in a series |
| next | Transition to the next state in a series |
| prev | Transition to the previous state in a series |

## Semantic Description

| Relation | Description |
|-|-|
| section | Indicates a section in a document |
| subsection | Indicates a subsection in a document |
| chapter | Indicates a chapter in a document |
| contents | Indicates the table of contents of a document |

## Metadata

| Relation | Description |
|-|-|
| latest-version | Transition to the latest version state |
| predecessor-version | Transition to the previous version state |
| successor-version | Transition to the next version state |
| version-history | Transition to a state showing version history |

## Related Information

| Relation | Description |
|----|
| help | Reference to help information |
| status | Reference to state information |
| alternate | Reference to alternative representation |

Notes:
1. This list is an excerpt of relations that are likely to be commonly used in ALPS profiles
2. For a complete list, refer to [IANA Registry](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
3. The categorization is for convenience
4. When using these relations, please select appropriate ones according to your application requirements



# Introduction

[![ALPS document](/images/alps.svg)](/alps/index.html)

## ALPS: A Format for Clarifying Application-Level Meaning and Structure

Application-Level Profile Semantics ([ALPS](http://alps.io/)) is a format that expresses application-level semantics and adds application-specific information to generic media such as JSON and HTML. ALPS clarifies the meaning, structure, and operations of data, enabling efficient development processes, enhanced system interoperability, and improved API reusability and discoverability.

Consider an e-commerce platform as an example. When integrating multiple payment services such as credit cards, digital money, and bank transfers, ALPS standardizes the meaning of data and operations at each step of the payment process. This makes it easier to add new payment methods and integrate with existing systems, allowing developers to implement APIs consistently. Frontend and backend developers can communicate efficiently using a common language, enabling rapid feature additions and improvements.

## ASD: Visualizing Application State Transitions

Application State Diagram (ASD) is a tool that visualizes state transitions and behaviors from ALPS documents. It enables intuitive understanding of an application's overall structure, state transitions, and possible actions. For example, in an online shopping application, it clearly visualizes the process from product search to purchase, helping developers understand the choices and possible operations users face at each stage. This aids in making design decisions that enhance the user experience.

With ASD, all team members—including product owners, backend and frontend developers, and UI/UX designers—can understand the application from the same perspective and work together effectively. This enables smooth communication between members from different specialties and helps new members quickly integrate into complex projects. Furthermore, it allows quick evaluation and adjustment of application flows and logic, providing opportunities to identify and resolve issues early in the design phase, directly contributing to improved development efficiency and application quality.

Through the use of ASD, project transparency increases, minimizing discrepancies in vision among team members.

## Information Architecture for REST Application Design

When designing REST applications from an information architecture perspective, ALPS and ASD complement each other in their roles. ALPS standardizes the meaning and structure of data handled by applications, enabling teams to define information using a common vocabulary. ASD, on the other hand, represents state changes in diagrams, making it easy to visually understand user operations and application responses. Through ALPS specifications and ASD visualization, information design in REST application development is strengthened, team communication becomes smoother, and the overall project consistency and quality are enhanced.

To improve development efficiency, deliver excellent user experiences, and ensure project sustainability, a shared understanding among diverse developers is essential. ALPS and ASD build this foundation and support the long-term success of projects.


# Introduction

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## ALPS: A way to organize app information

ALPS (Application Level Profile Semantics) is a way to neatly describe the information and mechanics of an app. It adds app-specific information to formats commonly used on the Internet (e.g., JSON and HTML) to clarify how the app works and what information it handles. This will make the process of creating the app smoother and allow different apps and systems to work well together.

For example, consider an online shopping site. For the sequence of steps (including payment) that a customer goes through to select and buy a product, ALPS can clearly show what is happening at each step. This makes it easier for those who create the app to make the necessary improvements to ensure a smooth shopping experience for customers.

## ASD: Diagrams showing how the app works

The ASD (Application State Transition Diagram) shows a diagram of how the app moves and the operations the user can perform based on the app information described in the ALPS. This allows you to understand at a glance how the app is working. In the case of an online shopping site, the diagram shows a series of steps, such as searching for a product, adding it to the cart, and paying for it.

ASD allows people in different roles in the team building the app, such as programmers and designers, to have a common understanding of how the app should work. This can be very helpful in discussions about how to improve the app and in coming up with new ideas.

## Designing REST Applications

ALPS and ASD are especially useful for designing apps that run on the web (called REST applications). Using these tools, you can clearly show what information the app handles and how it works. The result is an app that is easier to create and improve, and more user-friendly for the people using it.

In order for team members with diverse skills to work efficiently toward the same goal, it is important that they understand exactly what each other is working on, and ALPS and ASD are very useful tools to help them achieve this understanding.



# Resource

* [ALPS official](http://alps.io/)
* [RFC](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07)
* Skeleton
  * [json](https://github.com/alps-asd/alps-skeleton-json)
  * [xml](https://github.com/alps-asd/alps-skeleton-xml)
* [GitHub Action](https://github.com/marketplace/actions/app-state-diagram)
* [app-state-diagram](https://github.com/alps-asd/app-state-diagram)


<style>
  /* Common Styles */
  .alps-brewery {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }
  
  .alps-brewery .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .alps-brewery header {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .alps-brewery .logo {
    font-size: 2.5rem;
    font-weight: bold;
    color: #336699;
    margin-bottom: 10px;
  }
  
  .alps-brewery .tagline {
    font-size: 1.2rem;
    color: #666;
  }
  
  .alps-brewery .gpts-link {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #f0f4f8;
    border-radius: 6px;
    font-size: 0.95rem;
    display: inline-block;
  }
  
  .alps-brewery .gpts-link a {
    color: #336699;
    text-decoration: none;
    font-weight: bold;
  }
  
  .alps-brewery .gpts-link a:hover {
    text-decoration: underline;
  }
  
  .alps-brewery main {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px 30px;
    margin-bottom: 40px;
  }
  
  .alps-brewery h1, .alps-brewery h2, .alps-brewery h3 {
    color: #336699;
    margin-top: 0;
  }
  
  .alps-brewery textarea {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
    font-family: monospace;
    font-size: 14px;
    resize: vertical;
  }
  
  .alps-brewery button {
    background-color: #336699;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
  }
  
  .alps-brewery button:hover {
    background-color: #254e77;
  }
  
  .alps-brewery button.selected {
    background-color: #254e77;
    box-shadow: 0 0 0 2px rgba(37, 78, 119, 0.5);
  }
  
  .alps-brewery button.secondary-btn {
    background-color: #6c757d;
  }
  
  .alps-brewery button.secondary-btn:hover {
    background-color: #5a6268;
  }
  
  .alps-brewery button.copy-btn {
    background-color: #4CAF50;
    font-size: 0.9rem;
    padding: 6px 12px;
  }
  
  .alps-brewery button.copy-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery .hidden {
    display: none;
  }
  
  .alps-brewery footer {
    text-align: center;
    margin-top: 20px;
    color: #666;
    font-size: 0.9rem;
  }
  
  /* Step Indicator */
  .alps-brewery .step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }
  
  .alps-brewery .step {
    width: 180px;
    padding: 10px;
    text-align: center;
    background-color: #e9ecef;
    position: relative;
    z-index: 1;
  }
  
  .alps-brewery .step:not(:last-child):after {
    content: '';
    position: absolute;
    top: 50%;
    right: -15px;
    width: 30px;
    height: 2px;
    background-color: #e9ecef;
    z-index: 0;
  }
  
  .alps-brewery .step.active {
    background-color: #336699;
    color: white;
    font-weight: bold;
  }
  
  .alps-brewery .step.active:not(:last-child):after {
    background-color: #336699;
  }
  
  /* Tabs */
  .alps-brewery .tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
  }
  
  .alps-brewery .tab-btn {
    padding: 10px 20px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-bottom: none;
    margin-right: 5px;
    border-radius: 5px 5px 0 0;
    cursor: pointer;
    font-weight: normal;
  }
  
  .alps-brewery .tab-btn.active {
    background-color: #336699;
    color: white;
    border-color: #336699;
    font-weight: bold;
  }
  
  .alps-brewery .tab-content {
    display: none;
    padding-top: 15px;
  }
  
  .alps-brewery .tab-content.active {
    display: block;
  }
  
  /* Section Controls */
  .alps-brewery .options-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
  }
  
  .alps-brewery .format-selection, .alps-brewery .language-selection {
    margin-bottom: 15px;
  }
  
  .alps-brewery .format-selection label, .alps-brewery .language-selection label {
    margin-right: 10px;
  }
  
  .alps-brewery select, .alps-brewery input[type="text"] {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.9rem;
  }
  
  .alps-brewery .sample-controls {
    margin-bottom: 15px;
  }
  
  .alps-brewery .sample-controls select {
    width: 100%;
    max-width: 300px;
  }
  
  /* Format Buttons */
  .alps-brewery .format-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  /* Result Section */
  .alps-brewery .result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .alps-brewery .verification-tip {
    background-color: #f8f9fa;
    border-left: 4px solid #336699;
    padding: 10px 15px;
    margin: 15px 0;
    font-size: 0.95rem;
  }
  
  .alps-brewery .verification-tip .tip-text {
    background-color: #eef1f7;
    padding: 3px 6px;
    border-radius: 3px;
    font-family: monospace;
  }
  
  .alps-brewery .mini-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    padding: 3px 8px;
    font-size: 0.8rem;
    cursor: pointer;
    margin-left: 5px;
    vertical-align: middle;
  }
  
  .alps-brewery .mini-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery #promptResult {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
    white-space: pre-wrap;
    font-family: monospace;
    font-size: 14px;
    overflow-y: auto;
    margin-bottom: 20px;
  }
  
  /* Navigation Buttons */
  .alps-brewery .nav-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
</style>

<div class="alps-brewery">
  <div class="container">
    <header>
      <div class="logo">ALPS Prompt Brewery</div>
      <div class="tagline">AI prompt generator for ALPS and implementation code</div>
    </header>

    <main>
      <div class="step-indicator">
        <div class="step active" id="step1">Step 1: User Story</div>
        <div class="step" id="step2">Step 2: ALPS</div>
      </div>
      
      <!-- Step 1: User Story to ALPS Prompt -->
      <section id="userStorySection" class="section-active">
        <h2>ALPS Prompt Creation</h2>
        
        <div class="tabs">
          <button class="tab-btn active" id="userStoryTabBtn">Create from User Story</button>
          <button class="tab-btn" id="directAlpsTabBtn">Convert Existing ALPS</button>
        </div>
        <!-- User Story Tab Content -->
        <div id="userStoryTab" class="tab-content active">
          <div class="sample-controls">
            <label>Need inspiration?</label>
            <select id="sampleStorySelect">
              <option value="">Select a sample user story...</option>
              <optgroup label="Business Applications">
                <option value="ecommerce">E-commerce Product Management</option>
                <option value="taskapp">Task Management App</option>
                <option value="restaurant">Restaurant Reservation System</option>
              </optgroup>
              <optgroup label="Content & Information Systems">
                <option value="blog">Blog System</option>
                <option value="library">Library Management System</option>
                <option value="lms">Learning Management System (LMS)</option>
              </optgroup>
              <optgroup label="Service Industries">
                <option value="travel">Travel Booking System</option>
                <option value="events">Event Management Platform</option>
                <option value="healthcare">Healthcare Patient Management</option>
              </optgroup>
            </select>
          </div>
          
          <textarea id="userStoryInput" placeholder="Enter your user story or system requirements here..."></textarea>
          
          <div class="options-row">
            <div class="format-selection">
              <label>ALPS Format:</label>
              <label><input type="radio" name="alpsFormat" value="json" checked> JSON</label>
              <label><input type="radio" name="alpsFormat" value="xml"> XML</label>
            </div>
            
            <div class="language-selection">
              <label>Documentation Language:</label>
              <select id="languageSelect">
                <option value="English">English</option>
                <option value="Japanese">Japanese</option>
                <option value="Spanish">Spanish</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Chinese">Chinese</option>
                <option value="other">Other...</option>
              </select>
              <input type="text" id="customLanguage" placeholder="Specify language" class="hidden">
            </div>
          </div>
          
          <button id="generateAlpsPromptBtn" class="primary-btn">Generate ALPS Prompt</button>
        </div>
        
        <!-- Direct ALPS Tab Content -->
        <div id="directAlpsTab" class="tab-content">
          <p>Paste your existing ALPS profile below and proceed directly to the format conversion step.</p>
          <textarea id="directAlpsInput" placeholder="Paste your existing ALPS profile here..."></textarea>
          <div class="format-selection">
            <label>Select the format of your ALPS profile:</label>
            <label><input type="radio" name="directAlpsFormat" value="json" checked> JSON</label>
            <label><input type="radio" name="directAlpsFormat" value="xml"> XML</label>
          </div>
          <button id="proceedToConversionBtn" class="primary-btn">Proceed to Conversion</button>
        </div>
      </section>
      
      <!-- Step 2: ALPS to Implementation -->
      <section id="alpsSection" class="hidden">
        <h2>Convert ALPS to Implementation Format</h2>
        
        <div class="result-header">
          <h3>Generated ALPS Prompt</h3>
          <button id="copyAlpsBtn" class="copy-btn">Copy ALPS Prompt</button>
        </div>
        
        <textarea id="alpsInput" placeholder="Your generated ALPS prompt will appear here. You can also paste your own ALPS profile."></textarea>
        
        <div class="verification-tip">
          <p><strong>💡 Pro Tip:</strong> After receiving your ALPS profile from the AI, consider asking: <span class="tip-text">"Please review this ALPS profile to verify that there are no isolated states (unreachable or exit-less states) and that all state transitions are properly connected. Also check if all semantic descriptors are consistently tagged and grouped."</span> <button id="copyTipBtn" class="mini-btn">Copy Tip</button></p>
          <p><strong>💡 Next Step:</strong> After confirming that ALPS is rendered correctly at <a target="_blank" href="https://editor.app-state-diagram.com/">https://editor.app-state-diagram.com/</a>, Paste your ALPS profile into textarea and proceed directly to the format conversion step. 
          </p>
        </div>
        
        <h3>Select Target Implementation Format</h3>
        <div class="format-buttons">
          <button id="openApiBtn">OpenAPI</button>
          <button id="jsonSchemaBtn">JSON Schema</button>
          <button id="graphqlBtn">GraphQL</button>
          <button id="sqlBtn">SQL</button>
          <button id="typescriptBtn">TypeScript</button>
        </div>
        
        <button id="convertAlpsBtn" class="primary-btn">Generate Conversion Prompt</button>
        
        <div class="nav-buttons">
          <button id="backToUserStoryBtn" class="secondary-btn">← Back to User Story</button>
        </div>
      </section>
      
      <!-- Step 3: Result -->
      <section id="resultSection" class="hidden">
        <div class="result-header">
          <h2 id="resultTitle">Generated Conversion Prompt</h2>
          <button id="copyResultBtn" class="copy-btn">Copy to Clipboard</button>
        </div>
        
        <p>Copy this prompt to ChatGPT, Claude, or any other AI assistant:</p>
        <div id="promptResult"></div>
        
        <div class="verification-tip">
          <p><strong>💡 Remember:</strong> For best results, first have the AI verify the ALPS profile for correctness, then provide this conversion prompt.</p>
        </div>
        
        <div class="nav-buttons">
          <button id="startOverBtn" class="secondary-btn">Start Over</button>
          <button id="backToAlpsBtn" class="secondary-btn">← Back to ALPS</button>
        </div>
        
        <div class="gpts-link" style="margin-top: 25px; text-align: center;">
          <p>Tip: For quick results, you can also use <a href="https://chatgpt.com/g/g-HYPygRnLS-alps-assistant" target="_blank">ALPS Assistant GPTs</a> with your prompts.</p>
        </div>
      </section>
    </main>
    
    <footer>
    </footer>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const userStoryInput = document.getElementById('userStoryInput');
    const alpsInput = document.getElementById('alpsInput');
    const promptResult = document.getElementById('promptResult');
    const resultTitle = document.getElementById('resultTitle');
    
    // Sections
    const userStorySection = document.getElementById('userStorySection');
    const alpsSection = document.getElementById('alpsSection');
    const resultSection = document.getElementById('resultSection');
    
    // Step indicators
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    // Buttons
    const generateAlpsPromptBtn = document.getElementById('generateAlpsPromptBtn');
    const convertAlpsBtn = document.getElementById('convertAlpsBtn');
    const copyAlpsBtn = document.getElementById('copyAlpsBtn');
    const copyResultBtn = document.getElementById('copyResultBtn');
    const backToUserStoryBtn = document.getElementById('backToUserStoryBtn');
    const backToAlpsBtn = document.getElementById('backToAlpsBtn');
    const startOverBtn = document.getElementById('startOverBtn');
    
    // Format buttons
    const openApiBtn = document.getElementById('openApiBtn');
    const jsonSchemaBtn = document.getElementById('jsonSchemaBtn');
    const graphqlBtn = document.getElementById('graphqlBtn');
    const sqlBtn = document.getElementById('sqlBtn');
    const typescriptBtn = document.getElementById('typescriptBtn');
    
    // Sample user stories
    const sampleStories = {
      'ecommerce': `As a store owner, I want to manage product inventory.
Products have a name, description, price, category, and stock quantity.
I need to add new products, update existing ones, and remove discontinued items.
Customers should be able to browse products by category and view product details.`,
      
      'taskapp': `As a project manager, I need a task tracking system.
Tasks have a title, description, due date, priority, and assigned user.
Users should be able to create tasks, update status, and mark them complete.
The system should display task lists filtered by status or assigned user.`,
      
      'blog': `As a content creator, I need a blog management system.
Articles have a title, content, publication date, tags, and author.
I want to create drafts, publish articles, and manage comments.
Readers should be able to view articles by tag or author and leave comments.`,
      
      'travel': `As a travel agent, I need a booking management system.
Trips have destinations, departure/arrival dates, transportation type, and accommodations.
Customers have personal details, payment information, and travel preferences.
Agents should be able to search for available trips, make reservations, and manage itineraries.
The system needs to track booking status, payments, and send confirmation notifications.`,
      
      'healthcare': `As a clinic administrator, I need a patient management system.
Patients have personal information, medical history, and insurance details.
Appointments have a date, time, doctor, patient, and status.
Medical staff need to schedule appointments, record diagnoses, and manage prescriptions.
Patients should be able to view their medical records and upcoming appointments.`,
      
      'events': `As an event planner, I need an event management platform.
Events have a name, venue, date, time, capacity, and ticket types.
Attendees can purchase tickets, register for sessions, and leave feedback.
Organizers need to manage venues, speakers, schedules, and ticket sales.
The system should support check-ins, send reminders, and generate attendance reports.`,
      
      'library': `As a librarian, I need a library management system.
Books have titles, authors, genres, ISBN, publication dates, and availability status.
Members have accounts with personal information, borrowed books, and borrowing history.
Librarians need to catalog books, process loans and returns, and manage reservations.
Members should be able to search the catalog, reserve books, and view their account status.`,
      
      'restaurant': `As a restaurant owner, I need a reservation and ordering system.
Tables have capacity, location, and availability status.
Menu items have names, descriptions, prices, categories, and dietary information.
Staff need to manage reservations, take orders, and process payments.
Customers should be able to book tables, browse menus, and place orders.`,
      
      'lms': `## Learning Management System (LMS)

### Core Users
1. **Students**: Individuals who register for courses, access content, and submit assignments
2. **Instructors**: Educators who create and manage courses, evaluate student progress
3. **Administrators**: People who oversee the entire system, manage user accounts and course catalog

### Course & Content Management
- **As an instructor**, I want to create courses with metadata like title, description, category, start/end dates, enrollment capacity, and difficulty level.
- **As an instructor**, I want to add modules or sections to courses to organize content in logical order.
- **As an instructor**, I want to upload various formats of teaching materials including text, video, audio, PDFs, slideshows, and interactive HTML elements.
- **As an instructor**, I want to create course content in draft mode and preview it before publishing.
- **As an administrator**, I want to view the entire course catalog and filter by category, instructor, or status (active, private, archived).

### Enrollment & Progress Tracking
- **As a student**, I want to browse available courses, check details, and then register.
- **As a student**, I want to track my progress and see completed modules and what's next.
- **As a student**, I want to check course prerequisites to understand required skills or prior knowledge before enrolling.
- **As an instructor**, I want to enroll or unenroll students and set course start/end date extensions for individuals or the entire class.
- **As an instructor**, I want to view class-wide progress on a dashboard and identify students falling behind.

### Assessment & Feedback
- **As an instructor**, I want to create various types of assignments and tests including multiple-choice, written, file upload, and programming assignments.
- **As an instructor**, I want to set grading criteria (rubrics) and provide detailed feedback on assignments.
- **As a student**, I want to submit assignments and resubmit before deadlines if needed.
- **As a student**, I want to view my grades and feedback, and ask questions to the instructor if necessary.
- **As an instructor**, I want to manage a gradebook and calculate overall grades for each student.

### Communication & Collaboration
- **As a student**, I want to post questions on discussion forums and receive answers from other students or instructors.
- **As an instructor**, I want to send notifications and announcements to the entire class or individual students.
- **As a student**, I want to participate in group projects with a shared workspace for collaboration with other students.
- **As any user**, I want to send and receive messages within the system and share attachments.
- **As an instructor**, I want to schedule real-time webinars or online sessions and save recordings for students to access later.

### Reports & Analytics
- **As an instructor**, I want to see analytics on student engagement and activity (login frequency, content viewed, time to complete assignments).
- **As an administrator**, I want to view platform-wide usage and performance metrics.
- **As an administrator**, I want to generate reports on enrollment trends, completion rates, and satisfaction ratings.
- **As an instructor**, I want to export student performance data for use in external analytics tools.

### Accessibility & Localization
- **As any user**, I want to select my interface language for interacting with the system.
- **As a student**, I want to use accessibility features for visual or hearing impairments.
- **As an instructor**, I want to add accessibility elements to content like captions and alternative text.

### Mobile & Offline Access
- **As a student**, I want to access courses from mobile devices and learn comfortably on smartphones or tablets.
- **As a student**, I want to download content for offline learning without internet connection.
- **As an instructor**, I want to send notifications via mobile app to boost student engagement.`
    };
    
    // ALPS guide content
    const alpsGuide = `## ‼️ Important: JSON Format Guidelines ‼️

1. Write each descriptor on a single line (mandatory).
2. Only indent and line-break descriptors if they contain other descriptors.
3. All nested descriptors must reference their parent with \`href\`.

\`\`\`json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "title": "Name", "def": "https://schema.org/name"},
{"id": "email", "title": "Email", "def": "https://schema.org/email"},
{"id": "User", "title": "User Profile", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "title": "User List", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "View User Details", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "Create User", "rt": "#UserList"}
]}}
\`\`\`

## XML Format Guidelines

- Use indentation to indicate hierarchy.
- Write each element on a single line.

\`\`\`xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
\`\`\`

## Structuring Semantic Descriptors

Organize into the following three blocks. Each descriptor must either reference or contain other descriptors:

1. Semantic Definitions (Ontology)
   - Define basic elements (lowerCamelCase).
   - Always specify \`def\` as a full URL if there's a Schema.org definition.
   - Add a \`title\` to all descriptors.
   - Include \`doc\` only if necessary.
   - Each defined element must be referenced by at least one taxonomy state.

2. Containment Relationships (Taxonomy)
   - Descriptors representing states use UpperCamelCase.
   - Use \`href\` for referencing elements (direct definition via \`id\` is not allowed).
   - Each application state includes:
     * Elements displayed/used in the state (defined in the ontology).
     * Actions that can be performed (defined in choreography).
   - Use \`doc\` for additional details if needed.
   - Each taxonomy must either contain or transition to other taxonomies.

3. State Transitions (Choreography)
   - Define transition actions.
   - Select the appropriate \`type\` attribute.
   - Specify the transition destination (\`rt\`).
   - Use \`href\` to refer to necessary data items.
   - Each operation must be referenced by at least one taxonomy state.`;
    
    // Conversion prompt templates
    const conversionPrompts = {
      'OpenAPI': `**Task:** Convert this ALPS profile into a comprehensive OpenAPI 3.1 specification.

**Key Instructions:**

1. **State to Endpoint Mapping:**
   - Map each semantic state to a resource endpoint
   - Use tag attributes to organize endpoints into logical groups
   - Apply proper REST principles (plural nouns for collections, etc.)

2. **Transition Operations:**
   - Convert transitions with specific type attributes:
     - \`safe\` → GET operations
     - \`unsafe\` → POST operations 
     - \`idempotent\` → PUT/PATCH operations
     - Include DELETE operations for removal actions
   - Use appropriate HTTP status codes (200, 201, 204, 400, 404, etc.)

3. **Schema Definitions:**
   - Build schemas from semantic descriptors
   - Include all properties referenced in state descriptors
   - Use Schema.org definitions when available via \`def\` attributes
   - Apply proper validation constraints based on domain knowledge
   - Create both request and response schemas

4. **Complete Documentation:**
   - Use titles as summary descriptions
   - Convert doc attributes to detailed descriptions
   - Include examples for each operation
   - Document error responses and handling

5. **Consistent Design:**
   - Apply query parameters for filtering, sorting, pagination
   - Use path parameters for resource identifiers
   - Include security schemes appropriate for the domain
   - Ensure all endpoints have complete request/response documentation

**Output Format:** Provide YAML format with appropriate indentation and organization.`,
      
      'JSON Schema': `**Task:** Convert this ALPS profile into a comprehensive JSON Schema that accurately captures all data structures.

**Key Instructions:**

1. **Semantic Descriptors:**
   - Create type definitions for each semantic descriptor
   - Use $defs for proper schema reusability
   - Follow semantic descriptor hierarchies when defining nested structures
   - Use \`$ref\` to reference repeated structures

2. **Type & Format Selection:**
   - Choose appropriate types (string, number, integer, boolean, object, array)
   - Apply formats based on semantic meaning (date-time, email, uri, etc.)
   - For descriptors with Schema.org definitions, infer types from those definitions
   - Include multitype properties where appropriate

3. **Validation Rules:**
   - Add property constraints:
     - Strings: minLength, maxLength, pattern
     - Numbers: minimum, maximum, multipleOf
     - Arrays: minItems, maxItems, uniqueItems
     - Objects: required, additionalProperties
   - Define enumerations for constrained values

4. **Documentation & Metadata:**
   - Include title from the ALPS descriptor
   - Add description from doc attributes
   - Provide examples of valid data
   - Add $schema reference for validation

5. **Design Patterns:**
   - Use oneOf/anyOf for polymorphic structures
   - Create composition patterns with allOf when appropriate
   - Add conditional validation with if/then/else where needed

**Output Format:** Provide properly formatted JSON with appropriate indentation.`,
      
'GraphQL': `**Task:** Convert this ALPS profile into a complete GraphQL schema with operations and resolvers.

**Key Instructions:**

1. **Type Definitions:**
   - Create GraphQL types for each semantic descriptor
   - Define scalars based on data nature (String, Int, Float, Boolean, ID)
   - Create custom scalars for special formats (DateTime, Email, URL)
   - Structure relationships using proper GraphQL object connections

2. **Query Operations:**
   - Create queries from \`safe\` transitions
   - Implement filtering, sorting, and pagination for collection queries
   - Design nested queries that follow the semantic connections
   - Support efficient graph traversal with proper resolver planning

3. **Mutation Operations:**
   - Create mutations from \`unsafe\` and \`idempotent\` transitions
   - Define input types for creating and updating resources
   - Implement proper error handling and return types
   - Return modified objects from mutations for efficient client updates

4. **Schema Organization:**
   - Use GraphQL directives for documentation and validation
   - Group related operations based on ALPS tag attributes
   - Design consistent naming patterns across the schema
   - Implement interfaces for shared structures

5. **Advanced Features:**
   - Add subscription operations for real-time updates where appropriate
   - Implement union types for polymorphic responses
   - Design proper pagination with cursor-based approaches
   - Add custom directives for authorization and caching hints

**Output Format:** Provide the schema in SDL (Schema Definition Language) format, along with example operations and resolver patterns.`,
      
      'SQL': `**Task:** Convert this ALPS profile into a comprehensive SQL database schema with tables, relationships, and key operations.

**Key Instructions:**

1. **Table Structure:**
   - Create tables for main semantic descriptors
   - Define appropriate column types based on semantic meaning
   - Implement proper primary keys and indexes
   - Add foreign key constraints for relationships
   - Include CHECK constraints for data validation

2. **Relationship Modeling:**
   - Identify one-to-many, many-to-many, and one-to-one relationships
   - Create junction tables for many-to-many relationships
   - Implement proper ON DELETE/UPDATE behavior for referential integrity
   - Use appropriate naming conventions for relationship columns

3. **Data Operations:**
   - Create SELECT queries for \`safe\` transitions
   - Implement INSERT statements for \`unsafe\` transitions
   - Design UPDATE operations for \`idempotent\` transitions
   - Add DELETE operations where appropriate
   - Include stored procedures for complex operations

4. **Advanced Database Features:**
   - Design appropriate indexes for performance
   - Create views for common query patterns
   - Implement triggers for data integrity and auditing
   - Add computed columns for derived properties
   - Consider partitioning for large tables

5. **Completeness & Standards:**
   - Follow SQL standards for portability
   - Include documentation as comments
   - Create role-based permissions aligned with the domain
   - Design for transaction safety
   - Include data migration considerations

**Output Format:** Provide SQL DDL statements for schema creation, followed by example DML operations.`,
      
      'TypeScript': `**Task:** Convert this ALPS profile into a comprehensive TypeScript type system with interfaces, classes, and utility types.

**Key Instructions:**

1. **Core Type Definitions:**
   - Create interfaces for each semantic descriptor
   - Use proper TypeScript types (string, number, boolean, Date, etc.)
   - Implement inheritance for related types
   - Define enums for constrained values
   - Add JSDoc comments from ALPS documentation

2. **Type Relationships:**
   - Design composition patterns for nested structures
   - Create utility types for operations (Partial<T>, Pick<T>, etc.)
   - Implement generics for reusable patterns
   - Define index signatures for dynamic properties
   - Use union and intersection types appropriately

3. **API Integration:**
   - Create request and response interfaces
   - Implement service interfaces with typed methods
   - Design error handling with typed exceptions
   - Add validation decorators if using class-validator
   - Structure according to ALPS tag groupings

4. **Advanced TypeScript Features:**
   - Use conditional types for complex logic
   - Implement mapped types for transformations
   - Add template literal types for string patterns
   - Define type guards for runtime type checking
   - Use const assertions for literal values

5. **Code Organization:**
   - Structure code into modules based on ALPS tags
   - Create barrel exports for simplified imports
   - Design for tree-shaking and code splitting
   - Add examples of type usage
   - Include TypeScript configuration recommendations

**Output Format:** Provide well-organized TypeScript code with proper imports and exports.`
    };
    
    // Tab switching functionality
    document.getElementById('userStoryTabBtn').addEventListener('click', function() {
      document.getElementById('userStoryTab').classList.add('active');
      document.getElementById('directAlpsTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('directAlpsTabBtn').classList.remove('active');
    });
    
    document.getElementById('directAlpsTabBtn').addEventListener('click', function() {
      document.getElementById('directAlpsTab').classList.add('active');
      document.getElementById('userStoryTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('userStoryTabBtn').classList.remove('active');
    });
    
    // STEP 1: Sample story handling
    document.getElementById('sampleStorySelect').addEventListener('change', function() {
      if (this.value) {
        userStoryInput.value = sampleStories[this.value];
      }
    });
    
    // Custom language handling
    document.getElementById('languageSelect').addEventListener('change', function() {
      const customLanguageInput = document.getElementById('customLanguage');
      if (this.value === 'other') {
        customLanguageInput.classList.remove('hidden');
      } else {
        customLanguageInput.classList.add('hidden');
      }
    });
    
    // Generate ALPS Prompt button (from user story)
    generateAlpsPromptBtn.addEventListener('click', function() {
      if (userStoryInput.value.trim() === '') {
        alert('Please enter a user story.');
        return;
      }
      
      const format = document.querySelector('input[name="alpsFormat"]:checked').value;
      const language = getSelectedLanguage();
      
      // Generate ALPS prompt
      const alpsPrompt = generateAlpsPrompt(userStoryInput.value, format, language);
      alpsInput.value = alpsPrompt;
      
      // Move to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // Proceed to conversion button (from direct ALPS input)
    document.getElementById('proceedToConversionBtn').addEventListener('click', function() {
      const directAlpsInput = document.getElementById('directAlpsInput');
      
      if (directAlpsInput.value.trim() === '') {
        alert('Please enter an ALPS profile.');
        return;
      }
      
      // Transfer direct ALPS input to the conversion section
      alpsInput.value = directAlpsInput.value;
      
      // Move directly to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // STEP 2: Format selection handling
    let selectedFormat = null;
    
    openApiBtn.addEventListener('click', () => selectFormat('OpenAPI', openApiBtn));
    jsonSchemaBtn.addEventListener('click', () => selectFormat('JSON Schema', jsonSchemaBtn));
    graphqlBtn.addEventListener('click', () => selectFormat('GraphQL', graphqlBtn));
    sqlBtn.addEventListener('click', () => selectFormat('SQL', sqlBtn));
    typescriptBtn.addEventListener('click', () => selectFormat('TypeScript', typescriptBtn));
    
    function selectFormat(format, button) {
      selectedFormat = format;
      
      // Update UI to show selected format
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
      button.classList.add('selected');
    }
    
    // Convert ALPS button
    convertAlpsBtn.addEventListener('click', function() {
      if (alpsInput.value.trim() === '') {
        alert('Please generate or paste an ALPS profile.');
        return;
      }
      
      if (!selectedFormat) {
        alert('Please select a format to convert to.');
        return;
      }
      
      // Generate conversion prompt
      const conversionPrompt = conversionPrompts[selectedFormat] + 
        '\n\n_YOUR_ALPS_HERE_\n\n```\n' + alpsInput.value + '\n```';
      
      promptResult.textContent = conversionPrompt;
      resultTitle.textContent = `${selectedFormat} Conversion Prompt`;
      
      // Move to Step 3
      alpsSection.classList.add('hidden');
      resultSection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step3.classList.add('active');
    });
    
    // Navigation buttons
    backToUserStoryBtn.addEventListener('click', function() {
      alpsSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step1.classList.add('active');
    });
    
    backToAlpsBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step2.classList.add('active');
    });
    
    startOverBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step1.classList.add('active');
      step2.classList.remove('active');
      
      // Reset selections
      selectedFormat = null;
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
    });
    
    // Copy buttons
    copyAlpsBtn.addEventListener('click', function() {
      copyToClipboard(alpsInput.value, copyAlpsBtn);
    });
    
    copyResultBtn.addEventListener('click', function() {
      copyToClipboard(promptResult.textContent, copyResultBtn);
    });
    
    // Copy verification tip
    document.getElementById('copyTipBtn').addEventListener('click', function() {
      const tipText = "Please review this ALPS profile to verify that there are no isolated states (unreachable or exit-less states) and that all state transitions are properly connected. Also check if all semantic descriptors are consistently tagged and grouped.";
      copyToClipboard(tipText, this);
    });
    
    // Helper functions
    function getSelectedLanguage() {
      const languageSelect = document.getElementById('languageSelect');
      if (languageSelect.value === 'other') {
        return document.getElementById('customLanguage').value || 'Custom';
      } else {
        return languageSelect.value;
      }
    }
    
    function generateAlpsPrompt(userStory, format, language) {
      return `# ALPS Profile Creation Prompt

Please create an ALPS profile based on the following requirements. This profile should represent a complete and consistent application state design.

* Format: ${format.toUpperCase()}
* Language: ${language}
* Content: 

${userStory}

## ‼️ Important: Guidelines for Design Consistency and Completeness ‼️

1. **All states must be connected**:
   - Avoid isolated states (states that cannot be reached or exited)
   - Every state should have at least one incoming and one outgoing transition (except for home/start and final states)
   - Ensure all transitions between states are logical and clear

2. **Consistent use of semantic descriptors**:
   - Use consistent naming conventions for the same concepts
   - Only use the \`def\` attribute when a corresponding Schema.org definition exists
   - For custom concepts, provide clear titles and use the \`doc\` attribute for details when needed

3. **Complete user flows**:
   - Provide complete state transition paths for each key user story
   - Ensure CRUD operations (Create, Read, Update, Delete) are fully represented
   - Include all necessary functionality for each user role

4. **State transition completeness**:
   - Clearly define the success path for each operation
   - Ensure transitions between key states to prevent disruption of important business processes
   - Consider alternative flows for critical failure cases when necessary

5. **Grouping related elements**:
   - Group related processes and user journeys using the \`tag\` attribute
   - Use tags like "user-management", "content-creation", "payment-process", etc.
   - Apply consistent tags to states and transitions belonging to the same functional area
   - This helps identify related functionality when converting to APIs or data models

${alpsGuide}

## Output Requirements

- Include a clear title for every descriptor (concise one-line explanation)
- Use the doc attribute for detailed explanations when necessary
- Only reference Schema.org URLs with the def attribute when a corresponding definition exists
- Set appropriate type attributes (safe, unsafe, idempotent) for all state transitions
- Create reusable descriptors for common patterns
- Use consistent IDs and naming conventions for the same concepts
- Utilize the tag attribute to group related elements
- Use consistent tags for business domains or functional areas`;
    }
    
    function copyToClipboard(text, button) {
      navigator.clipboard.writeText(text)
        .then(() => {
          const originalText = button.textContent;
          button.textContent = '✅ Copied!, Paste it to your AI assistant';
          setTimeout(() => {
            button.textContent = originalText;
          }, 2000);
        })
        .catch(err => {
          console.error('Failed to copy: ', err);
          alert('Failed to copy. Please copy manually.');
        });
    }
  });
</script>



# Installation and Usage Guide

ASD (app-state-diagram) is a tool for creating comprehensive ALPS documentation that includes application state transition diagrams and vocabulary lists. It can be used in the following ways:

## Choosing Usage Method

### 1. Online Version

Use immediately without local installation:

- [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/)

Features:
- No installation required
- Immediately available in browser
- JSON/XML/HTML files can be loaded via drag & drop
- Snippets and advanced code completion
- Recommended option when local installation is not needed
- Note: Currently unable to edit multiple files simultaneously

### 2. Homebrew Version

Easiest to use in environments where [homebrew](https://brew.sh) is installed.

Installation:

```bash
brew install alps-asd/asd/asd
```

### 3. Docker Version

Download and run a script to execute in Docker. Follow these security verification steps as this involves downloading and running a shell script.

#### Security Verification Steps

1. Review script content (recommended):

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | less
```

2. Verify checksum:

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | sha256sum
```

Expected value:
```
0f05034400b2e7fbfee6cddfa9dceb922e51d93fc6dcda62e42803fb8ef05f66
```

3. Execute installation:

```bash
sudo curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh -o /usr/local/bin/asd
sudo chmod +x /usr/local/bin/asd
```

#### Prerequisites
- Docker must be installed
- curl command must be available

### 4. Mac Launcher Application (GUI Version)

A Mac GUI application that doesn't require command line operations.

Installation steps:
1. Download [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip)
2. Security verification:
    - View the downloaded files and verify the contents before proceeding
    - Verify the checksum (SHA-256):
      ```bash
      shasum -a 256 [downloaded zip file]
      ```
    - Compare with the expected checksum on the official repository: 659ecc3225b95a04f0e2ac4ebed544267ba78a0221db7ed84b6dfd7b08ce423b
3. Open the verified script in Script Editor:
    - If you get a security warning, right-click (or Control-click) the script and select "Open"
    - In System Settings > Privacy & Security, click "Open Anyway" if prompted
4. Select "File" > "Export..."
5. Save location: "Applications"
6. Save as Format: "Application"

### 5. GitHub Actions Version

Create ASD in CI. See [marketplace](https://github.com/marketplace/actions/app-state-diagram) for details.

### 6. VSCode Plugin

You can live edit ALPS files while viewing the preview screen using the VSCode Plugin (experimental).

[Visual Studio Marketplace - Application State Diagram](https://marketplace.visualstudio.com/items?itemName=koriym.app-state-diagram)

## Usage

### Running Demo
```bash
# Download and run demo file
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### Command Line Options
```
asd [options] [alpsFile]

Options:
    -w, --watch     Watch mode
    -m, --mode      Drawing mode
    --port          Port to use (default 3000)
```

### Mode Settings
- Markdown mode available for use with private repositories
- However, diagram links don't function in Markdown mode
- Use as alternative option when HTML cannot be published

## Installation Verification

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## Selection Guidelines

- Quick trial, temporary use → Online version
- Local use on Mac → Homebrew version
- Cross-platform use → Docker version
- Mac local environment with GUI → Launcher application
- CI/CD environment use → GitHub Actions version



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
|-||-|--||
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
|-||-|--||
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



<link rel="stylesheet" href="{{ '/css/schema-styles.css' | relative_url }}">


# Schema.org Terms

<h2>Properties</h2>

{% include html/schema-search.html table_id="schema-property-table" %}

<table id="schema-property-table">
  <thead>
    <tr>
      <th>Property</th>
      <th>Description</th>
      <th>Meta information</th>
    </tr>
  </thead>
  <tbody>
    {% for property in site.data.schema_properties %}
      <tr>
        <td>
          <a href="https://schema.org/{{ property.label }}" class="schema-link">{{ property.label }}</a>
        </td>
        <td>{{ property.comment | replace: 'href="/', 'href="https://schema.org/' }}</td>
        {% include html/property-meta.html property=property %}
      </tr>
    {% endfor %}
  </tbody>
</table>

<h2>Types</h2>

<table id="schema-type-table">
  <thead>
    <tr>
      <th>Type</th>
      <th>Description</th>
      <th>Meta information</th>
    </tr>
  </thead>
  <tbody>
    {% for type in site.data.schema_types %}
      <tr>
        <td>
          <a href="https://schema.org/{{ type.label }}" class="schema-link">{{ type.label }}</a>
        </td>
        <td>{{ type.comment | replace: 'href="/', 'href="https://schema.org/' }}</td>
        {% include html/type-meta.html type=type %}
      </tr>
    {% endfor %}
  </tbody>
</table>


# Recommended Semantic Terms

## Overview

This document provides a complete list of terms from [Schema.org](https://schema.org) vocabulary that can be used as semantic descriptors (id) in ALPS profiles.

### Usage

1. When starting API design, first select appropriate terms from 🔵 Core Terms.
2. If more detailed expression is needed, consider 🟡 Extended Terms.
3. For special use cases, consider ⚪ Full Terms.
4. You can find terms by category using the category index.
5. Regarding domain-specific terms:
- Define industry or business-specific terms as custom semantic descriptors
- Naming convention: domainName + PropertyName (e.g., orderShippingStatus, medicalDiagnosisCode)
- It is recommended to build on Schema.org terms while making necessary extensions
- When defining domain-specific terms, it's important to clearly document their meaning and usage

### Category Index

1. [Basic Properties](#basic-properties)
2. [Identifiers & References](#identifiers--references)
3. [Metadata](#metadata)
4. [Dates & Periods](#dates--periods)
5. [Text & Content](#text--content)
6. [Media & Files](#media--files)
7. [Person & Individual](#person--individual)
8. [Organization & Group](#organization--group)
9. [Address & Location](#address--location)
10. [Products & Services](#products--services)
11. [Price & Payment](#price--payment)
12. [Events & Activities](#events--activities)
13. [Reviews & Ratings](#reviews--ratings)
14. [Education & Learning](#education--learning)
15. [Medical & Health](#medical--health)
16. [Finance & Transactions](#finance--transactions)
17. [Reservations & Scheduling](#reservations--scheduling)
18. [Communication](#communication)
19. [Security & Access Control](#security--access-control)
20. [Workflow & Process](#workflow--process)
21. [Technical & System](#technical--system)
22. [Legal & Terms](#legal--terms)
23. [Other Attributes](#other-attributes)

---|
| status | 🔵 | Status |
| type | 🔵 | Type |
| category | 🔵 | Category |
| order | 🔵 | Order |
| priority | 🔵 | Priority |
| tag | 🔵 | Tag |
| group | 🔵 | Group |
| relation | 🔵 | Relation |
| source | 🔵 | Source |
| target | 🔵 | Target |
| origin | 🟡 | Origin |
| destination | 🟡 | Destination |
| sortOrder | 🟡 | Sort order |
| rank | 🟡 | Rank |
| score | 🟡 | Score |
| level | 🟡 | Level |
| theme | 🟡 | Theme |
| style | 🟡 | Style |
| layout | 🟡 | Layout |
| template | 🟡 | Template |
| format | 🟡 | Format |
| mode | 🟡 | Mode |
| state | 🟡 | State |
| phase | 🟡 | Phase |
| context | 🟡 | Context |
| scope | 🟡 | Scope |
| flags | ⚪ | Flags |
| options | ⚪ | Options |
| settings | ⚪ | Settings |
| preferences | ⚪ | Preferences |
| configuration | ⚪ | Configuration |
| customization | ⚪ | Customization |
| variant | ⚪ | Variant |
| alternative | ⚪ | Alternative |
| fallback | ⚪ | Fallback |
| override | ⚪ | Override |
| default | ⚪ | Default |
| custom | ⚪ | Custom |
| external | ⚪ | External |
| internal | ⚪ | Internal |
| public | ⚪ | Public |
| private | ⚪ | Private |
| hidden | ⚪ | Hidden |
| visible | ⚪ | Visible |
| enabled | ⚪ | Enabled |
| disabled | ⚪ | Disabled |
| locked | ⚪ | Locked |
| archived | ⚪ | Archived |
| deleted | ⚪ | Deleted |
| deprecated | ⚪ | Deprecated |

## Conclusion

This document is continuously updated and new terms and usage patterns may be added.

### Importance Levels

All terms are classified into three levels based on importance and frequency of use:

🔵 **Core Terms**: Essential key terms for basic APIs (about 10-15% of total)
- Fundamental vocabulary used in most applications
- First choice when creating simple APIs
- Terms necessary for common CRUD operations

🟡 **Extended Terms**: Commonly used extended terms (about 30-35% of total)
- Vocabulary needed for specific domains and more detailed expressions
- Terms commonly used in general business applications
- Options when richer expressiveness is needed

⚪ **Full Terms**: Special purpose terms (about 50-55% of total)
- Vocabulary needed for specific industries and special use cases
- Options when complete compatibility is needed
- Terms for very specialized expressions

### Usage Notes

2. **Naming Conventions**:
- Use lowerCamelCase format
- Avoid abbreviations, use complete words
- Maintain consistent naming patterns

3. **Customization**:
- Can add custom terms as needed
- Recommend using appropriate prefixes for industry-specific terms
- Strive for unified term usage within organization

4. **Interoperability**:
- Consider compatibility with Schema.org
- Prioritize standard terms
- Clearly document when making custom extensions

### Reference Resources

- [Schema.org](https://schema.org)
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
- [ALPS Specification](http://alps.io/spec/)




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



<style>

.description {
    font-size: 24px;
    line-height: 1.5;
    color: #333;
    text-align: center;
    margin: 50px 0;
    font-family: "Noto Sans JP", "Yu Gothic", "游ゴシック", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", sans-serif;
}
</style>

<img class="crop-image" src="/images/slide/app-state-diagram.001.jpeg" alt="An image showing a photo of the exterior of the house, a photo of the interior, and a perspective drawing. This shows that a rendering of the completed house is not enough.">
<p class="description">When building a house, we don't rely solely on pictures or perspective drawings.</p>



<div class="image-container">
<img src="/images/slide/app-state-diagram.003.jpeg" alt="A state transition diagram for ALPS and a list of related semantic descriptors. This shows ALPS as a common language for website construction.">
</div>
<p class="description">Similarly, ALPS document is that common language when it comes to building a website.</p>



<a class="intl btn btn-light" id="learn" href="/manuals/1.0/en/index.html">
    Learn More &raquo;
</a>
<script src="/js/switch_intl.js"></script>
<script src="/js/speech.js"></script>


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

1. Open [ALPS Editor]( https://editor.app-state-diagram.com/)
2. Delete all demo code displayed in the left editor pane

Note: While you can use the ASD application in a local environment, we recommend using the online editor for this tutorial.

## First Step: Preparing an Empty File

The first step in creating an ALPS document is to prepare a basic empty file. This file serves as the starting point with the minimum structure required for all ALPS documents.

ALPS documents can be written in either XML or JSON format. Each format references its respective schema (xsd for XML, json-schema for JSON) which defines the valid structure and ensures your document follows the ALPS specification. There is no functional difference between the two formats, so you can choose based on your team's preferences and existing toolchain.

For XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
```

For JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
        ]
    }
}
```

## Register Meanings as IDs

In ALPS, specific terms handled by the application are defined as IDs. Let's start by adding the term `dateCreated`.

In XML:
```diff
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
+    <descriptor id="dateCreated"/>
</alps>
```

In JSON:
```diff
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
+            {"id": "dateCreated"}
        ]
    }
}
```

## Describe Terms

You can add descriptions using `title` and `doc`.

In XML:
```diff
<?xml version="1.0" encoding="UTF-8"?>
<alps
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
-    <descriptor id="dateCreated"/>
+   <descriptor id="dateCreated" title="作成日付">
+      <doc format="text">ISO8601フォーマットで記事の作成日付を表します</doc>
+   </descriptor>
</alps>
```

In JSON:
```diff
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "descriptor": [
-            {"id": "dateCreated"}
+            {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the article creation date in ISO8601 format"}}
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



# ALPS Tutorial for REST Applications

## Introduction

Modern web applications (online shopping, social networks, video streaming services, business systems, etc.) are mostly built based on the REST architecture. In this tutorial, we will explain how to design applications using ALPS, considering the basic concepts of REST.

### Essence of REST Applications

A REST application is essentially a "state transition system." For example:

- Search for a product, add it to the cart, and confirm the order (online shopping)
- Read posts, react, and leave comments (social network)

All of these actions can be viewed as "transitions" from one "state" to another, and a REST application manages these transitions.

### What is State Transition?

State transition refers to a change from one state to another within a system. In web applications:

1. Users are always "somewhere" (current state).
2. They can move "somewhere else" (possible state transition).
3. "How" to move is defined (transition method).

These three elements are the basics of a state transition system.

### Two States in REST

In addition to the states used in state transitions, REST has two important types of states:

1. **Application State**
- Represents the client (browser) location, expressed as URLs

2. **Resource State**
- Represents the state of data managed on the server

The client accesses resource states by changing its application state, and
the server responds with both resource states and network affordances that describe possible state transitions.

### Basic Flow of State Transitions in REST Applications

State transitions in REST applications proceed as follows:

1. Recognize the Current State
   - The client understands the current state and the available information.

2. Choose a Transition
   - The client checks the provided links and actions, then chooses the next transition.

3. Execute the Transition
   - The client performs the chosen action, moving to a new state.

This flow repeats continuously throughout the use of the application.

## Information Architecture and ALPS

To properly design a REST application, the state transition system needs to be systematically documented.
Dan Klyn has proposed three important aspects needed for this documentation:

1. Ontology
   - Defines "what something means."
   - Example: The meaning of terms such as "blog post" or "creation date."
   - Shares the same meaning of terms.

2. Taxonomy
   - Organizes "how things relate."
   - Example: A "blog post" has a "creation date" and "body."
   - Defines the structure of information.

3. Choreography
   - Describes "how things work."
   - Example: Viewing, creating, updating, and deleting posts.
   - Shows the flow of actions.

ALPS is a means to practically express these concepts. In the following sections of this tutorial:

1. Ontology: Define the basic terms.
2. Taxonomy (1): Define the information structure.
3. Choreography: Define state transitions.
4. Taxonomy (2): Integrate states and transitions.

We will learn the specific implementation methods.

## Ontology: Defining Terms

Ontology defines the meaning of terms used in the application. Clearly defining these terms at this stage helps create a shared understanding among the team and ensures consistent API design.

### Setting Up the Editor

1. Open [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/) in your browser.
2. Delete all the demo code displayed in the left editor pane.

### Defining the First Term

Below is an example definition for the term "creation date."

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="Creation Date">
        <doc format="text">Represents the date the post was created, in ISO8601 format</doc>
    </descriptor>
</alps>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the date the post was created, in ISO8601 format"}}
        ]
    }
}
```

Explanation of each element in this definition:

1. `id` Attribute
   - The identifier for the term.

2. `title` Attribute
   - A short, human-readable description used for display in UI or documentation.

3. `doc` Element
   - Describes the precise meaning and usage of the term.
   - Specifies the format attribute (e.g., text).

### Defining the Article Body

Next, we add a term that represents the body of a blog post.

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="Creation Date">
        <doc format="text">Represents the date the post was created, in ISO8601 format</doc>
    </descriptor>
    <descriptor id="articleBody" title="Article Body">
        <doc format="text">The body of the blog post</doc>
    </descriptor>
</alps>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the date the post was created, in ISO8601 format"}},
            {"id": "articleBody", "title": "Article Body", "doc": {"format": "text", "value": "The body of the blog post"}}
        ]
    }
}
```

### Key Points of Ontology Definition

1. Naming Conventions
   - Prioritize [semantic terms](semantic-terms.html).
   - Use consistent naming patterns.
   - CamelCase is recommended (e.g., dateCreated, articleBody).

2. Writing Descriptions
   - Aim for concise and clear descriptions.
   - Include examples if necessary.
   - Specify formats or constraints if applicable.

## Taxonomy: Structuring Information

Taxonomy defines "how to organize and classify information."
By combining the terms we defined earlier, we can represent larger concepts.

A blog post (BlogPosting) can be defined as a collection of information with a creation date and body.

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="Creation Date">
        <doc format="text">Represents the date the post was created, in ISO8601 format</doc>
    </descriptor>
    <descriptor id="articleBody" title="Article Body">
        <doc format="text">The body of the blog post</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="Blog Post">
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
</alps>
```

In JSON:
```json
{
   "$schema": "https://alps-io.github.io/schemas/alps.json",
   "alps": {
      "version": "1.0",
      "descriptor": [
         {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the date the post was created, in ISO8601 format"}},
         {"id": "articleBody", "title": "Article Body", "doc": {"format": "text", "value": "The body of the blog post"}},
         {"id": "BlogPosting", "title": "Blog Post", "descriptor": [
            {"href": "#dateCreated"},
            {"href": "#articleBody"}
         ]}
      ]
   }
}
```

### Key Points of Structuring

1. Reference by `href`
   - Use `#` to refer to existing terms.
   - Allows reuse of the same definitions multiple times.
   - Ensures consistency of terms.

2. Representation of Hierarchical Structure
   - `BlogPosting` includes `dateCreated` and `articleBody`.
   - The included elements are represented using the `descriptor` tag.
   - Represented as a parent-child relationship.

### Preview in Editor

1. Vocabulary List
   - Defined terms are displayed hierarchically.
   - Elements contained within `BlogPosting` are displayed.

2. State Diagram
   - `BlogPosting` is displayed as a single state.
   - No transitions are defined at this stage.

### Why Structuring is Important

1. Clarification of Relationships
   - Which information belongs to which concept.
   - Visualization of dependencies between pieces of information.

2. Consistent API
   - The same structure is always represented in the same way.
   - Makes implementation on the client side easier.

3. Role as Documentation
   - Understanding the system as a whole.
   - Establishing a common understanding of the information structure.

## Choreography: Defining State Transitions

Choreography defines state transitions according to the types of operations. In ALPS, operations are categorized as follows:

|Operation | Type |  HTTP Method Description |
| - | ---- | 
|safe | GET | Changes only application state |
|unsafe | POST | Creates new resource state |
|idempotent | PUT/DELETE | Updates/deletes resource state |

1. `safe`
   - Changes only the application state (e.g., GET).
   - Resource state is not altered.

3. `unsafe`
   - Creates a new resource state.
   - May have different outcomes each time it is executed.

3. `idempotent`
   - Updates or deletes the resource state.
   - Produces the same outcome no matter how many times it is executed.

ALPS operations distinguish between resource changes that have a different result each time they are performed, i.e., non-idempotent operations, such as add operations, and those that have a different result each time they are performed, i.e., idempotent operations, such as change or delete operations, which do not change the result no matter how many times they are repeated.

### Defining the Transition to View an Article

First, let’s define a `safe` operation to view a blog post:

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="dateCreated" title="Creation Date">
        <doc format="text">Represents the date the post was created, in ISO8601 format</doc>
    </descriptor>
    <descriptor id="articleBody" title="Article Body">
        <doc format="text">The body of the blog post</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="Blog Post">
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="View Blog Post">
        <descriptor href="#dateCreated"/>
    </descriptor>
</alps>
```

In JSON:
```json
{
    "$schema": "https://alps-io.github.io/schemas/alps.json",
    "alps": {
        "version": "1.0",
        "descriptor": [
            {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the date the post was created, in ISO8601 format"}},
            {"id": "articleBody", "title": "Article Body", "doc": {"format": "text", "value": "The body of the blog post"}},
            {"id": "BlogPosting", "title": "Blog Post", "descriptor": [
               {"href": "#dateCreated"},
               {"href": "#articleBody"}
            ]},
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "View Blog Post", "descriptor": [
               {"href": "#dateCreated"}
            ]}
        ]
    }
}
```

Important elements of this definition:

0. Prefix Naming Convention
   - Use `go` for `safe` transitions.
   - Use `do` for `unsafe` and `idempotent` transitions.

1. `type` Attribute
   - Specifies the type of operation.
   - In this case, it is `safe` (a safe transition).

2. `rt` (return type) Attribute
   - Specifies the destination state.
   - Indicates a transition to `#BlogPosting`.

3. Information Needed for the Transition
   - Specified by `descriptor href="#dateCreated"`.
   - Represents the information needed to identify the post.

In the preview screen:
1. The state diagram shows the state (`BlogPosting`) and an arrow representing the transition.
2. The vocabulary list displays information about the transition (`goBlogPosting`).



### Defining the Transition to Create an Article

Next, let's define an `unsafe` operation to create a new blog post:

In XML:
```xml
<descriptor id="doCreateBlogPosting" type="unsafe" rt="#BlogPosting" title="Create Blog Post">
    <descriptor href="#articleBody"/>
</descriptor>
```

In JSON:
```json
{"id": "doCreateBlogPosting", "type": "unsafe", "rt": "#BlogPosting", "title": "Create Blog Post", "descriptor": [
    {"href": "#articleBody"}
]}
```

Important elements of this definition:

1. Prefix Naming Convention
   - Use `do` for `unsafe` transitions.

2. `type` Attribute
   - Specifies the type of operation.
   - In this case, it is `unsafe` (a state-changing operation).

3. `rt` (return type) Attribute
   - Specifies the destination state.
   - Indicates a transition to `#BlogPosting`.

4. Information Needed for the Transition
   - Specified by `descriptor href="#articleBody"`.
   - Represents the information needed to create the post.

In the preview screen:
1. The state diagram shows the state (`BlogPosting`) and an arrow representing the transition (`doCreateBlogPosting`).
2. The vocabulary list displays information about the transition (`doCreateBlogPosting`).

### Defining the Transition to Update an Article

Now, let's define an `idempotent` operation to update a blog post:

In XML:
```xml
<descriptor id="doUpdateBlogPosting" type="idempotent" rt="#BlogPosting" title="Update Blog Post">
    <descriptor href="#articleBody"/>
</descriptor>
```

In JSON:
```json
{"id": "doUpdateBlogPosting", "type": "idempotent", "rt": "#BlogPosting", "title": "Update Blog Post", "descriptor": [
   {"href": "#articleBody"}
]}
```

Important elements of this definition:

1. Prefix Naming Convention
   - Use `do` for `idempotent` transitions.

2. `type` Attribute
   - Specifies the type of operation.
   - In this case, it is `idempotent` (an operation that can be repeated without changing the result).

3. `rt` (return type) Attribute
   - Specifies the destination state.
   - Indicates a transition to `#BlogPosting`.

4. Information Needed for the Transition
   - Specified by `descriptor href="#articleBody"`.
   - Represents the information needed to update the post.

In the preview screen:
1. The state diagram shows the state (`BlogPosting`) and an arrow representing the transition (`doUpdateBlogPosting`).
2. The vocabulary list displays information about the transition (`doUpdateBlogPosting`).


## Taxonomy (2): Integrating States and Transitions

So far, we have defined the terms (ontology), the information structure (taxonomy), and the state transitions (choreography). Now, let's integrate these elements to represent the complete blog system.

In XML:
```xml
<descriptor id="Blog" title="Blog">
    <descriptor href="#BlogPosting"/>
    <descriptor href="#goBlogPosting"/>
    <descriptor href="#doCreateBlogPosting"/>
    <descriptor href="#doUpdateBlogPosting"/>
</descriptor>
```

In JSON:
```json
{"id": "Blog", "title": "Blog", "descriptor": [
   {"href": "#BlogPosting"},
   {"href": "#goBlogPosting"},
   {"href": "#doCreateBlogPosting"},
   {"href": "#doUpdateBlogPosting"}
]}
```

This final structure represents the complete blog system, integrating all defined states and transitions.

### Summary of Blog Structure

1. **Information Structure**
   - BlogPosting: Represents the structure of a blog post (with `dateCreated` and `articleBody`).

2. **State Transitions**
   - goBlogPosting: A `safe` operation to view a blog post.
   - doCreateBlogPosting: An `unsafe` operation to create a new blog post.
   - doUpdateBlogPosting: An `idempotent` operation to update an existing blog post.

3. **Complete Blog System**
   - Blog: Integrates all states (`BlogPosting`) and transitions (`goBlogPosting`, `doCreateBlogPosting`, `doUpdateBlogPosting`).

In the preview screen:
1. The state diagram shows the complete structure of the blog system.
2. The vocabulary list displays all defined elements and their relationships.

## Conclusion: ALPS as a Design Methodology

In this tutorial, we learned how to use ALPS to design a blog system:

1. **Ontology**: Defining terms and their meanings.
2. **Taxonomy**: Structuring information.
3. **Choreography**: Defining state transitions.
4. **Integration**: Combining states and transitions to represent the complete system.

Using ALPS allows for clear and consistent API design, shared understanding among team members, and effective documentation.

The ALPS approach may initially seem like extra work, but as the project grows, its value becomes evident. Consistent design, clear documentation, and effective communication are key contributors to the long-term success of a project.


