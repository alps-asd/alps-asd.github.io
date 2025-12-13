---
layout: docs-ja
title: ALPS AIガイド
category: Manual
permalink: /manuals/1.0/ja/ai-assistant.html
---

# ALPS AIガイド

## なぜAIは優れたALPSガイドなのか

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

### 反復的な改善

AIはALPSプロファイルを検証し、問題を特定し、改善を提案します—API設計の品質を高めるフィードバックループを作り出します。

## 統合方法

環境に合った方法を選択してください：

| 優先度 | 環境 | 方法 |
|--------|------|------|
| 1st | Skillクライアント | [Skill](#skill-claude-code) |
| 2nd | MCPクライアント | [MCPサーバー](#mcpサーバー) |
| 3rd | その他のLLM | [llms.txt](#llmstxt-その他のllm) |

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

- 「ALPSスキルを使用してブログシステムのALPSプロファイルを作成してください」
- 「alps.xmlを検証して問題を修正してください」
- 「このALPSプロファイルを改善してください」

## MCPサーバー

[Model Context Protocol](https://modelcontextprotocol.io/)をサポートするAIクライアント向けです。MCPは検証とダイアグラム生成のためのリアルタイムツールアクセスを提供します。

### セットアップ

プロジェクトに`.mcp.json`を作成：

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

確認: `/mcp`でリストに「alps」が表示されるはずです。

注意: MCPの接続はセッション中に切断されることがあります。`/mcp`を実行して再接続してください。

### その他のMCPクライアント向け

MCPクライアント設定に`npx @alps-asd/mcp`をstdioサーバーとして追加してください。

### 利用可能なツール

| ツール | 説明 |
|--------|------|
| `validate_alps` | ALPSプロファイルを検証し詳細なフィードバックを取得 |
| `alps2svg` | SVG状態ダイアグラムを生成 |
| `alps_guide` | ALPSベストプラクティスを取得 |

## llms.txt (その他のLLM)

SkillやMCPをサポートしないLLM向けです。[llms.txt標準](https://llmstxt.org/)は、どのアシスタントでも利用できるAIフレンドリーなドキュメントを提供します。

### リソース

| リソース | 説明 |
|----------|------|
| [llms.txt](/llms.txt) | ALPS仕様インデックス |
| [llms-full.txt](/llms-full.txt) | 完全なALPS仕様 |
| [ALPS作成ガイド](https://alps-asd.github.io/app-state-diagram/alps-skill.md) | 設計原則と例 |

### システムプロンプト

システムプロンプトまたはAGENTS.mdに追加：

```text
ALPSプロファイルの作成については、次を参照してください: https://alps-asd.github.io/app-state-diagram/alps-skill.md
```

### 手動コピー

<button id="copyLlmsText" class="copy-button">llms-full.txtをコピー</button>
<span id="copyStatus" class="copy-status"></span>

<div class="usage-guide">
  <h3>使い方</h3>
  <ul>
    <li>会話の最初に貼り付ける</li>
    <li>またはファイル/プロジェクトの添付としてアップロード</li>
  </ul>
</div>

## OpenAI GPTs

[ALPSアシスタント](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant)は、ALPSに関する質問に特化してトレーニングされたカスタムGPTです。

<div class="info-box">
  <p><strong>注意:</strong> OpenAI Plusアカウントが必要です。</p>
</div>

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
.info-box {
  background-color: #f8f9fa;
  border-left: 4px solid #17a2b8;
  padding: 15px;
  margin: 20px 0;
  border-radius: 4px;
}

.usage-guide {
  background-color: #fff3cd;
  border-left: 4px solid #ffc107;
  padding: 15px;
  margin: 20px 0;
  border-radius: 4px;
}

.usage-guide h3 {
  margin-top: 0;
  color: #856404;
}

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

.legacy-link {
  font-size: 0.8em;
  color: #6c757d;
  margin-top: 3em;
}
</style>

<p class="legacy-link">
  <a href="/manuals/1.0/ja/ai-assistant-legacy-prompt.html">レガシー: プロンプトベースガイド</a>
</p>
