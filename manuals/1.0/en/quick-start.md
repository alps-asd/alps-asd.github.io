---
layout: docs-en
title: Quick Start
category: Manual
permalink: /manuals/1.0/en/quick-start.html
---
# Quick Start

## Requirement

ASD requires [Docker](https://www.docker.com/products/docker-desktop).

## Install

Install the asd command.

```
curl -L https://alps-asd.github.io/app-state-diagram/asd.sh > ./asd && chmod +x ./asd && sudo mv ./asd /usr/local/bin
```

## Run the demo

The following will start the development server.

```
mkdir work
curl -L curl https://alps-asd.github.io/app-state-diagram/blog/profile.json > work/profile.json
asd --watch ./work/profile.json
```

Open [http://localhost:3000/](http://localhost:3000/) in your browser.
Can you see the diagram in the Application State Diagram link?

## Mac Application

A Mac GUI application that does not require console operation is also available.

Install:
* Download [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip) and open the `asd` script.
* In the script editor, select `File` > `Export...` and save the file to the `Application` folder with the file format as application.

Run:
* Open `asd` appliction  or drag and drop an ALPS file into the `asd` application.
* Selecting the ALPS file will start the asd server.

## Application State Diagram

Each rectangle connected by an arrow is called **application state**. **The resource state** and **affordance** (next action) are shown as links, and the application state transitions by following the links. Imagine a website where each page is linked with `<a>` tags and `<form>` tags.

The transition diagram is in SVG format and is linked to the detailed pages of the application states and links.
