<?php
/**
 * HTMLタグ保持機能強化版 翻訳スクリプト
 *
 * - HTMLタグを完全に分離して保護
 * - 翻訳前後のプレースホルダーマッピング
 * - 高精度なHTMLタグ復元
 * - HTMLタグの整合性チェック機能
 * - 空文字列("")の保持
 * - 最初のカラム(ID)の翻訳スキップ
 */



// 実行時間制限を無効化（長時間の処理に対応）
set_time_limit(0);

// ログ記録関数
function logMessage($message, $level = 'INFO') {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] [$level] $message\n";

    // ログファイルに追記
    file_put_contents($logFile, $logMessage, FILE_APPEND);

    // コンソールにも出力
    echo "$message\n";
}

// 進捗状態の読み込み
function loadProgress() {
    global $progressFile;

    $progress = [
        'current_row' => 0,
        'processed_rows' => []
    ];

    if (file_exists($progressFile)) {
        $data = json_decode(file_get_contents($progressFile), true);
        if ($data && isset($data['current_row'])) {
            $progress = $data;
        }
    }

    return $progress;
}

// 進捗状態の保存
function saveProgress($progress) {
    global $progressFile;

    $data = $progress;
    $data['last_update'] = date('Y-m-d H:i:s');

    // 一時ファイルに書き込んでから名前を変更（書き込み中の中断対策）
    $tempFile = $progressFile . '.tmp';
    file_put_contents($tempFile, json_encode($data, JSON_PRETTY_PRINT));

    if (file_exists($tempFile)) {
        if (file_exists($progressFile)) {
            unlink($progressFile);
        }
        rename($tempFile, $progressFile);
    }
}

/**
 * HTMLタグと保持すべき要素をプレースホルダーに置き換え
 *
 * @param string $text 処理するテキスト
 * @return array プレースホルダー置換後のテキストとマッピング情報
 */
function replaceElementsWithPlaceholders($text) {
    $result = [
        'processed_text' => $text,
        'mappings' => []
    ];

    // ランダムな一意的なプレフィックスを生成（プレースホルダーの衝突防止）
    $prefix = 'PH' . substr(md5(uniqid(rand(), true)), 0, 6) . '_';

    // リストアイテム全体を保護（<li>タグから</li>までを含む）
    $listItemPattern = '/<li>.*?<\/li>/is';
    preg_match_all($listItemPattern, $result['processed_text'], $matches);
    $counter = 0;

    foreach ($matches[0] as $match) {
        $placeholder = "{$prefix}LIST_ITEM_" . $counter . "_END";
        $result['mappings'][$placeholder] = [
            'original' => $match,
            'type' => 'list_item'
        ];

        // テキスト内の要素をプレースホルダーに置き換え
        $result['processed_text'] = preg_replace('/' . preg_quote($match, '/') . '/', $placeholder, $result['processed_text'], 1);
        $counter++;
    }

    // 保護すべき要素の順序付きパターンリスト（優先順位順）
    $patterns = [
        // 1. 相対パスを持つaタグ全体（内部テキストを含む）を保護
        'REL_LINK' => '/<a[^>]*?href="\/[^"]*?"[^>]*?>.*?<\/a>/is',

        // 2. URLを保護（先にURLを保護しないとHTMLタグの中のURLが失われる可能性がある）
        'URL' => '/https?:\/\/[^\s,"\'<>]+/',

        // 3. schema.org参照を保護
        'SCHEMA' => '/schema\.org\/[a-zA-Z0-9]+/',

        // 4. 通常のHTMLタグを保護
        'HTML' => '/<[^>]+>/'
    ];

    // 各パターンに対して処理
    foreach ($patterns as $type => $pattern) {
        preg_match_all($pattern, $result['processed_text'], $matches);
        $typeCounter = 0;

        foreach ($matches[0] as $match) {
            $placeholder = "{$prefix}{$type}_" . $typeCounter . "_END";
            $result['mappings'][$placeholder] = [
                'original' => $match,
                'type' => strtolower($type)
            ];

            // テキスト内の要素をプレースホルダーに置き換え（最初の出現のみ）
            $result['processed_text'] = preg_replace('/' . preg_quote($match, '/') . '/', $placeholder, $result['processed_text'], 1);

            $typeCounter++;
        }
    }

    return $result;
}

