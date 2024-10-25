---
layout: docs-en
title: Applied Tutorial
category: Manual
permalink: /manuals/1.0/en/tutorial_rest.html
---

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

There are two important types of states in REST applications:

1. **Application State**
   - Represents the current location on the client (browser) side, expressed through URLs.

2. **Resource State**
   - Represents the state of the data managed on the server side, which the client accesses.

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

1. Open [https://app-state-diagram.free.nf/](https://app-state-diagram.free.nf/) in your browser.
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
            {
                "id": "BlogPosting",
                "title": "Blog Post",
                "descriptor": [
                    {"href": "#dateCreated"},
                    {"href": "#articleBody"}
                ]
            }
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

|Operation | Type | 	HTTP Method	Description |
| ---- | ---- | ---- | 
|safe |	GET	| Changes only application state |
|unsafe |	POST |	Creates new resource state |
|idempotent |	PUT/DELETE | Updates/deletes resource state |

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
            {
                "id": "BlogPosting",
                "title": "Blog Post",
                "descriptor": [
                    {"href": "#dateCreated"},
                    {"href": "#articleBody"}
                ]
            },
            {
                "id": "goBlogPosting",
                "type": "safe",
                "rt": "#BlogPosting",
                "title": "View Blog Post",
                "descriptor": [
                    {"href": "#dateCreated"}
                ]
            }
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
{
    "id": "doCreateBlogPosting",
    "type": "unsafe",
    "rt": "#BlogPosting",
    "title": "Create Blog Post",
    "descriptor": [
        {"href": "#articleBody"}
    ]
}
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
{
    "id": "doUpdateBlogPosting",
    "type": "idempotent",
    "rt": "#BlogPosting",
    "title": "Update Blog Post",
    "descriptor": [
        {"href": "#articleBody"}
    ]
}
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
{
    "id": "Blog",
    "title": "Blog",
    "descriptor": [
        {"href": "#BlogPosting"},
        {"href": "#goBlogPosting"},
        {"href": "#doCreateBlogPosting"},
        {"href": "#doUpdateBlogPosting"}
    ]
}
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

