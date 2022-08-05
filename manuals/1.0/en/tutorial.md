---
layout: docs-en
title: Tutorial
category: Manual
permalink: /manuals/1.0/en/tutorial.html
---
# ALPS Tutorial

## Getting Started
Create an skeleton ALPS file `profile.xml` first. [^webstorm]

```xml
<?xml version="1.0" encoding="UTF-8"?>
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
```


[^webstorm]: editors with schema support are useful. Completion works and validation is performed. [Example in WebStorm](https://hackmd.io/@koriym/webstorm-for-alps#%E3%82%B9%E3%82%B1%E3%83%AB%E3%83%88%E3%83%B3%E3%83%95%E3%82%A1%E3%82%A4 See also %E3%83%AB%E3%81%AE%E4%BD%9C%E6%88%90).


## Register meaning as ID

ALPS defines specific words and phrases used by the application as IDs. Let's start by adding the phrase `dateCreated`.

```diff
 <?xml version="1.0" encoding="UTF-8"?>
 <alps
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
+ <descriptor id="dateCreated"/>
 </alps>
```

# Your first ASD

Let's try to display an ALPS file in ASD. Run the following command or open `profile.xml` in the ASD application on your Mac.

```
asd --watch . /profile.xml 
```

Open [http://localhost:3000](http://localhost:3000) and check it. You will see that the word `dateCreated` has been registered.

## Describe the word

You can add a description with ``title`` or ``doc``.

```xml
<descriptor id="dateCreated" title="Creation date"/>
```

```xml
<descriptor id="dateCreated">
    <doc format="markdown">Date the article was created in ISO8601 format</doc>.
</descriptor>
```

`title` is a brief expression, like a headline, and `doc` is a longer textual description.

The ID associated with this meaning is called a **semantic descriptor** . `dateCreated` is a semantic descriptor associated with the meaning "date created". Such definitions of meanings and concepts are called **ontologies**.

### Vocabulary

One of the important roles of ALPS is to be a dictionary of words in the application. Users use the same words when they refer to the same meaning, preventing inconsistent wording, and preventing users from having different understandings of a word.

## Information contains information

Semantic descriptors may contain semantic descriptors.

For example, `BlogPosting` contains `articleBody` and `dateCreated`. A descriptor within a descriptor represents a hierarchy of information. This organization and arrangement of information is the **taxonomy**.


```xml
<alps
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
     
    <!-- Ontology -->
    <descriptor id="id" title="id"/>
    <descriptor id="articleBody" title="body"/>
    <descriptor id="dateCreated" title="Creation date"/>

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

You can use `#` to refer to other descriptors. This is called **inline linking** and allows you to reference one descriptor from multiple locations.

Save the file and check the ASD document.
Do you see the `articleBody` and other registered words and phrases on the page? Click on `BlogPosting` to see what information is contained in the blog post.

## Browsing and manipulating information

Web pages contain not only information but also links to other pages and forms of action, allowing you to browse and manipulate related information. You can perform the following three types of operations.

### safe

Viewing related information, in HTML it is the A tag, in HTTP it is GET. A **safe transition** that does not change the state of the resource [^resource_state]. The **application state** that is what the user is viewing changes. In other words, the URL the user is viewing changes.

[^resource_state]: Information held by the server side as identified by the URL.

### idempotent

Changes the resource state. It is idempotent [^idempotent], and the result will be the same no matter how many times it is repeated. Think of it as overwriting a file. No matter how many times it is repeated, the result will be the same.

[^idempotent]: [https://en.wiktionary.org/wiki/idempotent](https://en.wiktionary.org/wiki/idempotent)

### unsafe

Like idempotent, this changes the resource status, but there is not idempotent. Think of it as a file append. The result will be different after repeated execution.

### Correspondence with HTTP methods

safe corresponds to `GET`, idempotent corresponds to `PUT` or `DELETE`, and unsafe corresponds to `POST`.


### Link

Create a link by specifying the type of operation with `type` and the destination with `rt`.
This example is a link to browse `Blog`.

```xml
<descriptor type="safe" id="goBlog" rt="#Blog" title="View list of blog posts" />
```

This example adds an operation from a blog post back to the blog post list.

```diff
 <descriptor id="BlogPosting" title="Articles">
     <descriptor href="#id"/>
     <descriptor href="#dateCreated"/>
     <descriptor href="#articleBody"/>
+ <descriptor id="goBlog" type="safe" rt="#Blog" title="View article list"/>
 </descriptor>
```

Include in the descriptor any descriptors needed for transitions and operations.

```xml
<descriptor id="goBlogPosting" type="safe" rt="#BlogPosting" title="View posts">
    <!-- ID required to browse posts -->
    <descriptor href="#id"/>
</descriptor>
````

Let's add links to both the blog post list and the blog post.

```diff
 <alps
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
     
     <! -- Ontology -->.
     <descriptor id="id" title="id"/>
     <descriptor id="articleBody" title="body"/>
     <descriptor id="dateCreated" title="Creation date"/>

     <! -- Taxonomy -->.
     <descriptor id="BlogPosting" title="Blog post" >
         <descriptor href="#id"/>
         <descriptor href="#dateCreated"/>
         <descriptor href="#articleBody"/>
+        <descriptor href="#goBlog" />
     </descriptor>

     <descriptor id="Blog" title="the list of blog posts">
         <descriptor href="#BlogPosting"/>
+        <descriptor href="#goBlogPosting" />
     </descriptor>

+ <! -- Choreography -->
+ <descriptor type="safe" id="goBlog" rt="#Blog" title="View the list of blog posts" />
+ <descriptor type="safe" id="goBlogPosting" rt="#BlogPosting" title="View blog post">
+     <descriptor href="#id"/>
+ </descriptor>
 </alps>
```

## Application State Transition Diagram

Clicking on **Application State Diagram** at [http://localhost:3000](http://localhost:3000) will display a state transition diagram linked from the article list, articles, and both.
The square box shows the application state, i.e., where the user is looking, i.e., the web page being viewed.
The arrows represent operations such as viewing or changing information, which correspond to the A tag and FORM tag transitions in HTML.
Click on a box or arrow to see more information. Check it out.

Just as information on a website is interlinked, ASD document pages are also interlinked. The application state transition diagram provides a bird's eye view of the site's information design and links to information design details such as information meaning, structure, and connections.

---
