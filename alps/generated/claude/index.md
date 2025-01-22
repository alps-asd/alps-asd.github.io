# Eコマースプラットフォーム JSONスキーマ定義集

このドキュメントは、Eコマースプラットフォームで使用される主要なデータモデルのJSONスキーマ定義集です。各スキーマはJSON Schema Draft 2020-12に準拠しており、データの構造、制約、相互関係を定義しています。

## スキーマ一覧

### 基盤となるスキーマ

- Money、Address、Ratingなど、複数のスキーマで共通して使用される基本的なデータ型の定義集です  
  [`common-types.json`](./schemas/common-types.json)

- ユーザープロファイル、認証情報、権限設定を含む、プラットフォームの基本となるユーザー情報スキーマです  
  [`user-schema.json`](./schemas/user-schema.json)

- 商品分類の階層構造、メタデータ、SEO情報を管理するスキーマです  
  [`category-schema.json`](./schemas/category-schema.json)

### 商品関連

- 商品の基本情報、価格、仕様、在庫状況など、商品に関するすべての情報を管理します  
  [`product-schema.json`](./schemas/product-schema.json)

- 商品画像、バナー、プロフィール画像などのメディアアセットとその最適化情報を管理します  
  [`image-schema.json`](./schemas/image-schema.json)

- リアルタイムの在庫数、倉庫位置、入出荷履歴、在庫予約状況を追跡します  
  [`inventory-schema.json`](./schemas/inventory-schema.json)

### 取引関連

- 注文の作成から配送完了までの全プロセス、支払い状態、配送状況を管理します  
  [`order-schema.json`](./schemas/order-schema.json)

- ユーザーの買い物かごの内容、小計、適用された割引などを管理します  
  [`cart-schema.json`](./schemas/cart-schema.json)

- ユーザーの欲しい物リストと、その共有設定、通知設定を管理します  
  [`wishlist-schema.json`](./schemas/wishlist-schema.json)

### 価格・プロモーション

- 商品個別の割引、カート全体の割引、クーポン適用などの価格調整を管理します  
  [`discount-schema.json`](./schemas/discount-schema.json)

- 期間限定セール、バンドル販売、会員特典などのキャンペーン情報を管理します  
  [`promotion-schema.json`](./schemas/promotion-schema.json)

### 配送・物流

- 配送業者、配送料金、配送時間、地域制限などの配送オプションを定義します  
  [`shipping-method-schema.json`](./schemas/shipping-method-schema.json)

- 物流拠点の設備、処理能力、在庫状況、運営スケジュールを管理します  
  [`fulfillment-center-schema.json`](./schemas/fulfillment-center-schema.json)

### マーケットプレイス関連

- 出店規約、手数料体系、カテゴリー制限などのマーケットプレイスの基本ルールを定義します  
  [`marketplace-schema.json`](./schemas/marketplace-schema.json)

- 出店者の基本情報、実績指標、評価、取扱商品カテゴリーを管理します  
  [`seller-schema.json`](./schemas/seller-schema.json)

- 卸売業者や製造業者との取引条件、在庫状況、リードタイムを管理します  
  [`supplier-schema.json`](./schemas/supplier-schema.json)

### カスタマーエンゲージメント

- 商品レビュー、評価スコア、画像、販売者の返信を管理します  
  [`review-schema.json`](./schemas/review-schema.json)

- 注文状況、プロモーション、システム通知などのメッセージを管理します  
  [`notification-schema.json`](./schemas/notification-schema.json)

### パートナーシップ・サービス

- アフィリエイトパートナーの成果報酬、トラッキング情報、支払い設定を管理します  
  [`affiliate-schema.json`](./schemas/affiliate-schema.json)

- 定期購入プラン、会員サービス、自動更新設定、支払い履歴を管理します  
  [`subscription-schema.json`](./schemas/subscription-schema.json)

## スキーマの利用について

- 各スキーマは`$ref`を使用して他のスキーマを参照することができます
- すべてのIDフィールドはUUID v4形式を使用します
- 日時情報はISO 8601形式で記録されます
- 金額情報は通貨コードを含むMoneyオブジェクトとして扱われます

## バージョン管理

このスキーマ定義集は定期的に更新され、各更新はセマンティックバージョニングに従って管理されます。重要な変更がある場合は、互換性を保つための移行ガイドが提供されます。

## エラーや改善提案について

スキーマに関するエラーの報告や改善提案は、GitHubのIssueを通じてお願いします。新しい要件やユースケースへの対応も随時検討しています。
