---
layout: docs-ja
title: ALPS Prompt Brewery
category: Manual
permalink: /manuals/1.0/ja/prompt.html
---
<style>
  /* Common Styles */
  .alps-brewery {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }
  
  .alps-brewery .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .alps-brewery header {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .alps-brewery .logo {
    font-size: 2.5rem;
    font-weight: bold;
    color: #336699;
    margin-bottom: 10px;
  }
  
  .alps-brewery .tagline {
    font-size: 1.2rem;
    color: #666;
  }
  
  .alps-brewery .gpts-link {
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #f0f4f8;
    border-radius: 6px;
    font-size: 0.95rem;
    display: inline-block;
  }
  
  .alps-brewery .gpts-link a {
    color: #336699;
    text-decoration: none;
    font-weight: bold;
  }
  
  .alps-brewery .gpts-link a:hover {
    text-decoration: underline;
  }
  
  .alps-brewery main {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px 30px;
    margin-bottom: 40px;
  }
  
  .alps-brewery h1, .alps-brewery h2, .alps-brewery h3 {
    color: #336699;
    margin-top: 0;
  }
  
  .alps-brewery textarea {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
    font-family: monospace;
    font-size: 14px;
    resize: vertical;
  }
  
  .alps-brewery button {
    background-color: #336699;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
  }
  
  .alps-brewery button:hover {
    background-color: #254e77;
  }
  
  .alps-brewery button.selected {
    background-color: #254e77;
    box-shadow: 0 0 0 2px rgba(37, 78, 119, 0.5);
  }
  
  .alps-brewery button.secondary-btn {
    background-color: #6c757d;
  }
  
  .alps-brewery button.secondary-btn:hover {
    background-color: #5a6268;
  }
  
  .alps-brewery button.copy-btn {
    background-color: #4CAF50;
    font-size: 0.9rem;
    padding: 6px 12px;
  }
  
  .alps-brewery button.copy-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery .hidden {
    display: none;
  }
  
  .alps-brewery footer {
    text-align: center;
    margin-top: 20px;
    color: #666;
    font-size: 0.9rem;
  }
  
  /* Step Indicator */
  .alps-brewery .step-indicator {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }
  
  .alps-brewery .step {
    width: 180px;
    padding: 10px;
    text-align: center;
    background-color: #e9ecef;
    position: relative;
    z-index: 1;
  }
  
  .alps-brewery .step:not(:last-child):after {
    content: '';
    position: absolute;
    top: 50%;
    right: -15px;
    width: 30px;
    height: 2px;
    background-color: #e9ecef;
    z-index: 0;
  }
  
  .alps-brewery .step.active {
    background-color: #336699;
    color: white;
    font-weight: bold;
  }
  
  .alps-brewery .step.active:not(:last-child):after {
    background-color: #336699;
  }
  
  /* Tabs */
  .alps-brewery .tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
  }
  
  .alps-brewery .tab-btn {
    padding: 10px 20px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-bottom: none;
    margin-right: 5px;
    border-radius: 5px 5px 0 0;
    cursor: pointer;
    font-weight: normal;
  }
  
  .alps-brewery .tab-btn.active {
    background-color: #336699;
    color: white;
    border-color: #336699;
    font-weight: bold;
  }
  
  .alps-brewery .tab-content {
    display: none;
    padding-top: 15px;
  }
  
  .alps-brewery .tab-content.active {
    display: block;
  }
  
  /* Section Controls */
  .alps-brewery .options-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
  }
  
  .alps-brewery .format-selection, .alps-brewery .language-selection {
    margin-bottom: 15px;
  }
  
  .alps-brewery .format-selection label, .alps-brewery .language-selection label {
    margin-right: 10px;
  }
  
  .alps-brewery select, .alps-brewery input[type="text"] {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.9rem;
  }
  
  .alps-brewery .sample-controls {
    margin-bottom: 15px;
  }
  
  .alps-brewery .sample-controls select {
    width: 100%;
    max-width: 300px;
  }
  
  /* Format Buttons */
  .alps-brewery .format-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  /* Result Section */
  .alps-brewery .result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .alps-brewery .verification-tip {
    background-color: #f8f9fa;
    border-left: 4px solid #336699;
    padding: 10px 15px;
    margin: 15px 0;
    font-size: 0.95rem;
  }
  
  .alps-brewery .verification-tip .tip-text {
    background-color: #eef1f7;
    padding: 3px 6px;
    border-radius: 3px;
    font-family: monospace;
  }
  
  .alps-brewery .mini-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    padding: 3px 8px;
    font-size: 0.8rem;
    cursor: pointer;
    margin-left: 5px;
    vertical-align: middle;
  }
  
  .alps-brewery .mini-btn:hover {
    background-color: #3e8e41;
  }
  
  .alps-brewery #promptResult {
    width: 100%;
    min-height: 200px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
    white-space: pre-wrap;
    font-family: monospace;
    font-size: 14px;
    overflow-y: auto;
    margin-bottom: 20px;
  }
  
  /* Navigation Buttons */
  .alps-brewery .nav-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
