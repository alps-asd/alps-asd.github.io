---
layout: docs-en
title: Tutorial
category: Manual
permalink: /manuals/1.0/en/tutorial.html
---
# ALPS Tutorial

## Getting started

Create a skeleton file `profile.xml`.

```xml
<?xml version="1.0" encoding="UTF-8"? >
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
```

An editor that supports schemas is useful. The completion works and validation is done. There is a free [WebStorm](https://www.jetbrains.com/ja-jp/webstorm/nextversion/).

First, use WebStorm to [create a skeleton file](https://hackmd.io/@koriym/webstorm-for-alps#%E3%82%B9%E3%82%B1%E3%83%AB%E3%83%88%E3%83%B3%E3%83%95%E3 82%A1%E3%82%A4%E3%83%AB%E3%81%AE%E4%BD%9C%E6%88%90).

## Ontology

In ALPS, meaning is defined as ID.

Let's add `dateCreated` (creation date).

```diff
<?xml version="1.0" encoding="UTF-8"? >
<alps
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
+ <descriptor id="dateCreated"/>
</alps>
```

### ASD for the first time

Now let's try to display the ALPS file with ASD.

Let's run ASD with the following command to create an ASD document.

```
asd --watch . /profile.xml 
```

Open [http://localhost:3000](http://localhost:3000) and you will see that one word has been registered.


After that, the ASD document will be redrawn when you save the file, and there is no need to operate the ASD tool.


! [](https://i.imgur.com/TxHvBpy.png)


### Describe a word or phrase


You can add a description with `title` or `doc`.

```xml
<descriptor id="dateCreated" title="date created"/>
```

```xml
<descriptor id="dateCreated">
    <doc format="markdown">The date the article was created in ISO8601 format</doc>.
</descriptor>
```

The ALPS document is a dictionary of terms used in the application. The ALPS application uses `dateCreated` for the creation date, not `created_date` or `created`.

An ALPS document is a collection of semantic descriptors.

The ALPS document is a collection of them. 

### Linking to word definitions


A better way than verbal descriptions is to link to standard word definitions with `def`. This prevents reinventing the wheel.


```xml
<descriptor id="dateCreated" def="https://schema.org/dateCreated" />
````

Some famous vocab sites include.

* [schema.org](https://schema.org/docs/schemas.html)
* [IANA](https://www.iana.org/assignments/link-relations/link-relations.xml)

### Vocabularies

One of the important roles of ALPS is to become a vocabulary dictionary for applications. Users will use the same ID and the same meaning.

## Taxonomy

Semantic descriptors may contain semantic descriptors.

For example, `BlogPosting` (blog post) contains `articleBody` (body) and `dateCreated`. Information contains information, and the information it contains is also included in other information. Such an arrangement of information is a taxonomy. A hierarchy is represented by a <descriptor> inside a <descriptor>.


```xml
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
     
    <! -- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="body"/>
    <descriptor id="dateCreated" title="Date Created"/>

    <! -- Taxonomy -->.
    <descriptor id="BlogPosting" title="Blog Posting">
        <descriptor href="#id"/>
        <descriptor href="#dateCreated"/>
        <descriptor href="#articleBody"/>
    </descriptor>
    <descriptor id="Blog" title="Blog post list">
        <descriptor href="#BlogPosting"/>
    </descriptor>
</alps>
```

* The above represents a blog post (`BlogPosting`) that contains the body of the article (`articleBody`), and a blog post list (`Blog`) that contains the article.

* In the ALPS file, the `<! -- Taxonomy -->` block in ALPS file uses other semantic descriptors inline linked with `href`.

* You can also link other files locally or on the web.


````xml
<descriptor href="definition.xml#dateCreated"/>.
````

```xml
<descriptor href="http://example.com/dateCreated.xml#dateCreated"/>
```

Let's save the file and check the ASD document.


## Choreography

Web pages can contain not only information, but also links to other pages and forms of actions, and this kind of interaction of information is called choreography.

There are three types as follows.

### Type

#### safe

`safe` is the A tag in HTML, or GET in HTTP. It is a safe transition and does not change the resource state on the server side.

#### idempotent

The `idempotent` transition changes the resource state, but is power-equivalent, meaning that it can be repeated many times with the same result.

#### unsafe

`unsafe` also changes the resource state, but is not power-limited. Care should be taken when repeating it.

safe corresponds to `GET`, idempotentidempotent corresponds to `PUT` or `DELETE`, unsafe corresponds to `POST`, and so on for each HTTP method.


### Link

Include them in other `descriptors` as follows.

```xml
<descriptor id="BlogPosting" " title="Blog Posting">
    <descriptor href="#id"/>
    <descriptor href="#dateCreated"/>
    <descriptor href="#articleBody"/>
    <descriptor id="goBlog" type="safe" rt="#Blog" title="View Blog Post List"/>
</descriptor>
````

### Arguments.

Include any descriptor needed for the transition.

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="View blog post">
    <descriptor href="#id"/>
</descriptor>
````


## Attributes

The following attributes can be used regardless of type.

### tag

Add a tag attribute.


```xml
<descriptor id="ticketList" tag="ontology collection" />
```

You can filter the attributes to draw the ASD. Let's try it.

[screenshot].

### link

Link to meta information.

```xml
<descriptor id="dateCreated">
  <link href="https://github.com/koriym/app-state-diagram/issues" rel="issue" title="Issue list"/>
</descriptor>.
```

## Link.

You can also use `href` to link to other ALPS documents.

```xml
<descriptor href="definition.xml#dateCreated"/>
<descriptor href="http://example.com/dateCreated.xml#dateCreated"/>
```

## Meta-information for ALPS

To add meta-information to the ALPS file, you can do this.


```xml
<?xml version="1.0" encoding="UTF-8"? >
<alps>
    <title>ALPS Blog</title>.
    <doc>An ALPS profile example for ASD</doc>.
    <link rel="issue" href="https://github.com/koriym/app-state-diagram/issues"/>
</alps>
```
