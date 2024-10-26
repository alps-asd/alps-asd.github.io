---
layout: docs-en
title: Information Architecture and ALPS
category: Manual
permalink: /manuals/1.0/en/ia_and_alps.html
---

# Information Architecture and ALPS

Applying Information Architecture (IA) concepts to domain modeling in API design and system development enables systematic organization of business requirements. The elements of IA—"meaning," "structure," and "interaction"—originally developed in UX and content design, play a crucial role in structuring business domain knowledge. ALPS provides a standardized method to express these concepts.

## Applying Information Architecture

Information Architecture expert Dan Klyn defined IA as the interplay of `Ontology`, `Taxonomy`, and `Choreography`. [^uia] These concepts serve as a foundation not only for content design but also for system design. While OpenAPI focuses on technical API details (endpoints, HTTP methods, request/response structures), ALPS uses these IA concepts to structure the business domain.

[^uia]: [Understanding Information Architecture](https://understandinggroup.com/ia-theory/understanding-information-architecture)

## Role in the Design Process

ALPS bridges business requirements and system design from the early stages of development. Unlike traditional endpoint-centric design, which is used to document predetermined specifications, ALPS can be utilized from the requirements definition phase. This enables early detection and correction of differences in business requirement interpretations. It also establishes a common language between technical and business teams, providing a framework for easily understanding the scope of design changes.

ALPS goes beyond API endpoint design to provide a means of systematizing and sharing business domain knowledge. As a Single Source of Truth (SSOT), it consistently models system structure and behavior. Using business terminology at its core, it clearly expresses complex business rules, visualizes workflows, and enables intuitive understanding of information interactions.

## Adapting to Technical Changes

ALPS offers flexibility in its application to various API styles. Even as technology evolves and architecture styles change, business domain design can be maintained. For example, whether transitioning from RESTful APIs to GraphQL, adopting microservice architecture, or implementing new communication protocols, domain models defined in ALPS remain valid. This is because ALPS focuses on abstracted business logic rather than implementation details.

## Building Sustainable Organizational Knowledge Foundation

In the implementation of `Taxonomy`, relationships between business entities are defined, ensuring scalability through hierarchical structure. This establishes a common vocabulary across the organization, streamlining communication. `Choreography` defines business process flows and service coordination rules, enhancing system-wide consistency and reliability.

Applying IA concepts to domain modeling naturally connects technical implementation with business requirements. ALPS functions as a framework to achieve this bridge, serving as a foundation for systematically structuring and evolving organizational knowledge.

Through this approach, organizations can build a sustainable knowledge foundation that remains resilient to technological changes.
