---
layout: docs-ja
title: レガシーインストール方法
category: Manual
permalink: /manuals/1.0/ja/legacy-install.html
---

# レガシーインストール方法

このページでは、現在は推奨されていないインストール方法を記載しています。最新のインストール方法については[クイックスタート](/manuals/1.0/ja/quick-start.html)を参照してください。

## Macランチャーアプリケーション（GUI版）

コマンドライン操作が不要なMac用GUIアプリケーションです。

インストール手順：
1. [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip)をダウンロード
2. セキュリティ確認：
   - ダウンロードしたファイルの内容を確認してください
   - チェックサム（SHA-256）の検証：
     ```bash
     shasum -a 256 [ダウンロードしたzipファイル]
     ```
   - 公式リポジトリの期待値と比較してください: 659ecc3225b95a04f0e2ac4ebed544267ba78a0221db7ed84b6dfd7b08ce423b
3. ダウンロードしたスクリプトをスクリプトエディタで開く
    - セキュリティ警告が表示された場合は、スクリプトを右クリック（またはControlキーを押しながらクリック）して「開く」を選択
    - システム設定 > プライバシーとセキュリティで、表示された場合は「開く」をクリック
4. アプリケーションとして書き出す：
   - 保存先：「アプリケーション」
   - フォーマット：「アプリケーション」として保存

## Docker版（PHP版）

Dockerで実行するためのスクリプトをダウンロードして実行します。シェルスクリプトのダウンロードと実行を伴うために以下のセキュリティ確認手順に従ってください。

### セキュリティ確認手順

1. スクリプトの内容確認（推奨）：

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | less
```

2. チェックサム検証：

```bash
curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh | sha256sum
```

期待値：
```
0f05034400b2e7fbfee6cddfa9dceb922e51d93fc6dcda62e42803fb8ef05f66
```

3. インストール実行：

```bash
sudo curl -sL https://alps-asd.github.io/app-state-diagram/asd.sh -o /usr/local/bin/asd
sudo chmod +x /usr/local/bin/asd
```

### 前提条件
- Dockerがインストールされていること
- curlコマンドが利用可能であること

注意：Docker版はPHP版を使用しています。新規インストールにはnpmまたはHomebrewをお勧めします。

## VSCode Plugin (experimental)

VSCodeでライブプレビューを可能にするプラグインです。

[Visual Studio Marketplace - Application State Diagram](https://marketplace.visualstudio.com/items?itemName=koriym.app-state-diagram)

注意：より幅広いエディタサポートには[Language Server](https://github.com/alps-asd/alps-lsp)の使用を検討してください。

## Composer（PHP版）

PHP版のapp-state-diagramはComposerでインストールできます。

```bash
composer require alps-asd/app-state-diagram
```

```bash
./vendor/bin/asd -w profile.json
```

注意：PHP版は現在メンテナンスモードです。新規インストールにはnpmまたはHomebrewをお勧めします。
