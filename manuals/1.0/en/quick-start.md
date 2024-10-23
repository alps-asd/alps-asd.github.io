---
layout: docs-en
title: Quick Start
category: Manual
permalink: /manuals/1.0/en/quick-start.html
---

# Quick Start

To convert ALPS documents into ASD (App State Diagram) documents with state transition diagrams and vocabulary lists using asd (app-state-diagram), you can use the asd tool.
The asd tool is available in several versions: online version, homebrew version, docker version, Mac launcher application version, and GitHub Actions version.

## Online Version

Using the online tool is the easiest method.

[https://app-state-diagram.free.nf/](https://app-state-diagram.free.nf/)

Currently, there is a limitation that only single files can be edited.

## Homebrew Version

Installation:

```shell
brew install alps-asd/asd/asd
```

Download and run the demo document:

```shell
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

## Docker Version

Installation:

```shell
curl -L https://alps-asd.github.io/app-state-diagram/asd.sh > ./asd && chmod +x ./asd && sudo mv ./asd /usr/local/bin
```

Download and run the demo document:

```shell
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > profile.json
asd --watch ./profile.json
```

## Mac Launcher Application

A Mac GUI application that doesn't require console operations is also available.

Installation and execution:

* Download [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip) and open the `asd` script.
* In Script Editor, select `File` > `Export...`, choose `Applications` as the location and set file format to `Application`.
* Run it and select an ALPS file to start the ASD server. Drag & drop is also supported.

## GitHub Actions Version

Create ASD in CI. For details, please see [https://github.com/marketplace/actions/app-state-diagram](https://github.com/marketplace/actions/app-state-diagram).

## Execution Options

```
asd [options] [alpsFile]

    -w, --watch
        Watch mode

    -m, --mode
        Drawing mode

     --port
        Port to use (default 3000)
```

### Mode

If your repository is private and your account is not a GHE or GHE Cloud account, you cannot make GitHub Pages private. In such cases, you can output in Markdown and keep the documentation private.

Unfortunately, there is no way to host linked SVG diagrams in Markdown. When converting to Markdown, the diagrams lose their links. Markdown is an option when you cannot publish HTML.
