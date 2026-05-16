---
layout: docs-en
title: ALPS/ASD Complete Manual
category: Manual
permalink: /manuals/1.0/en/1page.html
---

# ALPS/ASD Complete Manual

This comprehensive manual contains the main ALPS/ASD documentation in a single page for easy reference, printing, or offline viewing.

***
# Introduction

[![ALPS document](/alps/cart/alps.svg)](/alps/cart/)

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

***

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

***

# Installation and Usage Guide

ASD (app-state-diagram) is a tool for creating comprehensive ALPS documentation that includes application state transition diagrams and vocabulary lists. It can be used in the following ways:

## Choosing Usage Method

### 1. Online Version

Use immediately without local installation:

- [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/)

Features:
- JSON/XML/HTML files can be loaded via drag & drop
- Snippets and advanced code completion

### 2. Homebrew Version (Recommended)

Easiest to use in environments where [homebrew](https://brew.sh) is installed. It also always stays up-to-date with the latest version.

Installation:

```bash
brew install alps-asd/asd/asd
```

### 3. npm Version

Available in environments with Node.js 20 or higher installed.

Installation:

```bash
npm install -g @alps-asd/app-state-diagram
```

### 4. GitHub Actions Version

Create ASD in CI. See [marketplace](https://github.com/marketplace/actions/app-state-diagram) for details.

### 5. Language Server (experimental)

A Language Server that provides real-time validation, code completion, and hover information for editors such as Vim and VSCode.

[GitHub - alps-lsp](https://github.com/alps-asd/alps-lsp)

## Usage

### Running Demo
```bash
# Download and run demo file
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### Command Line Options
```text
asd [options] alps_file

Options:
  -v, --version          Show version information
  -e, --echo             Output to stdout instead of file
  -f, --format <format>  Output format (html|svg|dot|mermaid)
  -o, --output <file>    Output file (default: <input>.html)
  --label <mode>         Label mode: id or title
  --validate             Validate ALPS profile
  -w, --watch            Watch mode with live reload
  --port <port>          CDP port for watch mode (default: 9222)

Commands:
  merge <base> <source>  Merge ALPS profiles
```

## Installation Verification

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## Selection Guidelines

- Quick trial, temporary use → Online version
- Local use (Mac/Linux) → Homebrew version
- Node.js environment → npm version
- CI/CD environment use → GitHub Actions version

For other installation methods, see [Legacy Installation](/manuals/1.0/en/legacy-install.html).

***

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

***

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

***

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

A blog post (BlogPosting) can be defined as a collection of information with an ID, creation date, and body.

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="id" title="ID">
        <doc format="text">The ID that uniquely identifies the post</doc>
    </descriptor>
    <descriptor id="dateCreated" title="Creation Date">
        <doc format="text">Represents the date the post was created, in ISO8601 format</doc>
    </descriptor>
    <descriptor id="articleBody" title="Article Body">
        <doc format="text">The body of the blog post</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="Blog Post">
        <descriptor href="#id"/>
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
         {"id": "id", "title": "ID", "doc": {"format": "text", "value": "The ID that uniquely identifies the post"}},
         {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the date the post was created, in ISO8601 format"}},
         {"id": "articleBody", "title": "Article Body", "doc": {"format": "text", "value": "The body of the blog post"}},
         {"id": "BlogPosting", "title": "Blog Post", "descriptor": [
            {"href": "#id"},
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
   - `BlogPosting` includes `id`, `dateCreated`, and `articleBody`.
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
| ---- | ---- | ---- |
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

ALPS operations distinguish between resource changes that may produce a different result each time, such as create operations, and idempotent changes, such as update or delete operations, which produce the same result no matter how many times they are repeated.

### Defining the Transition to View an Article

First, let’s define a `safe` operation to view a blog post:

In XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
    <descriptor id="id" title="ID">
        <doc format="text">The ID that uniquely identifies the post</doc>
    </descriptor>
    <descriptor id="dateCreated" title="Creation Date">
        <doc format="text">Represents the date the post was created, in ISO8601 format</doc>
    </descriptor>
    <descriptor id="articleBody" title="Article Body">
        <doc format="text">The body of the blog post</doc>
    </descriptor>
    <descriptor id="BlogPosting" title="Blog Post">
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="View Blog Post">
        <descriptor href="#id"/>
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
            {"id": "id", "title": "ID", "doc": {"format": "text", "value": "The ID that uniquely identifies the post"}},
            {"id": "dateCreated", "title": "Creation Date", "doc": {"format": "text", "value": "Represents the date the post was created, in ISO8601 format"}},
            {"id": "articleBody", "title": "Article Body", "doc": {"format": "text", "value": "The body of the blog post"}},
            {"id": "BlogPosting", "title": "Blog Post", "descriptor": [
               {"href": "#id"},
               {"href": "#dateCreated"},
               {"href": "#articleBody"}
            ]},
            {"id": "goBlogPosting", "type": "safe", "rt": "#BlogPosting", "title": "View Blog Post", "descriptor": [
               {"href": "#id"}
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
   - Specified by `descriptor href="#id"`.
   - Represents the information needed to uniquely identify the post.

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
    <descriptor href="#id"/>
    <descriptor href="#articleBody"/>
</descriptor>
```

In JSON:
```json
{"id": "doUpdateBlogPosting", "type": "idempotent", "rt": "#BlogPosting", "title": "Update Blog Post", "descriptor": [
   {"href": "#id"},
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
   - Specified by `descriptor href="#id"` and `descriptor href="#articleBody"`.
   - Represents the information needed to identify and update the post.

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
   - BlogPosting: Represents the structure of a blog post (with `id`, `dateCreated`, and `articleBody`).

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

***

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
  - Must use URL-safe characters (compliant with [RFC3986](https://www.rfc-editor.org/rfc/rfc3986))

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

***

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

**IMPORTANT: Safe transitions (`go*`) MUST include the target state name in their id.**

```json
[
  {"id": "goProductList", "type": "safe", "rt": "#ProductList"},
  {"id": "goUserProfile", "type": "safe", "rt": "#UserProfile"},
  {"id": "goCheckout", "type": "safe", "rt": "#Checkout"}
]
```

This rule ensures consistency and makes the diagram self-documenting. When a transition has no source state (entry point), it will be displayed as originating from `UnknownState` in the diagram.

❌ **Invalid examples:**

```json
[
  {"id": "goStart", "type": "safe", "rt": "#ProductList"},
  {"id": "goNext", "type": "safe", "rt": "#Checkout"}
]
```

- `goStart` → should be `goProductList`
- `goNext` → should be `goCheckout`

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

## Tag Naming

Tags classify descriptors along multiple orthogonal axes. Use prefixed names for supplementary categories and leave the most fundamental category — the domain — unprefixed.

| Prefix | Category | Examples |
|--------|----------|----------|
| *(none)* | Domain | `catalog`, `order`, `checkout` |
| `flow-` | Workflow | `flow-purchase`, `flow-register` |
| `actor-` | Actor | `actor-admin`, `actor-customer` |

The domain category is unprefixed because it is the most universal dimension — nearly every descriptor belongs to a domain. Prefixing it (e.g. `domain-catalog`) would add noise without information. This follows the same principle as default namespaces in programming languages.

A single descriptor can carry tags from multiple axes:

```json
{"id": "doAddCart", "type": "unsafe", "rt": "#Cart",
  "tag": "cart flow-purchase actor-customer"}
```

Here `cart` is the domain, `flow-purchase` is the workflow, and `actor-customer` is who performs the action.

When a profile grows beyond a handful of tags, document the tag taxonomy in a separate file (e.g. `tag.md`) and link it from the profile:

```json
{
  "alps": {
    "link": [
      {"rel": "describedby", "href": "tag.md", "title": "Tag taxonomy"}
    ]
  }
}
```

This keeps the tag definitions human-readable and reviewable outside the profile itself.

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

***

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

***

# IANA Link Relations

This document lists IANA link relations recommended for use in the rel attribute of ALPS profiles.

## State Transitions

| Relation | Description |
|----------|-------------|
| edit | Represents a transition to edit the target state |
| edit-form | Represents a transition to get the edit form |
| create-form | Represents a transition to get the creation form |
| collection | Transition to a state representing the entire collection |
| item | Transition to a state representing an individual element of a collection |

## Ordered Transitions

| Relation | Description |
|----------|-------------|
| first | Transition to the first state in a series |
| last | Transition to the last state in a series |
| next | Transition to the next state in a series |
| prev | Transition to the previous state in a series |

## Semantic Description

| Relation | Description |
|----------|-------------|
| describedby | Reference to detailed description of a semantic descriptor |
| describes | Reference to what the semantic descriptor describes (inverse of describedby) |
| type | Indicates the abstract type of a semantic descriptor |

## Document Structure

| Relation | Description |
|----------|-------------|
| section | Indicates a section in a document |
| subsection | Indicates a subsection in a document |
| chapter | Indicates a chapter in a document |
| contents | Indicates the table of contents of a document |

## Metadata

| Relation | Description |
|----------|-------------|
| author | Reference to author information |
| license | Reference to license information |
| copyright | Reference to copyright information |

## Version Control

| Relation | Description |
|----------|-------------|
| latest-version | Transition to the latest version state |
| predecessor-version | Transition to the previous version state |
| successor-version | Transition to the next version state |
| version-history | Transition to a state showing version history |

## Related Information

| Relation | Description |
|----------|-------------|
| help | Reference to help information |
| status | Reference to state information |
| alternate | Reference to alternative representation |

Notes:
1. This list is an excerpt of relations that are likely to be commonly used in ALPS profiles
2. For a complete list, refer to [IANA Registry](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
3. The categorization is for convenience
4. When using these relations, please select appropriate ones according to your application requirements

***

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

***

## Terms by Category

### Basic Properties

| Term | Level | Description |
|------|--------|------------|
| name | 🔵 | Name |
| description | 🔵 | Description |
| url | 🔵 | URL |
| alternateName | 🔵 | Alternative name |
| title | 🔵 | Title |
| text | 🔵 | Text |
| value | 🔵 | Value |
| additionalValue | 🟡 | Additional value |
| defaultValue | 🟡 | Default value |
| maxValue | 🟡 | Maximum value |
| minValue | 🟡 | Minimum value |
| multipleValues | 🟡 | Multiple values |
| propertyID | 🟡 | Property ID |
| valueReference | 🟡 | Value reference |
| valueRequired | 🟡 | Required value |
| unitCode | ⚪ | Unit code |
| unitText | ⚪ | Unit text |
| propertyType | ⚪ | Property type |
| propertyValue | ⚪ | Property value |
| measurementTechnique | ⚪ | Measurement technique |

### Identifiers & References

| Term | Level | Description |
|------|--------|------------|
| identifier | 🔵 | Identifier |
| id | 🔵 | ID |
| sameAs | 🔵 | Same as reference |
| mainEntity | 🔵 | Main entity |
| about | 🟡 | About |
| mentions | 🟡 | Mentions |
| citation | 🟡 | Citation |
| reference | 🟡 | Reference |
| referencesOrder | 🟡 | Reference order |
| isBasedOn | 🟡 | Is based on |
| isPartOf | 🟡 | Is part of |
| hasPart | 🟡 | Has part |
| itemListElement | 🟡 | Item list element |
| itemListOrder | 🟡 | Item list order |
| position | 🟡 | Position |
| isVersionOf | ⚪ | Is version of |
| predecessorOf | ⚪ | Predecessor of |
| successorOf | ⚪ | Successor of |
| isRelatedTo | ⚪ | Is related to |
| isSimilarTo | ⚪ | Is similar to |
| isVariantOf | ⚪ | Is variant of |
| exampleOfWork | ⚪ | Example of work |
| workExample | ⚪ | Work example |
| isBasedOnUrl | ⚪ | Is based on URL |

### Metadata

| Term | Level | Description |
|------|--------|------------|
| version | 🔵 | Version |
| status | 🔵 | Status |
| category | 🔵 | Category |
| keywords | 🔵 | Keywords |
| type | 🔵 | Type |
| format | 🔵 | Format |
| language | 🔵 | Language |
| source | 🔵 | Source |
| license | 🟡 | License |
| creator | 🟡 | Creator |
| editor | 🟡 | Editor |
| publisher | 🟡 | Publisher |
| contributor | 🟡 | Contributor |
| rights | 🟡 | Rights |
| copyrightHolder | 🟡 | Copyright holder |
| copyrightYear | 🟡 | Copyright year |
| creditText | 🟡 | Credit text |
| maintainer | 🟡 | Maintainer |
| schemaVersion | ⚪ | Schema version |
| usageInfo | ⚪ | Usage information |
| encoding | ⚪ | Encoding |
| isAccessibleForFree | ⚪ | Is accessible for free |
| conditionsOfAccess | ⚪ | Conditions of access |
| contentReferenceTime | ⚪ | Content reference time |

### Dates & Periods

| Term | Level | Description |
|------|--------|------------|
| dateCreated | 🔵 | Date created |
| dateModified | 🔵 | Date modified |
| datePublished | 🔵 | Date published |
| startDate | 🔵 | Start date |
| endDate | 🔵 | End date |
| startTime | 🔵 | Start time |
| endTime | 🔵 | End time |
| duration | 🔵 | Duration |
| validFrom | 🔵 | Valid from |
| validThrough | 🔵 | Valid through |
| dateDeleted | 🟡 | Date deleted |
| dateRead | 🟡 | Date read |
| dateReceived | 🟡 | Date received |
| dateSent | 🟡 | Date sent |
| dateIssued | 🟡 | Date issued |
| scheduleTime | 🟡 | Schedule time |
| birthDate | 🟡 | Birth date |
| deathDate | 🟡 | Death date |
| foundingDate | 🟡 | Founding date |
| dissolutionDate | 🟡 | Dissolution date |
| previousStartDate | ⚪ | Previous start date |
| uploadDate | ⚪ | Upload date |
| modifiedTime | ⚪ | Modified time |
| expires | ⚪ | Expires |
| temporalCoverage | ⚪ | Temporal coverage |

### Text & Content

| Term | Level | Description |
|------|--------|------------|
| title | 🔵 | Title |
| text | 🔵 | Text |
| content | 🔵 | Content |
| articleBody | 🔵 | Article body |
| headline | 🔵 | Headline |
| abstract | 🔵 | Abstract |
| description | 🔵 | Description |
| comment | 🔵 | Comment |
| contentType | 🔵 | Content type |
| encodingFormat | 🟡 | Encoding format |
| wordCount | 🟡 | Word count |
| characterCount | 🟡 | Character count |
| pagination | 🟡 | Pagination |
| pageStart | 🟡 | Page start |
| pageEnd | 🟡 | Page end |
| section | 🟡 | Section |
| chapter | 🟡 | Chapter |
| articleSection | 🟡 | Article section |
| speakable | ⚪ | Speakable text |
| textTemplate | ⚪ | Text template |
| cssSelector | ⚪ | CSS selector |
| xpath | ⚪ | XPath |
| transcript | ⚪ | Transcript |
| translationOfWork | ⚪ | Translation of work |
| workTranslation | ⚪ | Work translation |

### Media & Files

| Term | Level | Description |
|------|--------|------------|
| image | 🔵 | Image |
| audio | 🔵 | Audio |
| video | 🔵 | Video |
| file | 🔵 | File |
| fileSize | 🔵 | File size |
| fileFormat | 🔵 | File format |
| contentUrl | 🔵 | Content URL |
| thumbnailUrl | 🔵 | Thumbnail URL |
| downloadUrl | 🔵 | Download URL |
| embedUrl | 🟡 | Embed URL |
| height | 🟡 | Height |
| width | 🟡 | Width |
| duration | 🟡 | Duration |
| bitrate | 🟡 | Bitrate |
| encodingFormat | 🟡 | Encoding format |
| playerType | 🟡 | Player type |
| productionCompany | 🟡 | Production company |
| thumbnail | 🟡 | Thumbnail |
| uploadDate | 🟡 | Upload date |
| contentSize | 🟡 | Content size |
| encodesCreativeWork | ⚪ | Encodes creative work |
| associatedMedia | ⚪ | Associated media |
| requiresSubscription | ⚪ | Requires subscription |
| videoFrameSize | ⚪ | Video frame size |
| videoQuality | ⚪ | Video quality |
| hasDigitalDocumentPermission | ⚪ | Has digital document permission |

### Person & Individual

| Term | Level | Description |
|------|--------|------------|
| givenName | 🔵 | Given name |
| familyName | 🔵 | Family name |
| email | 🔵 | Email |
| telephone | 🔵 | Telephone |
| gender | 🔵 | Gender |
| birthDate | 🔵 | Birth date |
| nationality | 🔵 | Nationality |
| address | 🔵 | Address |
| jobTitle | 🔵 | Job title |
| additionalName | 🟡 | Additional name |
| honorificPrefix | 🟡 | Honorific prefix |
| honorificSuffix | 🟡 | Honorific suffix |
| birthPlace | 🟡 | Birthplace |
| deathDate | 🟡 | Death date |
| deathPlace | 🟡 | Death place |
| height | 🟡 | Height |
| weight | 🟡 | Weight |
| worksFor | 🟡 | Works for |
| alumniOf | 🟡 | Alumni of |
| awards | 🟡 | Awards |
| knows | ⚪ | Knows |
| colleagues | ⚪ | Colleagues |
| follows | ⚪ | Follows |
| parent | ⚪ | Parent |
| children | ⚪ | Children |
| sibling | ⚪ | Sibling |
| spouse | ⚪ | Spouse |
| homeLocation | ⚪ | Home location |
| workLocation | ⚪ | Work location |

### Organization & Group

| Term | Level | Description |
|------|--------|------------|
| organizationName | 🔵 | Organization name |
| legalName | 🔵 | Legal name |
| department | 🔵 | Department |
| address | 🔵 | Address |
| telephone | 🔵 | Telephone |
| email | 🔵 | Email |
| url | 🔵 | Website |
| foundingDate | 🟡 | Founding date |
| founder | 🟡 | Founder |
| numberOfEmployees | 🟡 | Number of employees |
| parentOrganization | 🟡 | Parent organization |
| subOrganization | 🟡 | Sub organization |
| member | 🟡 | Member |
| memberOf | 🟡 | Member of |
| taxID | 🟡 | Tax ID |
| vatID | 🟡 | VAT number |
| globalLocationNumber | ⚪ | GLN |
| duns | ⚪ | DUNS number |
| funder | ⚪ | Funder |
| sponsor | ⚪ | Sponsor |
| ownershipFundingInfo | ⚪ | Ownership funding info |
| slogan | ⚪ | Slogan |
| brand | ⚪ | Brand |
| dissolutionDate | ⚪ | Dissolution date |

### Address & Location

| Term | Level | Description |
|------|--------|------------|
| streetAddress | 🔵 | Street address |
| addressLocality | 🔵 | City/Town |
| addressRegion | 🔵 | State/Province |
| addressCountry | 🔵 | Country |
| postalCode | 🔵 | Postal code |
| location | 🔵 | Location |
| latitude | 🔵 | Latitude |
| longitude | 🔵 | Longitude |
| elevation | 🟡 | Elevation |
| postOfficeBoxNumber | 🟡 | PO box number |
| floor | 🟡 | Floor |
| room | 🟡 | Room |
| landmark | 🟡 | Landmark |
| areaServed | 🟡 | Area served |
| serviceArea | 🟡 | Service area |
| geo | 🟡 | Geographical coordinates |
| geoRadius | ⚪ | Geographical radius |
| geoCoveredBy | ⚪ | Geo covered by |
| geoCovers | ⚪ | Geo covers |
| geoDisjoint | ⚪ | Geo disjoint |
| geoIntersects | ⚪ | Geo intersects |
| geoTouches | ⚪ | Geo touches |
| containsPlace | ⚪ | Contains place |
| containedInPlace | ⚪ | Contained in place |

### Products & Services

| Term | Level | Description |
|------|--------|------------|
| productID | 🔵 | Product ID |
| sku | 🔵 | SKU |
| name | 🔵 | Product name |
| description | 🔵 | Product description |
| brand | 🔵 | Brand |
| manufacturer | 🔵 | Manufacturer |
| category | 🔵 | Category |
| price | 🔵 | Price |
| availability | 🔵 | Availability |
| color | 🟡 | Color |
| size | 🟡 | Size |
| weight | 🟡 | Weight |
| material | 🟡 | Material |
| model | 🟡 | Model |
| gtin | 🟡 | GTIN (Global Trade Item Number) |
| mpn | 🟡 | MPN (Manufacturer Part Number) |
| countryOfOrigin | 🟡 | Country of origin |
| productionDate | 🟡 | Production date |
| releaseDate | 🟡 | Release date |
| itemCondition | 🟡 | Item condition |
| width | ⚪ | Width |
| height | ⚪ | Height |
| depth | ⚪ | Depth |
| additionalProperty | ⚪ | Additional property |
| hasMerchantReturnPolicy | ⚪ | Has merchant return policy |
| hasWarranty | ⚪ | Has warranty |
| isFamilyFriendly | ⚪ | Is family-friendly |
| isAccessoryOrSparePartFor | ⚪ | Is accessory or spare part for |
| isConsumableFor | ⚪ | Is consumable for |

### Price & Payment

| Term | Level | Description |
|------|--------|------------|
| price | 🔵 | Price |
| priceCurrency | 🔵 | Price currency |
| paymentMethod | 🔵 | Payment method |
| paymentStatus | 🔵 | Payment status |
| paymentDue | 🔵 | Payment due |
| validFrom | 🔵 | Valid from |
| validThrough | 🔵 | Valid through |
| minPrice | 🟡 | Minimum price |
| maxPrice | 🟡 | Maximum price |
| priceValidUntil | 🟡 | Price valid until |
| discount | 🟡 | Discount |
| discountCode | 🟡 | Discount code |
| valueAddedTaxIncluded | 🟡 | VAT included |
| priceType | 🟡 | Price type |
| paymentAccepted | 🟡 | Payment accepted |
| paymentUrl | 🟡 | Payment URL |
| billingPeriod | ⚪ | Billing period |
| billingDuration | ⚪ | Billing duration |
| billingIncrement | ⚪ | Billing increment |
| billingStart | ⚪ | Billing start |
| downPayment | ⚪ | Down payment |
| installment | ⚪ | Installment |
| loanTerm | ⚪ | Loan term |
| monthlyMinimumPayment | ⚪ | Monthly minimum payment |

### Events & Activities

| Term | Level | Description |
|------|--------|------------|
| eventName | 🔵 | Event name |
| eventStatus | 🔵 | Event status |
| startDate | 🔵 | Start date |
| endDate | 🔵 | End date |
| location | 🔵 | Location |
| organizer | 🔵 | Organizer |
| performer | 🔵 | Performer |
| eventAttendanceMode | 🔵 | Event attendance mode |
| maximumAttendeeCapacity | 🟡 | Maximum attendee capacity |
| remainingAttendeeCapacity | 🟡 | Remaining attendee capacity |
| offers | 🟡 | Offers |
| doorTime | 🟡 | Door time |
| duration | 🟡 | Duration |
| inLanguage | 🟡 | In language |
| sponsor | 🟡 | Sponsor |
| superEvent | ⚪ | Super event |
| subEvent | ⚪ | Sub event |
| recordedIn | ⚪ | Recorded in |
| workFeatured | ⚪ | Work featured |
| workPerformed | ⚪ | Work performed |
| contributor | ⚪ | Contributor |

### Reviews & Ratings

| Term | Level | Description |
|------|--------|------------|
| review | 🔵 | Review |
| rating | 🔵 | Rating |
| ratingValue | 🔵 | Rating value |
| reviewBody | 🔵 | Review body |
| author | 🔵 | Author |
| datePublished | 🔵 | Date published |
| reviewRating | 🟡 | Review rating |
| bestRating | 🟡 | Best rating |
| worstRating | 🟡 | Worst rating |
| ratingCount | 🟡 | Rating count |
| reviewAspect | 🟡 | Review aspect |
| positiveNotes | 🟡 | Positive notes |
| negativeNotes | 🟡 | Negative notes |
| aggregateRating | 🟡 | Aggregate rating |
| itemReviewed | 🟡 | Item reviewed |
| recommendationStrength | ⚪ | Recommendation strength |
| associatedReview | ⚪ | Associated review |
| abridged | ⚪ | Abridged |

### Education & Learning

| Term | Level | Description |
|------|--------|------------|
| educationalLevel | 🔵 | Educational level |
| learningResourceType | 🔵 | Learning resource type |
| teaches | 🔵 | Teaches |
| courseCode | 🔵 | Course code |
| instructor | 🔵 | Instructor |
| courseWorkload | 🔵 | Course workload |
| competencyRequired | 🟡 | Competency required |
| educationalUse | 🟡 | Educational use |
| timeRequired | 🟡 | Time required |
| typicalAgeRange | 🟡 | Typical age range |
| assesses | 🟡 | Assesses |
| educationalAlignment | 🟡 | Educational alignment |
| educationalFramework | 🟡 | Educational framework |
| proficiencyLevel | ⚪ | Proficiency level |
| coursePrerequisites | ⚪ | Course prerequisites |
| educationalProgramMode | ⚪ | Educational program mode |
| occupationalCredentialAwarded | ⚪ | Occupational credential awarded |
| numberOfCredits | ⚪ | Number of credits |

### Medical & Health

| Term | Level | Description |
|------|--------|------------|
| medicalCondition | 🔵 | Medical condition |
| diagnosis | 🔵 | Diagnosis |
| treatment | 🔵 | Treatment |
| medication | 🔵 | Medication |
| symptoms | 🔵 | Symptoms |
| healthcareProvider | 🔵 | Healthcare provider |
| medicalSpecialty | 🟡 | Medical specialty |
| procedure | 🟡 | Procedure |
| dosageSchedule | 🟡 | Dosage schedule |
| adverseOutcome | 🟡 | Adverse outcome |
| contraindication | 🟡 | Contraindication |
| indication | 🟡 | Indication |
| sideEffect | 🟡 | Side effect |
| warning | 🟡 | Warning |
| activeIngredient | ⚪ | Active ingredient |
| administrationRoute | ⚪ | Administration route |
| recommendedIntake | ⚪ | Recommended intake |
| maximumIntake | ⚪ | Maximum intake |
| drugClass | ⚪ | Drug class |
| prescribingInfo | ⚪ | Prescribing information |

### Finance & Transactions

| Term | Level | Description |
|------|--------|------------|
| accountId | 🔵 | Account ID |
| accountName | 🔵 | Account name |
| accountType | 🔵 | Account type |
| amount | 🔵 | Amount |
| currency | 🔵 | Currency |
| transactionId | 🔵 | Transaction ID |
| transactionDate | 🔵 | Transaction date |
| balance | 🔵 | Balance |
| bankAccount | 🟡 | Bank account |
| creditCard | 🟡 | Credit card |
| interestRate | 🟡 | Interest rate |
| paymentDueDate | 🟡 | Payment due date |
| paymentStatus | 🟡 | Payment status |
| minimumPayment | 🟡 | Minimum payment |
| creditLimit | 🟡 | Credit limit |
| exchangeRate | 🟡 | Exchange rate |
| accountMinimumInflow | ⚪ | Account minimum inflow |
| accountOverdraftLimit | ⚪ | Account overdraft limit |
| annualPercentageRate | ⚪ | Annual percentage rate |
| beneficiaryBank | ⚪ | Beneficiary bank |
| cashBack | ⚪ | Cash back |
| loanType | ⚪ | Loan type |

### Reservations & Scheduling

| Term | Level | Description |
|------|--------|------------|
| reservationId | 🔵 | Reservation ID |
| reservationStatus | 🔵 | Reservation status |
| reservationFor | 🔵 | Reservation for |
| underName | 🔵 | Under name |
| reservationDate | 🔵 | Reservation date |
| startTime | 🔵 | Start time |
| endTime | 🔵 | End time |
| partySize | 🟡 | Party size |
| bookingTime | 🟡 | Booking time |
| bookingAgent | 🟡 | Booking agent |
| programMembershipUsed | 🟡 | Program membership used |
| modifiedTime | 🟡 | Modified time |
| cancelationPolicy | 🟡 | Cancelation policy |
| advanceBookingRequirement | ⚪ | Advance booking requirement |
| lodgingUnitType | ⚪ | Lodging unit type |
| lodgingUnitDescription | ⚪ | Lodging unit description |
| checkInTime | ⚪ | Check-in time |
| checkOutTime | ⚪ | Check-out time |
| amenityFeature | ⚪ | Amenity feature |

### Communication

| Term | Level | Description |
|------|--------|------------|
| sender | 🔵 | Sender |
| recipient | 🔵 | Recipient |
| messageText | 🔵 | Message text |
| subject | 🔵 | Subject |
| dateSent | 🔵 | Date sent |
| dateReceived | 🔵 | Date received |
| messageStatus | 🔵 | Message status |
| messageType | 🟡 | Message type |
| inReplyTo | 🟡 | In reply to |
| ccRecipient | 🟡 | CC recipient |
| bccRecipient | 🟡 | BCC recipient |
| messageAttachment | 🟡 | Message attachment |
| replyToUrl | 🟡 | Reply to URL |
| discussionUrl | 🟡 | Discussion URL |
| toRecipient | ⚪ | To recipient |
| aboutPerson | ⚪ | About person |
| aboutOrganization | ⚪ | About organization |
| mentions | ⚪ | Mentions |

### Security & Access Control

| Term | Level | Description |
|------|--------|------------|
| accessibilityControl | 🔵 | Accessibility control |
| permission | 🔵 | Permission |
| permissionType | 🔵 | Permission type |
| authenticator | 🔵 | Authenticator |
| securityClearance | 🔵 | Security clearance |
| accessCode | 🟡 | Access code |
| accessModeSufficient | 🟡 | Access mode sufficient |
| accessibilityAPI | 🟡 | Accessibility API |
| accessibilityFeature | 🟡 | Accessibility feature |
| accessibilityHazard | 🟡 | Accessibility hazard |
| conditionsOfAccess | 🟡 | Conditions of access |
| hasDigitalDocumentPermission | 🟡 | Has digital document permission |
| permissionAssertion | ⚪ | Permission assertion |
| securityScreening | ⚪ | Security screening |

### Workflow & Process

| Term | Level | Description |
|------|--------|------------|
| status | 🔵 | Status |
| stage | 🔵 | Stage |
| processType | 🔵 | Process type |
| currentStatus | 🔵 | Current status |
| action | 🔵 | Action |
| actionStatus | 🔵 | Action status |
| workflowStep | 🟡 | Workflow step |
| predecessor | 🟡 | Predecessor |
| successor | 🟡 | Successor |
| approver | 🟡 | Approver |
| assignee | 🟡 | Assignee |
| dueDate | 🟡 | Due date |
| priority | 🟡 | Priority |
| escalationLevel | ⚪ | Escalation level |
| workflowTemplate | ⚪ | Workflow template |
| decisionPoint | ⚪ | Decision point |
| conditionalStep | ⚪ | Conditional step |
| parallelStep | ⚪ | Parallel step |

### Technical & System

| Term | Level | Description |
|------|--------|------------|
| softwareVersion | 🔵 | Software version |
| operatingSystem | 🔵 | Operating system |
| applicationCategory | 🔵 | Application category |
| programmingLanguage | 🔵 | Programming language |
| systemRequirements | 🔵 | System requirements |
| softwareRequirements | 🟡 | Software requirements |
| processorRequirements | 🟡 | Processor requirements |
| memoryRequirements | 🟡 | Memory requirements |
| storageRequirements | 🟡 | Storage requirements |
| installUrl | 🟡 | Install URL |
| downloadUrl | 🟡 | Download URL |
| codeRepository | 🟡 | Code repository |
| applicationSubCategory | ⚪ | Application subcategory |
| applicationSuite | ⚪ | Application suite |
| availableOnDevice | ⚪ | Available on device |
| browserRequirements | ⚪ | Browser requirements |

### Legal & Terms

| Term | Level | Description |
|------|--------|------------|
| termsOfService | 🔵 | Terms of service |
| privacyPolicy | 🔵 | Privacy policy |
| license | 🔵 | License |
| copyright | 🔵 | Copyright |
| legalStatus | 🔵 | Legal status |
| jurisdiction | 🟡 | Jurisdiction |
| legislationType | 🟡 | Legislation type |
| regulations | 🟡 | Regulations |
| disclaimer | 🟡 | Disclaimer |
| compliance | 🟡 | Compliance |
| legalName | 🟡 | Legal name |
| legislationDate | ⚪ | Legislation date |
| legislationIdentifier | ⚪ | Legislation identifier |
| legislationPassedBy | ⚪ | Legislation passed by |
| legislationResponsible | ⚪ | Legislation responsible |
| governmentBenefitsInfo | ⚪ | Government benefits info |

### Other Attributes

| Term | Level | Description |
|------|--------|------------|
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

1. **Naming Conventions**:
- Use lowerCamelCase format
- Avoid abbreviations, use complete words
- Maintain consistent naming patterns

2. **Customization**:
- Can add custom terms as needed
- Recommend using appropriate prefixes for industry-specific terms
- Strive for unified term usage within organization

3. **Interoperability**:
- Consider compatibility with Schema.org
- Prioritize standard terms
- Clearly document when making custom extensions

### Reference Resources

- [Schema.org](https://schema.org)
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
- [ALPS Specification](http://alps.io/spec/)

***

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

***

# Example

## State Diagrams

* [Online Bookstore](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) - Book catalog and purchase flow. Demonstrates tags, doc, and def usage
* [Amazon Shopping](https://alps-asd.github.io/app-state-diagram/demo/amazon/alps.html) - From product search to reviews, wishlists, and subscriptions. Large-scale profile structure
* [Learning Management System](https://alps-asd.github.io/app-state-diagram/demo/lms/alps.html) - Course management, assignments, and grading. Nested descriptors and href-based reuse

## HTML Mock

A demo of [Semantic Wireframe](semantic-wireframe.html) generated from an ALPS profile.

* [Online Bookstore Mock](https://www.app-state-diagram.com/alps/mock/level2/) — Three CSS fidelity levels over the same semantic HTML:
  * [Level 1 - Bare](https://www.app-state-diagram.com/alps/mock/level1/) — Minimal readability, no layout
  * [Level 2 - Wireframe](https://www.app-state-diagram.com/alps/mock/level2/) — Information skeleton. Hover any element to see its ALPS semantic descriptor ID
  * [Level 3 - Production](https://www.app-state-diagram.com/alps/mock/level3/) — A demo of full design system with typography, color, and responsive layout

***

# Semantic Wireframe

<figure style="max-width: 45%; margin-bottom: 1em;">
<img src="/images/semantic-wireframe.png" alt="Semantic Wireframe" style="width: 100%;">
<figcaption style="font-size: 0.85em; color: #666; margin-top: 0.5em;">A wireframe that visualizes meaning structure — what information exists and how transitions connect them — rather than layout or UI components. Hovering reveals ALPS descriptor IDs</figcaption>
</figure>

## Why Semantic Wireframes

ALPS design enables visualizing the same information structure in multiple forms.

- **ALPS profiles** (JSON/XML) precisely define the application's meaning structure, but are developer-oriented
- **ASD** (state diagrams) visualize application-wide state transitions as a graph
- **Semantic wireframes** visualize the same information structure as HTML pages — an extension of the traditional wireframe format

They let you reach agreement with stakeholders on information architecture before investing in visual design.

## How It Works

Swap only the CSS while keeping the HTML identical — the same idea as [CSS Zen Garden](http://www.csszengarden.com/) (2003). The difference is the purpose. CSS Zen Garden demonstrated the separation of content and presentation as a CSS technique; semantic wireframes leverage that separation as **a design tool for stakeholder communication**.

Every CSS class in the HTML uses only ALPS semantic descriptor IDs, with no presentation classes.

```html
<article class="Book">
  <h2 class="bookTitle">The Art of Web Design</h2>
  <span class="price">$29.99</span>
  <a href="cart.html" class="doAddToCart">Add to Cart</a>
</article>
```

There are no presentation classes like `container` or `btn-primary`. Only meaning structure remains in the HTML. Styles are applied to those semantic classes, and by swapping only the CSS, three fidelity levels are achieved:

- **Level 1** — Minimal readability, no layout
- **Level 2** — Information skeleton (wireframe)
- **Level 3** — Full design with typography, color, and responsive layout

The AI skill ([alps-to-mock](ai-assistant.html#skill-claude-code)) or MCP tool ([alps2mock](ai-assistant.html#available-tools)) can auto-generate these from an ALPS profile.

## Visual Notation

The [Level 2 wireframe](example.html#html-mock) uses the following visual notation.

### Hover Labels

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <span title=".Book" style="border: 1px solid #ccc; padding: 4px 12px; background: #f9f9f9; font-size: 14px; cursor: default; position: relative;">Book<span style="position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 2px 8px; border-radius: 3px; font-size: 12px; white-space: nowrap;">.Book</span></span>
  <span style="align-self: center; color: #666; font-size: 14px;">Hover any element to see its ALPS semantic descriptor ID as a tooltip</span>
</div>

### Dashed Borders

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <div style="border: 1px dashed #999; padding: 8px 16px; font-size: 14px; color: #333;">section</div>
  <span style="align-self: center; color: #666; font-size: 14px;"><code>section</code>, <code>article</code>, and <code>aside</code> are outlined with dashed borders, making block structure visible</span>
</div>

### Underlined Links

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <span style="text-decoration: underline; color: #00A86B; font-size: 14px;">Book Details</span>
  <span style="align-self: center; color: #666; font-size: 14px;">safe transition (<code>go*</code>) — read-only navigation with no side effects</span>
</div>

### Transition Types and Left Border Colors

Button left border colors distinguish transition types, using the same colors as state diagram edges.

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #00A86B; padding: 6px 16px; background: white; font-size: 14px;" disabled>Search</button>
  <span style="align-self: center; color: #666; font-size: 14px;">safe — read-only, no side effects</span>
</div>
<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #FF4136; padding: 6px 16px; background: white; font-size: 14px;" disabled>Add to Cart</button>
  <span style="align-self: center; color: #666; font-size: 14px;">unsafe — state-changing, non-idempotent</span>
</div>
<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #D4A000; padding: 6px 16px; background: white; font-size: 14px;" disabled>Update Quantity</button>
  <span style="align-self: center; color: #666; font-size: 14px;">idempotent — state-changing, idempotent</span>
</div>

### X-box Images

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <svg width="60" height="40" style="border: 1px solid #ccc; background: #f0f0f0;"><line x1="0" y1="0" x2="60" y2="40" stroke="#999" stroke-width="1"/><line x1="60" y1="0" x2="0" y2="40" stroke="#999" stroke-width="1"/></svg>
  <span style="align-self: center; color: #666; font-size: 14px;">Image placeholder — standard wireframe notation for "an image goes here"</span>
</div>

## Demo

See the same online bookstore information structure in three forms:

- [ALPS](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.xml) — Profile
- [ASD](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) — State diagram
- [Wireframe](https://www.app-state-diagram.com/alps/mock/level2/) — Semantic wireframe

By swapping only the CSS, you can switch from the wireframe to a skeleton view or a near-production design. [Compare all three fidelity levels](example.html#html-mock).

## AI Affinity

The HTML of a semantic wireframe is self-describing — the meaning structure is expressed directly, not buried under presentation. In typical HTML, AI must infer meaning through the noise of layout and decoration classes like `flex`, `md:grid-cols-3`, and `shadow-lg`. In semantic HTML, that guesswork is eliminated. Fewer tokens, more accurate understanding.

***

# Resource

* [ALPS official](http://alps.io/)
* [RFC](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07)
* Skeleton
  * [json](https://github.com/alps-asd/alps-skeleton-json)
  * [xml](https://github.com/alps-asd/alps-skeleton-xml)
* [GitHub Action](https://github.com/marketplace/actions/app-state-diagram)
* [app-state-diagram](https://github.com/alps-asd/app-state-diagram)

***

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

A. There is no difference in functionality. There is also no need to unify them when using multiple ALPS files. Please compare them in practice. [XML](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.xml) / [JSON](https://github.com/koriym/app-state-diagram/blob/master/docs/blog/profile.json)

<strong>Q. Can it be used for APIs without links</strong>?

A. Yes. It cannot represent a transition diagram, but it can generate a vocabulary and documentation of the nature of the information.

<strong>Q. Are there any other technologies that are similar to ALPS?</strong>

A. There are no direct competitors. A similar technology is [Microformat](http://www.asahi-net.or.jp/~ax2s-kmtn/internet/rec-owl-features-20040210.html).

<strong>Q. What is the difference from IDL such as OpenAPI</strong>?

A. ALPS deals with REST abstractions that are higher than HTTP. Therefore, it can be used as a modeling and design language for OpenAPI implementations.

<strong>Q. Do I need it</strong>?

A. If you want to model information to improve the quality of user experience, or if you want a reference (SSOT) to unify the understanding among production members, or if you want to overview and reuse your design, or if you want to keep your information design as a standardized document, ALPS+ASD will be useful as your information design modeling tool or as a format to express it.

***

# Application-Level Profile Semantics (ALPS)

This page points to the original English draft of the ALPS specification:

- [Application-Level Profile Semantics (ALPS), draft-amundsen-richardson-foster-alps-07](https://datatracker.ietf.org/doc/html/draft-amundsen-richardson-foster-alps-07)

The Japanese manual includes a translated copy of the draft. Use the official IETF draft above as the authoritative English reference.

***

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
