---
layout: docs-en
title: ASD Installation and Usage Guide
category: Manual
permalink: /manuals/1.0/en/quick-start.html
---

# Installation and Usage Guide

ASD (app-state-diagram) is a tool for creating comprehensive ALPS documentation that includes application state transition diagrams and vocabulary lists. It can be used in the following ways:

## Choosing Usage Method

### 1. Online Version

Use immediately without local installation:

- [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/)

Features:
- JSON/XML/HTML files can be loaded via drag & drop
- Snippets and advanced code completion

### 2. Homebrew Version

Easiest to use in environments where [homebrew](https://brew.sh) is installed. It also always stays up-to-date with the latest version.

Installation:

```bash
brew install alps-asd/asd/asd
```

Note: Currently installs the legacy PHP version.

### 3. npm Version (Recommended)

Available in environments with Node.js 18 or higher installed.

Installation:

```bash
npm install -g @alps-asd/app-state-diagram
```

### 4. GitHub Actions Version

Create ASD in CI. See [marketplace](https://github.com/marketplace/actions/app-state-diagram) for details.

### 5. Language Server (experimental)

A Language Server that provides real-time validation, code completion, and hover information for editors such as Vim and VSCode.

[GitHub - alps-lsp](https://github.com/alps-asd/alps-lsp)

## Usage

### Running Demo
```bash
# Download and run demo file
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### Command Line Options
```
asd [options] [alpsFile]

Options:
    -w, --watch     Watch mode
    -m, --mode      Drawing mode
    --port          Port to use (default 3000)
```

### Mode Settings
- Markdown mode available for use with private repositories
- However, diagram links don't function in Markdown mode
- Use as alternative option when HTML cannot be published

## Installation Verification

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## Selection Guidelines

- Quick trial, temporary use → Online version
- Local use (Mac/Linux) → Homebrew version
- Node.js environment → npm version
- CI/CD environment use → GitHub Actions version

For other installation methods, see [Legacy Installation](/manuals/1.0/en/legacy-install.html).
