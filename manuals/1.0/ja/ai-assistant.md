---
layout: docs-ja
title: ALPS AIガイド
category: Manual
permalink: /manuals/1.0/ja/ai-assistant.html
image: /images/ai-guide.png
---

# ALPS AIガイド

<img src="/images/ai-guide.png" alt="AIとALPS設計" style="max-width: 200px; margin-bottom: 1em;">

## ALPS設計におけるAIの力

ALPS設計には、明確な状態定義、意味のある遷移、一貫した命名、標準語彙との整合性など、複数の要素のバランスが求められます。AIアシスタントはこのような多次元的な思考に優れています。

### 深いコンテキスト理解

AIはドメイン要件を分析し、本質的な状態と遷移を特定できます。「ショッピングカート付きのECシステム」と説明すると、AIは暗黙のフロー（閲覧 → カート → 決済 → 確認）を理解し、適切な状態名と遷移ラベルを提案します。

### セマンティックな命名

命名には規約以上のもの—意図の理解が必要です。Linterは`go*`や`do*`のパターンを強制できますが、AIは*何を意味するか*と*なぜ重要か*を理解します。

「ユーザーが後で見るためにアイテムを保存できるようにする」と説明すると、AIはこれをウィッシュリストのパターンとして認識し、汎用的な`doSave`ではなくSchema.orgの`WantAction`に沿った`doAddToWishlist`を提案します。`author`（創作的帰属）と`creator`（技術的起源）を区別し、外部システムと意味的に接続できる語彙を確保します。

### 標準への準拠

AIは自動的にディスクリプタを確立された語彙と整合させます：

