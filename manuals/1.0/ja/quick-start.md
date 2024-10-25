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

- [https://app-state-diagram.com/](https://app-state-diagram.com/)

特徴：
- インストール不要
- ブラウザですぐに利用可能
- JSON/XML/HTMLファイルをドラッグ＆ドロップで読み込み可能
- スニペットや高度なコード補完機能
- ローカル環境へのインストールが不要な場合の推奨オプション
- 注意）現在複数ファイルを一度に編集することができません

### 2. Homebrew版

[homebrew](https://brew.sh/ja/)がインストールされている環境では最も簡単に利用できます。

インストール:

```bash
brew install alps-asd/asd/asd
```

### 3. Docker版

Dockerで実行するためのスクリプトをダウンロードして実行します。シェルスクリプトのダウンロードと実行を伴うために以下のセキュリティ確認手順に従ってください。

#### セキュリティ確認手順

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

#### 前提条件
- Dockerがインストールされていること
- curlコマンドが利用可能であること

### 4. Macランチャーアプリケーション（GUI版）

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

### 5. GitHub Actions版

CIでASD作成を行います。詳細は[マーケットプレイス](https://github.com/marketplace/actions/app-state-diagram)をご覧ください。

## 使用方法

### デモ実行
```bash
# デモファイルのダウンロードと実行
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

### コマンドラインオプション
```
asd [options] [alpsFile]

オプション：
    -w, --watch     ウォッチモード
    -m, --mode      描画モード
    --port          利用ポート（デフォルト3000）
```

### モード設定
- 非公開リポジトリでの利用時はMarkdownモードを使用可能
- ただし、Markdownモードではダイアグラムのリンクは機能しません
- HTMLを公開できない場合の代替オプションとして利用

## インストール確認

```bash
asd
usage: asd [options] alps_file
@see https://github.com/alps-asd/app-state-diagram#usage
```

## 選択の目安

- すぐに試したい、一時的な利用 → オンライン版
- Mac環境でのローカル利用 → Homebrew版
- クロスプラットフォームでの利用 → Docker版
- Macローカル環境でGUI → ランチャーアプリケーション
- CI/CD環境での利用 → GitHub Actions版
