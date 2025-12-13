---
layout: docs-ja
title: ALPS AI アシスタント (レガシー - プロンプト方式)
category: Manual
permalink: /manuals/1.0/ja/ai-assistant-legacy-prompt.html
---

# ALPS AIアシスタント

AIの力でALPS開発をサポートすることができます。

## OpenAI GPTs - ALPSアシスタント

[ALPSアシスタント](https://chatgpt.com/g/g-HYPygRnLS-alps-assistant)はALPSに関する質問に特化して回答するようにトレーニングされたカスタムGPTです。

<div class="info-box">
  <p><strong>注意:</strong> GPTsを使用するにはOpenAI Plusアカウントが必要です。</p>
</div>

## llms-full.txtによるAIサポート

他のAIアシスタント（ClaudeやGeminiなど）にALPSの知識を提供するには、以下のボタンを使用してllms-full.txtの内容をコピーするか、[/llms-full.txt](/llms-full.txt)から取得し、AIとの会話の冒頭に貼り付けてください。

### llms.txtとは何ですか？

`llms-full.txt`ファイルは`llms.txt`標準に基づいており、重要な情報をクリーンなMarkdown形式でAIモデルと共有するシンプルな方法です。これにより、AIアシスタントはALPSのような重要な詳細を余分な情報なしで迅速に理解できます。詳細は[llmstxt.org](https://llmstxt.org/)をご覧ください。

<button id="copyLlmsText" class="copy-button">llms-full.txtをコピー</button>
<span id="copyStatus" class="copy-status"></span>

<div class="usage-guide">
  <h3>コピーした情報の使い方</h3>
  <ul>
    <li><strong>Claude:</strong> 会話の冒頭に貼り付けるか、プロジェクトとしてアップロードしてください</li>
    <li><strong>その他のAIアシスタント:</strong> 会話の冒頭に以下のメモと共に貼り付けてください：「これはALPSに関する情報です。質問に答える前にこの情報を理解してください」</li>
  </ul>
  <p>※ AIアシスタントがALPSに関する事前知識を持っていない場合は、必ずこの情報を提供してください。</p>
</div>


---

<script>
document.getElementById('copyLlmsText').addEventListener('click', function() {
  // Fetch the llms-full.txt file from the root
  fetch('/llms-full.txt')
    .then(response => {
      if (!response.ok) {
        throw new Error('File not found');
      }
      return response.text();
    })
    .then(text => {
      navigator.clipboard.writeText(text).then(function() {
        const status = document.getElementById('copyStatus');
        status.textContent = 'Copied!';
        setTimeout(function() {
          status.textContent = '';
        }, 2000);
      }).catch(function(err) {
        console.error('Failed to copy to clipboard', err);
        alert('Failed to copy to clipboard.');
      });
    })
    .catch(error => {
      console.error('Failed to load file:', error);
      alert('Failed to load llms-full.txt.');
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
</style>