</style>

<div class="alps-brewery">
  <div class="container">
    <header>
      <div class="logo">ALPS Prompt Brewery</div>
      <div class="tagline">AI prompt generator for ALPS and implementation code</div>
    </header>

    <main>
      <div class="step-indicator">
        <div class="step active" id="step1">Step 1: User Story</div>
        <div class="step" id="step2">Step 2: ALPS</div>
      </div>
      
      <!-- Step 1: User Story to ALPS Prompt -->
      <section id="userStorySection" class="section-active">
        <h2>ALPS Prompt Creation</h2>
        
        <div class="tabs">
          <button class="tab-btn active" id="userStoryTabBtn">Create from User Story</button>
          <button class="tab-btn" id="directAlpsTabBtn">Convert Existing ALPS</button>
        </div>
        <!-- User Story Tab Content -->
        <div id="userStoryTab" class="tab-content active">
          <div class="sample-controls">
            <label>Need inspiration?</label>
<select id="sampleStorySelect">
  <option value="">サンプルユーザーストーリーを選択してください...</option>
  <optgroup label="ビジネスアプリケーション">
    <option value="ecommerce">Eコマース商品管理</option>
    <option value="taskapp">タスク管理アプリ</option>
    <option value="restaurant">レストラン予約システム</option>
  </optgroup>
  <optgroup label="コンテンツ・情報システム">
    <option value="blog">ブログシステム</option>
    <option value="library">図書館管理システム</option>
    <option value="lms">学習管理システム（LMS）</option>
  </optgroup>
  <optgroup label="サービス業">
    <option value="travel">旅行予約システム</option>
    <option value="events">イベント管理プラットフォーム</option>
    <option value="healthcare">医療患者管理</option>
  </optgroup>
