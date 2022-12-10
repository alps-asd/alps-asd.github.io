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

    -c, --config=asd.xml
        設定ファイル

    -w, --watch
    　　 ウオッチモード

    --and-tag={tag1, tag2} --or-tag={tag3} [--color=red]
        フィルターのためのタグ

    -m, --mode={markdown|html}
        出力フォーマット
    
     --port
        利用ポート（デフォルト3000)
```

`asd`を引数なしで実行した場合、同じフォルダにある `asd.xml` という設定ファイルが使用されます。


## asd.xml 設定ファイル

例）
```xml
<?xml version="1.0"?>
<asd xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="docs/asd.xsd">
    <alpsFile>profile.xml</alpsFile>
    <watch>false</watch>
    <mode>markdown</mode>
</asd>
```

### watch

```xml
<asd>
  <watch>[bool]</watch>
</asd>
```

ウォッチモードでASD開発サーバを起動することができます。
プロファイルファイルが変更されるたびに、ページが再読み込みされます。

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

特定のタグで部分的にグラフを抽出したり、特定のグラフに色をつけたりすることができます。

条件を指定するには、`or` または `and`の欄にタグ名を指定します。`color`を指定すると、その条件のグラフに色をつけますが、指定しない場合はその条件のグラフのみを抽出して描画します。

### label

```xml
<asd>
  <label>[string]</label>
</asd>
```

グラフにラベルを指定します。

### mode

リポジトリが非公開でアカウントがGHEやGHE Cloudのアカウントでない場合、GitHub Pqgesを非公開にすることができません。そのような場合は、Markdownで出力し、ドキュメントを非公開にすることができます。

残念ながらリンクされたSVGのダイアグラムをMarkdownでホストする方法はありません。Markdownにするとダイアログはリンクを失います。 MarkdownはHTMLを公開できない場合のオプションです。

```xml
<asd>
  <mode>markdown</mode>
</asd>
```
