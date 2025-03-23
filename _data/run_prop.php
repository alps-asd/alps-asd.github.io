<?php

// 設定
$inputFile = 'schema_properties.csv';           // 入力ファイル
$outputFile = 'schema_properties_ja.csv';     // 出力ファイル
$logFile = 'schema_properties_translation_log.txt';   // ログファイル
$progressFile = 'schema_properties_progress.json';    // 進捗状況ファイル
$sourceLanguage = 'en';             // 翻訳元言語（英語）
$targetLanguage = 'ja';             // 翻訳先言語（日本語）
$ollamaEndpoint = 'http://localhost:11434/api/generate'; // Ollama APIエンドポイント
$ollamaModel = 'gemma3:27b';            // 使用するモデル
$maxApiRetries = 3;                 // APIリクエストの最大リトライ回数

require __DIR__ . '/translator.php';
