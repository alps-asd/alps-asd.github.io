---
layout: docs-en
title: ASD Installation and Usage Guide
category: Manual
permalink: /manuals/1.0/en/quick-start.html
---

# ASD Installation and Usage Guide

ASD (app-state-diagram) is a tool for creating comprehensive ALPS documentation that includes application state transition diagrams and vocabulary lists. It can be used in the following ways:

## Choosing Usage Method

### 1. Online Version

Use immediately without local installation:

- [https://app-state-diagram.free.nf/](https://app-state-diagram.free.nf/)

Features:
- No installation required
- Immediately available in browser
- JSON/XML/HTML files can be loaded via drag & drop
- Snippets and advanced code completion
- Recommended option when local installation is not needed
- Note: Currently unable to edit multiple files simultaneously

### 2. Homebrew Version

Easiest to use in environments where [homebrew](https://brew.sh) is installed.

Installation:

```bash
brew install alps-asd/asd/asd
```

### 3. Docker Version

Download and run a script to execute in Docker. Follow these security verification steps as this involves downloading and running a shell script.

#### Security Verification Steps

1. Review script content (recommended):

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | less
```

2. Verify checksum:

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | sha256sum
```

Expected value:
```
0f05034400b2e7fbfee6cddfa9dceb922e51d93fc6dcda62e42803fb8ef05f66
```

3. Execute installation:

```bash
sudo curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh -o /usr/local/bin/asd
sudo chmod +x /usr/local/bin/asd
```

#### Prerequisites
- Docker must be installed
- curl command must be available

### 4. Mac Launcher Application (GUI Version)

A Mac GUI application that doesn't require command line operations.

Installation steps:
1. Download [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip)
2. Security verification:
    - View the downloaded files and verify the contents before proceeding
    - Verify the checksum (SHA-256):
      ```bash
      shasum -a 256 [downloaded zip file]
      ```
    - Compare with the expected checksum on the official repository: 659ecc3225b95a04f0e2ac4ebed544267ba78a0221db7ed84b6dfd7b08ce423b
3. Open the verified script in Script Editor:
    - If you get a security warning, right-click (or Control-click) the script and select "Open"
    - In System Settings > Privacy & Security, click "Open Anyway" if prompted
4. Select "File" > "Export..."
5. Save location: "Applications"
6. Save as Format: "Application"

### 5. GitHub Actions Version

Create ASD in CI. See [marketplace](https://github.com/marketplace/actions/app-state-diagram) for details.

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
- Local use on Mac → Homebrew version
- Cross-platform use → Docker version
- Mac local environment with GUI → Launcher application
- CI/CD environment use → GitHub Actions version
