---
layout: docs-ja
title: ALPSプロンプトブルワリー
category: マニュアル
permalink: /manuals/1.0/ja/prompt.html
---
<style>
  /* 共通スタイル */
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
  
  /* ステップインジケーター */
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
  
  /* タブ */
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
  
  /* セクションコントロール */
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
  
  /* フォーマットボタン */
  .alps-brewery .format-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  /* 結果セクション */
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
  
  /* ナビゲーションボタン */
  .alps-brewery .nav-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
  }
</style>

<div class="alps-brewery">
  <div class="container">
    <header>
      <div class="logo">ALPSプロンプト</div>
      <div class="tagline">あなたのユーザーストーリーから実装コードプロンプトを生成します</div>
    </header>

    <main>
      <div class="step-indicator">
        <div class="step active" id="step1">ステップ1: ユーザーストーリー → ALPS</div>
        <div class="step" id="step2">ステップ2: ALPS → 実装</div>
        <div class="step" id="step3">結果</div>
      </div>
      
      <!-- ステップ1: ユーザーストーリーからALPSプロンプトへ -->
      <section id="userStorySection" class="section-active">
        <h2>ALPSプロンプト作成</h2>
        
        <div class="tabs">
          <button class="tab-btn active" id="userStoryTabBtn">ユーザーストーリーから作成</button>
          <button class="tab-btn" id="directAlpsTabBtn">既存のALPSを変換</button>
        </div>
        
        <!-- ユーザーストーリータブコンテンツ -->
        <div id="userStoryTab" class="tab-content active">
          <div class="sample-controls">
            <label>インスピレーションが必要ですか？</label>
            <select id="sampleStorySelect">
              <option value="">サンプルユーザーストーリーを選択...</option>
              <optgroup label="ビジネスアプリケーション">
                <option value="ecommerce">Eコマース商品管理</option>
                <option value="taskapp">タスク管理アプリ</option>
                <option value="restaurant">レストラン予約システム</option>
              </optgroup>
              <optgroup label="コンテンツ＆情報システム">
                <option value="blog">ブログシステム</option>
                <option value="library">図書館管理システム</option>
              </optgroup>
              <optgroup label="サービス産業">
                <option value="travel">旅行予約システム</option>
                <option value="events">イベント管理プラットフォーム</option>
                <option value="healthcare">医療患者管理</option>
              </optgroup>
            </select>
          </div>
          
          <textarea id="userStoryInput" placeholder="ここにユーザーストーリーまたはシステム要件を入力してください..."></textarea>
          
          <div class="options-row">
            <div class="format-selection">
              <label>ALPSフォーマット:</label>
              <label><input type="radio" name="alpsFormat" value="json" checked> JSON</label>
              <label><input type="radio" name="alpsFormat" value="xml"> XML</label>
            </div>
            
            <div class="language-selection">
              <label>ドキュメント言語:</label>
              <select id="languageSelect">
                <option value="English">英語</option>
                <option value="Japanese">日本語</option>
                <option value="Spanish">スペイン語</option>
                <option value="French">フランス語</option>
                <option value="German">ドイツ語</option>
                <option value="Chinese">中国語</option>
                <option value="other">その他...</option>
              </select>
              <input type="text" id="customLanguage" placeholder="言語を指定" class="hidden">
            </div>
          </div>
          
          <button id="generateAlpsPromptBtn" class="primary-btn">ALPSプロンプトを生成</button>
        </div>
        
        <!-- 直接ALPSタブコンテンツ -->
        <div id="directAlpsTab" class="tab-content">
          <p>既存のALPSプロファイルを以下に貼り付けて、フォーマット変換ステップに直接進みます。</p>
          <textarea id="directAlpsInput" placeholder="既存のALPSプロファイルをここに貼り付けてください..."></textarea>
          <div class="format-selection">
            <label>ALPSプロファイルのフォーマットを選択:</label>
            <label><input type="radio" name="directAlpsFormat" value="json" checked> JSON</label>
            <label><input type="radio" name="directAlpsFormat" value="xml"> XML</label>
          </div>
          <button id="proceedToConversionBtn" class="primary-btn">変換に進む</button>
        </div>
      </section>
      
      <!-- ステップ2: ALPSから実装へ -->
      <section id="alpsSection" class="hidden">
        <h2>ALPSを実装フォーマットに変換</h2>
        
        <div class="result-header">
          <h3>生成されたALPSプロンプト</h3>
          <button id="copyAlpsBtn" class="copy-btn">ALPSプロンプトをコピー</button>
        </div>
        
        <textarea id="alpsInput" placeholder="生成されたALPSプロンプトがここに表示されます。独自のALPSプロファイルを貼り付けることもできます。"></textarea>
        
        <div class="verification-tip">
          <p><strong>💡 プロのヒント:</strong> AIからALPSプロファイルを受け取った後、次のように尋ねることを検討してください: <span class="tip-text">"このALPSプロファイル内のすべてのリンクと参照を確認し、不整合を修正してください。"</span> <button id="copyTipBtn" class="mini-btn">ヒントをコピー</button></p>
        </div>
        
        <h3>目標実装フォーマットを選択</h3>
        <div class="format-buttons">
          <button id="openApiBtn">OpenAPI</button>
          <button id="jsonSchemaBtn">JSON Schema</button>
          <button id="graphqlBtn">GraphQL</button>
          <button id="sqlBtn">SQL</button>
          <button id="typescriptBtn">TypeScript</button>
        </div>
        
        <button id="convertAlpsBtn" class="primary-btn">変換プロンプトを生成</button>
        
        <div class="nav-buttons">
          <button id="backToUserStoryBtn" class="secondary-btn">← ユーザーストーリーに戻る</button>
        </div>
      </section>
      
      <!-- ステップ3: 結果 -->
      <section id="resultSection" class="hidden">
        <div class="result-header">
          <h2 id="resultTitle">生成された変換プロンプト</h2>
          <button id="copyResultBtn" class="copy-btn">クリップボードにコピー</button>
        </div>
        
        <p>このプロンプトをChatGPT、Claude、またはその他のAIアシスタントにコピーしてください:</p>
        <div id="promptResult"></div>
        
        <div class="verification-tip">
          <p><strong>💡 覚えておいてください:</strong> 最良の結果を得るには、まずAIにALPSプロファイルの正確性を確認させ、その後この変換プロンプトを提供してください。</p>
        </div>
        
        <div class="nav-buttons">
          <button id="startOverBtn" class="secondary-btn">最初からやり直す</button>
          <button id="backToAlpsBtn" class="secondary-btn">← ALPSに戻る</button>
        </div>
        
        <div class="gpts-link" style="margin-top: 25px; text-align: center;">
          <p>ヒント: 迅速な結果を得るには、<a href="https://chatgpt.com/g/g-HYPygRnLS-alps-assistant" target="_blank">ALPSアシスタントGPTs</a>をプロンプトと一緒に使用することもできます。</p>
        </div>
      </section>
    </main>
    
    <footer>
    </footer>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 要素
    const userStoryInput = document.getElementById('userStoryInput');
    const alpsInput = document.getElementById('alpsInput');
    const promptResult = document.getElementById('promptResult');
    const resultTitle = document.getElementById('resultTitle');
    
    // セクション
    const userStorySection = document.getElementById('userStorySection');
    const alpsSection = document.getElementById('alpsSection');
    const resultSection = document.getElementById('resultSection');
    
    // ステップインジケーター
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    // ボタン
    const generateAlpsPromptBtn = document.getElementById('generateAlpsPromptBtn');
    const convertAlpsBtn = document.getElementById('convertAlpsBtn');
    const copyAlpsBtn = document.getElementById('copyAlpsBtn');
    const copyResultBtn = document.getElementById('copyResultBtn');
    const backToUserStoryBtn = document.getElementById('backToUserStoryBtn');
    const backToAlpsBtn = document.getElementById('backToAlpsBtn');
    const startOverBtn = document.getElementById('startOverBtn');
    
    // フォーマットボタン
    const openApiBtn = document.getElementById('openApiBtn');
    const jsonSchemaBtn = document.getElementById('jsonSchemaBtn');
    const graphqlBtn = document.getElementById('graphqlBtn');
    const sqlBtn = document.getElementById('sqlBtn');
    const typescriptBtn = document.getElementById('typescriptBtn');
    
    // サンプルユーザーストーリー
    const sampleStories = {
      'ecommerce': `ストアオーナーとして、商品在庫を管理したい。
商品には名前、説明、価格、カテゴリ、在庫数量があります。
新商品の追加、既存商品の更新、販売終了商品の削除が必要です。
顧客はカテゴリごとに商品を閲覧し、商品の詳細を確認できるようにしてください。`,
      
      'taskapp': `プロジェクトマネージャーとして、タスク追跡システムが必要です。
タスクにはタイトル、説明、期限、優先度、割り当てられたユーザーが含まれます。
ユーザーはタスクを作成し、ステータスを更新し、完了としてマークできるようにしてください。
システムはステータスまたは割り当てられたユーザーでフィルタリングされたタスクリストを表示する必要があります。`,
      
      'blog': `コンテンツクリエイターとして、ブログ管理システムが必要です。
記事にはタイトル、内容、公開日、タグ、著者が含まれます。
下書きを作成し、記事を公開し、コメントを管理したいです。
読者はタグまたは著者で記事を閲覧し、コメントを残せるようにしてください。`,
      
      'travel': `旅行代理店として、予約管理システムが必要です。
旅行には目的地、出発/到着日、交通手段、宿泊施設が含まれます。
顧客には個人情報、支払情報、旅行の好みがあります。
代理店は利用可能な旅行を検索し、予約を行い、旅程を管理できるようにしてください。
システムは予約状況、支払い、確認通知の送信を追跡する必要があります。`,
      
      'healthcare': `クリニック管理者として、患者管理システムが必要です。
患者には個人情報、医療履歴、保険の詳細が含まれます。
予約には日付、時間、医師、患者、ステータスがあります。
医療スタッフは予約をスケジュールし、診断を記録し、処方箋を管理する必要があります。
患者は医療記録と今後の予約を確認できるようにしてください。`,
      
      'events': `イベントプランナーとして、イベント管理プラットフォームが必要です。
イベントには名前、会場、日付、時間、収容人数、チケットタイプが含まれます。
参加者はチケットを購入し、セッションに登録し、フィードバックを残せます。
主催者は会場、スピーカー、スケジュール、チケット販売を管理する必要があります。
システムはチェックインをサポートし、リマインダーを送信し、出席レポートを生成する必要があります。`,
      
      'library': `図書館員として、図書館管理システムが必要です。
本にはタイトル、著者、ジャンル、ISBN、出版日、利用可能性ステータスがあります。
メンバーは個人情報、借りた本、借用履歴を含むアカウントを持ちます。
図書館員は本をカタログ化し、貸出と返却を処理し、予約を管理する必要があります。
メンバーはカタログを検索し、本を予約し、アカウント状況を確認できるようにしてください。`,
      
      'restaurant': `レストランオーナーとして、予約と注文システムが必要です。
テーブルには収容人数、場所、利用可能性ステータスがあります。
メニュー項目には名前、説明、価格、カテゴリ、食事情報が含まれます。
スタッフは予約を管理し、注文を受け付け、支払いを処理する必要があります。
顧客はテーブルを予約し、メニューを閲覧し、注文できるようにしてください。`
    };
    
    // ALPSガイドコンテンツ（簡略版）
    const alpsGuide = `## ‼️ 重要: JSONフォーマットガイドライン ‼️

1. 各ディスクリプターを1行で記述（必須）。
2. 他のディスクリプターを含む場合のみインデントと改行を使用。
3. すべてのネストされたディスクリプターは親を\`href\`で参照する必要があります。

\`\`\`json
{"$schema": "https://alps-io.github.io/schemas/alps.json", "alps": {"version": "1.0", "descriptor": [
{"id": "name", "type": "semantic", "title": "名前", "def": "https://schema.org/name"},
{"id": "email", "type": "semantic", "title": "メール", "def": "https://schema.org/email"},
{"id": "User", "type": "semantic", "title": "ユーザープロフィール", "descriptor": [
  {"href": "#name"},
  {"href": "#email"}
]},
{"id": "UserList", "type": "semantic", "title": "ユーザーリスト", "descriptor": [
  {"href": "#User"},
  {"href": "#goUser"},
  {"href": "#doCreateUser"}
]},
{"id": "goUser", "type": "safe", "title": "ユーザー詳細を表示", "rt": "#User"},
{"id": "doCreateUser", "type": "unsafe", "title": "ユーザーを作成", "rt": "#UserList"}
]}}
\`\`\`

## XMLフォーマットガイドライン

- 階層を示すためにインデントを使用。
- 各要素を1行で記述。

\`\`\`xml
<alps version="1.0"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="https://alps-io.github.io/schemas/alps.xsd">
</alps>
\`\`\`

## セマンティックディスクリプターの構造化

次の3つのブロックに整理します。各ディスクリプターは他のディスクリプターを参照するか含む必要があります:

1. セマンティック定義（オントロジー）
   - 基本要素を定義（lowerCamelCaseを使用）。
   - Schema.orgの定義がある場合は、\`def\`を完全なURLとして指定。
   - すべてのディスクリプターに\`title\`を追加。
   - 必要に応じてのみ\`doc\`を含める。
   - 定義された各要素は少なくとも1つの分類状態で参照される必要があります。

2. 包含関係（分類）
   - 状態を表すディスクリプターはUpperCamelCaseを使用。
   - 要素を参照するために\`href\`を使用（\`id\`による直接定義は不可）。
   - 各アプリケーション状態には以下が含まれます:
     * 状態で表示/使用される要素（オントロジーで定義）。
     * 実行可能なアクション（振付で定義）。
   - 必要に応じて追加の詳細のために\`doc\`を使用。
   - 各分類は他の分類を含むか、それに移行する必要があります。

3. 状態遷移（振付）
   - 遷移アクションを定義。
   - 適切な\`type\`属性を選択。
   - 遷移先（\`rt\`）を指定。
   - 必要なデータ項目を参照するために\`href\`を使用。
   - 各操作は少なくとも1つの分類状態で参照される必要があります。`;
    
    // 変換プロンプトテンプレート
    const conversionPrompts = {
      'OpenAPI': `**タスク:** 提供されたALPS（アプリケーション層プロファイルセマンティクス）ファイルをOpenAPI 3.0定義ファイル（YAMLフォーマット）に変換してください。

**考慮すべき主なポイント:**

1. **ディスクリプター要素:**
    - **\`descriptor\`の理解:** ALPSでは、\`descriptor\`はセマンティック要素を表し、データ要素または状態遷移のいずれかになります。
    - **OpenAPIパスと操作へのマッピング:**
        - 状態遷移（\`type\`が\`safe\`, \`unsafe\`, または\`idempotent\`の\`descriptor\`）を適切なHTTPメソッド（\`GET\`, \`POST\`, \`PUT\`, \`DELETE\`）の下のOpenAPI操作にマッピング。
        - 冪等操作には\`PUT\`または\`DELETE\`を使用。
        - \`DELETE\`操作にはリクエストボディを含めない。

2. **コンポーネントと再利用性:**
    - **スキーマとパラメータ:**
        - データ要素ディスクリプター（\`type\`が\`semantic\`のもの）を抽出し、\`components/schemas\`の下で再利用可能なスキーマとして定義。
        - 必要に応じてリクエストボディやレスポンスでこれらのスキーマを使用。
    - **共通パラメータ:**
        - 共通パラメータ（例: ID、クエリパラメータ）を特定し、\`components/parameters\`の下で再利用のために定義。

3. **レスポンスとステータスコード:**
    - **適切なステータスコード:**
        - 取得成功には\`200 OK\`を使用。
        - 新しいリソース作成時には\`201 Created\`を使用。
        - 操作が成功したがコンテンツを返さない場合は\`204 No Content\`を使用。
        - エラー処理には\`400 Bad Request\`, \`404 Not Found\`などを使用。
    - **レスポンススキーマ:**
        - 先に定義したコンポーネントを使用してレスポンススキーマを定義。

4. **データ制約:**
    - **バリデーション:**
        - 次のようなデータ制約を追加:
            - **文字列制約:** \`minLength\`, \`maxLength\`, \`pattern\`（正規表現）。
            - **数値制約:** \`minimum\`, \`maximum\`。
            - **列挙型:** 固定値セットには\`enum\`。
    - **制約の適用:**
        - これらの制約を\`components/schemas\`内のスキーマに適用。

5. **リンクと外部ドキュメント:**
    - **リンク関係:**
        - \`descriptor\`に\`href\`または\`rel\`が含まれる場合、OpenAPIの\`externalDocs\`または\`links\`を使用して関係を表現することを検討。
    - **説明:**
        - ALPSの\`doc\`要素を使用して、操作、パラメータ、スキーマの説明を提供。

**出力フォーマット:**
- OpenAPI定義を**YAML**フォーマットで提供してください。`,
      
      'JSON Schema': `**タスク:** 提供されたALPS（アプリケーション層プロファイルセマンティクス）ファイルをJSON Schema定義に変換してください。

**考慮すべき主なポイント:**

1. **ディスクリプター要素:**
    - **\`descriptor\`の理解:** ALPSでは、\`descriptor\`はセマンティック要素を表します。
    - **JSON Schemaへのマッピング:**
        - データ要素（\`type\`が\`semantic\`の\`descriptor\`）をJSON Schemaプロパティにマッピング。
        - データ要素の性質に基づいて適切なJSON Schemaタイプを使用。

2. **スキーマ構造:**
    - **ルートスキーマ:**
        - \`$schema\`と\`type\`プロパティでルートスキーマを定義。
        - \`title\`や\`description\`などの適切なメタデータを含める。
    - **プロパティ:**
        - ALPSディスクリプターに基づいてプロパティを定義。
        - \`properties\`と\`items\`を使用してネストされた構造を整理。

3. **データ型とフォーマット:**
    - **基本型:**
        - 適切なJSON Schemaタイプを使用:
            - \`string\`
            - \`number\`
            - \`integer\`
            - \`boolean\`
            - \`object\`
            - \`array\`
    - **フォーマット:**
        - 該当する場合に標準フォーマットを適用:
            - \`date-time\`
            - \`date\`
            - \`email\`
            - \`uri\`
            - など

4. **データ制約:**
    - **バリデーションルール:**
        - 次のような制約を追加:
            - **文字列:** \`minLength\`, \`maxLength\`, \`pattern\`
            - **数値:** \`minimum\`, \`maximum\`, \`multipleOf\`
            - **配列:** \`minItems\`, \`maxItems\`, \`uniqueItems\`
            - **オブジェクト:** \`required\`, \`additionalProperties\`
    - **列挙型:**
        - 固定値セットには\`enum\`を使用
        - 列挙値に説明を含める

5. **定義と参照:**
    - **再利用可能なコンポーネント:**
        - 共通スキーマを\`$defs\`の下に定義
        - 再利用可能なスキーマを参照するために\`$ref\`を使用
    - **継承:**
        - 複雑な型の関係には\`allOf\`, \`anyOf\`, または\`oneOf\`を使用

6. **ドキュメント:**
    - **説明:**
        - ALPSの\`doc\`要素を使用してスキーマとプロパティの説明を提供
    - **例:**
        - 役立つ場合は\`examples\`を含める
    - **タイトル:**
        - プロパティと定義に明確なタイトルを追加`,
      
      'GraphQL': `**タスク:** 提供されたALPS（アプリケーション層プロファイルセマンティクス）ファイルを完全なGraphQL実装（スキーマ定義と操作例を含む）に変換してください。

**考慮すべき主なポイント:**

1. **スキーマ定義:**
   - **型定義:**
     - ALPSセマンティックディスクリプターをGraphQL型にマッピング
     - 適切なスカラー型（ID、String、Int、Float、Boolean）を使用
     - 必要に応じてカスタムスカラー型（DateTime、JSONなど）を定義

   - **関係:**
     - 1対1、1対多、多対多の関係を処理
     - null許容フィールドと非nullフィールドを検討

   - **入力型:**
     - ミューテーション用に入力型を作成
     - バリデーション要件を考慮

   - **インターフェースとユニオン:**
     - 共有フィールド用にインターフェースを定義
     - 多形関係にユニオンを使用

2. **クエリ操作:**
   - **基本クエリ:**
     - 単一アイテムの取得
     - フィルタリング付きリスト取得
     - 検索操作

   - **フィルタリングシステム:**
     - フィルター入力型を定義
     - 複雑なフィルタリング操作をサポート

   - **ページネーション:**
     - カーソルベースのページネーションを実装
     - 制限/オフセットページネーションをサポート

3. **ミューテーション操作:**
   - **作成操作:**
     - 適切な入力バリデーションを含める
     - エラーハンドリング付きの意味のあるペイロードを返す

   - **バッチ操作:**
     - バッチ作成/更新/削除操作をサポート

   - **エラーハンドリング:**
     - 適切なエラーハンドリング構造を定義
     - フィールドレベルのエラーを含める

4. **サブスクリプション操作:**
   - リアルタイム更新用にイベントベースのサブスクリプションを定義

5. **ディレクティブ:**
   - 認証、非推奨などの適切なディレクティブを追加`,
      
      'SQL': `**タスク:** 提供されたALPS（アプリケーション層プロファイルセマンティクス）ファイルをSQL DDL（データ定義言語）とDML（データ操作言語）ステートメントに変換してください。

**パート1: DDLステートメント**

1. **スキーマとテーブル設計:**
   - **データベーススキーマ:**
      - ALPSプロファイルに基づいて適切なデータベーススキーマ名を作成
      - スキーマのバージョニングを考慮
   - **テーブル作成:**
      - \`type\`が\`semantic\`のALPSディスクリプターをデータベーステーブルにマッピング
      - テーブル関係を通じてネストされた構造を処理

**パート2: DMLステートメント生成**

1. **SELECTクエリ:**
    - **基本クエリ:**
        - 各主要リソースに対するSELECTステートメントを生成
        - 関係に基づく適切なJOIN句を含める
        - フィルタリング用のWHERE句を追加
        - ページネーション（LIMIT/OFFSET）を考慮

    - **複雑なクエリ:**
        - 複数のJOINを使用したクエリを作成
        - 適切な場所でサブクエリを追加
        - 集計関数（COUNT、SUMなど）を含める
        - GROUP BYとHAVING句を実装

    - **ビュークエリ:**
        - 役立つビュー定義を生成
        - パフォーマンスのためにマテリアライズドビューを作成

2. **INSERTステートメント:**
    - 以下を含むINSERTステートメントを生成:
        - 単一行挿入
        - バルク挿入テンプレート
        - INSERT ... SELECTパターン
        - 該当する場合にRETURNING句

3. **UPDATEステートメント:**
    - 以下用のUPDATEテンプレートを作成:
        - 単一レコード更新
        - バルク更新
        - JOINを使用した更新
        - 条件付き更新

4. **DELETEステートメント:**
    - 以下を含むDELETEステートメントを生成:
        - 安全な削除パターン
        - ソフト削除実装
        - カスケード削除の考慮
        - アーカイブ戦略`,
      
      'TypeScript': `**タスク:** 提供されたALPS（アプリケーション層プロファイルセマンティクス）ファイルをTypeScriptの型定義、インターフェース、関連ユーティリティに変換してください。

**パート1: コア型定義**

1. **基本型とインターフェース:**
    - **エンティティ型:**
        - 主要エンティティ用にインターフェースを作成
        - 適切な型アノテーションを含める
        - 有限値セットにenumを使用

    - **ネストされた型:**
        - 構成を通じてネストされた構造を処理
        - 関連型に拡張を使用

2. **ユーティリティ型:**
    - **部分型:**
        - 更新ペイロード型を作成
        - 適切なフィールドを省略

    - **ピック型:**
        - 特定の操作用に特殊化されたサブセットを作成

    - **レコード型:**
        - ルックアップコレクションを作成

3. **ジェネリック型:**
    - **レスポンスラッパー:**
        - ページネーションラッパーを作成
        - 適切なエラーハンドリング型を設計

**パート2: API型**

1. **リクエスト/レスポンス型:**
    - リクエストペイロードを定義
    - レスポンス構造を定義
    - 適切なバリデーション制約を含める

2. **クエリパラメータ:**
    - 検索パラメータ型を定義
    - ソートおよびフィルタリングオプションを含める

3. **APIクライアント型:**
    - サービスインターフェースを定義
    - 適切なエラーハンドリングを含める

**パート3: バリデーションスキーマ**

1. **Zodスキーマ:**
    - バリデーションスキーマを定義
    - スキーマから型を推論

2. **カスタムバリデータ:**
    - 型ガードを作成
    - 適切なエラー報告を含める`
    };
    
    // タブ切り替え機能
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
    
    // ステップ1: サンプルストーリーの処理
    document.getElementById('sampleStorySelect').addEventListener('change', function() {
      if (this.value) {
        userStoryInput.value = sampleStories[this.value];
      }
    });
    
    // カスタム言語の処理
    document.getElementById('languageSelect').addEventListener('change', function() {
      const customLanguageInput = document.getElementById('customLanguage');
      if (this.value === 'other') {
        customLanguageInput.classList.remove('hidden');
      } else {
        customLanguageInput.classList.add('hidden');
      }
    });
    
    // ALPSプロンプト生成ボタン（ユーザーストーリーから）
    generateAlpsPromptBtn.addEventListener('click', function() {
      if (userStoryInput.value.trim() === '') {
        alert('ユーザーストーリーを入力してください。');
        return;
      }
      
      const format = document.querySelector('input[name="alpsFormat"]:checked').value;
      const language = getSelectedLanguage();
      
      // ALPSプロンプトを生成
      const alpsPrompt = generateAlpsPrompt(userStoryInput.value, format, language);
      alpsInput.value = alpsPrompt;
      
      // ステップ2に移動
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // 変換に進むボタン（直接ALPS入力から）
    document.getElementById('proceedToConversionBtn').addEventListener('click', function() {
      const directAlpsInput = document.getElementById('directAlpsInput');
      
      if (directAlpsInput.value.trim() === '') {
        alert('ALPSプロファイルを入力してください。');
        return;
      }
      
      // 直接ALPS入力を変換セクションに転送
      alpsInput.value = directAlpsInput.value;
      
      // ステップ2に直接移動
      userStorySection.classList.add('hidden');
      alpsSection.classList.remove('hidden');
      
      step1.classList.remove('active');
      step2.classList.add('active');
    });
    
    // ステップ2: フォーマット選択の処理
    let selectedFormat = null;
    
    openApiBtn.addEventListener('click', () => selectFormat('OpenAPI', openApiBtn));
    jsonSchemaBtn.addEventListener('click', () => selectFormat('JSON Schema', jsonSchemaBtn));
    graphqlBtn.addEventListener('click', () => selectFormat('GraphQL', graphqlBtn));
    sqlBtn.addEventListener('click', () => selectFormat('SQL', sqlBtn));
    typescriptBtn.addEventListener('click', () => selectFormat('TypeScript', typescriptBtn));
    
    function selectFormat(format, button) {
      selectedFormat = format;
      
      // UIを更新して選択されたフォーマットを表示
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
      button.classList.add('selected');
    }
    
    // ALPS変換ボタン
    convertAlpsBtn.addEventListener('click', function() {
      if (alpsInput.value.trim() === '') {
        alert('ALPSプロファイルを生成または貼り付けてください。');
        return;
      }
      
      if (!selectedFormat) {
        alert('変換するフォーマットを選択してください。');
        return;
      }
      
      // 変換プロンプトを生成
      const conversionPrompt = conversionPrompts[selectedFormat] + 
        '\n\n_YOUR_ALPS_HERE_\n\n```\n' + alpsInput.value + '\n```';
      
      promptResult.textContent = conversionPrompt;
      resultTitle.textContent = `${selectedFormat} 変換プロンプト`;
      
      // ステップ3に移動
      alpsSection.classList.add('hidden');
      resultSection.classList.remove('hidden');
      
      step2.classList.remove('active');
      step3.classList.add('active');
    });
    
    // ナビゲーションボタン
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
      
      // 選択をリセット
      selectedFormat = null;
      document.querySelectorAll('.format-buttons button').forEach(btn => {
        btn.classList.remove('selected');
      });
    });
    
    // コピーボタン
    copyAlpsBtn.addEventListener('click', function() {
      copyToClipboard(alpsInput.value, copyAlpsBtn);
    });
    
    copyResultBtn.addEventListener('click', function() {
      copyToClipboard(promptResult.textContent, copyResultBtn);
    });
    
    // 検証ヒントのコピー
    document.getElementById('copyTipBtn').addEventListener('click', function() {
      const tipText = "このALPSプロファイル内のすべてのリンクと参照を確認し、不整合を修正してください。";
      copyToClipboard(tipText, this);
    });
    
    // ヘルパー関数
    function getSelectedLanguage() {
      const languageSelect = document.getElementById('languageSelect');
      if (languageSelect.value === 'other') {
        return document.getElementById('customLanguage').value || 'カスタム';
      } else {
        return languageSelect.value;
      }
    }
    
    function generateAlpsPrompt(userStory, format, language) {
      return `# ALPSプロファイル作成プロンプト

以下の要件に基づいてALPSプロファイルを作成し、以下に記載されたガイドラインに従ってください:

* フォーマット: ${format.toUpperCase()}
* 言語: ${language}
* 内容: 

${userStory}

${alpsGuide}`;
    }
    
    function copyToClipboard(text, button) {
      navigator.clipboard.writeText(text)
        .then(() => {
          const originalText = button.textContent;
          button.textContent = '✅ コピー完了!';
          setTimeout(() => {
            button.textContent = originalText;
          }, 2000);
        })
        .catch(err => {
          console.error('コピーに失敗しました: ', err);
          alert('コピーに失敗しました。手動でコピーしてください。');
        });
    }
  });
</script>
