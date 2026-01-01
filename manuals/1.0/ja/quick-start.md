---
layout: docs-ja
title: ASDインストールと利用ガイド
category: Manual
permalink: /manuals/1.0/ja/quick-start.html
---

# インストールと利用ガイド

ASD（app-state-diagram）は、アプリケーションの状態遷移図やボキャブラリリストを含んだALPSの包括的なドキュメントを作成するためのツールです。以下の方法で利用できます。

## 利用方法の選択

### 1. オンライン版

ローカルインストール不要で、すぐに利用できます：

- [ https://editor.app-state-diagram.com/]( https://editor.app-state-diagram.com/)

特徴：
- JSON/XML/HTMLファイルをドラッグ＆ドロップで読み込み可能
- スニペットや高度なコード補完機能

### 2. Homebrew版（推奨）

[homebrew](https://brew.sh/ja/)がインストールされている環境では最も簡単に利用できます。また常に最新版に更新されます。

インストール:

```bash
brew install alps-asd/asd/asd
```

### 3. npm版

Node.js 20以上がインストールされている環境で利用できます。

インストール:

```bash
npm install -g @alps-asd/app-state-diagram
```

### 4. GitHub Actions版

CIでASD作成を行います。詳細は[マーケットプレイス](https://github.com/marketplace/actions/app-state-diagram)をご覧ください。

### 5. Language Server (experimental)

VimやVSCodeなどのエディタでリアルタイム検証、コード補完、ホバー情報を提供するLanguage Serverです。

[GitHub - alps-lsp](https://github.com/alps-asd/alps-lsp)

## 使用方法

### デモ実行
```bash
# デモファイルのダウンロードと実行
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### コマンドラインオプション
```
asd [options] alps_file

オプション：
  -v, --version          バージョン表示
  -e, --echo             ファイルではなく標準出力に出力
  -f, --format <format>  出力形式 (html|svg|dot|mermaid)
  -o, --output <file>    出力ファイル (デフォルト: <入力>.html)
  --label <mode>         ラベルモード: id または title
  --validate             ALPSプロファイルを検証
  -w, --watch            ウォッチモード（ライブリロード）
  --port <port>          ウォッチモードのCDPポート (デフォルト: 9222)

コマンド：
  merge <base> <source>  ALPSプロファイルをマージ
```

## インストール確認

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## 選択の目安

- すぐに試したい、一時的な利用 → オンライン版
- ローカル利用（Mac/Linux） → Homebrew版
- Node.js環境での利用 → npm版
- CI/CD環境での利用 → GitHub Actions版

その他のインストール方法については[レガシーインストール](/manuals/1.0/ja/legacy-install.html)を参照してください。
