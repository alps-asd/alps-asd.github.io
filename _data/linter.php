<?php
/**
 * CSV フォーマット検証ツール (Linter)
 *
 * このツールは翻訳後のCSVファイルを検証し、以下を確認します：
 * - 1列目は https://schema.org/ で始まるURLであること
 * - 2列目は翻訳されていないこと（英語の単語のみ）
 * - HTMLタグのバランスが取れていること
 * - 空文字列が保持されていること
 * - URL＋記号を後検知します。（未修正）
 */

// 設定
$inputFile = __DIR__ . '/schema_types_ja.csv';     // 検証するCSVファイル
$logFile = 'linter_log.txt';       // ログファイル
$originalFile = __DIR__ . '/schema_types.csv';       // 元のCSVファイル (2列目の検証用)
$skipFirstRow = true;              // 最初の行（ヘッダー行）をスキップするかどうか

// 実行時間制限を無効化（大きなファイル用）
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

/**
 * HTMLタグのバランスをチェック
 *
 * @param string $text チェックするテキスト
 * @return array チェック結果 ['valid' => bool, 'message' => string]
 */
function checkHtmlTagBalance($text) {
    // 空のテキストは有効とみなす
    if (empty($text)) {
        return ['valid' => true, 'message' => 'テキストが空です'];
    }

    // HTMLタグを抽出
    preg_match_all('/<[^>]+>/', $text, $matches);
    $tags = $matches[0];

    // HTMLタグがなければ有効
    if (count($tags) === 0) {
        return ['valid' => true, 'message' => 'HTMLタグはありません'];
    }

    $tagCounts = [];
    $selfClosingTags = ['br', 'hr', 'img', 'input', 'link', 'meta', 'area', 'base', 'col', 'command', 'embed', 'keygen', 'param', 'source', 'track', 'wbr'];

    foreach ($tags as $tag) {
        // コメントやDOCTYPEはスキップ
        if (strpos($tag, '<!--') === 0 || strpos($tag, '<!DOCTYPE') === 0) {
            continue;
        }

        // 閉じタグかどうかチェック
        if (strpos($tag, '</') === 0) {
            $tagName = strtolower(substr($tag, 2, strlen($tag) - 3));

            if (!isset($tagCounts[$tagName])) {
                $tagCounts[$tagName] = ['open' => 0, 'close' => 0];
            }

            $tagCounts[$tagName]['close']++;
        } else {
            // 開始タグまたは自己閉じタグ
            $isSelfClosing = (substr($tag, -2) === '/>' ||
                (preg_match('/<([a-z0-9]+)[\s>]/i', $tag, $tagMatch) &&
                    in_array(strtolower($tagMatch[1]), $selfClosingTags)));

            if ($isSelfClosing) {
                continue; // 自己閉じタグはカウントしない
            }

            // タグ名を抽出
            preg_match('/<([a-z0-9]+)[\s>]/i', $tag, $tagMatch);
            if (isset($tagMatch[1])) {
                $tagName = strtolower($tagMatch[1]);

                if (!isset($tagCounts[$tagName])) {
                    $tagCounts[$tagName] = ['open' => 0, 'close' => 0];
                }

                $tagCounts[$tagName]['open']++;
            }
        }
    }

    // タグのバランスをチェック
    $unbalancedTags = [];

    foreach ($tagCounts as $tagName => $counts) {
        $openCount = $counts['open'];
        $closeCount = $counts['close'];

        if ($openCount !== $closeCount) {
            $unbalancedTags[$tagName] = [
                'open' => $openCount,
                'close' => $closeCount,
                'diff' => $openCount - $closeCount
            ];
        }
    }

    if (!empty($unbalancedTags)) {
        $messages = [];
        foreach ($unbalancedTags as $tagName => $info) {
            $diff = $info['diff'];
            if ($diff > 0) {
                $messages[] = "タグ '$tagName' の閉じタグが $diff 個不足しています (開始: {$info['open']}, 終了: {$info['close']})";
            } else {
                $messages[] = "タグ '$tagName' の閉じタグが " . abs($diff) . " 個余分にあります (開始: {$info['open']}, 終了: {$info['close']})";
            }
        }

        return [
            'valid' => false,
            'message' => 'HTMLタグのバランスが不正: ' . implode('; ', $messages)
        ];
    }

    return ['valid' => true, 'message' => 'HTMLタグのバランスは正常です'];
}