/**
 * プレースホルダーを元の要素に戻す
 *
 * @param string $text プレースホルダーを含むテキスト
 * @param array $mappings プレースホルダーと元の要素のマッピング
 * @return string 元の要素に戻したテキスト
 */
function restorePlaceholders($text, $mappings) {
    $result = $text;

    // 残っている特殊なプレースホルダーパターンを検出
    preg_match_all('/PH[a-f0-9]{6}_[A-Z_]+_\d+_END/', $result, $matches);

    if (!empty($matches[0])) {
        foreach ($matches[0] as $match) {
            if (isset($mappings[$match])) {
                $result = str_replace($match, $mappings[$match]['original'], $result);
            } else {
                logMessage("警告: 未知のプレースホルダー '$match' が見つかりました", "WARNING");
            }
        }
    }

    // 残っているプレースホルダーをチェック
    $remainingPlaceholders = false;
    foreach ($mappings as $placeholder => $info) {
        if (strpos($result, $placeholder) !== false) {
            logMessage("警告: プレースホルダー '$placeholder' がまだ残っています", "WARNING");
            // 残っているプレースホルダーを強制的に置換
            $result = str_replace($placeholder, $info['original'], $result);
            $remainingPlaceholders = true;
        }
    }

    if ($remainingPlaceholders) {
        logMessage("すべてのプレースホルダーを強制的に元の値に置き換えました", "INFO");
    }

    return $result;
}

/**
 * HTMLタグのバランスをチェックし修正する
 *
 * @param string $text チェックするテキスト
 * @return string 修正されたテキスト
 */
function validateHtmlTags($text) {
    // 開始タグと終了タグのカウントを追跡
    $tagCounts = [];
    $selfClosingTags = ['br', 'hr', 'img', 'input', 'link', 'meta', 'area', 'base', 'col', 'command', 'embed', 'keygen', 'param', 'source', 'track', 'wbr'];

    // HTMLタグを抽出
    preg_match_all('/<[^>]+>/', $text, $matches, PREG_OFFSET_CAPTURE);
    $tags = $matches[0];

    // 各タグの情報を収集
    $tagInfo = [];
    $result = $text;
    $offset = 0; // 削除によるオフセット

    // 最初にタグのカウントを集計
    foreach ($tags as $tag) {
        $tagText = $tag[0];
        $position = $tag[1];

        // コメントやDOCTYPEはスキップ
        if (strpos($tagText, '<!--') === 0 || strpos($tagText, '<!DOCTYPE') === 0) {
            continue;
        }

        // 閉じタグかどうかチェック
        if (strpos($tagText, '</') === 0) {
            $tagName = strtolower(substr($tagText, 2, strlen($tagText) - 3));

            if (!isset($tagCounts[$tagName])) {
                $tagCounts[$tagName] = ['open' => 0, 'close' => 0];
            }

            $tagCounts[$tagName]['close']++;
            $tagInfo[] = [
                'type' => 'close',
                'name' => $tagName,
                'text' => $tagText,
                'position' => $position
            ];
        } else {
            // 開始タグまたは自己閉じタグ
            $isSelfClosing = (substr($tagText, -2) === '/>' ||
                (preg_match('/<([a-z0-9]+)[\s>]/i', $tagText, $tagMatch) &&
                    in_array(strtolower($tagMatch[1]), $selfClosingTags)));

            if ($isSelfClosing) {
                continue; // 自己閉じタグはカウントしない
            }

            // タグ名を抽出
            preg_match('/<([a-z0-9]+)[\s>]/i', $tagText, $tagMatch);
            if (isset($tagMatch[1])) {
                $tagName = strtolower($tagMatch[1]);

                if (!isset($tagCounts[$tagName])) {
                    $tagCounts[$tagName] = ['open' => 0, 'close' => 0];
                }

                $tagCounts[$tagName]['open']++;
                $tagInfo[] = [
                    'type' => 'open',
                    'name' => $tagName,
                    'text' => $tagText,
                    'position' => $position
                ];
            }
        }
    }

    // タグのバランスをチェック
    $tagsToRemove = [];
    $tagsToAdd = [];

    foreach ($tagCounts as $tagName => $counts) {
        $openCount = $counts['open'];
        $closeCount = $counts['close'];

        if ($openCount > $closeCount) {
            // 閉じタグが不足している場合
            $diff = $openCount - $closeCount;
            logMessage("警告: タグ '$tagName' の閉じタグが $diff 個不足しています", "WARNING");

            // 不足している閉じタグを追加
            for ($i = 0; $i < $diff; $i++) {
                $tagsToAdd[] = "</$tagName>";
            }
        } else if ($closeCount > $openCount) {
            // 余分な閉じタグがある場合
            $diff = $closeCount - $openCount;
            logMessage("警告: タグ '$tagName' の閉じタグが $diff 個余分にあります", "WARNING");

            // 余分な閉じタグを特定して削除マークする
            $extraCloseTags = 0;
            for ($i = count($tagInfo) - 1; $i >= 0; $i--) {
                $info = $tagInfo[$i];
                if ($info['type'] === 'close' && $info['name'] === $tagName) {
                    if ($extraCloseTags < $diff) {
                        $tagsToRemove[] = $info;
                        $extraCloseTags++;
                    }

                    if ($extraCloseTags >= $diff) {
                        break;
                    }
                }
            }
        }
    }

    // 余分なタグを削除
    if (!empty($tagsToRemove)) {
        // 位置の降順でソート（後ろから削除するため）
        usort($tagsToRemove, function($a, $b) {
            return $b['position'] - $a['position'];
        });

        foreach ($tagsToRemove as $tag) {
            $pos = $tag['position'] - $offset;
            $len = strlen($tag['text']);

            // タグを削除
            $result = substr($result, 0, $pos) . substr($result, $pos + $len);
            $offset += $len;

            logMessage("修正: 余分なタグ '" . $tag['text'] . "' を削除しました", "INFO");
        }
    }

    // 不足しているタグを追加
    if (!empty($tagsToAdd)) {
        // タグを適切な順序で追加する必要がある
        // 例えば、<div><span>...</span></div> のような入れ子構造を考慮

        // とりあえず最後に追加
        $result .= implode('', $tagsToAdd);

        foreach ($tagsToAdd as $tag) {
            logMessage("修正: 不足しているタグ '$tag' を追加しました", "INFO");
        }
    }

    return $result;
}

