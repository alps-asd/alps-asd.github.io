---
layout: docs-ja
title: クイックスタート
category: Manual
permalink: /manuals/1.0/ja/quick-start.html
---

# クイックスタート

asd(app-state-diagram)でALPSドキュメントを状態遷移図やボキャブラリリストのあるASDドキュメントにするにはasdツールを使います。
asdツールはオンライン版、homebrew版、docker版、Macランチャーアプリケーション版、GHアクション版が用意されています。

## オンライン版

オンラインツールを使うのが最も簡単な方法です。

[https://app-state-diagram.free.nf/](https://app-state-diagram.free.nf/)

現在単一のファイルしか編集できないという制限があります。

## homebrew版

インストール:

```shell
brew install alps-asd/asd/asd
```

デモドキュメントをダウンロードして実行

```
curl -L https://alps-asd.github.io/app-state-diagram/blog/profile.json > alps.json
asd -w ./alps.json
```

## Docker版

インストール:

```
curl -L https://alps-asd.github.io/app-state-diagram/asd.sh > ./asd && chmod +x ./asd && sudo mv ./asd /usr/local/bin
```

デモドキュメントをダウンロードして実行

```
curl -L curl https://alps-asd.github.io/app-state-diagram/blog/profile.json > profile.json
asd --watch ./profile.json
```

## Macランチャーアプリケーション

コンソールの操作が不要なMacのGUIアプリケーションも用意されています。

インストールと実行：

* [ASD launcher](https://github.com/alps-asd/asd-launcher/archive/master.zip)をダウンロードして`asd`スクリプトを開きます。
* スクリプトエディタで、`ファイル` > `書き出す..` を選択し、場所を`アプリケーション`、ファイルフォーマットも`アプリケーション`にして保存します。
* 実行してALPSファイルを選択するとASDサーバーが起動します。ドラッグ&ドロップにも対応しています。

## GHアクション版

CIでASD作成を行います。詳細は[https://github.com/marketplace/actions/app-state-diagram](https://github.com/marketplace/actions/app-state-diagram)をご覧ください。

## 実行オプション

```
asd [options] [alpsFile]

    -w, --watch
    　　 ウオッチモード

    -m, --mode
    　　 描画モード

     --port
        利用ポート（デフォルト3000)
```

### mode

リポジトリが非公開でアカウントがGHEやGHE Cloudのアカウントでない場合、GitHub Pagesを非公開にすることができません。そのような場合は、Markdownで出力し、ドキュメントを非公開にすることができます。

残念ながらリンクされたSVGのダイアグラムをMarkdownでホストする方法はありません。Markdownにするとダイアログはリンクを失います。 MarkdownはHTMLを公開できない場合のオプションです。