</select>
          </div>
          
          <textarea id="userStoryInput" placeholder="Enter your user story or system requirements here..."></textarea>
          
          <div class="options-row">
            <div class="format-selection">
              <label>ALPS Format:</label>
              <label><input type="radio" name="alpsFormat" value="json" checked> JSON</label>
              <label><input type="radio" name="alpsFormat" value="xml"> XML</label>
            </div>
            
            <div class="language-selection">
              <label>Documentation Language:</label>
              <select id="languageSelect">
                <option value="English">English</option>
                <option value="Japanese">Japanese</option>
                <option value="Spanish">Spanish</option>
                <option value="French">French</option>
                <option value="German">German</option>
                <option value="Chinese">Chinese</option>
                <option value="other">Other...</option>
              </select>
              <input type="text" id="customLanguage" placeholder="Specify language" class="hidden">
            </div>
          </div>
          
          <button id="generateAlpsPromptBtn" class="primary-btn">Generate ALPS Prompt</button>
        </div>
        
        <!-- Direct ALPS Tab Content -->
        <div id="directAlpsTab" class="tab-content">
          <p>Paste your existing ALPS profile below and proceed directly to the format conversion step.</p>
          <textarea id="directAlpsInput" placeholder="Paste your existing ALPS profile here..."></textarea>
          <div class="format-selection">
            <label>Select the format of your ALPS profile:</label>
            <label><input type="radio" name="directAlpsFormat" value="json" checked> JSON</label>
            <label><input type="radio" name="directAlpsFormat" value="xml"> XML</label>
          </div>
          <button id="proceedToConversionBtn" class="primary-btn">Proceed to Conversion</button>
        </div>
      </section>
      
      <!-- Step 2: ALPS to Implementation -->
      <section id="alpsSection" class="hidden">
        <h2>Convert ALPS to Implementation Format</h2>
        
        <div class="result-header">
          <h3>Generated ALPS Prompt</h3>
          <button id="copyAlpsBtn" class="copy-btn">Copy ALPS Prompt</button>
        </div>
        
        <textarea id="alpsInput" placeholder="Your generated ALPS prompt will appear here. You can also paste your own ALPS profile."></textarea>
        
        <div class="verification-tip">
          <p><strong>💡 Pro Tip:</strong> After receiving your ALPS profile from the AI, consider asking: <span class="tip-text">"Please review this ALPS profile to verify that there are no isolated states (unreachable or exit-less states) and that all state transitions are properly connected. Also check if all semantic descriptors are consistently tagged and grouped."</span> <button id="copyTipBtn" class="mini-btn">Copy Tip</button></p>
          <p><strong>💡 Next Step:</strong> After confirming that ALPS is rendered correctly at <a target="_blank" href="https://editor.app-state-diagram.com/">https://editor.app-state-diagram.com/</a>, Paste your ALPS profile into textarea and proceed directly to the format conversion step. 
          </p>
        </div>
        
        <h3>Select Target Implementation Format</h3>
        <div class="format-buttons">
          <button id="openApiBtn">OpenAPI</button>
          <button id="jsonSchemaBtn">JSON Schema</button>
          <button id="graphqlBtn">GraphQL</button>
          <button id="sqlBtn">SQL</button>
          <button id="typescriptBtn">TypeScript</button>
        </div>
        
        <button id="convertAlpsBtn" class="primary-btn">Generate Conversion Prompt</button>
        
        <div class="nav-buttons">
          <button id="backToUserStoryBtn" class="secondary-btn">← Back to User Story</button>
        </div>
      </section>
      
      <!-- Step 3: Result -->
      <section id="resultSection" class="hidden">
        <div class="result-header">
          <h2 id="resultTitle">Generated Conversion Prompt</h2>
          <button id="copyResultBtn" class="copy-btn">Copy to Clipboard</button>
        </div>
        
        <p>Copy this prompt to ChatGPT, Claude, or any other AI assistant:</p>
        <div id="promptResult"></div>
        
        <div class="verification-tip">
          <p><strong>💡 Remember:</strong> For best results, first have the AI verify the ALPS profile for correctness, then provide this conversion prompt.</p>
        </div>
        
        <div class="nav-buttons">
          <button id="startOverBtn" class="secondary-btn">Start Over</button>
          <button id="backToAlpsBtn" class="secondary-btn">← Back to ALPS</button>
        </div>
        
        <div class="gpts-link" style="margin-top: 25px; text-align: center;">
          <p>Tip: For quick results, you can also use <a href="https://chatgpt.com/g/g-HYPygRnLS-alps-assistant" target="_blank">ALPS Assistant GPTs</a> with your prompts.</p>
        </div>
      </section>
    </main>
    
    <footer>
    </footer>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const userStoryInput = document.getElementById('userStoryInput');
    const alpsInput = document.getElementById('alpsInput');
    const promptResult = document.getElementById('promptResult');
    const resultTitle = document.getElementById('resultTitle');
    
    // Sections
    const userStorySection = document.getElementById('userStorySection');
    const alpsSection = document.getElementById('alpsSection');
    const resultSection = document.getElementById('resultSection');
    
    // Step indicators
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    // Buttons
    const generateAlpsPromptBtn = document.getElementById('generateAlpsPromptBtn');
    const convertAlpsBtn = document.getElementById('convertAlpsBtn');
    const copyAlpsBtn = document.getElementById('copyAlpsBtn');
    const copyResultBtn = document.getElementById('copyResultBtn');
    const backToUserStoryBtn = document.getElementById('backToUserStoryBtn');
    const backToAlpsBtn = document.getElementById('backToAlpsBtn');
    const startOverBtn = document.getElementById('startOverBtn');
    
    // Format buttons
    const openApiBtn = document.getElementById('openApiBtn');
    const jsonSchemaBtn = document.getElementById('jsonSchemaBtn');
    const graphqlBtn = document.getElementById('graphqlBtn');
    const sqlBtn = document.getElementById('sqlBtn');
    const typescriptBtn = document.getElementById('typescriptBtn');
    
    // サンプルユーザーストーリー
