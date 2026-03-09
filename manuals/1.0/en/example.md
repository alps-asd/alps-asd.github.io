---
layout: docs-en
title: Example
category: Manual
permalink: /manuals/1.0/en/example.html
---

# Example

## State Diagrams

* [Online Bookstore](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) - Book catalog and purchase flow. Demonstrates tags, doc, and def usage
* [Amazon Shopping](https://alps-asd.github.io/app-state-diagram/demo/amazon/alps.html) - From product search to reviews, wishlists, and subscriptions. Large-scale profile structure
* [Learning Management System](https://alps-asd.github.io/app-state-diagram/demo/lms/alps.html) - Course management, assignments, and grading. Nested descriptors and href-based reuse

## HTML Mock

HTML mock generated from an ALPS profile. The ALPS information structure appears directly as semantic HTML — every CSS class is an ALPS descriptor ID, no presentation classes. CSS adds progressive fidelity to this semantic skeleton, from bare readability to full visual design. The HTML is identical across all three levels; only the CSS differs.

* [Online Bookstore Mock](https://www.app-state-diagram.com/alps/mock/level2/) — Three CSS fidelity levels over the same semantic HTML:
  * [Level 1 - Bare](https://www.app-state-diagram.com/alps/mock/level1/) — Minimal readability, no layout
  * [Level 2 - Wireframe](https://www.app-state-diagram.com/alps/mock/level2/) — Information skeleton. Hover any element to see its ALPS descriptor ID
  * [Level 3 - Production](https://www.app-state-diagram.com/alps/mock/level3/) — A demo of full design system with typography, color, and responsive layout

Start with Level 2 to review information architecture with stakeholders before investing in visual design.
