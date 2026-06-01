---
layout: docs-ja
title: リファレンス
category: Manual
permalink: /manuals/1.0/ja/semantic-terms.html
---

# 推奨セマンティック用語

## 概要

このドキュメントは[Schema.org](https://schema.org)で定義されている語彙から、ALPSプロファイルのセマンティックディスクリプタ(id)として使用できる用語の完全な一覧です。

### 使い方

1. APIの設計を始める際は、まず 🔵 Core Terms から適切な用語を選択します。
2. より詳細な表現が必要な場合は、🟡 Extended Terms を検討します。
3. 特殊なユースケースでは、⚪ Full Terms まで視野に入れて検討します。
4. カテゴリインデックスから必要な分野の用語を探せます。
5. ドメイン固有の用語について:
- 業界やビジネス固有の用語は、独自のセマンティックディスクリプタとして定義します。
- 命名規則: domainName + PropertyName （例：orderShippingStatus, medicalDiagnosisCode）
- できるだけSchema.orgの用語を基盤としつつ、必要な拡張を行うことを推奨します。
- ドメイン固有の用語を定義する際は、その意味と用途を明確にドキュメント化することが重要です。

### カテゴリインデックス

1. [基本プロパティ](#基本プロパティ)
2. [識別子・参照](#識別子参照)
3. [メタデータ](#メタデータ)
4. [日時・期間](#日時期間)
5. [テキスト・コンテンツ](#テキストコンテンツ)
6. [メディア・ファイル](#メディアファイル)
7. [人物・個人](#人物個人)
8. [組織・団体](#組織団体)
9. [住所・位置](#住所位置)
10. [商品・サービス](#商品サービス)
11. [価格・支払い](#価格支払い)
12. [イベント・活動](#イベント活動)
13. [レビュー・評価](#レビュー評価)
14. [教育・学習](#教育学習)
15. [医療・健康](#医療健康)
16. [金融・取引](#金融取引)
17. [予約・スケジュール](#予約スケジュール)
18. [コミュニケーション](#コミュニケーション)
19. [セキュリティ・アクセス制御](#セキュリティアクセス制御)
20. [ワークフロー・プロセス](#ワークフロープロセス)
21. [技術・システム](#技術システム)
22. [法務・規約](#法務規約)
23. [その他の属性](#その他の属性)

---

## カテゴリ別用語一覧

### 基本プロパティ

| 用語 | レベル | 説明 |
|------|--------|------|
| name | 🔵 | 名前 |
| description | 🔵 | 説明 |
| url | 🔵 | URL |
| alternateName | 🔵 | 別名 |
| title | 🔵 | タイトル |
| text | 🔵 | テキスト |
| value | 🔵 | 値 |
| additionalValue | 🟡 | 追加の値 |
| defaultValue | 🟡 | デフォルト値 |
| maxValue | 🟡 | 最大値 |
| minValue | 🟡 | 最小値 |
| multipleValues | 🟡 | 複数の値 |
| propertyID | 🟡 | プロパティID |
| valueReference | 🟡 | 値の参照 |
| valueRequired | 🟡 | 必須値 |
| unitCode | ⚪ | 単位コード |
| unitText | ⚪ | 単位テキスト |
| propertyType | ⚪ | プロパティタイプ |
| propertyValue | ⚪ | プロパティ値 |
| measurementTechnique | ⚪ | 測定手法 |

### 識別子・参照

| 用語 | レベル | 説明 |
|------|--------|------|
| identifier | 🔵 | 識別子 |
| id | 🔵 | ID |
| sameAs | 🔵 | 同一参照 |
| mainEntity | 🔵 | 主要実体 |
| about | 🟡 | 参照対象 |
| mentions | 🟡 | 言及 |
| citation | 🟡 | 引用 |
| reference | 🟡 | 参照 |
| referencesOrder | 🟡 | 参照順序 |
| isBasedOn | 🟡 | 基づいている |
| isPartOf | 🟡 | 一部である |
| hasPart | 🟡 | 部分を持つ |
| itemListElement | 🟡 | リスト要素 |
| itemListOrder | 🟡 | リスト順序 |
| position | 🟡 | 位置 |
| isVersionOf | ⚪ | バージョンである |
| predecessorOf | ⚪ | 前任である |
| successorOf | ⚪ | 後任である |
| isRelatedTo | ⚪ | 関連している |
| isSimilarTo | ⚪ | 類似している |
| isVariantOf | ⚪ | バリエーションである |
| exampleOfWork | ⚪ | 作品の例 |
| workExample | ⚪ | 例となる作品 |
| isBasedOnUrl | ⚪ | 基づいているURL |

### メタデータ

| 用語 | レベル | 説明 |
|------|--------|------|
| version | 🔵 | バージョン |
| status | 🔵 | 状態 |
| category | 🔵 | カテゴリ |
| keywords | 🔵 | キーワード |
| type | 🔵 | タイプ |
| format | 🔵 | フォーマット |
| language | 🔵 | 言語 |
| source | 🔵 | ソース |
| license | 🟡 | ライセンス |
| creator | 🟡 | 作成者 |
| editor | 🟡 | 編集者 |
| publisher | 🟡 | 発行者 |
| contributor | 🟡 | 貢献者 |
| rights | 🟡 | 権利 |
| copyrightHolder | 🟡 | 著作権者 |
| copyrightYear | 🟡 | 著作権年 |
| creditText | 🟡 | クレジットテキスト |
| maintainer | 🟡 | メンテナー |
| schemaVersion | ⚪ | スキーマバージョン |
| usageInfo | ⚪ | 使用情報 |
| encoding | ⚪ | エンコーディング |
| isAccessibleForFree | ⚪ | 無料アクセス可能 |
| conditionsOfAccess | ⚪ | アクセス条件 |
| contentReferenceTime | ⚪ | コンテンツ参照時間 |

### 日時・期間

| 用語 | レベル | 説明 |
|------|--------|------|
| dateCreated | 🔵 | 作成日時 |
| dateModified | 🔵 | 更新日時 |
| datePublished | 🔵 | 公開日時 |
| startDate | 🔵 | 開始日 |
| endDate | 🔵 | 終了日 |
| startTime | 🔵 | 開始時刻 |
| endTime | 🔵 | 終了時刻 |
| duration | 🔵 | 期間 |
| validFrom | 🔵 | 有効開始日時 |
| validThrough | 🔵 | 有効終了日時 |
| dateDeleted | 🟡 | 削除日時 |
| dateRead | 🟡 | 読取日時 |
| dateReceived | 🟡 | 受信日時 |
| dateSent | 🟡 | 送信日時 |
| dateIssued | 🟡 | 発行日時 |
| scheduleTime | 🟡 | 予定時刻 |
| birthDate | 🟡 | 生年月日 |
| deathDate | 🟡 | 死亡日時 |
| foundingDate | 🟡 | 設立日 |
| dissolutionDate | 🟡 | 解散日 |
| previousStartDate | ⚪ | 前回開始日 |
| uploadDate | ⚪ | アップロード日時 |
| modifiedTime | ⚪ | 変更時刻 |
| expires | ⚪ | 有効期限 |
| temporalCoverage | ⚪ | 時間的範囲 |

### テキスト・コンテンツ

| 用語 | レベル | 説明 |
|------|--------|------|
| title | 🔵 | タイトル |
| text | 🔵 | テキスト |
| content | 🔵 | コンテンツ |
| articleBody | 🔵 | 記事本文 |
| headline | 🔵 | 見出し |
| abstract | 🔵 | 要約 |
| description | 🔵 | 説明 |
| comment | 🔵 | コメント |
| contentType | 🔵 | コンテンツタイプ |
| encodingFormat | 🟡 | エンコーディング形式 |
| wordCount | 🟡 | 単語数 |
| characterCount | 🟡 | 文字数 |
| pagination | 🟡 | ページ番号 |
| pageStart | 🟡 | 開始ページ |
| pageEnd | 🟡 | 終了ページ |
| section | 🟡 | セクション |
| chapter | 🟡 | 章 |
| articleSection | 🟡 | 記事セクション |
| speakable | ⚪ | 読み上げ可能テキスト |
| textTemplate | ⚪ | テキストテンプレート |
| cssSelector | ⚪ | CSSセレクタ |
| xpath | ⚪ | XPath |
| transcript | ⚪ | 文字起こし |
| translationOfWork | ⚪ | 翻訳元作品 |
| workTranslation | ⚪ | 翻訳作品 |

### メディア・ファイル

| 用語 | レベル | 説明 |
|------|--------|------|
| image | 🔵 | 画像 |
| audio | 🔵 | 音声 |
| video | 🔵 | 動画 |
| file | 🔵 | ファイル |
| fileSize | 🔵 | ファイルサイズ |
| fileFormat | 🔵 | ファイル形式 |
| contentUrl | 🔵 | コンテンツURL |
| thumbnailUrl | 🔵 | サムネイルURL |
| downloadUrl | 🔵 | ダウンロードURL |
| embedUrl | 🟡 | 埋め込みURL |
| height | 🟡 | 高さ |
| width | 🟡 | 幅 |
| duration | 🟡 | 長さ |
| bitrate | 🟡 | ビットレート |
| encodingFormat | 🟡 | エンコーディング形式 |
| playerType | 🟡 | プレーヤータイプ |
| productionCompany | 🟡 | 制作会社 |
| thumbnail | 🟡 | サムネイル |
| uploadDate | 🟡 | アップロード日 |
| contentSize | 🟡 | コンテンツサイズ |
| encodesCreativeWork | ⚪ | エンコード対象作品 |
| associatedMedia | ⚪ | 関連メディア |
| requiresSubscription | ⚪ | 購読要件 |
| videoFrameSize | ⚪ | 動画フレームサイズ |
| videoQuality | ⚪ | 動画品質 |
| hasDigitalDocumentPermission | ⚪ | デジタル文書権限 |

### 人物・個人

| 用語 | レベル | 説明 |
|------|--------|------|
| givenName | 🔵 | 名 |
| familyName | 🔵 | 姓 |
| email | 🔵 | メールアドレス |
| telephone | 🔵 | 電話番号 |
| gender | 🔵 | 性別 |
| birthDate | 🔵 | 生年月日 |
| nationality | 🔵 | 国籍 |
| address | 🔵 | 住所 |
| jobTitle | 🔵 | 役職 |
| additionalName | 🟡 | ミドルネーム |
| honorificPrefix | 🟡 | 敬称（前） |
| honorificSuffix | 🟡 | 敬称（後） |
| birthPlace | 🟡 | 出生地 |
| deathDate | 🟡 | 死亡日 |
| deathPlace | 🟡 | 死亡地 |
| height | 🟡 | 身長 |
| weight | 🟡 | 体重 |
| worksFor | 🟡 | 勤務先 |
| alumniOf | 🟡 | 卒業校 |
| awards | 🟡 | 受賞歴 |
| knows | ⚪ | 知人 |
| colleagues | ⚪ | 同僚 |
| follows | ⚪ | フォロー |
| parent | ⚪ | 親 |
| children | ⚪ | 子 |
| sibling | ⚪ | 兄弟姉妹 |
| spouse | ⚪ | 配偶者 |
| homeLocation | ⚪ | 居住地 |
| workLocation | ⚪ | 勤務地 |

### 組織・団体

| 用語 | レベル | 説明 |
|------|--------|------|
| organizationName | 🔵 | 組織名 |
| legalName | 🔵 | 正式名称 |
| department | 🔵 | 部署 |
| address | 🔵 | 所在地 |
| telephone | 🔵 | 電話番号 |
| email | 🔵 | メールアドレス |
| url | 🔵 | ウェブサイト |
| foundingDate | 🟡 | 設立日 |
| founder | 🟡 | 設立者 |
| numberOfEmployees | 🟡 | 従業員数 |
| parentOrganization | 🟡 | 親組織 |
| subOrganization | 🟡 | 子組織 |
| member | 🟡 | メンバー |
| memberOf | 🟡 | 所属組織 |
| taxID | 🟡 | 税務ID |
| vatID | 🟡 | VAT番号 |
| globalLocationNumber | ⚪ | GLN |
| duns | ⚪ | DUNS番号 |
| funder | ⚪ | 出資者 |
| sponsor | ⚪ | スポンサー |
| ownershipFundingInfo | ⚪ | 所有権・資金情報 |
| slogan | ⚪ | スローガン |
| brand | ⚪ | ブランド |
| dissolutionDate | ⚪ | 解散日 |

### 住所・位置

| 用語 | レベル | 説明 |
|------|--------|------|
| streetAddress | 🔵 | 町名・番地 |
| addressLocality | 🔵 | 市区町村 |
| addressRegion | 🔵 | 都道府県 |
| addressCountry | 🔵 | 国 |
| postalCode | 🔵 | 郵便番号 |
| location | 🔵 | 場所 |
| latitude | 🔵 | 緯度 |
| longitude | 🔵 | 経度 |
| elevation | 🟡 | 標高 |
| postOfficeBoxNumber | 🟡 | 私書箱番号 |
| floor | 🟡 | 階 |
| room | 🟡 | 部屋 |
| landmark | 🟡 | 目印 |
| areaServed | 🟡 | サービス提供地域 |
| serviceArea | 🟡 | サービスエリア |
| geo | 🟡 | 地理情報 |
| geoRadius | ⚪ | 地理的半径 |
| geoCoveredBy | ⚪ | 地理的包含関係 |
| geoCovers | ⚪ | 地理的範囲 |
| geoDisjoint | ⚪ | 地理的分離 |
| geoIntersects | ⚪ | 地理的交差 |
| geoTouches | ⚪ | 地理的接触 |
| containsPlace | ⚪ | 包含する場所 |
| containedInPlace | ⚪ | 包含される場所 |

### 商品・サービス

| 用語 | レベル | 説明 |
|------|--------|------|
| productID | 🔵 | 商品ID |
| sku | 🔵 | SKU（在庫管理番号） |
| name | 🔵 | 商品名 |
| description | 🔵 | 商品説明 |
| brand | 🔵 | ブランド |
| manufacturer | 🔵 | 製造元 |
| category | 🔵 | カテゴリ |
| price | 🔵 | 価格 |
| availability | 🔵 | 在庫状況 |
| color | 🟡 | 色 |
| size | 🟡 | サイズ |
| weight | 🟡 | 重量 |
| material | 🟡 | 素材 |
| model | 🟡 | モデル |
| gtin | 🟡 | GTIN（商品コード） |
| mpn | 🟡 | MPN（製造番号） |
| countryOfOrigin | 🟡 | 原産国 |
| productionDate | 🟡 | 製造日 |
| releaseDate | 🟡 | 発売日 |
| itemCondition | 🟡 | 商品状態 |
| width | ⚪ | 幅 |
| height | ⚪ | 高さ |
| depth | ⚪ | 奥行き |
| additionalProperty | ⚪ | 追加属性 |
| hasMerchantReturnPolicy | ⚪ | 返品ポリシー |
| hasWarranty | ⚪ | 保証情報 |
| isFamilyFriendly | ⚪ | 家族向け |
| isAccessoryOrSparePartFor | ⚪ | 付属品・交換部品 |
| isConsumableFor | ⚪ | 消耗品 |

### 価格・支払い

| 用語 | レベル | 説明 |
|------|--------|------|
| price | 🔵 | 価格 |
| priceCurrency | 🔵 | 通貨 |
| paymentMethod | 🔵 | 支払方法 |
| paymentStatus | 🔵 | 支払状態 |
| paymentDue | 🔵 | 支払期限 |
| validFrom | 🔵 | 価格適用開始日 |
| validThrough | 🔵 | 価格適用終了日 |
| minPrice | 🟡 | 最低価格 |
| maxPrice | 🟡 | 最高価格 |
| priceValidUntil | 🟡 | 価格有効期限 |
| discount | 🟡 | 割引 |
| discountCode | 🟡 | 割引コード |
| valueAddedTaxIncluded | 🟡 | 税込表示 |
| priceType | 🟡 | 価格タイプ |
| paymentAccepted | 🟡 | 利用可能な支払方法 |
| paymentUrl | 🟡 | 支払URL |
| billingPeriod | ⚪ | 請求期間 |
| billingDuration | ⚪ | 請求期間長 |
| billingIncrement | ⚪ | 請求増分 |
| billingStart | ⚪ | 請求開始日 |
| downPayment | ⚪ | 頭金 |
| installment | ⚪ | 分割払い |
| loanTerm | ⚪ | ローン期間 |
| monthlyMinimumPayment | ⚪ | 最低月払い額 |

### イベント・活動

| 用語 | レベル | 説明 |
|------|--------|------|
| eventName | 🔵 | イベント名 |
| eventStatus | 🔵 | イベント状態 |
| startDate | 🔵 | 開始日 |
| endDate | 🔵 | 終了日 |
| location | 🔵 | 開催場所 |
| organizer | 🔵 | 主催者 |
| performer | 🔵 | 出演者 |
| eventAttendanceMode | 🔵 | 参加形式 |
| maximumAttendeeCapacity | 🟡 | 最大参加人数 |
| remainingAttendeeCapacity | 🟡 | 残席数 |
| offers | 🟡 | チケット情報 |
| doorTime | 🟡 | 開場時間 |
| duration | 🟡 | 所要時間 |
| inLanguage | 🟡 | 使用言語 |
| sponsor | 🟡 | スポンサー |
| superEvent | ⚪ | 親イベント |
| subEvent | ⚪ | サブイベント |
| recordedIn | ⚪ | 記録メディア |
| workFeatured | ⚪ | 特集作品 |
| workPerformed | ⚪ | 上演作品 |
| contributor | ⚪ | 協力者 |

### レビュー・評価

| 用語 | レベル | 説明 |
|------|--------|------|
| review | 🔵 | レビュー |
| rating | 🔵 | 評価 |
| ratingValue | 🔵 | 評価値 |
| reviewBody | 🔵 | レビュー本文 |
| author | 🔵 | 評価者 |
| datePublished | 🔵 | 投稿日 |
| reviewRating | 🟡 | レビュー評価 |
| bestRating | 🟡 | 最高評価 |
| worstRating | 🟡 | 最低評価 |
| ratingCount | 🟡 | 評価数 |
| reviewAspect | 🟡 | レビュー観点 |
| positiveNotes | 🟡 | 良い点 |
| negativeNotes | 🟡 | 改善点 |
| aggregateRating | 🟡 | 総合評価 |
| itemReviewed | 🟡 | レビュー対象 |
| recommendationStrength | ⚪ | 推奨強度 |
| associatedReview | ⚪ | 関連レビュー |
| abridged | ⚪ | 要約版 |

### 教育・学習

| 用語 | レベル | 説明 |
|------|--------|------|
| educationalLevel | 🔵 | 教育レベル |
| learningResourceType | 🔵 | 学習リソースタイプ |
| teaches | 🔵 | 教育内容 |
| courseCode | 🔵 | コース番号 |
| instructor | 🔵 | 講師 |
| courseWorkload | 🔵 | 学習量 |
| competencyRequired | 🟡 | 必要な能力 |
| educationalUse | 🟡 | 教育用途 |
| timeRequired | 🟡 | 所要時間 |
| typicalAgeRange | 🟡 | 対象年齢層 |
| assesses | 🟡 | 評価対象 |
| educationalAlignment | 🟡 | 教育的整合性 |
| educationalFramework | 🟡 | 教育フレームワーク |
| proficiencyLevel | ⚪ | 習熟度レベル |
| coursePrerequisites | ⚪ | 前提条件 |
| educationalProgramMode | ⚪ | 教育プログラム形式 |
| occupationalCredentialAwarded | ⚪ | 取得可能資格 |
| numberOfCredits | ⚪ | 単位数 |

### 医療・健康

| 用語 | レベル | 説明 |
|------|--------|------|
| medicalCondition | 🔵 | 病状 |
| diagnosis | 🔵 | 診断 |
| treatment | 🔵 | 治療 |
| medication | 🔵 | 薬剤 |
| symptoms | 🔵 | 症状 |
| healthcareProvider | 🔵 | 医療提供者 |
| medicalSpecialty | 🟡 | 専門分野 |
| procedure | 🟡 | 処置 |
| dosageSchedule | 🟡 | 投薬スケジュール |
| adverseOutcome | 🟡 | 有害結果 |
| contraindication | 🟡 | 禁忌 |
| indication | 🟡 | 適応 |
| sideEffect | 🟡 | 副作用 |
| warning | 🟡 | 警告 |
| activeIngredient | ⚪ | 有効成分 |
| administrationRoute | ⚪ | 投与経路 |
| recommendedIntake | ⚪ | 推奨摂取量 |
| maximumIntake | ⚪ | 最大摂取量 |
| drugClass | ⚪ | 薬剤分類 |
| prescribingInfo | ⚪ | 処方情報 |

### 金融・取引

| 用語 | レベル | 説明 |
|------|--------|------|
| accountId | 🔵 | 口座ID |
| accountName | 🔵 | 口座名 |
| accountType | 🔵 | 口座種別 |
| amount | 🔵 | 金額 |
| currency | 🔵 | 通貨 |
| transactionId | 🔵 | 取引ID |
| transactionDate | 🔵 | 取引日 |
| balance | 🔵 | 残高 |
| bankAccount | 🟡 | 銀行口座 |
| creditCard | 🟡 | クレジットカード |
| interestRate | 🟡 | 金利 |
| paymentDueDate | 🟡 | 支払期限 |
| paymentStatus | 🟡 | 支払状態 |
| minimumPayment | 🟡 | 最低支払額 |
| creditLimit | 🟡 | 与信限度額 |
| exchangeRate | 🟡 | 為替レート |
| accountMinimumInflow | ⚪ | 最低入金額 |
| accountOverdraftLimit | ⚪ | 当座貸越限度額 |
| annualPercentageRate | ⚪ | 年率 |
| beneficiaryBank | ⚪ | 受取銀行 |
| cashBack | ⚪ | キャッシュバック |
| loanType | ⚪ | ローン種別 |

### 予約・スケジュール

| 用語 | レベル | 説明 |
|------|--------|------|
| reservationId | 🔵 | 予約ID |
| reservationStatus | 🔵 | 予約状態 |
| reservationFor | 🔵 | 予約対象 |
| underName | 🔵 | 予約者名 |
| reservationDate | 🔵 | 予約日 |
| startTime | 🔵 | 開始時刻 |
| endTime | 🔵 | 終了時刻 |
| partySize | 🟡 | 人数 |
| bookingTime | 🟡 | 予約時刻 |
| bookingAgent | 🟡 | 予約代理店 |
| programMembershipUsed | 🟡 | 利用会員権 |
| modifiedTime | 🟡 | 変更時刻 |
| cancelationPolicy | 🟡 | キャンセルポリシー |
| advanceBookingRequirement | ⚪ | 事前予約要件 |
| lodgingUnitType | ⚪ | 宿泊ユニットタイプ |
| lodgingUnitDescription | ⚪ | 宿泊ユニット説明 |
| checkInTime | ⚪ | チェックイン時刻 |
| checkOutTime | ⚪ | チェックアウト時刻 |
| amenityFeature | ⚪ | 設備特徴 |

### コミュニケーション

| 用語 | レベル | 説明 |
|------|--------|------|
| sender | 🔵 | 送信者 |
| recipient | 🔵 | 受信者 |
| messageText | 🔵 | メッセージ本文 |
| subject | 🔵 | 件名 |
| dateSent | 🔵 | 送信日時 |
| dateReceived | 🔵 | 受信日時 |
| messageStatus | 🔵 | メッセージ状態 |
| messageType | 🟡 | メッセージタイプ |
| inReplyTo | 🟡 | 返信対象 |
| ccRecipient | 🟡 | CCの受信者 |
| bccRecipient | 🟡 | BCCの受信者 |
| messageAttachment | 🟡 | 添付ファイル |
| replyToUrl | 🟡 | 返信URL |
| discussionUrl | 🟡 | 討議URL |
| toRecipient | ⚪ | 宛先 |
| aboutPerson | ⚪ | 対象者 |
| aboutOrganization | ⚪ | 対象組織 |
| mentions | ⚪ | 言及 |

### セキュリティ・アクセス制御

| 用語 | レベル | 説明 |
|------|--------|------|
| accessibilityControl | 🔵 | アクセス制御 |
| permission | 🔵 | 権限 |
| permissionType | 🔵 | 権限タイプ |
| authenticator | 🔵 | 認証者 |
| securityClearance | 🔵 | セキュリティクリアランス |
| accessCode | 🟡 | アクセスコード |
| accessModeSufficient | 🟡 | 十分なアクセスモード |
| accessibilityAPI | 🟡 | アクセシビリティAPI |
| accessibilityFeature | 🟡 | アクセシビリティ機能 |
| accessibilityHazard | 🟡 | アクセシビリティ上の危険 |
| conditionsOfAccess | 🟡 | アクセス条件 |
| hasDigitalDocumentPermission | 🟡 | デジタル文書権限 |
| permissionAssertion | ⚪ | 権限アサーション |
| securityScreening | ⚪ | セキュリティスクリーニング |

### ワークフロー・プロセス

| 用語 | レベル | 説明 |
|------|--------|------|
| status | 🔵 | 状態 |
| stage | 🔵 | ステージ |
| processType | 🔵 | プロセスタイプ |
| currentStatus | 🔵 | 現在の状態 |
| action | 🔵 | アクション |
| actionStatus | 🔵 | アクション状態 |
| workflowStep | 🟡 | ワークフローステップ |
| predecessor | 🟡 | 前工程 |
| successor | 🟡 | 次工程 |
| approver | 🟡 | 承認者 |
| assignee | 🟡 | 担当者 |
| dueDate | 🟡 | 期限 |
| priority | 🟡 | 優先度 |
| escalationLevel | ⚪ | エスカレーションレベル |
| workflowTemplate | ⚪ | ワークフローテンプレート |
| decisionPoint | ⚪ | 決定ポイント |
| conditionalStep | ⚪ | 条件付きステップ |
| parallelStep | ⚪ | 並列ステップ |

### 技術・システム

| 用語 | レベル | 説明 |
|------|--------|------|
| softwareVersion | 🔵 | ソフトウェアバージョン |
| operatingSystem | 🔵 | オペレーティングシステム |
| applicationCategory | 🔵 | アプリケーションカテゴリ |
| programmingLanguage | 🔵 | プログラミング言語 |
| systemRequirements | 🔵 | システム要件 |
| softwareRequirements | 🟡 | ソフトウェア要件 |
| processorRequirements | 🟡 | プロセッサ要件 |
| memoryRequirements | 🟡 | メモリ要件 |
| storageRequirements | 🟡 | ストレージ要件 |
| installUrl | 🟡 | インストールURL |
| downloadUrl | 🟡 | ダウンロードURL |
| codeRepository | 🟡 | コードリポジトリ |
| applicationSubCategory | ⚪ | アプリケーションサブカテゴリ |
| applicationSuite | ⚪ | アプリケーションスイート |
| availableOnDevice | ⚪ | 利用可能デバイス |
| browserRequirements | ⚪ | ブラウザ要件 |

### 法務・規約

| 用語 | レベル | 説明 |
|------|--------|------|
| termsOfService | 🔵 | 利用規約 |
| privacyPolicy | 🔵 | プライバシーポリシー |
| license | 🔵 | ライセンス |
| copyright | 🔵 | 著作権 |
| legalStatus | 🔵 | 法的状態 |
| jurisdiction | 🟡 | 管轄区域 |
| legislationType | 🟡 | 法制度タイプ |
| regulations | 🟡 | 規制 |
| disclaimer | 🟡 | 免責事項 |
| compliance | 🟡 | コンプライアンス |
| legalName | 🟡 | 法人名 |
| legislationDate | ⚪ | 法制定日 |
| legislationIdentifier | ⚪ | 法制度識別子 |
| legislationPassedBy | ⚪ | 法制定者 |
| legislationResponsible | ⚪ | 法的責任者 |
| governmentBenefitsInfo | ⚪ | 政府給付情報 |

### その他の属性

| 用語 | レベル | 説明 |
|------|--------|------|
| status | 🔵 | 状態 |
| type | 🔵 | タイプ |
| category | 🔵 | カテゴリ |
| order | 🔵 | 順序 |
| priority | 🔵 | 優先度 |
| tag | 🔵 | タグ |
| group | 🔵 | グループ |
| relation | 🔵 | 関係 |
| source | 🔵 | ソース |
| target | 🔵 | ターゲット |
| origin | 🟡 | 起源 |
| destination | 🟡 | 目的地 |
| sortOrder | 🟡 | ソート順 |
| rank | 🟡 | ランク |
| score | 🟡 | スコア |
| level | 🟡 | レベル |
| theme | 🟡 | テーマ |
| style | 🟡 | スタイル |
| layout | 🟡 | レイアウト |
| template | 🟡 | テンプレート |
| format | 🟡 | フォーマット |
| mode | 🟡 | モード |
| state | 🟡 | 状態 |
| phase | 🟡 | フェーズ |
| context | 🟡 | コンテキスト |
| scope | 🟡 | スコープ |
| flags | ⚪ | フラグ |
| options | ⚪ | オプション |
| settings | ⚪ | 設定 |
| preferences | ⚪ | 環境設定 |
| configuration | ⚪ | 構成 |
| customization | ⚪ | カスタマイズ |
| variant | ⚪ | バリアント |
| alternative | ⚪ | 代替 |
| fallback | ⚪ | フォールバック |
| override | ⚪ | 上書き |
| default | ⚪ | デフォルト |
| custom | ⚪ | カスタム |
| external | ⚪ | 外部 |
| internal | ⚪ | 内部 |
| public | ⚪ | 公開 |
| private | ⚪ | 非公開 |
| hidden | ⚪ | 非表示 |
| visible | ⚪ | 表示 |
| enabled | ⚪ | 有効 |
| disabled | ⚪ | 無効 |
| locked | ⚪ | ロック済み |
| archived | ⚪ | アーカイブ済み |
| deleted | ⚪ | 削除済み |
| deprecated | ⚪ | 非推奨 |

## おわりに

このドキュメントは継続的に更新され、新しい用語や使用パターンが追加される可能性があります。

### 重要度レベル

すべての用語は、重要度と使用頻度に基づいて3段階にレベル分けされています：

- 🔵 **Core Terms**: 基本的なAPIに必須の主要用語（全体の約10-15%）
  - ほとんどのアプリケーションで使用される基礎的な語彙
  - シンプルなAPIを作る際の最初の選択肢
  - 一般的なCRUD操作に必要な用語

- 🟡 **Extended Terms**: よく使用される拡張用語（全体の約30-35%）
  - 特定のドメインやより詳細な表現に必要な語彙
  - 一般的なビジネスアプリケーションでよく使用される用語
  - より豊かな表現力が必要な場合の選択肢

- ⚪ **Full Terms**: 特殊用途の用語（全体の約50-55%）
  - 特定の業界や特殊なユースケースで必要となる語彙
  - 完全な互換性が必要な場合の選択肢
  - 非常に専門的な表現のための用語


### 使用上の注意


1. **命名規則**:
  - lowerCamelCase形式を使用
  - 略語は避け、完全な単語を使用
  - 一貫性のある命名パターンを維持

2. **カスタマイズ**:
  - 必要に応じて独自の用語を追加可能
  - 業界固有の用語は適切なプレフィックスを付けることを推奨
  - 組織内で統一した用語の使用を心がける

3. **相互運用性**:
  - Schema.orgとの互換性を意識
  - 標準的な用語を優先的に使用
  - 独自拡張する場合は明確な文書化を行う

### 参考リソース

- [Schema.org](https://schema.org)
- [IANA Link Relations](https://www.iana.org/assignments/link-relations/link-relations.xhtml)
- [ALPS Specification](http://alps.io/spec/)