// 翻訳APIを呼び出す（リトライ機能付き）
function callTranslationAPI($text, $sourceLanguage, $targetLanguage, $endpoint, $model) {
    global $maxApiRetries;
    $retryDelay = 1; // 秒

    for ($attempt = 1; $attempt <= $maxApiRetries; $attempt++) {
        // APIリクエストを準備
        $data = [
            'model' => $model,
            'prompt' => $text,
            'stream' => false,
            'temperature' => 0.1
        ];

        // デバッグ情報を記録（オプション）
        if ($attempt > 1) {
            logMessage("APIリクエスト試行 $attempt/$maxApiRetries", "DEBUG");
        }

        // APIリクエストを実行
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if (!$error && $status === 200) {
            // 成功
            $responseData = json_decode($response, true);
            if (isset($responseData['response'])) {
                return $responseData['response'];
            }
        }

        // エラー情報を記録
        if ($attempt < $maxApiRetries) {
            logMessage("APIエラー (試行 $attempt): $error, ステータス: $status - 再試行します", "WARNING");
            // 次の試行まで待機
            sleep($retryDelay);
            // 待機時間を増やす（指数バックオフ）
            $retryDelay *= 2;
        } else {
            logMessage("APIエラー: $error, ステータス: $status - 再試行回数上限に達しました", "ERROR");
        }
    }

    throw new Exception("APIエラー: 最大再試行回数に達しました");
}

/**
 * テキストを翻訳（HTMLタグなどを保護）
 *
 * @param string $text 翻訳するテキスト
 * @param int $rowNumber 行番号（ログ用）
 * @param int $fieldIndex フィールドインデックス（ログ用）
 * @return string 翻訳されたテキスト
 */