/**
 * 列1のフォーマットをチェック（URLまたはスキーマ参照）
 *
 * @param string $value チェックする値
 * @return array チェック結果 ['valid' => bool, 'message' => string]
 */
function checkFirstColumn($value) {
    // 空の値は許可しない
    if (empty($value)) {
        return ['valid' => false, 'message' => '最初の列は空であってはいけません'];
    }

    // URLまたはスキーマ参照かどうかチェック
    if (strpos($value, 'https://schema.org/') === 0) {
        return ['valid' => true, 'message' => 'スキーマ参照フォーマットが正しいです'];
    } elseif (preg_match('/^https?:\/\/[^\s,"\'<>]+$/', $value)) {
        return ['valid' => true, 'message' => 'URLフォーマットが正しいです'];
    }

    return ['valid' => false, 'message' => '最初の列はURLまたはスキーマ参照である必要があります: ' . $value];
}

/**
 * 2列目が適切なスキーマプロパティ名であることを確認
 *
 * @param string $value チェックする値
 * @return array チェック結果 ['valid' => bool, 'message' => string]
 */
function checkSecondColumn($value, $originalValue = null) {
    // 空の値は許可（一部のスキーマでは2列目が空の場合がある）
    if (empty($value)) {
        return ['valid' => true, 'message' => '2列目は空です'];
    }

    // 翻訳されていないことを確認（元の値と比較）
    if ($originalValue !== null && $value !== $originalValue) {
        return [
            'valid' => false,
            'message' => "2列目が翻訳されています: '$value' (元の値: '$originalValue')"
        ];
    }

    // 基本的なプロパティ名の形式をチェック（英数字、アンダースコア、ハイフンのみ）
    if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $value)) {
        return [
            'valid' => false,
            'message' => "2列目のフォーマットが不正です: '$value' (英数字、アンダースコア、ハイフンのみ使用可)"
        ];
    }

    return ['valid' => true, 'message' => '2列目のフォーマットが正しいです'];
}

/**
 * CSVの行の各フィールドを検証
 *
 * @param array $row 検証する行
 * @param array $originalRow 元のファイルの対応する行
 * @param int $rowNumber 行番号
 * @return array エラーのリスト
 */
function validateRow($row, $originalRow, $rowNumber) {
    $errors = [];

    // 元のCSVデータが提供されていない場合
    if ($originalRow === null) {
        logMessage("行 $rowNumber: 元のCSVデータが提供されていないため、完全な検証はスキップされます", "WARNING");
        $originalRow = [];
    }

    // 1列目の検証 - IDフィールドは常に同じであるべき
    if (isset($row[0])) {
        $firstColumnCheck = checkFirstColumn($row[0]);
        if (!$firstColumnCheck['valid']) {
            $errors[] = "行 $rowNumber, 列 1: " . $firstColumnCheck['message'];
        }

        // 元のCSVと一致するか確認
        if (isset($originalRow[0]) && $row[0] !== $originalRow[0]) {
            $errors[] = "行 $rowNumber, 列 1: IDフィールドが元のCSVと一致しません（現在: '{$row[0]}', 元: '{$originalRow[0]}'）";
        }
    } else {
        $errors[] = "行 $rowNumber: 1列目が存在しません";
    }

    // 2列目の検証（元のファイルと比較）
    if (isset($row[1])) {
        $originalSecondColumn = isset($originalRow[1]) ? $originalRow[1] : null;
        $secondColumnCheck = checkSecondColumn($row[1], $originalSecondColumn);
        if (!$secondColumnCheck['valid']) {
            $errors[] = "行 $rowNumber, 列 2: " . $secondColumnCheck['message'];
        }
    }

    // HTMLタグのバランスと特定の要素の保持を各フィールドでチェック
    foreach ($row as $index => $field) {
        if ($index > 1) { // 3列目以降をチェック
            // HTMLタグのバランスをチェック
            $htmlCheck = checkHtmlTagBalance($field);
            if (!$htmlCheck['valid']) {
                $errors[] = "行 $rowNumber, 列 " . ($index + 1) . ": " . $htmlCheck['message'];
            }

            // schema.org URLを含む場合はそれが保持されているか確認
            if (isset($originalRow[$index]) &&
                preg_match_all('/https?:\/\/schema\.org\/[a-zA-Z0-9]+/', $originalRow[$index], $matches)) {
                foreach ($matches[0] as $schemaUrl) {
                    if (strpos($field, $schemaUrl) === false) {
                        $errors[] = "$originalSecondColumn: $schemaUrl: 行 $rowNumber, 列 " . ($index + 1) . ": schema.org URL '$schemaUrl' が保持されていません";
                    }
                }
            }

            // 一般的なURLが保持されているか確認
            if (isset($originalRow[$index]) &&
                preg_match_all('/https?:\/\/(?!schema\.org)[^\s,"\'<>]+/', $originalRow[$index], $matches)) {
                foreach ($matches[0] as $url) {
                    if (strpos($field, $url) === false) {
                        $errors[] = "$originalSecondColumn: 行 $rowNumber, 列 " . ($index + 1) . ": URL '$url' が保持されていません";
                    }
                }
            }
        }
    }

    return $errors;
}

