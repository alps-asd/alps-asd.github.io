---
layout: docs-ja
title: クイックスタート
category: Manual
permalink: /manuals/1.0/ja/quick-start.html
---
# クイックスタート

## 環境

ASDの実行には[Docker](https://www.docker.com/products/docker-desktop)が必要です。

## インストール

次のコマンドでasdコマンドをインストールします。

```
curl -L https://alps-asd.github.io/app-state-diagram/asd.sh > ./asd && chmod +x ./asd && sudo mv ./asd /usr/local/bin
```

## デモの実行

以下の操作でASDサーバーが起動します。

```
mkdir work
curl -L curl https://alps-asd.github.io/app-state-diagram/blog/profile.json > work/profile.json
asd --watch ./work/profile.json
```

ブラウザで[http://localhost:3000/](http://localhost:3000/)を開きます。
Application State Diagramのリンクでダイアグラムが確認できますか？

## Macアプリケーション

コンソールの操作が不要なMacのGUIアプリケーションも用意されています。

実行方法：
* [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/refs/tags/v1.zip)をダウンロードして`asd`スクリプトを開きます。
* ツールバーの実行ボタンをクリックするか、`Command-R`キーを押して、スクリプトを実行します。
* ALPSファイルを選択するとASDサーバーが起動されます。

## アプリケーション状態遷移図

矢印で結ばれたそれぞれの四角形を**アプリケーション状態**といいます。**リソースの状態**と **アフォーダンス**（次のアクション）がリンクとして示されていて、リンクを辿ることでアプリケーション状態が遷移します。 `<a>`タグや`<form>`タグで各ページがリンクされたWebサイトをイメージしてください。

遷移図はSVGフォーマットで、アプリケーション状態やリンクの詳細ページにリンクされています。
