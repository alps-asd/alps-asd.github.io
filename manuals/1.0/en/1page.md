---
layout: docs-en
title: 1 Page Manual
category: Manual
permalink: /manuals/1.0/en/1page.html
---
This is a page that brings together all the manual pages for BEAR.Sunday.

# Advanced Implementation Guide

## Overview

This document describes more advanced implementation topics for Application-Level Profile Semantics (alps). For a description of basic elements and attributes, please refer to the [alps Reference](reference.html).

## Descriptors and Link Relation Types

When including state transitions in representations, valid values for link relation types can be any of the following:

1. **Standard Link Relation Types**
   - Short strings registered in registries like IANA or Microformats.org
   - Example: `rel="edit"`, `rel="next"`, `rel="collection"`
   - See [IANA Link Relations](https://www.iana.org/assignments/link-relations/)

2. **Extended Link Relation Types** ([RFC8288])
   - Fully qualified URI for a document describing the relation type
   - Contains a URI fragment identifier for an alps descriptor
   - Example: `rel="http://alps.io/profiles/item#purchased-by"`
   - Example: `rel="http://alps.io/profiles/blog#comment"`

3. **alps Descriptor ID**
   - `id` attribute value of a state transition descriptor in an alps document
   - Usable only if the representation includes an alps profile
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

alps can be used in combination with various existing media types. Below, we explain how to integrate with major media types.

### HTML

In HTML, alps descriptors are primarily represented using the `class` attribute:

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

Corresponding alps profile:
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

## Referencing alps Documents

This section describes how to reference alps profiles when applying them.

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

Multiple alps profiles can be applied to a single representation:

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

## alps File Structure

The semantic descriptors in alps files are divided into three blocks in the following order:

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

## Hierarchical Structure Outside alps

In alps, hierarchical meanings can be expressed by position.

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

When creating alps profiles, it is recommended to add schema references.

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


# FAQ

<strong>Q. Who can use the software</strong>?

A. It can be used by anyone involved in site creation (engineers, designers, POs).

<strong>Q. What kind of people can write alps</strong>?

A. Anyone who can understand XML and JSON and can do simple HTML coding can write alps.

<strong>Q. How do you use it?</strong>

A. It is used to design a site by organizing information into the minimum necessary elements, and to design web and API services. The design can be expressed in formats such as JSON and XML, and documents such as transition diagrams and vocabulary lists can be generated. In addition, each producer can know the exact words, meanings and structures of information based on the information design.

<strong>Q. What is information design</strong>?

A. Based on IA (Information Architecture), it defines the information (meta-information) of information in terms of ontology (meaning of words), taxonomy (classification of information), and choreography (links).

<strong>Q. Is it used for design clarification</strong>?

A. No, it is not. It can be used as a modeling tool from the very early stage of site design to organize information and formulate what kind of site it will be.

<strong>Q. What do I need to write alps</strong>?

A. You need an editor to edit JSON and XML.

<strong>Q. Isn't it hard to edit XML and JSON directly</strong>?

A. If you use an editor that supports schemas such as WebStorm, you can edit them comfortably with completion and validation.

<strong>Q. Which is better, XML or JSON</strong>?

A. There is no difference in functionality. There is also no need to unify them when using multiple alps files. Please compare them in practice. [XML](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.xml) / [JSON](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.xml) [JSON](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.json)

<strong>Q. Can it be used for APIs without links</strong>?

A. Yes. It cannot represent a transition diagram, but it can generate a vocabulary and documentation of the nature of the information.

<strong>Q. Are there any other technologies that are similar to alps?</strong>

A. There are no direct competitors. A similar technology is [Microformat](http://www.asahi-net.or.jp/~ax2s-kmtn/internet/rec-owl-features-20040210.html).

<strong>Q. What is the difference from IDL such as OpenAPI</strong>?

A. alps deals with REST abstractions that are higher than HTTP. Therefore, it can be used as a modeling and design language for OpenAPI implementations.

<strong>Q. Do I need it</strong>?

A. If you want to model information to improve the quality of user experience, or if you want a reference (SSOT) to unify the understanding among production members, or if you want to overview and reuse your design, or if you want to keep your information design as a standardized document, alps+ASD will be useful as your information design modeling tool or as a format to express it.




# Information Architecture and alps

Applying Information Architecture (IA) concepts to domain modeling in API design and system development enables systematic organization of business requirements. The elements of IA—"meaning," "structure," and "interaction"—originally developed in UX and content design, play a crucial role in structuring business domain knowledge. alps provides a standardized method to express these concepts.

## Applying Information Architecture

Information Architecture expert Dan Klyn defined IA as the interplay of `Ontology`, `Taxonomy`, and `Choreography`. [^uia] These concepts serve as a foundation not only for content design but also for system design. While OpenAPI focuses on technical API details (endpoints, HTTP methods, request/response structures), alps uses these IA concepts to structure the business domain.

[^uia]: [Understanding Information Architecture](https://understandinggroup.com/ia-theory/understanding-information-architecture)

## Role in the Design Process

alps bridges business requirements and system design from the early stages of development. Unlike traditional endpoint-centric design, which typically starts with documenting predetermined API specifications, alps can be utilized from the requirements definition phase. This enables early detection and correction of differences in business requirement interpretations. It also establishes a common language between technical and business teams, providing a framework for easily understanding the scope of design changes.

alps goes beyond API endpoint design to provide a means of systematizing and sharing business domain knowledge. As a Single Source of Truth (SSOT), it consistently models system structure and behavior. Using business terminology at its core, it clearly expresses complex business rules, visualizes workflows, and enables intuitive understanding of information interactions.

## Adapting to Technical Changes

alps offers flexibility in its application to various API styles. Even as technology evolves and architecture styles change, business domain design can be maintained. For example, whether transitioning from RESTful APIs to GraphQL, adopting microservice architecture, or implementing new communication protocols, domain models defined in alps remain valid. This is because alps focuses on abstracted business logic rather than implementation details.

## Building Knowledge Foundation

In the implementation of `Taxonomy`, relationships between business entities are defined, ensuring scalability through hierarchical structure. This establishes a common vocabulary across the organization, streamlining communication. `Choreography` defines business process flows and service coordination rules, enhancing system-wide consistency and reliability.

Applying IA concepts to domain modeling naturally connects technical implementation with business requirements. alps functions as a framework to achieve this bridge, serving as a foundation for systematically structuring and evolving organizational knowledge.

Through this approach, organizations can build a sustainable knowledge foundation that remains resilient to technological changes.



# IANA Link Relations

This document lists IANA link relations recommended for use in the rel attribute of alps profiles.

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
1. This list is an excerpt of relations that are likely to be commonly used in alps profiles
2. For a complete list, refer to [IANA Registry](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
3. The categorization is for convenience
4. When using these relations, please select appropriate ones according to your application requirements



# Introduction

[![alps document](/images/alps.svg)](/alps/index.html)

## alps: A Format for Clarifying Application-Level Meaning and Structure

Application-Level Profile Semantics ([alps](http://alps.io/)) is a format that expresses application-level semantics and adds application-specific information to generic media such as JSON and HTML. alps clarifies the meaning, structure, and operations of data, enabling efficient development processes, enhanced system interoperability, and improved API reusability and discoverability.

Consider an e-commerce platform as an example. When integrating multiple payment services such as credit cards, digital money, and bank transfers, alps standardizes the meaning of data and operations at each step of the payment process. This makes it easier to add new payment methods and integrate with existing systems, allowing developers to implement APIs consistently. Frontend and backend developers can communicate efficiently using a common language, enabling rapid feature additions and improvements.

## ASD: Visualizing Application State Transitions

Application State Diagram (ASD) is a tool that visualizes state transitions and behaviors from alps documents. It enables intuitive understanding of an application's overall structure, state transitions, and possible actions. For example, in an online shopping application, it clearly visualizes the process from product search to purchase, helping developers understand the choices and possible operations users face at each stage. This aids in making design decisions that enhance the user experience.

With ASD, all team members—including product owners, backend and frontend developers, and UI/UX designers—can understand the application from the same perspective and work together effectively. This enables smooth communication between members from different specialties and helps new members quickly integrate into complex projects. Furthermore, it allows quick evaluation and adjustment of application flows and logic, providing opportunities to identify and resolve issues early in the design phase, directly contributing to improved development efficiency and application quality.

Through the use of ASD, project transparency increases, minimizing discrepancies in vision among team members.

## Information Architecture for REST Application Design

When designing REST applications from an information architecture perspective, alps and ASD complement each other in their roles. alps standardizes the meaning and structure of data handled by applications, enabling teams to define information using a common vocabulary. ASD, on the other hand, represents state changes in diagrams, making it easy to visually understand user operations and application responses. Through alps specifications and ASD visualization, information design in REST application development is strengthened, team communication becomes smoother, and the overall project consistency and quality are enhanced.

To improve development efficiency, deliver excellent user experiences, and ensure project sustainability, a shared understanding among diverse developers is essential. alps and ASD build this foundation and support the long-term success of projects.


# Introduction

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## alps: A way to organize app information

alps (Application Level Profile Semantics) is a way to neatly describe the information and mechanics of an app. It adds app-specific information to formats commonly used on the Internet (e.g., JSON and HTML) to clarify how the app works and what information it handles. This will make the process of creating the app smoother and allow different apps and systems to work well together.

For example, consider an online shopping site. For the sequence of steps (including payment) that a customer goes through to select and buy a product, alps can clearly show what is happening at each step. This makes it easier for those who create the app to make the necessary improvements to ensure a smooth shopping experience for customers.

## ASD: Diagrams showing how the app works

The ASD (Application State Transition Diagram) shows a diagram of how the app moves and the operations the user can perform based on the app information described in the alps. This allows you to understand at a glance how the app is working. In the case of an online shopping site, the diagram shows a series of steps, such as searching for a product, adding it to the cart, and paying for it.

ASD allows people in different roles in the team building the app, such as programmers and designers, to have a common understanding of how the app should work. This can be very helpful in discussions about how to improve the app and in coming up with new ideas.

## Designing REST Applications

alps and ASD are especially useful for designing apps that run on the web (called REST applications). Using these tools, you can clearly show what information the app handles and how it works. The result is an app that is easier to create and improve, and more user-friendly for the people using it.

In order for team members with diverse skills to work efficiently toward the same goal, it is important that they understand exactly what each other is working on, and alps and ASD are very useful tools to help them achieve this understanding.



# Resource

* [alps official](http://alps.io/)
* [RFC](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07)
* Skeleton
  * [json](https://github.com/alps-asd/alps-skeleton-json)
  * [xml](https://github.com/alps-asd/alps-skeleton-xml)
* [GitHub Action](https://github.com/marketplace/actions/app-state-diagram)
* [app-state-diagram](https://github.com/alps-asd/app-state-diagram)



# Prompts

## Create alps profile

Chat-GPT Plus users can use the alps Assistant, where instructions are given to the AI in advance so that the appropriate alps profile is generated by the AI.

- [alps Assistant](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant)

Alternatively, the following prompt can be used when the alps profile is generated by the AI. By following this prompt, you can create a consistent alps profile suitable for conversion in the prompts described below.

- [alps](#alps)

## Convert alps profile

While system implementation definitions such as OpenAPI, GraphQL, and SQL tend to become complex due to the many details they contain, alps can express the core information design of a system at a high level of abstraction through semantic descriptions.

This abstract representation enables efficient communication with AI and facilitates conversion to various concrete implementation forms such as API specifications, database schemas, and type definitions. By utilizing the prompts introduced here, you can efficiently generate various implementation definitions from alps.

## List of conversion prompts

- [OpenAPI](#openapi)
- [JSON Schema](#json-schema)
- [GraphQL](#graphql)
- [SQL](#sql)
- [TypeScript type definitions](#typescript-type-definitions)

## alps

<pre style="font-size: x-small">
# alps Profile Creation Prompt

Create an alps profile based on the following requirements, adhering to the guidelines described below:

* Format: [XML|JSON]
* Content: [Description of the profile to be created]

## ‼️ Important: JSON Format Guidelines ‼️

1. Write each descriptor on a single line (mandatory).
2. Only indent and line-break descriptors if they contain other descriptors.
3. All nested descriptors must reference their parent with `href`.

```json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "type": "semantic", "title": "Name", "def": "https://schema.org/name"},
{"id": "email", "type": "semantic", "title": "Email", "def": "https://schema.org/email"},
{"id": "User", "type": "semantic", "title": "User Profile", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "type": "semantic", "title": "User List", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "View User Details", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "Create User", "rt": "#UserList"}
]}}
```

## XML Format Guidelines

- Use indentation to indicate hierarchy.
- Write each element on a single line.

```xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
```

## Structuring Semantic Descriptors

Organize into the following three blocks. Each descriptor must either reference or contain other descriptors:

1. Semantic Definitions (Ontology)
   - Define basic elements (lowerCamelCase).
   - Always specify `def` as a full URL if there’s a Schema.org definition.
   - Add a `title` to all descriptors.
   - Include `doc` only if necessary.
   - Each defined element must be referenced by at least one taxonomy state.

2. Containment Relationships (Taxonomy)
   - Descriptors representing states use UpperCamelCase.
   - Use `href` for referencing elements (direct definition via `id` is not allowed).
   - Each application state includes:
     * Elements displayed/used in the state (defined in the ontology).
     * Actions that can be performed (defined in choreography).
   - Use `doc` for additional details if needed.
   - Each taxonomy must either contain or transition to other taxonomies.

3. State Transitions (Choreography)
   - Define transition actions.
   - Select the appropriate `type` attribute.
   - Specify the transition destination (`rt`).
   - Use `href` to refer to necessary data items.
   - Each operation must be referenced by at least one taxonomy state.

## Guidelines for Choosing the `type` Attribute

1. safe
   - Read-only operation.
   - Prefix: "go"
   - Example: `goUserProfile`
   - Represents a transition to another state.

2. idempotent
   - Operations where repeated execution has no effect on the outcome.
   - Prefix: "do"
   - Example: `doUpdateUser`, `doDeleteUser`
   - Typically PUT or DELETE actions.

3. unsafe
   - Operation with potentially different outcomes each time.
   - Prefix: "do"
   - Example: `doCreateUser`
   - Used for actions like creating new entries via POST.
   - **Note**: Prefer `idempotent` when possible; use `unsafe` only when necessary.

## Usage Guidelines for Descriptor Attributes

1. Required Attributes
   - `id`: Unique identifier (or `href`)
   - `title`: Human-readable display name.

2. Conditional Attributes
   - `def`: Required if there is a Schema.org definition.
   - `doc`: Use only if additional description is necessary.
   - `rt`: Required for transition operations.
   - `rel`: Specify if there’s an IANA-defined relation.
   - `tag`: Use for suitable grouping.

## Checklist

### General Format
- [ ] Schema reference and version information are included.
- [ ] All descriptors have a `title`.
- [ ] Any element with a Schema.org definition specifies `def` as a complete URL.
- [ ] Transition naming conventions are correct (go/do prefix).
- [ ] The chosen `type` is appropriate (especially distinguishing between `idempotent` and `unsafe`).
- [ ] Three blocks (Ontology, Taxonomy, and Choreography) are clearly defined.
- [ ] Naming conventions are followed (states in UpperCamelCase, elements in lowerCamelCase).
- [ ] All element references use `href` (no direct `id` definitions).
- [ ] Each application state is properly defined and includes executable actions.
- [ ] All operations specify appropriate transition destinations (`rt`).

### Relationship Verification (Mandatory)
- [ ] ‼️ All descriptors are either referenced by other descriptors or contain other descriptors.
- [ ] ‼️ All elements defined in the ontology are referenced by at least one taxonomy state.
- [ ] ‼️ All actions defined in choreography are referenced by at least one taxonomy state.
- [ ] ‼️ Each taxonomy element is contained in or transitions to other taxonomies.
- [ ] ‼️ No isolated descriptors exist.

### For JSON Format (Mandatory)
- [ ] ‼️ Each descriptor is on a single line.
- [ ] Indent and line-break only when descriptors contain other descriptors.
- [ ] Use double quotes for property names.

### For XML Format
- [ ] Properly indented.

</alps>
</pre>

## OpenAPI

<pre style="font-size: x-small">
**Task:** Convert the provided alps (Application-Level Profile Semantics) file into an OpenAPI 3.0 definition file in YAML format.

**Key Points to Consider:**

1. **Descriptor Elements:**
    - **Understanding `descriptor`:** In alps, a `descriptor` represents a semantic element, which can be a data element or a state transition.
    - **Mapping to OpenAPI Paths and Operations:**
        - For state transitions (`descriptor` with `type` of `safe`, `unsafe`, or `idempotent`), map these to OpenAPI operations under appropriate HTTP methods (`GET`, `POST`, `PUT`, `DELETE`).
        - Ensure idempotent operations use `PUT` or `DELETE`.
        - Do not include a request body for `DELETE` operations.

2. **Components and Reusability:**
    - **Schemas and Parameters:**
        - Extract data element descriptors (those with `type` of `semantic`) and define them as reusable schemas under `components/schemas`.
        - Use these schemas in request bodies and responses where applicable.
    - **Common Parameters:**
        - Identify common parameters (e.g., IDs, query parameters) and define them under `components/parameters` for reuse.

3. **Responses and Status Codes:**
    - **Appropriate Status Codes:**
        - Use `200 OK` for successful retrieval.
        - Use `201 Created` when a new resource is created.
        - Use `204 No Content` when an operation is successful but does not return content.
        - Use `400 Bad Request`, `404 Not Found`, etc., for error handling.
    - **Response Schemas:**
        - Define response schemas using the components defined earlier.

4. **Data Constraints:**
    - **Validation:**
        - Add data constraints such as:
            - **String Constraints:** `minLength`, `maxLength`, `pattern` (regular expressions).
            - **Numeric Constraints:** `minimum`, `maximum`.
            - **Enumerations:** `enum` for fixed sets of values.
    - **Applying Constraints:**
        - Apply these constraints to the schemas in `components/schemas`.

5. **Links and External Documentation:**
    - **Link Relations:**
        - If the `descriptor` includes `href` or `rel`, consider using OpenAPI's `externalDocs` or `links` to represent relationships.
    - **Descriptions:**
        - Use the `doc` element in alps to provide descriptions for operations, parameters, and schemas.

**Output Format:**
- Provide the OpenAPI definition in **YAML** format.

---

**Additional Notes:**

- Focus on accurately translating the alps descriptors into OpenAPI paths, operations, and components.
- Ensure that the resulting OpenAPI file is valid and follows best practices.
- Do not include unnecessary information from the alps file that does not contribute to the OpenAPI definition.


_YOUR_alps_HERE_
</pre>

## JSON Schema

<pre style="font-size: x-small">
**Task:** Convert the provided alps (Application-Level Profile Semantics) file into a JSON Schema definition.

**Key Points to Consider:**

1. **Descriptor Elements:**
    - **Understanding `descriptor`:** In alps, a `descriptor` represents a semantic element.
    - **Mapping to JSON Schema:**
        - Map data elements (`descriptor` with `type` of `semantic`) to JSON Schema properties.
        - Use appropriate JSON Schema types based on the data element's nature.

2. **Schema Structure:**
    - **Root Schema:**
        - Define the root schema with `$schema` and `type` properties.
        - Include appropriate metadata like `title` and `description`.
    - **Properties:**
        - Define properties based on alps descriptors.
        - Organize nested structures using `properties` and `items`.

3. **Data Types and Formats:**
    - **Basic Types:**
        - Use appropriate JSON Schema types:
            - `string`
            - `number`
            - `integer`
            - `boolean`
            - `object`
            - `array`
    - **Formats:**
        - Apply standard formats where applicable:
            - `date-time`
            - `date`
            - `email`
            - `uri`
            - etc.

4. **Data Constraints:**
    - **Validation Rules:**
        - Add constraints such as:
            - **Strings:** `minLength`, `maxLength`, `pattern`
            - **Numbers:** `minimum`, `maximum`, `multipleOf`
            - **Arrays:** `minItems`, `maxItems`, `uniqueItems`
            - **Objects:** `required`, `additionalProperties`
    - **Enumerations:**
        - Use `enum` for fixed sets of values
        - Include descriptions for enum values

5. **Definitions and References:**
    - **Reusable Components:**
        - Define common schemas under `$defs`
        - Use `$ref` to reference reusable schemas
    - **Inheritance:**
        - Use `allOf`, `anyOf`, or `oneOf` for complex type relationships

6. **Documentation:**
    - **Descriptions:**
        - Use alps `doc` elements for schema and property descriptions
    - **Examples:**
        - Include `examples` where helpful
    - **Titles:**
        - Add clear titles for properties and definitions

**Output Format:**
- Provide the JSON Schema in standard JSON format
- Use proper indentation for readability

**Additional Requirements:**
- The schema should be valid against JSON Schema Draft 2020-12
- Include appropriate `required` properties
- Use meaningful property names
- Add comments for complex validations or business rules

_YOUR_alps_HERE_
</pre>

## SQL

<pre style="font-size: x-small">
**Task:** Convert the provided alps (Application-Level Profile Semantics) file into SQL DDL (Data Definition Language) and DML (Data Manipulation Language) statements.

**Part 1: DDL Statements**

1. **Schema and Table Design:**
   - **Database Schema:**
      - Create an appropriate database schema name based on the alps profile
      - Include schema versioning considerations
   - **Table Creation:**
      - Map alps descriptors with `type` of `semantic` to database tables
      - Handle nested structures through table relationships

**Part 2: DML Statement Generation**

1. **SELECT Queries:**
    - **Basic Queries:**
        - Generate SELECT statements for each main resource
        - Include appropriate JOIN clauses based on relationships
        - Add WHERE clauses for filtering
        - Consider pagination (LIMIT/OFFSET)

    - **Complex Queries:**
        - Create queries with multiple JOINs
        - Add subqueries where appropriate
        - Include aggregate functions (COUNT, SUM, etc.)
        - Implement GROUP BY and HAVING clauses

    - **View Queries:**
        - Generate useful view definitions
        - Create materialized views for performance

2. **INSERT Statements:**
    - Generate INSERT statements with:
        - Single row insertions
        - Bulk insert templates
        - INSERT ... SELECT patterns
        - RETURNING clauses where applicable

3. **UPDATE Statements:**
    - Create UPDATE templates for:
        - Single record updates
        - Bulk updates
        - Updates with JOINs
        - Conditional updates

    - Include:
        - WHERE clauses for safe updates
        - UPDATE triggers consideration
        - Optimistic locking patterns

4. **DELETE Statements:**
    - Generate DELETE statements with:
        - Safe deletion patterns
        - Soft delete implementations
        - Cascade delete considerations
        - Archive strategies

5. **Transaction Patterns:**
    - Create transaction templates for:
        - Complex operations
        - Data consistency
        - Error handling
        - Rollback scenarios

6. **Common Query Patterns:**
    - **Search:**
        - Full-text search queries
        - Pattern matching (LIKE/ILIKE)
        - Fuzzy matching

    - **Reporting:**
        - Summary queries
        - Time-based aggregations
        - Cross-table analytics

    - **Audit:**
        - Change tracking queries
        - History viewing
        - Activity logs

**Output Format Requirements:**

1. **DDL Format:**
    - Complete CREATE statements
    - Index definitions
    - Constraint definitions
    - Comment blocks explaining design decisions

2. **DML Format:**
    - Parameterized queries using :param or $n notation
    - Comments explaining complex logic
    - Performance considerations
    - Expected index usage

3. **Query Organization:**
    - Group related queries together
    - Include use case descriptions
    - Document expected results
    - Note any specific database engine requirements

**Additional Considerations:**

1. **Performance:**
    - Index usage hints
    - EXPLAIN plan considerations
    - Query optimization suggestions
    - Batch processing patterns

2. **Security:**
    - SQL injection prevention
    - Permission requirements
    - Row-level security patterns
    - Audit trail implementation

3. **Maintainability:**
    - Clear query structure
    - Consistent naming conventions
    - Reusable components (CTEs, Views)
    - Documentation of complex logic

4. **Error Handling:**
    - EXCEPTION blocks
    - Transaction management
    - Deadlock handling
    - Constraint violation handling

_YOUR_alps_HERE_
</pre>

## GraphQL

<pre style="font-size: x-small">

**Task:** Convert the provided alps (Application-Level Profile Semantics) file into a complete GraphQL implementation including schema definitions and operation examples.

**Key Points to Consider:**

1. **Schema Definition:**
   - **Type Definitions:**
     - Map alps semantic descriptors to GraphQL types
     - Use appropriate scalar types (ID, String, Int, Float, Boolean)
     - Define custom scalar types if needed (DateTime, JSON, etc.)
     ```graphql
     scalar DateTime
     scalar JSON

     type User {
       id: ID!
       name: String!
       email: String!
       createdAt: DateTime!
       metadata: JSON
     }
     ```

   - **Relationships:**
     - Handle one-to-one, one-to-many, and many-to-many relationships
     - Consider nullable vs. non-nullable fields
     ```graphql
     type Order {
       id: ID!
       user: User!
       items: [OrderItem!]!
       total: Float!
     }
     ```

   - **Input Types:**
     - Create input types for mutations
     - Consider validation requirements
     ```graphql
     input CreateUserInput {
       name: String!
       email: String!
       password: String!
     }
     ```

   - **Interfaces and Unions:**
     - Define interfaces for shared fields
     - Use unions for polymorphic relationships
     ```graphql
     interface Node {
       id: ID!
     }

     union SearchResult = User | Order | Product
     ```

2. **Query Operations:**
   - **Base Queries:**
     - Single item retrieval
     - List retrieval with filtering
     - Search operations
     ```graphql
     type Query {
       user(id: ID!): User
       users(filter: UserFilter, limit: Int, offset: Int): [User!]!
       search(term: String!): [SearchResult!]!
     }
     ```

   - **Filtering System:**
     - Define filter input types
     - Support complex filtering operations
     ```graphql
     input UserFilter {
       name: StringFilter
       age: IntFilter
       AND: [UserFilter!]
       OR: [UserFilter!]
     }

     input StringFilter {
       eq: String
       contains: String
       startsWith: String
       in: [String!]
     }
     ```

   - **Pagination:**
     - Implement cursor-based pagination
     - Support limit/offset pagination
     ```graphql
     type UserConnection {
       edges: [UserEdge!]!
       pageInfo: PageInfo!
       totalCount: Int!
     }

     type UserEdge {
       node: User!
       cursor: String!
     }

     type PageInfo {
       hasNextPage: Boolean!
       hasPreviousPage: Boolean!
       startCursor: String
       endCursor: String
     }
     ```

3. **Mutation Operations:**
   - **Create Operations:**
     ```graphql
     type Mutation {
       createUser(input: CreateUserInput!): CreateUserPayload!
       updateUser(id: ID!, input: UpdateUserInput!): UpdateUserPayload!
       deleteUser(id: ID!): DeleteUserPayload!
     }

     type CreateUserPayload {
       user: User
       errors: [Error!]
     }
     ```

   - **Batch Operations:**
     ```graphql
     input BatchCreateUserInput {
       users: [CreateUserInput!]!
     }

     type BatchCreateUserPayload {
       users: [User!]!
       errors: [BatchError!]!
     }
     ```

   - **Error Handling:**
     ```graphql
     type Error {
       field: String
       message: String!
       code: ErrorCode!
     }

     type BatchError {
       index: Int!
       errors: [Error!]!
     }

     enum ErrorCode {
       INVALID_INPUT
       NOT_FOUND
       UNAUTHORIZED
       INTERNAL_ERROR
     }
     ```

4. **Subscription Operations:**
   ```graphql
   type Subscription {
     userUpdated(id: ID): User!
     newOrder: Order!
     notifications(userId: ID!): Notification!
   }
   ```

5. **Directives:**
   ```graphql
   directive @auth(
     requires: Role = USER
   ) on OBJECT | FIELD_DEFINITION

   directive @deprecated(
     reason: String = "No longer supported"
   ) on FIELD_DEFINITION | ENUM_VALUE

   enum Role {
     ADMIN
     USER
     GUEST
   }
   ```

**Part 2: Implementation Guidelines**

1. **Resolver Structure:**
   ```typescript
   // Example resolver structure
   const resolvers = {
     Query: {
       user: (parent, { id }, context) => {},
       users: (parent, { filter, limit, offset }, context) => {}
     },
     Mutation: {
       createUser: (parent, { input }, context) => {}
     },
     User: {
       orders: (parent, args, context) => {}
     }
   }
   ```

2. **Context and Authentication:**
   ```typescript
   interface Context {
     user: User | null;
     dataSources: DataSources;
     authenticate: () => Promise<User>;
   }
   ```

3. **Best Practices:**
    - Use DataLoader for N+1 query prevention
    - Implement proper error handling
    - Follow naming conventions
    - Add field-level documentation
    - Consider rate limiting
    - Implement proper authorization

**Additional Considerations:**

1. **Performance:**
    - Query complexity analysis
    - Field-level cost calculation
    - Caching strategies
    - Batching optimizations

2. **Security:**
    - Input validation
    - Authorization checks
    - Rate limiting
    - Query depth limiting

3. **Testing:**
    - Unit tests for resolvers
    - Integration tests for operations
    - Schema validation tests
    - Performance benchmarks

**Output Format Requirements:**

1. **Schema Organization:**
    - Separate files for different concerns
    - Clear module structure
    - Proper type imports/exports

2. **Documentation:**
    - Schema documentation
    - Operation examples
    - Use cases
    - Error scenarios

Please provide your alps document and I'll help you convert it to a GraphQL implementation following these guidelines.

_YOUR_alps_HERE_

</User></pre>

## TypeScript type definitions

<pre style="font-size: x-small">
**Task:** Convert the provided alps (Application-Level Profile Semantics) file into TypeScript type definitions, interfaces, and related utilities.

**Part 1: Core Type Definitions**

1. **Base Types and Interfaces:**
    - **Entity Types:**
        ```typescript
        // Example of expected output:
        interface User {
          id: string;
          email: string;
          name: string;
          status: UserStatus;
          createdAt: Date;
          updatedAt: Date;
        }

        enum UserStatus {
          Active = 'ACTIVE',
          Inactive = 'INACTIVE',
          Suspended = 'SUSPENDED'
        }
        ```

    - **Nested Types:**
        ```typescript
        interface Address {
          street: string;
          city: string;
          postalCode: string;
          country: string;
        }

        interface UserWithAddress extends User {
          address?: Address;
        }
        ```

2. **Utility Types:**
    - **Partial Types:**
        ```typescript
        type UpdateUserPayload = Partial<Omit<User, 'id' | 'createdAt' | 'updatedAt'>>;
        ```
    
    - **Pick Types:**
        ```typescript
        type UserCredentials = Pick<User, 'email' | 'password'>;
        ```
    
    - **Record Types:**
        ```typescript
        type UsersByID = Record<string, User>;
        ```

3. **Generic Types:**
    - **Response Wrappers:**
        ```typescript
        interface PaginatedResponse<T> {
          items: T[];
          totalCount: number;
          pageInfo: {
            hasNextPage: boolean;
            hasPreviousPage: boolean;
            startCursor: string;
            endCursor: string;
          };
        }
        ```

    - **Error Handling:**
        ```typescript
        interface ApiError {
          code: string;
          message: string;
          field?: string;
        }

        type Result<T> = 
          | { success: true; data: T }
          | { success: false; error: ApiError };
        ```

**Part 2: API Types**

1. **Request/Response Types:**
    ```typescript
    // Request types
    interface CreateUserRequest {
      email: string;
      name: string;
      password: string;
      address?: Address;
    }

    interface UpdateUserRequest {
      userId: string;
      data: UpdateUserPayload;
    }

    // Response types
    interface CreateUserResponse {
      user: User;
      token: string;
    }

    interface UpdateUserResponse {
      user: User;
      modified: Array<keyof User>;
    }
    ```

2. **Query Parameters:**
    ```typescript
    interface UserQueryParams {
      search?: string;
      status?: UserStatus;
      sortBy?: keyof User;
      sortOrder?: 'asc' | 'desc';
      page?: number;
      pageSize?: number;
    }
    ```

3. **API Client Types:**
    ```typescript
    interface ApiClient {
      users: {
        create(data: CreateUserRequest): Promise<Result<CreateUserResponse>>;
        update(data: UpdateUserRequest): Promise<Result<UpdateUserResponse>>;
        delete(userId: string): Promise<Result<void>>;
        get(userId: string): Promise<Result<User>>;
        list(params: UserQueryParams): Promise<Result<PaginatedResponse<User>>>;
      };
    }
    ```

**Part 3: Validation Schemas**

1. **Zod Schemas:**
    ```typescript
    import { z } from 'zod';

    const UserSchema = z.object({
      id: z.string().uuid(),
      email: z.string().email(),
      name: z.string().min(2).max(100),
      status: z.enum(['ACTIVE', 'INACTIVE', 'SUSPENDED']),
      createdAt: z.date(),
      updatedAt: z.date()
    });

    type UserFromSchema = z.infer<typeof UserSchema>;
    ```

2. **Custom Validators:**
    ```typescript
    type Validator<T> = {
      validate: (value: unknown) => value is T;
      errors: () => string[];
    };
    ```

**Part 4: Helper Types**

1. **State Management:**
    ```typescript
    interface EntityState<T> {
      data: Record<string, T>;
      loading: boolean;
      error: ApiError | null;
      selectedId: string | null;
    }

    type EntityActions<T> = 
      | { type: 'SET_DATA'; payload: Record<string, T> }
      | { type: 'SET_LOADING'; payload: boolean }
      | { type: 'SET_ERROR'; payload: ApiError | null }
      | { type: 'SELECT'; payload: string | null };
    ```

2. **Event Types:**
    ```typescript
    interface EntityEvent<T> {
      type: 'created' | 'updated' | 'deleted';
      entity: T;
      timestamp: Date;
      actor: string;
    }
    ```

**Additional Considerations:**

1. **Type Guards:**
    ```typescript
    function isUser(value: unknown): value is User {
      return (
        typeof value === 'object' &&
        value !== null &&
        'id' in value &&
        'email' in value &&
        'name' in value
      );
    }
    ```

2. **Mapped Types:**
    ```typescript
    type ResourceActions<T> = {
      [K in keyof T as `update${Capitalize<string & K>}`]: 
        (value: T[K]) => Promise<void>
    };
    ```

3. **Conditional Types:**
    ```typescript
    type NonNullableFields<T> = {
      [K in keyof T]: NonNullable<T[K]>;
    };
    ```

**Output Requirements:**

1. **File Organization:**
    ```typescript
    // models/index.ts
    export * from './user';
    export * from './address';
    
    // models/user.ts
    export interface User { ... }
    export type UserCreate = ...
    export type UserUpdate = ...
    ```

2. **Documentation:**
    ```typescript
    /**
     * Represents a user in the system
     * @property {string} id - Unique identifier
     * @property {string} email - User's email address
     */
    export interface User {
      id: string;
      email: string;
      // ...
    }
    ```

3. **Type Exports:**
    ```typescript
    export type {
      User,
      UserCreate,
      UserUpdate,
      UserQueryParams,
      // ...
    };
    ```
_YOUR_alps_HERE_

</pre>




# Installation and Usage Guide

ASD (app-state-diagram) is a tool for creating comprehensive alps documentation that includes application state transition diagrams and vocabulary lists. It can be used in the following ways:

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

You can live edit alps files while viewing the preview screen using the VSCode Plugin (experimental).

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


# Reference

## Overview

Application-Level Profile Semantics (alps) is a document format for describing application semantics. This document explains the elements and attributes of alps.

## Document Structure

alps documents have the following hierarchical structure:

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

alps documents can be written in two formats:

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

The root element of an alps document.

Attributes:
- version: Document version (required)

### descriptor

Defines the meaning (semantics) of application functions and information.
Either id or href is required; other attributes are optional.

### List of descriptor Attributes

| Attribute | Required | Type | Description | Example |
|-||-|--||
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



# Recommended Semantic Terms

## Overview

This document provides a complete list of terms from [Schema.org](https://schema.org) vocabulary that can be used as semantic descriptors (id) in alps profiles.

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
- [alps Specification](http://alps.io/spec/)




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

alps files that import semantics from [Schema.org](https://schema.org) are available.

* [Schema.org alps Index](https://alps-io.github.io/imports/schema.org)

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
<img src="/images/slide/app-state-diagram.003.jpeg" alt="A state transition diagram for alps and a list of related semantic descriptors. This shows alps as a common language for website construction.">
</div>
<p class="description">Similarly, alps document is that common language when it comes to building a website.</p>



<a class="intl btn btn-light" id="learn" href="/manuals/1.0/en/index.html">
    Learn More &raquo;
</a>
<script src="/js/switch_intl.js"></script>
<script src="/js/speech.js"></script>


# alps Basic Tutorial

The alps tutorial consists of two parts:

1. **Basic Tutorial** (this page)
   - Learn the basic usage of alps through hands-on practice
   - Start with tool usage and gradually understand alps features
   - Ideal as the first step to getting started with alps

2. **[Advanced Tutorial](./tutorial_rest.html)**
   - Learn about the theoretical foundation and design patterns of alps
   - Understand the essence of REST/HTTP applications as state transition systems
   - For those who want a deeper understanding or are involved in large-scale application design

We recommend starting with this basic tutorial.

---

## Getting Started

In this tutorial, we'll use the browser-based alps editor:

1. Open [alps Editor]( https://editor.app-state-diagram.com/)
2. Delete all demo code displayed in the left editor pane

Note: While you can use the ASD application in a local environment, we recommend using the online editor for this tutorial.

## First Step: Preparing an Empty File

The first step in creating an alps document is to prepare a basic empty file. This file serves as the starting point with the minimum structure required for all alps documents.

alps documents can be written in either XML or JSON format. Each format references its respective schema (xsd for XML, json-schema for JSON) which defines the valid structure and ensures your document follows the alps specification. There is no functional difference between the two formats, so you can choose based on your team's preferences and existing toolchain.

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

In alps, specific terms handled by the application are defined as IDs. Let's start by adding the term `dateCreated`.

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

One of alps's important roles is to serve as a dictionary of application terms. It helps users use the same terms when referring to the same meaning, preventing expression variations and misunderstandings among users.

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



# alps Tutorial for REST Applications

## Introduction

Modern web applications (online shopping, social networks, video streaming services, business systems, etc.) are mostly built based on the REST architecture. In this tutorial, we will explain how to design applications using alps, considering the basic concepts of REST.

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

## Information Architecture and alps

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

alps is a means to practically express these concepts. In the following sections of this tutorial:

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

Choreography defines state transitions according to the types of operations. In alps, operations are categorized as follows:

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

alps operations distinguish between resource changes that have a different result each time they are performed, i.e., non-idempotent operations, such as add operations, and those that have a different result each time they are performed, i.e., idempotent operations, such as change or delete operations, which do not change the result no matter how many times they are repeated.

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

## Conclusion: alps as a Design Methodology

In this tutorial, we learned how to use alps to design a blog system:

1. **Ontology**: Defining terms and their meanings.
2. **Taxonomy**: Structuring information.
3. **Choreography**: Defining state transitions.
4. **Integration**: Combining states and transitions to represent the complete system.

Using alps allows for clear and consistent API design, shared understanding among team members, and effective documentation.

The alps approach may initially seem like extra work, but as the project grows, its value becomes evident. Consistent design, clear documentation, and effective communication are key contributors to the long-term success of a project.


