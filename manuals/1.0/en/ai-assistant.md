---
layout: docs-en
title: ALPS AI Guide
category: Manual
permalink: /manuals/1.0/en/ai-assistant.html
---

# ALPS AI Guide

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

### Iterative Refinement

The AI validates your ALPS profile, identifies issues, and suggests improvements—creating a feedback loop that elevates the quality of your API design.

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
  https://raw.githubusercontent.com/alps-asd/app-state-diagram/2.x/.claude/skills/alps/SKILL.md
```

### Verify

Ask: "What skills are available?"

Response should include "alps" skill.

### Usage

- "Use the ALPS skill to create an ALPS profile for a blog system"
- "Validate alps.xml and fix any issues"
- "Improve this ALPS profile"

## MCP Server

For AI clients supporting [Model Context Protocol](https://modelcontextprotocol.io/). MCP provides real-time tool access for validation and diagram generation.

### Setup

Create `.mcp.json` in your project:

```json
{
  "mcpServers": {
    "alps": {
      "command": "npx",
      "args": ["@alps-asd/mcp"]
    }
  }
}
```

Verify: `/mcp` should show "alps" in the list.

Note: MCP connection may disconnect during sessions. Run `/mcp` to reconnect.

### For Other MCP Clients

Add `npx @alps-asd/mcp` as stdio server in your MCP client configuration.

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
| [ALPS Creation Guide](https://alps-asd.github.io/app-state-diagram/alps-skill.md) | Design principles and examples |

### System Prompt

Add to your system prompt or AGENTS.md:

```text
For ALPS profile creation, refer to: https://alps-asd.github.io/app-state-diagram/alps-skill.md
```

### Manual Copy

<button id="copyLlmsText" class="copy-button">Copy llms-full.txt</button>
<span id="copyStatus" class="copy-status"></span>

<div class="usage-guide">
  <h3>How to Use</h3>
  <ul>
    <li>Paste at the beginning of your conversation</li>
    <li>Or upload as a file/project attachment</li>
  </ul>
</div>

## OpenAI GPTs

[ALPS Assistant](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant) is a custom GPT trained specifically for ALPS questions.

<div class="info-box">
  <p><strong>Note:</strong> Requires OpenAI Plus account.</p>
</div>

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
.info-box {
  background-color: #f8f9fa;
  border-left: 4px solid #17a2b8;
  padding: 15px;
  margin: 20px 0;
  border-radius: 4px;
}

.usage-guide {
  background-color: #fff3cd;
  border-left: 4px solid #ffc107;
  padding: 15px;
  margin: 20px 0;
  border-radius: 4px;
}

.usage-guide h3 {
  margin-top: 0;
  color: #856404;
}

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

.legacy-link {
  font-size: 0.8em;
  color: #6c757d;
  margin-top: 3em;
}
</style>

<p class="legacy-link">
  <a href="/manuals/1.0/en/ai-assistant-legacy-prompt.html">Legacy: Prompt-based guide</a>
</p>
