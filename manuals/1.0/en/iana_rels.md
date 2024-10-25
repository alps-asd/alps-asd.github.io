---
layout: docs-en
title: IANA Link Relations
category: Manual
permalink: /manuals/1.0/en/iana_rels.html
---

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