- [Schema.org](https://schema.org/)の一般的な概念の定義
- [IANAリンクリレーション](https://www.iana.org/assignments/link-relations/)の標準的な関係
- プロファイル全体で一貫した命名規則

## 統合方法

[Claude Code](https://claude.ai/code)をお使いなら[Skill](#skill-claude-code)が最も簡単です。Claude DesktopなどMCP対応クライアントをお使いなら[MCPサーバー](#mcpサーバー)を、その他のLLMをお使いなら[llms.txt](#llmstxt-その他のllm)を参照してください。

## Skill (Claude Code)

[Claude Code](https://claude.ai/code)ユーザー向けの推奨方法です。Skillはセッション全体でAIの動作をガイドする永続的なコンテキストを提供します。

### セットアップ

```bash
claude --version  # 2.0.0以上が必要
claude update     # 必要に応じてアップデート

mkdir -p .claude/skills/alps
curl -o .claude/skills/alps/SKILL.md \
  https://raw.githubusercontent.com/alps-asd/app-state-diagram/master/.claude/skills/alps/SKILL.md
```

### 確認

質問: 「利用可能なスキルは何ですか？」

レスポンスに「alps」スキルが含まれているはずです。

### 使用方法

- 「ブログシステムのALPSプロファイルを作成して」
- 「alps.xmlを検証して問題を修正して」

入力はテキスト、Figmaデザイン、OpenAPI仕様、ホワイトボード写真、WebサイトURL、<span class="tooltip-trigger">その他<span class="tooltip-content">データベーススキーマ、既存コード、GraphQLスキーマ、Postmanコレクション、Swaggerドキュメント、シーケンス図、ユーザーストーリー、ER図、JSONレスポンス、ルート定義、議事録、Slackスレッド、ナプキンスケッチ...</span></span>が可能です。

**Tip:** コンソールで`Ctrl+V`を押すとクリップボードから画像を貼り付けられます。

## MCPサーバー

[Model Context Protocol](https://modelcontextprotocol.io/)をサポートするAIクライアント向けです。MCPは検証とダイアグラム生成のためのリアルタイムツールアクセスを提供します。

### 1. Node.jsバージョンの確認

```bash
node --version  # v18.0.0以上が必要
```

v18未満の場合はアップグレードしてください。nvmを使用している場合は`nvm use 18`を実行します。

### 2. 設定ファイルの作成

お使いのクライアントに以下の設定を追加します：

**Claude Code**: プロジェクトに`.mcp.json`を作成

**Claude Desktop**: `~/Library/Application Support/Claude/claude_desktop_config.json`を編集

**Cursor**: Settings → MCP → Add Server

```json
{
  "mcpServers": {
    "alps": {
      "command": "npx",
      "args": ["@alps-asd/mcp"]
    }
  }
}
```

### 3. 接続の確認

MCPサーバーのリストに「alps」が表示されることを確認します。Claude Codeの場合は`/mcp`を実行します。

### 4. 試してみる

「todoアプリのALPSプロファイルを作成して」と指示してみましょう。ダイアグラムを含んだASDドキュメントが生成されます。

### 5. 注意とおすすめ

MCPの接続はセッション中に切断されることがあります。`/mcp`を実行して再接続してください。

頻繁に使う場合は、グローバルインストールすると起動が速くなります：

```bash
npm install -g @alps-asd/mcp
```

### 利用可能なツール

| ツール | 説明 |
|--------|------|
| `validate_alps` | ALPSプロファイルを検証し詳細なフィードバックを取得 |
| `alps2svg` | SVG状態ダイアグラムを生成 |
| `alps2mermaid` | Mermaidダイアグラムを生成 |
| `alps_guide` | ALPSベストプラクティスを取得 |

## llms.txt (その他のLLM)

SkillやMCPをサポートしないLLM向けです。[llms.txt標準](https://llmstxt.org/)は、どのアシスタントでも利用できるAIフレンドリーなドキュメントを提供します。

### リソース

| リソース | 説明 |
|----------|------|
| [llms.txt](/llms.txt) | ALPS仕様インデックス |
| [llms-full.txt](/llms-full.txt) | 完全なALPS仕様 |
| [ALPS作成ガイド](https://raw.githubusercontent.com/alps-asd/app-state-diagram/master/.claude/skills/alps/SKILL.md) | 設計原則と例 |

### システムプロンプト

システムプロンプトまたはAGENTS.mdに追加：

```text
ALPSプロファイルの作成については、次を参照してください: https://raw.githubusercontent.com/alps-asd/app-state-diagram/master/.claude/skills/alps/SKILL.md
```

### 手動コピー

<button id="copyLlmsText" class="copy-button">llms-full.txtをコピー</button>
<span id="copyStatus" class="copy-status"></span>

会話の最初に貼り付けるか、ファイルとしてアップロードしてください。

## OpenAI GPTs

[ALPSアシスタント](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant)は、ALPSに関する質問に特化してトレーニングされたカスタムGPTです。

注意: OpenAI Plusアカウントが必要です。

## Google NotebookLM

[ALPS Guide Notebook](https://notebooklm.google.com/notebook/69a90152-3986-4630-a907-bd0e449c000e)は、AIアシスタントと共にALPSの概念を探求できるインタラクティブなノートブックです。

<script>
document.getElementById('copyLlmsText').addEventListener('click', function() {
  fetch('/llms-full.txt')
    .then(response => {
      if (!response.ok) throw new Error('File not found');
      return response.text();
    })
    .then(text => {
      navigator.clipboard.writeText(text).then(function() {
        const status = document.getElementById('copyStatus');
        status.textContent = 'コピーしました!';
        setTimeout(function() { status.textContent = ''; }, 2000);
      }).catch(function(err) {
        alert('クリップボードへのコピーに失敗しました。');
      });
    })
    .catch(error => {
      alert('llms-full.txtの読み込みに失敗しました。');
    });
});
</script>

<style>
.copy-button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.copy-button:hover {
  background-color: #45a049;
}

.copy-status {
  margin-left: 10px;
  color: #4CAF50;
  font-weight: bold;
}

.tooltip-trigger {
  color: #0066cc;
  text-decoration: underline;
  cursor: help;
  position: relative;
}

.tooltip-trigger:hover {
  color: #004499;
}

.tooltip-content {
  display: none;
  position: absolute;
  background: #333;
  color: white;
  padding: 8px 12px;
  border-radius: 6px;
  font-size: 0.85em;
  width: 280px;
  bottom: 125%;
  left: 50%;
  transform: translateX(-50%);
  z-index: 100;
}

.tooltip-trigger:hover .tooltip-content {
  display: block;
}
</style>