const sampleStories = {
  'ecommerce': `ストア所有者として、商品在庫を管理したいです。
商品には、名前、説明、価格、カテゴリ、在庫数量があります。
新しい商品を追加し、既存の商品を更新し、廃止された商品を削除する必要があります。
顧客はカテゴリ別に商品を閲覧し、商品の詳細を確認できるようにする必要があります。`,
  
  'taskapp': `プロジェクトマネージャーとして、タスク追跡システムが必要です。
タスクにはタイトル、説明、期限、優先度、担当ユーザーがあります。
ユーザーはタスクを作成し、ステータスを更新し、完了としてマークできる必要があります。
システムはステータスまたは担当ユーザーでフィルタリングされたタスクリストを表示する必要があります。`,
  
  'blog': `コンテンツ作成者として、ブログ管理システムが必要です。
記事にはタイトル、内容、公開日、タグ、著者があります。
下書きを作成し、記事を公開し、コメントを管理したいです。
読者はタグまたは著者別に記事を閲覧し、コメントを残すことができる必要があります。`,
  
  'travel': `旅行代理店として、予約管理システムが必要です。
旅行には目的地、出発/到着日、交通手段、宿泊施設があります。
顧客には個人情報、支払い情報、旅行の好みがあります。
エージェントは利用可能な旅行を検索し、予約を行い、旅程を管理できる必要があります。
システムは予約状況、支払い、確認通知の送信を追跡する必要があります。`,
  
  'healthcare': `クリニック管理者として、患者管理システムが必要です。
患者には個人情報、医療履歴、保険の詳細があります。
予約には日付、時間、医師、患者、ステータスがあります。
医療スタッフは予約をスケジュールし、診断を記録し、処方箋を管理する必要があります。
患者は自分の医療記録と今後の予約を確認できる必要があります。`,
  
  'events': `イベントプランナーとして、イベント管理プラットフォームが必要です。
イベントには名前、会場、日付、時間、収容人数、チケットタイプがあります。
参加者はチケットを購入し、セッションに登録し、フィードバックを残すことができます。
主催者は会場、スピーカー、スケジュール、チケット販売を管理する必要があります。
システムはチェックイン、リマインダーの送信、出席レポートの生成をサポートする必要があります。`,
  
  'library': `図書館員として、図書館管理システムが必要です。
本にはタイトル、著者、ジャンル、ISBN、出版日、利用可能状況があります。
会員には個人情報、借りている本、貸出履歴を含むアカウントがあります。
図書館員は本をカタログ化し、貸出と返却を処理し、予約を管理する必要があります。
会員はカタログを検索し、本を予約し、アカウント状況を確認できる必要があります。`,
  
  'restaurant': `レストラン所有者として、予約と注文システムが必要です。
テーブルには収容人数、場所、利用可能状況があります。
メニュー項目には名前、説明、価格、カテゴリ、食事制限情報があります。
スタッフは予約を管理し、注文を受け、支払いを処理する必要があります。
顧客はテーブルを予約し、メニューを閲覧し、注文を行うことができる必要があります。`,
  
  'lms': `## 学習管理システム（LMS）

### 主要ユーザー
1. **学生**: コースに登録し、コンテンツにアクセスし、課題を提出する個人
2. **講師**: コースを作成・管理し、学生の進捗を評価する教育者
3. **管理者**: システム全体を監督し、ユーザーアカウントとコースカタログを管理する人々

### コース・コンテンツ管理
- **講師として**、タイトル、説明、カテゴリ、開始/終了日、登録定員、難易度などのメタデータを持つコースを作成したいです。
- **講師として**、コンテンツを論理的な順序で整理するためにコースにモジュールやセクションを追加したいです。
- **講師として**、テキスト、ビデオ、音声、PDF、スライドショー、インタラクティブなHTML要素など、様々な形式の教材をアップロードしたいです。
- **講師として**、コースコンテンツをドラフトモードで作成し、公開前にプレビューしたいです。
- **管理者として**、コース全体のカタログを閲覧し、カテゴリ、講師、ステータス（アクティブ、プライベート、アーカイブ）でフィルタリングしたいです。

### 登録・進捗追跡
- **学生として**、利用可能なコースを閲覧し、詳細を確認してから登録したいです。
- **学生として**、自分の進捗を追跡し、完了したモジュールと次に何があるかを確認したいです。
- **学生として**、登録前に必要なスキルや予備知識を理解するためにコースの前提条件を確認したいです。
- **講師として**、学生の登録・登録解除を行い、個人またはクラス全体のコース開始/終了日の延長を設定したいです。
- **講師として**、ダッシュボードでクラス全体の進捗を確認し、遅れている学生を特定したいです。

### 評価・フィードバック
- **講師として**、多肢選択、記述、ファイルアップロード、プログラミング課題など、様々なタイプの課題やテストを作成したいです。
- **講師として**、採点基準（ルーブリック）を設定し、課題に詳細なフィードバックを提供したいです。
- **学生として**、課題を提出し、必要に応じて締め切り前に再提出したいです。
- **学生として**、自分の成績とフィードバックを確認し、必要に応じて講師に質問したいです。
- **講師として**、成績簿を管理し、各学生の総合成績を計算したいです。

### コミュニケーション・コラボレーション
- **学生として**、ディスカッションフォーラムで質問を投稿し、他の学生や講師から回答を受け取りたいです。
- **講師として**、クラス全体または個々の学生に通知やアナウンスを送信したいです。
- **学生として**、他の学生との共同作業のための共有ワークスペースを持つグループプロジェクトに参加したいです。
- **すべてのユーザーとして**、システム内でメッセージを送受信し、添付ファイルを共有したいです。
- **講師として**、リアルタイムのウェビナーやオンラインセッションをスケジュールし、録画を保存して学生が後からアクセスできるようにしたいです。

### レポート・分析
- **講師として**、学生のエンゲージメントとアクティビティ（ログイン頻度、閲覧したコンテンツ、課題完了までの時間）に関する分析を確認したいです。
- **管理者として**、プラットフォーム全体の使用状況とパフォーマンスメトリクスを確認したいです。
- **管理者として**、登録傾向、完了率、満足度評価に関するレポートを生成したいです。
- **講師として**、外部分析ツールで使用するために学生のパフォーマンスデータをエクスポートしたいです。

### アクセシビリティ・ローカライゼーション
- **すべてのユーザーとして**、システムとの対話のためのインターフェース言語を選択したいです。
- **学生として**、視覚または聴覚障害のためのアクセシビリティ機能を使用したいです。
- **講師として**、キャプションや代替テキストなどのアクセシビリティ要素をコンテンツに追加したいです。

### モバイル・オフラインアクセス
- **学生として**、モバイルデバイスからコースにアクセスし、スマートフォンやタブレットで快適に学習したいです。
- **学生として**、インターネット接続なしでオフライン学習のためにコンテンツをダウンロードしたいです。
- **講師として**、学生のエンゲージメントを高めるためにモバイルアプリを通じて通知を送信したいです。`
};
    
    // ALPS guide content
    const alpsGuide = `## ‼️ Important: JSON Format Guidelines ‼️

0. Do not comment on JSON.
1. Write each descriptor on a single line (mandatory).
2. Only indent and line-break descriptors if they contain other descriptors.
3. All nested descriptors must reference their parent with \`href\`.

\`\`\`json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "title": "Name", "def": "https://schema.org/name"},
{"id": "email", "title": "Email", "def": "https://schema.org/email"},
{"id": "User", "title": "User Profile", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "title": "User List", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "View User Details", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "Create User", "rt": "#UserList"}
]}}
\`\`\`

## XML Format Guidelines

- Use indentation to indicate hierarchy.
- Write each element on a single line.

\`\`\`xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
\`\`\`

## Structuring Semantic Descriptors

Organize into the following three blocks. Each descriptor must either reference or contain other descriptors:

1. Semantic Definitions (Ontology)
   - Define basic elements (lowerCamelCase).
   - Always specify \`def\` as a full URL if there's a Schema.org definition.
   - Add a \`title\` to all descriptors.
   - Include \`doc\` only if necessary.
   - Each defined element must be referenced by at least one taxonomy state.

2. Containment Relationships (Taxonomy)
   - Descriptors representing states use UpperCamelCase.
   - Use \`href\` for referencing elements (direct definition via \`id\` is not allowed).
   - Each application state includes:
     * Elements displayed/used in the state (defined in the ontology).
     * Actions that can be performed (defined in choreography).
   - Use \`doc\` for additional details if needed.
   - Each taxonomy must either contain or transition to other taxonomies.

3. State Transitions (Choreography)
   - Define transition actions.
   - Select the appropriate \`type\` attribute.
   - Specify the transition destination (\`rt\`).
   - Use \`href\` to refer to necessary data items.
   - Each operation must be referenced by at least one taxonomy state.`;
    
    // Conversion prompt templates
    const conversionPrompts = {
      'OpenAPI': `**Task:** Convert this ALPS profile into a comprehensive OpenAPI 3.1 specification.

**Key Instructions:**

1. **State to Endpoint Mapping:**
   - Map each semantic state to a resource endpoint
   - Use tag attributes to organize endpoints into logical groups
   - Apply proper REST principles (plural nouns for collections, etc.)

2. **Transition Operations:**
   - Convert transitions with specific type attributes:
     - \`safe\` → GET operations
     - \`unsafe\` → POST operations 
     - \`idempotent\` → PUT/PATCH operations
     - Include DELETE operations for removal actions
   - Use appropriate HTTP status codes (200, 201, 204, 400, 404, etc.)

3. **Schema Definitions:**
   - Build schemas from semantic descriptors
   - Include all properties referenced in state descriptors
   - Use Schema.org definitions when available via \`def\` attributes
   - Apply proper validation constraints based on domain knowledge
   - Create both request and response schemas

4. **Complete Documentation:**
   - Use titles as summary descriptions
   - Convert doc attributes to detailed descriptions
   - Include examples for each operation
   - Document error responses and handling

5. **Consistent Design:**
   - Apply query parameters for filtering, sorting, pagination
   - Use path parameters for resource identifiers
   - Include security schemes appropriate for the domain
   - Ensure all endpoints have complete request/response documentation

**Output Format:** Provide YAML format with appropriate indentation and organization.`,
      
      'JSON Schema': `**Task:** Convert this ALPS profile into a comprehensive JSON Schema that accurately captures all data structures.

**Key Instructions:**

1. **Semantic Descriptors:**
   - Create type definitions for each semantic descriptor
   - Use $defs for proper schema reusability
   - Follow semantic descriptor hierarchies when defining nested structures
   - Use \`$ref\` to reference repeated structures

2. **Type & Format Selection:**
   - Choose appropriate types (string, number, integer, boolean, object, array)
   - Apply formats based on semantic meaning (date-time, email, uri, etc.)
   - For descriptors with Schema.org definitions, infer types from those definitions
   - Include multitype properties where appropriate

3. **Validation Rules:**
   - Add property constraints:
     - Strings: minLength, maxLength, pattern
     - Numbers: minimum, maximum, multipleOf
     - Arrays: minItems, maxItems, uniqueItems
     - Objects: required, additionalProperties
   - Define enumerations for constrained values

4. **Documentation & Metadata:**
   - Include title from the ALPS descriptor
   - Add description from doc attributes
   - Provide examples of valid data
   - Add $schema reference for validation

5. **Design Patterns:**
   - Use oneOf/anyOf for polymorphic structures
   - Create composition patterns with allOf when appropriate
   - Add conditional validation with if/then/else where needed

**Output Format:** Provide properly formatted JSON with appropriate indentation.`,
      
'GraphQL': `**Task:** Convert this ALPS profile into a complete GraphQL schema with operations and resolvers.

**Key Instructions:**

1. **Type Definitions:**
   - Create GraphQL types for each semantic descriptor
   - Define scalars based on data nature (String, Int, Float, Boolean, ID)
   - Create custom scalars for special formats (DateTime, Email, URL)
   - Structure relationships using proper GraphQL object connections

2. **Query Operations:**
   - Create queries from \`safe\` transitions
   - Implement filtering, sorting, and pagination for collection queries
   - Design nested queries that follow the semantic connections
   - Support efficient graph traversal with proper resolver planning

3. **Mutation Operations:**
   - Create mutations from \`unsafe\` and \`idempotent\` transitions
   - Define input types for creating and updating resources
   - Implement proper error handling and return types
   - Return modified objects from mutations for efficient client updates

4. **Schema Organization:**
   - Use GraphQL directives for documentation and validation
   - Group related operations based on ALPS tag attributes
   - Design consistent naming patterns across the schema
   - Implement interfaces for shared structures

5. **Advanced Features:**
   - Add subscription operations for real-time updates where appropriate
   - Implement union types for polymorphic responses
   - Design proper pagination with cursor-based approaches
   - Add custom directives for authorization and caching hints

**Output Format:** Provide the schema in SDL (Schema Definition Language) format, along with example operations and resolver patterns.`,
      
      'SQL': `**Task:** Convert this ALPS profile into a comprehensive SQL database schema with tables, relationships, and key operations.

**Key Instructions:**

1. **Table Structure:**
   - Create tables for main semantic descriptors
   - Define appropriate column types based on semantic meaning
   - Implement proper primary keys and indexes
   - Add foreign key constraints for relationships
   - Include CHECK constraints for data validation

2. **Relationship Modeling:**
   - Identify one-to-many, many-to-many, and one-to-one relationships
   - Create junction tables for many-to-many relationships
   - Implement proper ON DELETE/UPDATE behavior for referential integrity
   - Use appropriate naming conventions for relationship columns

3. **Data Operations:**
   - Create SELECT queries for \`safe\` transitions
   - Implement INSERT statements for \`unsafe\` transitions
   - Design UPDATE operations for \`idempotent\` transitions
   - Add DELETE operations where appropriate
   - Include stored procedures for complex operations

4. **Advanced Database Features:**
   - Design appropriate indexes for performance
   - Create views for common query patterns
   - Implement triggers for data integrity and auditing
   - Add computed columns for derived properties
   - Consider partitioning for large tables

5. **Completeness & Standards:**
   - Follow SQL standards for portability
   - Include documentation as comments
   - Create role-based permissions aligned with the domain
   - Design for transaction safety
   - Include data migration considerations

**Output Format:** Provide SQL DDL statements for schema creation, followed by example DML operations.`,
      
      'TypeScript': `**Task:** Convert this ALPS profile into a comprehensive TypeScript type system with interfaces, classes, and utility types.

**Key Instructions:**

1. **Core Type Definitions:**
   - Create interfaces for each semantic descriptor
   - Use proper TypeScript types (string, number, boolean, Date, etc.)
   - Implement inheritance for related types
   - Define enums for constrained values
   - Add JSDoc comments from ALPS documentation

2. **Type Relationships:**
   - Design composition patterns for nested structures
   - Create utility types for operations (Partial<T>, Pick<T>, etc.)
   - Implement generics for reusable patterns
   - Define index signatures for dynamic properties
   - Use union and intersection types appropriately

3. **API Integration:**
   - Create request and response interfaces
   - Implement service interfaces with typed methods
   - Design error handling with typed exceptions
   - Add validation decorators if using class-validator
   - Structure according to ALPS tag groupings

4. **Advanced TypeScript Features:**
   - Use conditional types for complex logic
   - Implement mapped types for transformations
   - Add template literal types for string patterns
   - Define type guards for runtime type checking
   - Use const assertions for literal values

5. **Code Organization:**
   - Structure code into modules based on ALPS tags
   - Create barrel exports for simplified imports
   - Design for tree-shaking and code splitting
   - Add examples of type usage
   - Include TypeScript configuration recommendations

**Output Format:** Provide well-organized TypeScript code with proper imports and exports.`
    };
    
    // Tab switching functionality
    document.getElementById('userStoryTabBtn').addEventListener('click', function() {
      document.getElementById('userStoryTab').classList.add('active');
      document.getElementById('directAlpsTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('directAlpsTabBtn').classList.remove('active');
    });
    
    document.getElementById('directAlpsTabBtn').addEventListener('click', function() {
      document.getElementById('directAlpsTab').classList.add('active');
      document.getElementById('userStoryTab').classList.remove('active');
      this.classList.add('active');
      document.getElementById('userStoryTabBtn').classList.remove('active');
    });
    
    // STEP 1: Sample story handling
    document.getElementById('sampleStorySelect').addEventListener('change', function() {
      if (this.value) {
        userStoryInput.value = sampleStories[this.value];
      }
    });
    
    // Custom language handling
    document.getElementById('languageSelect').addEventListener('change', function() {
      const customLanguageInput = document.getElementById('customLanguage');
      if (this.value === 'other') {
        customLanguageInput.classList.remove('hidden');
      } else {
        customLanguageInput.classList.add('hidden');
      }
    });
    
    // Generate ALPS Prompt button (from user story)
    generateAlpsPromptBtn.addEventListener('click', function() {
      if (userStoryInput.value.trim() === '') {
        alert('Please enter a user story.');
        return;
      }
      
      const format = document.querySelector('input[name="alpsFormat"]:checked').value;
      const language = getSelectedLanguage();
      
      // Generate ALPS prompt
      const alpsPrompt = generateAlpsPrompt(userStoryInput.value, format, language);
      alpsInput.value = alpsPrompt;
      
      // Move to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // Proceed to conversion button (from direct ALPS input)
    document.getElementById('proceedToConversionBtn').addEventListener('click', function() {
      const directAlpsInput = document.getElementById('directAlpsInput');
      
      if (directAlpsInput.value.trim() === '') {
        alert('Please enter an ALPS profile.');
        return;
      }
      
      // Transfer direct ALPS input to the conversion section
      alpsInput.value = directAlpsInput.value;
      
      // Move directly to Step 2
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // STEP 2: Format selection handling
    let selectedFormat = null;
    
    openApiBtn.addEventListener('click', () => selectFormat('OpenAPI', openApiBtn));
    jsonSchemaBtn.addEventListener('click', () => selectFormat('JSON Schema', jsonSchemaBtn));
    graphqlBtn.addEventListener('click', () => selectFormat('GraphQL', graphqlBtn));
    sqlBtn.addEventListener('click', () => selectFormat('SQL', sqlBtn));
    typescriptBtn.addEventListener('click', () => selectFormat('TypeScript', typescriptBtn));
    
    function selectFormat(format, button) {
      selectedFormat = format;
      
      // Update UI to show selected format
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
      button.classList.add('selected');
    }
    
    // Convert ALPS button
    convertAlpsBtn.addEventListener('click', function() {
      if (alpsInput.value.trim() === '') {
        alert('Please generate or paste an ALPS profile.');
        return;
      }
      
      if (!selectedFormat) {
        alert('Please select a format to convert to.');
        return;
      }
      
      // Generate conversion prompt
      const conversionPrompt = conversionPrompts[selectedFormat] + 
        '\n\n_YOUR_ALPS_HERE_\n\n```\n' + alpsInput.value + '\n```';
      
      promptResult.textContent = conversionPrompt;
      resultTitle.textContent = `${selectedFormat} Conversion Prompt`;
      
      // Move to Step 3
      alpsSection.classList.add('hidden');
      resultSection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step3.classList.add('active');
    });
    
    // Navigation buttons
    backToUserStoryBtn.addEventListener('click', function() {
      alpsSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step1.classList.add('active');
    });
    
    backToAlpsBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step2.classList.add('active');
    });
    
    startOverBtn.addEventListener('click', function() {
      resultSection.classList.add('hidden');
      userStorySection.classList.remove('hidden');
      
      step3.classList.remove('active');
      step1.classList.add('active');
      step2.classList.remove('active');
      
      // Reset selections
      selectedFormat = null;
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
    });
    
    // Copy buttons
    copyAlpsBtn.addEventListener('click', function() {
      copyToClipboard(alpsInput.value, copyAlpsBtn);
    });
    
    copyResultBtn.addEventListener('click', function() {
      copyToClipboard(promptResult.textContent, copyResultBtn);
    });
    
    // Copy verification tip
    document.getElementById('copyTipBtn').addEventListener('click', function() {
      const tipText = "Please review this ALPS profile to verify that there are no isolated states (unreachable or exit-less states) and that all state transitions are properly connected. Also check if all semantic descriptors are consistently tagged and grouped.";
      copyToClipboard(tipText, this);
    });
    
    // Helper functions
    function getSelectedLanguage() {
      const languageSelect = document.getElementById('languageSelect');
      if (languageSelect.value === 'other') {
        return document.getElementById('customLanguage').value || 'Custom';
      } else {
        return languageSelect.value;
      }
    }
    
    function generateAlpsPrompt(userStory, format, language) {
      return `# ALPS Profile Creation Prompt

Please create an ALPS profile based on the following requirements. This profile should represent a complete and consistent application state design.

* Format: ${format.toUpperCase()}
* Language: ${language}
* Content: 

${userStory}

## ‼️ Important: Guidelines for Design Consistency and Completeness ‼️

1. **All states must be connected**:
   - Avoid isolated states (states that cannot be reached or exited)
   - Every state should have at least one incoming and one outgoing transition (except for home/start and final states)
   - Ensure all transitions between states are logical and clear

2. **Consistent use of semantic descriptors**:
   - Use consistent naming conventions for the same concepts
   - Only use the \`def\` attribute when a corresponding Schema.org definition exists
   - For custom concepts, provide clear titles and use the \`doc\` attribute for details when needed

3. **Complete user flows**:
   - Provide complete state transition paths for each key user story
   - Ensure CRUD operations (Create, Read, Update, Delete) are fully represented
   - Include all necessary functionality for each user role

4. **State transition completeness**:
   - Clearly define the success path for each operation
   - Ensure transitions between key states to prevent disruption of important business processes
   - Consider alternative flows for critical failure cases when necessary

5. **Grouping related elements**:
   - Group related processes and user journeys using the \`tag\` attribute
   - Use tags like "user-management", "content-creation", "payment-process", etc.
   - Apply consistent tags to states and transitions belonging to the same functional area
   - This helps identify related functionality when converting to APIs or data models

${alpsGuide}

## Output Requirements

- Include a clear title for every descriptor (concise one-line explanation)
- Use the doc attribute for detailed explanations when necessary
- Only reference Schema.org URLs with the def attribute when a corresponding definition exists
- Set appropriate type attributes (safe, unsafe, idempotent) for all state transitions
- Create reusable descriptors for common patterns
- Use consistent IDs and naming conventions for the same concepts
- Utilize the tag attribute to group related elements
- Use consistent tags for business domains or functional areas`;
    }
    
    function copyToClipboard(text, button) {
      navigator.clipboard.writeText(text)
        .then(() => {
          const originalText = button.textContent;
          button.textContent = '✅ Copied!, Paste it to your AI assistant';
          setTimeout(() => {
            button.textContent = originalText;
          }, 2000);
        })
        .catch(err => {
          console.error('Failed to copy: ', err);
          alert('Failed to copy. Please copy manually.');
        });
    }
  });
</script>
