---
layout: docs-en
title: Introduction
category: Manual
permalink: /manuals/1.0/en/
---
# Introduction

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## What is ALPS?

Application-Level Profile Semantics (ALPS) is a format for expressing application-level semantics (the meaning and structure of words and phrases). It is useful for explaining information and understanding operations.

## What is ASD?

ASD (Application State Diagram) is the name of the application state transition diagram generated from ALPS documents and the [documentation generation tool](https://github.com/alps-asd/app-state-diagram).


## Uses

You can design a REST application from a pure information design perspective, excluding UI/UX, and get a bird's eye view of the whole system. Also, the defined vocabularies and links can be used as SSOT(Single source of truth) for shared understanding.

## FAQ

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

---

*[This manual]((https://github.com/alps-asd/alps-asd.github.io)) has been machine translated by [DeepL](www.DeepL.com/Translator)*. *Help us improve the quality of our translations!*

