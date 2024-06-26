---
layout: docs-en
title: Quick Start
category: Manual
permalink: /manuals/1.0/en/quick-start.html
---
# Quick Start

## Requirement

You need [Homebrew](https://brew.sh/ja/) or [Docker](https://www.docker.com/products/docker-desktop) to run ASD.

## Homebrew

Recommended. Do the following

```shell
brew install alps-asd/asd/asd
````

To uninstall, do the following: 

```shell
brew uninstall asd
brew untap alps-asd/asd
````

## Docker

Install the asd command with the following command.

```
curl -L https://alps-asd.github.io/app-state-diagram/asd.sh > . /asd && chmod +x . /asd && sudo mv . /asd /usr/local/bin
```

## Demo

After installing either Homebrew or Docker, let's run the demo.

```shell
mkdir work
curl -L curl https://alps-asd.github.io/app-state-diagram/blog/profile.json > work/profile.json
asd --watch ./work/profile.json
```

Open [http://localhost:3000/](http://localhost:3000/) in your browser.
Can you see the diagram in the Application State Diagram link?

## Mac Application

A Mac GUI application that does not require console operation is also available.

Install and Run:
* Download [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip) and open the `asd` script.
* In the script editor, select `File` > `Export...` and save the file to the `Application` folder with the file format as application.
* * Run and select an ALPS file to start the ASD server. Drag & Drop is also supported.

## Application State Diagram

Each rectangle connected by an arrow is called **application state**. **The resource state** and **affordance** (next action) are shown as links, and the application state transitions by following the links. Imagine a website where each page is linked with `<a>` tags and `<form>` tags.

The transition diagram is in SVG format and is linked to the detailed pages of the application states and links.
