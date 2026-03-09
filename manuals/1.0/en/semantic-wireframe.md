---
layout: docs-en
title: Semantic Wireframe
category: Manual
permalink: /manuals/1.0/en/semantic-wireframe.html
---

# Semantic Wireframe

<figure style="max-width: 45%; margin-bottom: 1em;">
<img src="/images/semantic-wireframe.png" alt="Semantic Wireframe" style="width: 100%;">
<figcaption style="font-size: 0.85em; color: #666; margin-top: 0.5em;">A wireframe that visualizes meaning structure — what information exists and how transitions connect them — rather than layout or UI components. Hovering reveals ALPS descriptor IDs</figcaption>
</figure>

## Why Semantic Wireframes

ALPS design enables visualizing the same information structure in multiple forms.

- **ALPS profiles** (JSON/XML) precisely define the application's meaning structure, but are developer-oriented
- **ASD** (state diagrams) visualize application-wide state transitions as a graph
- **Semantic wireframes** visualize the same information structure as HTML pages — an extension of the traditional wireframe format

They let you reach agreement with stakeholders on information architecture before investing in visual design.

## How It Works

Swap only the CSS while keeping the HTML identical — the same idea as [CSS Zen Garden](http://www.csszengarden.com/) (2003). The difference is the purpose. CSS Zen Garden demonstrated the separation of content and presentation as a CSS technique; semantic wireframes leverage that separation as **a design tool for stakeholder communication**.

Every CSS class in the HTML uses only ALPS semantic descriptor IDs, with no presentation classes.

```html
<article class="Book">
  <h2 class="bookTitle">The Art of Web Design</h2>
  <span class="price">$29.99</span>
  <a href="cart.html" class="doAddToCart">Add to Cart</a>
</article>
```

There are no presentation classes like `container` or `btn-primary`. Only meaning structure remains in the HTML. Styles are applied to those semantic classes, and by swapping only the CSS, three fidelity levels are achieved:

- **Level 1** — Minimal readability, no layout
- **Level 2** — Information skeleton (wireframe)
- **Level 3** — Full design with typography, color, and responsive layout

The AI skill ([alps-to-mock](ai-assistant.html#skill-claude-code)) or MCP tool ([alps2mock](ai-assistant.html#available-tools)) can auto-generate these from an ALPS profile.

## Visual Notation

The [Level 2 wireframe](example.html#html-mock) uses the following visual notation.

### Hover Labels

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <span title=".Book" style="border: 1px solid #ccc; padding: 4px 12px; background: #f9f9f9; font-size: 14px; cursor: default; position: relative;">Book<span style="position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 2px 8px; border-radius: 3px; font-size: 12px; white-space: nowrap;">.Book</span></span>
  <span style="align-self: center; color: #666; font-size: 14px;">Hover any element to see its ALPS semantic descriptor ID as a tooltip</span>
</div>

### Dashed Borders

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <div style="border: 1px dashed #999; padding: 8px 16px; font-size: 14px; color: #333;">section</div>
  <span style="align-self: center; color: #666; font-size: 14px;"><code>section</code>, <code>article</code>, and <code>aside</code> are outlined with dashed borders, making block structure visible</span>
</div>

### Underlined Links

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <span style="text-decoration: underline; color: #00A86B; font-size: 14px;">Book Details</span>
  <span style="align-self: center; color: #666; font-size: 14px;">safe transition (<code>go*</code>) — read-only navigation with no side effects</span>
</div>

### Transition Types and Left Border Colors

Button left border colors distinguish transition types, using the same colors as state diagram edges.

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #00A86B; padding: 6px 16px; background: white; font-size: 14px;" disabled>Search</button>
  <span style="align-self: center; color: #666; font-size: 14px;">safe — read-only, no side effects</span>
</div>
<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #FF4136; padding: 6px 16px; background: white; font-size: 14px;" disabled>Add to Cart</button>
  <span style="align-self: center; color: #666; font-size: 14px;">unsafe — state-changing, non-idempotent</span>
</div>
<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <button style="border: 1px solid #ccc; border-left: 3px solid #D4A000; padding: 6px 16px; background: white; font-size: 14px;" disabled>Update Quantity</button>
  <span style="align-self: center; color: #666; font-size: 14px;">idempotent — state-changing, idempotent</span>
</div>

### X-box Images

<div style="display: flex; gap: 1rem; flex-wrap: wrap; margin: 1rem 0;">
  <svg width="60" height="40" style="border: 1px solid #ccc; background: #f0f0f0;"><line x1="0" y1="0" x2="60" y2="40" stroke="#999" stroke-width="1"/><line x1="60" y1="0" x2="0" y2="40" stroke="#999" stroke-width="1"/></svg>
  <span style="align-self: center; color: #666; font-size: 14px;">Image placeholder — standard wireframe notation for "an image goes here"</span>
</div>

## Demo

See the same online bookstore information structure in three forms:

- [ALPS](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.xml) — Profile
- [ASD](https://alps-asd.github.io/app-state-diagram/demo/bookstore/alps.html) — State diagram
- [Wireframe](https://www.app-state-diagram.com/alps/mock/level2/) — Semantic wireframe

By swapping only the CSS, you can switch from the wireframe to a skeleton view or a near-production design. [Compare all three fidelity levels](example.html#html-mock).

## AI Affinity

The HTML of a semantic wireframe is self-describing — the meaning structure is expressed directly, not buried under presentation. In typical HTML, AI must infer meaning through the noise of layout and decoration classes like `flex`, `md:grid-cols-3`, and `shadow-lg`. In semantic HTML, that guesswork is eliminated. Fewer tokens, more accurate understanding.
