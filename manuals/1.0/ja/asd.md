---
layout: docs-ja
title: asd
category: Manual
permalink: /manuals/1.0/ja/asd.html
---

# asd

`asd`ツールはALPSファイルをASDドキュメントに変換します。

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

リポジトリが非公開でアカウントがGHEやGHE Cloudのアカウントでない場合、GitHub Pqgesを非公開にすることができません。そのような場合は、Markdownで出力し、ドキュメントを非公開にすることができます。

残念ながらリンクされたSVGのダイアグラムをMarkdownでホストする方法はありません。Markdownにするとダイアログはリンクを失います。 MarkdownはHTMLを公開できない場合のオプションです。
