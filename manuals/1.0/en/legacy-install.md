---
layout: docs-en
title: Legacy Installation Methods
category: Manual
permalink: /manuals/1.0/en/legacy-install.html
---

# Legacy Installation Methods

This page documents installation methods that are no longer recommended. For the latest installation methods, please refer to the [Quick Start](/manuals/1.0/en/quick-start.html).

## Mac Launcher Application (GUI Version)

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

## Docker Version (PHP Version)

Download and run a script to execute in Docker. Follow these security verification steps as this involves downloading and running a shell script.

### Security Verification Steps

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

### Prerequisites
- Docker must be installed
- curl command must be available

Note: The Docker version uses the PHP version. For new installations, npm or Homebrew is recommended.

## VSCode Plugin (experimental)

You can live edit ALPS files while viewing the preview screen using the VSCode Plugin.

[Visual Studio Marketplace - Application State Diagram](https://marketplace.visualstudio.com/items?itemName=koriym.app-state-diagram)

Note: Consider using the [Language Server](https://github.com/alps-asd/alps-lsp) for broader editor support.

## Composer (PHP Version)

The PHP version of app-state-diagram can be installed via Composer.

```bash
composer require alps-asd/app-state-diagram
```

```bash
./vendor/bin/asd -w profile.json
```

Note: The PHP version is currently in maintenance mode. For new installations, npm or Homebrew is recommended.