function translateText($text, $rowNumber, $fieldIndex) {
    global $sourceLanguage, $targetLanguage, $ollamaEndpoint, $ollamaModel;

    if (empty(trim($text))) {
        return $text;
    }

    try {
        // HTMLタグなどをプレースホルダーに置き換え
        $replacementResult = replaceElementsWithPlaceholders($text);
        $textWithPlaceholders = $replacementResult['processed_text'];
        $mappings = $replacementResult['mappings'];

        // プレースホルダーについての情報をログ出力
        $placeholderCount = count($mappings);
        if ($placeholderCount > 0) {
            logMessage("行 $rowNumber, フィールド $fieldIndex: $placeholderCount 個の要素を保護します", "INFO");
        }

        // 翻訳プロンプトを作成
        $prompt = <<<EOT
英語から日本語に翻訳してください。HTMLタグやURLはプレースホルダーで保護されています。

重要な指示:
1. プレースホルダー（[[html_tags_0]]、[[urls_0]]などの形式）はそのまま保持してください。
2. 「翻訳結果:」などの前置きは含めないでください。
3. 翻訳文のみを返してください。
4. すべてのプレースホルダー（[[...]])を必ず保持してください。
5. 翻訳の前後にプレースホルダーが変更されないようにしてください。

翻訳するテキスト:
$textWithPlaceholders

翻訳:
EOT;

        // 翻訳APIを呼び出し
        $translatedWithPlaceholders = callTranslationAPI($prompt, $sourceLanguage, $targetLanguage, $ollamaEndpoint, $ollamaModel);

        // 余分なテキストを削除
        $unwantedPatterns = [
            '/^Translation:\s*/i',
            '/^Here\'s the translation:\s*/i',
            '/^Translated text:\s*/i',
            '/^Translation result:\s*/i',
            '/^The translation is:\s*/i',
            '/^翻訳結果:\s*/i',
            '/^翻訳:\s*/i',
            '/^\s*"\s*|\s*"\s*$/', // 前後の引用符を削除
            '/^\s*\'|\'\s*$/'      // 前後の引用符を削除
        ];

        foreach ($unwantedPatterns as $pattern) {
            $translatedWithPlaceholders = preg_replace($pattern, '', $translatedWithPlaceholders);
        }

        // プレースホルダーを元の要素に戻す
        $translatedText = restorePlaceholders(trim($translatedWithPlaceholders), $mappings);

        // プレースホルダーが正しく戻されたかチェック
        $allRestored = true;
        foreach ($mappings as $placeholder => $info) {
            if (strpos($translatedText, $placeholder) !== false) {
                $allRestored = false;
                logMessage("警告: プレースホルダー '$placeholder' が元の要素に戻されていません", "WARNING");
            }
        }

        if (!$allRestored) {
            // プレースホルダーが残っている場合は、強制的に置き換え
            $translatedText = restorePlaceholders($translatedWithPlaceholders, $mappings);
            logMessage("プレースホルダーを強制的に元の要素に戻しました", "WARNING");
        }

        // HTMLタグの整合性チェックと修正
        $translatedText = validateHtmlTags($translatedText);

        return $translatedText;

    } catch (Exception $e) {
        logMessage("翻訳エラー: " . $e->getMessage(), "ERROR");
        return $text; // エラー時は原文を返す
    }
}

/**
 * フィールドを翻訳
 *
 * @param string $field 翻訳するフィールド
 * @param int $rowNumber 行番号
 * @param int $fieldIndex フィールドインデックス
 * @return string 翻訳されたフィールド
 */
function translateField($field, $rowNumber, $fieldIndex) {
    // 3列目（インデックス2）のみを翻訳
    if ($fieldIndex !== 2) {
        return $field;  // 3列目以外はそのまま返す
    }

    // 空のフィールドは翻訳しない
    if (empty($field)) {
        return $field;
    }

    // URLだけのフィールドは翻訳しない
    if (preg_match('/^https?:\/\/[^\s]+$/', $field)) {
        return $field;
    }

    // フィールド内にURLが含まれるかチェック
    $containsUrl = preg_match('/https?:\/\/[^\s,"\'<>]+/', $field);
    $containsHtml = preg_match('/<[^>]+>/', $field);

    // URL付きのフィールドは特別な注意が必要
    if ($containsUrl || $containsHtml) {
        logMessage("行 $rowNumber, フィールド $fieldIndex: URLまたはHTMLタグを含んでいます", "INFO");
    }

    // 翻訳を実行
    $translatedField = translateText($field, $rowNumber, $fieldIndex);

    // 最終的なプレースホルダーチェック（念のため）
    if (preg_match('/__(?:HTML|URL|SCHEMA)_\d+__/', $translatedField)) {
        logMessage("情報: 未変換のプレースホルダーを修正します", "INFO");
        $translatedField = preg_replace('/__(?:HTML|URL|SCHEMA)_\d+__/', '', $translatedField);
    }

    // 古い形式のプレースホルダーも念のためチェック
    if (preg_match('/\[\[([a-z_]+)_(\d+)\]\]/', $translatedField)) {
        logMessage("情報: 誤った形式のプレースホルダーを修正します", "INFO");
        $translatedField = preg_replace('/\[\[([a-z_]+)_(\d+)\]\]/', '', $translatedField);
    }

    // 翻訳結果が原文と同じでなければ成功とみなす
    if ($translatedField !== $field && !empty($field)) {
        logMessage("行 $rowNumber, フィールド $fieldIndex: 正常に翻訳されました", "INFO");
    }

    return $translatedField;
}

