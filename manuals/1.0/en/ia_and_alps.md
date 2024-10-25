---
layout: docs-en
title: Information Architecture and ALPS
category: Manual
permalink: /manuals/1.0/en/ia_and_alps.html
---

# Information Architecture and ALPS

In API design and system development, the concepts of Information Architecture (IA) are effective for domain modeling. The elements of IA - "meaning," "structure," and "interaction" - originally developed for UX and content design, hold similar value when structuring business domain knowledge. ALPS can represent this approach in a standardized way.

## Applying Information Architecture

Dan Klyn defined Information Architecture (IA) as the interplay between "meaning (`Ontology`)", "structure (`Taxonomy`)", and "rules of interaction (`Choreography`)".[^uia] These concepts function not only for content design but also as a foundation for system design. While OpenAPI focuses on technical API details like endpoints, HTTP methods, and request/response structures, ALPS uses these IA concepts to structure business domains.

[^uia]: [Understanding Information Architecture](https://understandinggroup.com/ia-theory/understanding-information-architecture)

## Position in the Design Process

ALPS bridges business requirements and system design from the early stages of development. While traditional endpoint-centric design is used at the documentation stage of finalized specifications, ALPS can be utilized from the requirements definition phase. This enables early detection of misinterpretations in business requirements. It also establishes a common language between technical and business teams and provides a structure that makes it easier to understand the scope of design changes.

ALPS goes beyond API endpoint design to provide a means of systematizing and sharing business domain knowledge. As a **Single Source of Truth (SSOT)**, it consistently models system structure and behavior. Through business terminology-centered descriptions, it can clearly express complex business rules, visualize workflows, and provide an intuitive understanding of information interactions from a bird's-eye view.

## Adapting to Technical Changes

ALPS has the flexibility to apply to various API styles. Even as technology evolves and architectural styles change, business domain design can be maintained. The domain model defined in ALPS can continue to be used despite technical changes such as transitions from RESTful APIs to GraphQL, introduction of microservice architecture, or adoption of new communication protocols. This is because ALPS focuses on abstraction rather than implementation details.

## From Information Design to Domain Model

In Taxonomy implementation, relationships between business entities are defined, and scalability through hierarchical structure is ensured. This establishes a common vocabulary across the organization, streamlining communication. Choreography defines business process flows and service coordination rules, ensuring system-wide consistency and reliability.

By applying IA concepts to domain modeling, technical implementation and business requirements can be naturally connected. ALPS functions as a framework to achieve this bridge, serving as a foundation for structuring and evolving organizational knowledge.

## Summary

By applying information architecture concepts to domain modeling, ALPS functions beyond an API design tool as a framework that structures business domain knowledge and bridges it to technical implementation. It provides a sustainable domain model that is relatively immune to technological changes.
