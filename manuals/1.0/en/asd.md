---
layout: docs-en
title: asd
category: Manual
permalink: /manuals/1.0/en/asd.html
---

# asd

The `asd` tool converts ALPS files to ASD documents.

```
asd [options] [alpsFile]

    -c, --config=asd.xml
        Path to a asd.xml configuration file

    -w, --watch
        Watch mode

    --and-tag={tag1, tag2} --or-tag={tag3} [--color=red]
        Filter graph

    -m, --mode={markdown|html}
        Output format
        
    --port
        Port number used in watch mode
```

If `asd` is run without arguments, a configuration file named `asd.xml` in the same folder is used.

## asd.xml config file

Example）
```xml
<?xml version="1.0"?>
<asd xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="docs/asd.xsd">
    <alpsFile>profile.xml</alpsFile>
    <watch>false</watch>
    <mode>markdown</mode>
</asd>
```

### Optional <asd /> attributes

### watch

```xml
<asd>
  <watch>[bool]</watch>
</asd>
```

You can start ASD development server with watch mode.
Each time the profile file changes, the page is reloaded.

If you want to start with a specific port number, you can specify the port number at startup as follows.

```xml
<asd>
  <port>3001</port>
</asd>
```

### filter

```xml
<asd>
  <filter>
    <and>[string]</and>
    <and>[string]</and>
    <or>[string]</or>
    <color>[string]</color>
  </filter>
</asd>
```

You can extract partial graphs by specific tags, or color specific graphs.

Specify a tag name in the "or" or "and" field to specify the condition. If you specify "color", the graph for that condition will be colored, but if you don't, only the graph for that condition will be extracted and drawn.

### markdown format

If your repository is private and your account is not a GHE or GHE Cloud account, you cannot make GitHub Pqges private. In such a case, you can output the document as Markdown and make the document private.

Unfortunately there is no way to host linked SVGs (diagrams) in Markdown, the dialog will lose the link when in Markdown.

This is an option if public HTML is not possible.

```xml
<asd>
  <mode>markdown</mode>
</asd>
```