// メイン処理
try {
    // 進捗状態を読み込む
    $progress = loadProgress();
    $startRow = $progress['current_row'];

    logMessage("翻訳処理を開始します。開始行: $startRow");
    logMessage("言語設定: $sourceLanguage → $targetLanguage");
    logMessage("HTMLタグ保持機能強化版を使用します");

    // 入力ファイルチェック
    if (!file_exists($inputFile)) {
        throw new Exception("入力ファイルが見つかりません: $inputFile");
    }

    // 入力ファイルを開く
    $input = fopen($inputFile, 'r');
    if (!$input) {
        throw new Exception("入力ファイルを開けませんでした");
    }

    // 出力ファイルの準備
    $tempOutputFile = $outputFile . '.temp';

    if ($startRow > 0 && file_exists($outputFile)) {
        // 既存の出力ファイルを継続利用
        copy($outputFile, $tempOutputFile);
        $output = fopen($tempOutputFile, 'a');
    } else {
        // 新規作成
        $output = fopen($tempOutputFile, 'w');
    }

    if (!$output) {
        fclose($input);
        throw new Exception("出力ファイルを開けませんでした");
    }

    // 開始行までスキップ
    $currentRow = 0;
    while ($currentRow < $startRow && ($row = fgetcsv($input)) !== false) {
        $currentRow++;
    }

    $successCount = 0;
    $errorCount = 0;

    // 行の処理
    while (($row = fgetcsv($input)) !== false) {
        $currentRow++;

        // 既に処理済みの行はスキップ
        if (in_array($currentRow, $progress['processed_rows'])) {
            logMessage("行 $currentRow: すでに処理済みのためスキップします");
            continue;
        }

        // 行のIDを取得 (最初の列)
        $rowId = isset($row[0]) ? $row[0] : "不明";
        logMessage("行 $currentRow を処理中... ID: $rowId");

        $translatedRow = [];
        $rowSuccess = true;

        // 各フィールドの処理
        foreach ($row as $index => $field) {
            try {
                // 空の引用符文字列を保持
                if ($field === "") {
                    $translatedRow[] = "";
                    continue;
                }

                $translatedField = translateField($field, $currentRow, $index);
                $translatedRow[] = $translatedField;
            } catch (Exception $e) {
                $rowSuccess = false;
                $translatedRow[] = $field; // エラー時は原文を使用
                logMessage("行 $currentRow, フィールド $index: エラー: " . $e->getMessage(), "ERROR");
            }
        }

        // 翻訳した行を書き込む
        @fputcsv($output, $translatedRow);

        // 進捗を更新
        $progress['current_row'] = $currentRow;
        if (!in_array($currentRow, $progress['processed_rows'])) {
            $progress['processed_rows'][] = $currentRow;
        }
        saveProgress($progress);

        if ($rowSuccess) {
            $successCount++;
        } else {
            $errorCount++;
        }

        // APIに負荷をかけないように遅延
//        usleep(500000); // 0.5秒
    }

    // ファイルを閉じる
    fclose($input);
    fclose($output);

    // 一時ファイルを最終ファイルにリネーム
    if (file_exists($tempOutputFile)) {
        if (file_exists($outputFile)) {
            unlink($outputFile);
        }
        rename($tempOutputFile, $outputFile);
    }

    // 完了メッセージ
    logMessage("翻訳完了");
    logMessage("処理された行の合計: " . ($currentRow - $startRow));
    logMessage("正常に翻訳された行: $successCount");
    logMessage("エラーのある行: $errorCount");

} catch (Exception $e) {
    logMessage("致命的なエラー: " . $e->getMessage(), "ERROR");
    exit(1);
}
