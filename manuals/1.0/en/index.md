---
layout: docs-en
title: Introduction
category: Manual
permalink: /manuals/1.0/en/
---
# Introduction

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## ALPS: A format for clarifying application-level semantics and structure

Application-Level Profile Semantics (ALPS) is a format that expresses application-level semantics and adds application-specific information to general-purpose media such as JSON and HTML. operations, making the development process more efficient, improving compatibility between systems, and facilitating API reusability and discoverability.

Consider the example of an e-commerce platform. When integrating with multiple payment services, ALPS standardizes the meaning of data and operations for each step of the payment process, facilitating API integration across different systems. Front-end and back-end developers can also communicate effectively in a common language to quickly add and improve functionality.

## ASD: Visualization of Application State Transitions

ASD (Application State Diagram) is a tool for visualizing application state transitions and actions from ALPS documents. This enables a bird's-eye view of the overall structure of the application and an intuitive grasp of the transitions between states and possible actions. For example, in an online shopping application, the process from the user's search for a product to its purchase can be clearly visualized, making it easier for developers to understand the choices and possible actions the user faces at each stage. This aids design decisions that lead to improved user experience.

The use of ASDs provides a common point of reference (Single Source of Truth, [SSOT](https://ja.)) for nearly all team members involved in a project, including product owners, back-end and front-end developers, and UI/UX designers. wikipedia.org/wiki/%E4%BF%A1%E9%A0%BC%E3%81%A7%E3%81%8D%E3%82%8B%E5%94%AF%E4%B8%80%E3%81%AE%E6%83%85%E5%A0%B1%E6%BA%90). This facilitates effective communication and cooperation among team members with different areas of expertise, helping to bring complex projects and new members on board quickly. It also allows the application flow and logic to be quickly evaluated and adjusted accordingly, providing an opportunity to identify and resolve problems early in the design process, directly contributing to increased development efficiency and improved application quality.

Utilizing ASD increases project transparency and minimizes discrepancies between the visions held by each team member.

## Information Architecture for REST Application Design

ALPS and ASD are important tools for designing and understanding REST applications within the framework of information architecture. ALPS standardizes the meaning and structure of the data handled by the application and uses a common vocabulary to define the meaning and function of information. ASD, on the other hand, provides a state transition diagram of the application, helping to visually understand the user's actions and the application's reactions. Thus, ALPS and ASD provide a foundation for enhancing information architecture in REST application development, supporting efficient communication among teams, and improving consistency and quality throughout the project.

Building a **basis of shared understanding** that resolves conflicts among diverse developers is essential to increase development efficiency, provide a superior user experience, and ensure project sustainability. ALPS and ASD can be very effective tools to achieve this goal.
