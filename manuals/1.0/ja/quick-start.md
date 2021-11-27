---
layout: docs-ja
title: クイックスタート
category: Manual
permalink: /manuals/1.0/ja/quick-start.html
---
# クイックスタート

## インストール

dockerイメージを取得します。

```
docker pull ghcr.io/alps-asd/app-state-diagram:latest
```

asdコマンドをインストールします。

```
curl -L https://alps-asd.github.io/app-state-diagram/asd.sh > ./asd && chmod +x ./asd && sudo mv ./asd /usr/local/bin
```

## デモの実行

以下の操作で開発サーバーが起動します。

```
mkdir work
curl -L curl https://alps-asd.github.io/app-state-diagram/blog/profile.json > work/profile.json
asd --watch ./work/profile.json
```

ブラウザで[http://localhost:3000/](http://localhost:3000/)を開きます。
**Application State Diagram**をクリックしたらダイアグラムが見えましたか？


## アプリケーション状態遷移図

矢印で結ばれたそれぞれの四角形を**アプリケーション状態**といいます。**リソースの状態**と **アフォーダンス**（次のアクション）がリンクとして示されていて、リンクを辿ることでアプリケーション状態が遷移します。 `<a>`タグや`<form>`タグで各ページがリンクされたWebサイトをイメージしてください。

遷移図はSVGフォーマットで、アプリケーション状態やリンクの詳細ページにリンクされています。
