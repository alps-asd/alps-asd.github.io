---
layout: docs-en
title: ALPS AI Guide
category: Manual
permalink: /manuals/1.0/en/ai-assistant.html
image: /images/ai-guide.png
---

# ALPS AI Guide

<img src="/images/ai-guide.png" alt="ALPS Design with AI" style="max-width: 200px; margin-bottom: 1em;">

## Why AI Makes a Great ALPS Guide

ALPS design requires balancing multiple concerns: clear state definitions, meaningful transitions, consistent naming, and alignment with standard vocabularies. AI assistants excel at this kind of multi-dimensional thinking.

### Deep Context Understanding

AI can analyze your domain requirements and identify the essential states and transitions. When you describe "an e-commerce system with shopping cart," the AI understands the implicit flow: browsing → cart → checkout → confirmation, and suggests appropriate state names and transition labels.

### Semantic Naming

Naming requires more than following conventions—it demands understanding intent. While linters can enforce patterns like `go*` or `do*`, AI understands *what you mean* and *why it matters*.

When you describe "let users save items for later," AI recognizes this as a wishlist pattern and suggests `doAddToWishlist` aligned with Schema.org's `WantAction`—not a generic `doSave`. It distinguishes `author` (creative attribution) from `creator` (technical origin), ensuring your vocabulary connects meaningfully with external systems.

### Standards Compliance

AI automatically aligns your descriptors with established vocabularies:

- [Schema.org](https://schema.org/) definitions for common concepts
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/) for standard relationships
- Consistent naming conventions across your entire profile

## Integration Methods

Choose the method that fits your environment:

| Priority | Environment | Method |
|----------|-------------|--------|
| 1st | Skill clients | [Skill](#skill-claude-code) |
| 2nd | MCP clients | [MCP Server](#mcp-server) |
| 3rd | Any LLM | [llms.txt](#llmstxt-any-llm) |

## Skill (Claude Code)

The recommended method for [Claude Code](https://claude.ai/code) users. Skills provide persistent context that guides AI behavior throughout your session.

### Setup

```bash
claude --version  # Requires 2.0.0+
claude update     # Update if needed

mkdir -p .claude/skills/alps
curl -o .claude/skills/alps/SKILL.md \
  https://raw.githubusercontent.com/alps-asd/app-state-diagram/master/.claude/skills/alps/SKILL.md
```

### Verify

Ask: "What skills are available?"

Response should include "alps" skill.

### Usage

- "Create an ALPS profile for a blog system"
- "Validate alps.xml and fix any issues"

Input can be text, Figma designs, OpenAPI specs, whiteboard photos, website URLs, and <span class="tooltip-trigger">more<span class="tooltip-content">database schemas, existing code, GraphQL schemas, Postman collections, Swagger docs, sequence diagrams, user stories, ERDs, JSON responses, route definitions, meeting notes, Slack threads, napkin sketches...</span></span>.

**Tip:** Press `Ctrl+V` in the console to paste images from clipboard.

## MCP Server

For AI clients supporting [Model Context Protocol](https://modelcontextprotocol.io/). MCP provides real-time tool access for validation and diagram generation.

### Setup

First, find your asd path:

```bash
which asd  # e.g., /opt/homebrew/bin/asd
```

Create `.mcp.json` in your project using the full path:

```json
{
  "mcpServers": {
    "alps": {
      "command": "/opt/homebrew/bin/asd",
      "args": ["--mcp"]
    }
  }
}
```

Verify: `/mcp` should show "alps" in the list.

Note: MCP connection may disconnect during sessions. Run `/mcp` to reconnect.

### For Other MCP Clients

Add `asd --mcp` (with full path) as stdio server in your MCP client configuration.

### Available Tools

| Tool | Description |
|------|-------------|
| `validate_alps` | Validate ALPS profile and get detailed feedback |
| `alps2svg` | Generate SVG state diagram |
| `alps_guide` | Get ALPS best practices |

## llms.txt (Any LLM)

For LLMs without Skill or MCP support. The [llms.txt standard](https://llmstxt.org/) provides AI-friendly documentation that any assistant can consume.

### Resources

| Resource | Description |
|----------|-------------|
| [llms.txt](/llms.txt) | ALPS specification index |
| [llms-full.txt](/llms-full.txt) | Complete ALPS specification |
| [ALPS Creation Guide](https://raw.githubusercontent.com/alps-asd/app-state-diagram/master/.claude/skills/alps/SKILL.md) | Design principles and examples |

### System Prompt

Add to your system prompt or AGENTS.md:

```text
For ALPS profile creation, refer to: https://raw.githubusercontent.com/alps-asd/app-state-diagram/master/.claude/skills/alps/SKILL.md
```

### Manual Copy

<button id="copyLlmsText" class="copy-button">Copy llms-full.txt</button>
<span id="copyStatus" class="copy-status"></span>

Paste at the beginning of your conversation or upload as a file attachment.

## OpenAI GPTs

[ALPS Assistant](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant) is a custom GPT trained specifically for ALPS questions.

Note: Requires OpenAI Plus account.

## Google NotebookLM

[ALPS Guide Notebook](https://notebooklm.google.com/notebook/69a90152-3986-4630-a907-bd0e449c000e) is an interactive notebook for exploring ALPS concepts with AI assistance.

<script>
document.getElementById('copyLlmsText').addEventListener('click', function() {
  fetch('/llms-full.txt')
    .then(response => {
      if (!response.ok) throw new Error('File not found');
      return response.text();
    })
    .then(text => {
      navigator.clipboard.writeText(text).then(function() {
        const status = document.getElementById('copyStatus');
        status.textContent = 'Copied!';
        setTimeout(function() { status.textContent = ''; }, 2000);
      }).catch(function(err) {
        alert('Failed to copy to clipboard.');
      });
    })
    .catch(error => {
      alert('Failed to load llms-full.txt.');
    });
});
</script>

<style>
.copy-button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.copy-button:hover {
  background-color: #45a049;
}

.copy-status {
  margin-left: 10px;
  color: #4CAF50;
  font-weight: bold;
}

.tooltip-trigger {
  color: #0066cc;
  text-decoration: underline;
  cursor: help;
  position: relative;
}

.tooltip-trigger:hover {
  color: #004499;
}

.tooltip-content {
  display: none;
  position: absolute;
  background: #333;
  color: white;
  padding: 8px 12px;
  border-radius: 6px;
  font-size: 0.85em;
  width: 280px;
  bottom: 125%;
  left: 50%;
  transform: translateX(-50%);
  z-index: 100;
}

.tooltip-trigger:hover .tooltip-content {
  display: block;
}
</style>