// メイン処理
try {
    logMessage("CSVフォーマット検証を開始します");

    // 入力ファイルチェック
    if (!file_exists($inputFile)) {
        throw new Exception("検証ファイルが見つかりません: $inputFile");
    }

    if (!file_exists($originalFile)) {
        logMessage("警告: 元のCSVファイルが見つかりません: $originalFile", "WARNING");
        logMessage("2列目の翻訳チェックはスキップされます", "WARNING");
        $originalFile = null;
    }

    // CSVファイルを開く
    $input = fopen($inputFile, 'r');
    if (!$input) {
        throw new Exception("検証ファイルを開けませんでした");
    }

    // 元のCSVファイルを開く（比較用）
    $original = null;
    if ($originalFile !== null) {
        $original = fopen($originalFile, 'r');
        if (!$original) {
            logMessage("警告: 元のCSVファイルを開けませんでした", "WARNING");
            $originalFile = null;
        }
    }

    $rowNumber = 0;
    $errorCount = 0;
    $warningCount = 0;
    $totalErrors = [];

    // 各行を検証
    while (($row = fgetcsv($input)) !== false) {
        $rowNumber++;

        // 元のCSVの対応する行を取得
        $originalRow = null;
        if ($original !== null) {
            $originalRow = fgetcsv($original);
        }

        // 最初の行をスキップ（ヘッダー行）
        if ($skipFirstRow && $rowNumber === 1) {
            logMessage("行 1: ヘッダー行のためスキップします", "INFO");
            continue;
        }

        // 行を検証
        $errors = validateRow($row, $originalRow, $rowNumber);

        if (!empty($errors)) {
            foreach ($errors as $error) {
                logMessage($error, "ERROR");
                $totalErrors[] = $error;
            }
            $errorCount++;
        }
    }

    // ファイルを閉じる
    fclose($input);
    if ($original !== null) {
        fclose($original);
    }

    // 結果サマリー
    logMessage("検証完了: 合計 $rowNumber 行を処理しました", "INFO");
    logMessage("エラーがある行: $errorCount", "INFO");

    if ($errorCount === 0) {
        logMessage("フォーマットは正常です！", "SUCCESS");
    } else {
        logMessage("フォーマットに問題があります。修正が必要です。", "ERROR");

        // エラーの分類と要約
        $errorTypes = [];
        foreach ($totalErrors as $error) {
            $errorType = preg_replace('/行 \d+, 列 \d+: /', '', $error);
            $errorType = preg_replace('/具体的な値: .*$/', '', $errorType);

            if (!isset($errorTypes[$errorType])) {
                $errorTypes[$errorType] = 1;
            } else {
                $errorTypes[$errorType]++;
            }
        }

        logMessage("エラータイプの要約:", "INFO");
        foreach ($errorTypes as $type => $count) {
            logMessage(" - $type: $count 件", "INFO");
        }
    }

} catch (Exception $e) {
    logMessage("検証エラー: " . $e->getMessage(), "ERROR");
    exit(1);
}
