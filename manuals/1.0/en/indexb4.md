---
layout: docs-en
title: Introduction
category: Manual
permalink: /manuals/1.0/en/index4b.html
---
# Introduction

![ASD](https://alps-asd.github.io/app-state-diagram/blog/profile.svg)

## ALPS: A way to organize app information

ALPS (Application Level Profile Semantics) is a way to neatly describe the information and mechanics of an app. It adds app-specific information to formats commonly used on the Internet (e.g., JSON and HTML) to clarify how the app works and what information it handles. This will make the process of creating the app smoother and allow different apps and systems to work well together.

For example, consider an online shopping site. For the sequence of steps (including payment) that a customer goes through to select and buy a product, ALPS can clearly show what is happening at each step. This makes it easier for those who create the app to make the necessary improvements to ensure a smooth shopping experience for customers.

## ASD: Diagrams showing how the app works

The ASD (Application State Transition Diagram) shows a diagram of how the app moves and the operations the user can perform based on the app information described in the ALPS. This allows you to understand at a glance how the app is working. In the case of an online shopping site, the diagram shows a series of steps, such as searching for a product, adding it to the cart, and paying for it.

ASD allows people in different roles in the team building the app, such as programmers and designers, to have a common understanding of how the app should work. This can be very helpful in discussions about how to improve the app and in coming up with new ideas.

## Designing REST Applications

ALPS and ASD are especially useful for designing apps that run on the web (called REST applications). Using these tools, you can clearly show what information the app handles and how it works. The result is an app that is easier to create and improve, and more user-friendly for the people using it.

In order for team members with diverse skills to work efficiently toward the same goal, it is important that they understand exactly what each other is working on, and ALPS and ASD are very useful tools to help them achieve this understanding.

