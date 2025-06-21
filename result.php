<?php
// result.php

// 回答データのファイルパス
$file_path = 'survey_responses.txt';
$parsed_responses = []; // 解析された回答データを格納する配列

// ファイルが存在する場合のみ処理を実行
if (file_exists($file_path)) {
    $file_content = file_get_contents($file_path);

    // 回答エントリの区切り文字でファイル内容を分割
    $raw_entries = explode('======================================', $file_content);

    // 各項目をテーブルのヘッダーとして表示するためのマップ
    // ファイル内のキーのプレフィックスと、テーブルに表示するヘッダー名を定義
    $field_map = [
        '回答日時' => '回答日時', // 回答日時 (特殊処理)
        'お子様の名前: ' => '名前',
        'お子様のクラス: ' => 'クラス',
        '運動会全体の満足度: ' => '全体満足度',
        '種目の内容: ' => '種目',
        'プログラムの構成: ' => '構成',
        '事前のお知らせ: ' => '事前通知',
        '会場設営（安全性、見やすさなど）: ' => '会場設営',
        '職員の対応: ' => '職員対応',
        'お子様の楽しんでいる様子: ' => '楽しさ',
        '保護者の方の参加状況: ' => '参加状況',
        'その他項目: ' => 'その他評価',
        '特に良かった点:' => '良い点',       // 複数行テキストフィールド
        '改善してほしい点・要望:' => '改善点', // 複数行テキストフィールド
        'その他コメント:' => 'その他コメント' // 複数行テキストフィールド
    ];

    // 複数行テキストフィールドのキーワードリスト
    $multiline_field_prefixes = [
        '特に良かった点:',
        '改善してほしい点・要望:',
        'その他コメント:'
    ];

    foreach ($raw_entries as $entry_block) {
        $entry_block = trim($entry_block);
        if (empty($entry_block)) {
            continue; // 空のエントリはスキップ
        }

        $current_response = [];
        // 全てのフィールドを初期化 (テーブルの列を揃えるため)
        foreach ($field_map as $key_prefix => $display_name) {
            $current_response[$display_name] = '';
        }

        $lines = explode("\n", $entry_block);
        $current_multiline_field_key = '';
        $in_multiline_mode = false;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // 回答日時を解析
            if (strpos($line, '----- 回答日時: ') === 0) {
                $current_response['回答日時'] = substr($line, strlen('----- 回答日時: '), 19);
                $in_multiline_mode = false;
                continue;
            }

            // 単一行フィールドを解析
            $matched_single_line = false;
            foreach ($field_map as $key_prefix => $display_name) {
                // キープレフィックスが ': ' を含む場合、単一行の "Key: Value" 形式と判断
                if (strpos($key_prefix, ': ') !== false && strpos($line, $key_prefix) === 0) {
                    $current_response[$display_name] = substr($line, strlen($key_prefix));
                    $in_multiline_mode = false; // 複数行モードを終了
                    $matched_single_line = true;
                    break;
                }
            }
            if ($matched_single_line) {
                continue; // 次の行へ
            }

            // 複数行フィールドの開始を検出
            foreach ($multiline_field_prefixes as $prefix) {
                if (strpos($line, $prefix) === 0) {
                    $current_multiline_field_key = $field_map[$prefix]; // テーブルヘッダーのキーを設定
                    $current_response[$current_multiline_field_key] = ''; // コンテンツを初期化
                    $in_multiline_mode = true; // 複数行モードを開始
                    continue 2; // この行はヘッダーなので、次の行からコンテンツを読み取るために次の行へスキップ
                }
            }

            // 複数行モード中の場合、現在のフィールドに内容を追加
            if ($in_multiline_mode && $current_multiline_field_key !== '') {
                // 次のセクション開始を示すデリミタで複数行モードを終了
                if (strpos($line, '--- ') === 0 || strpos($line, '======================================') === 0) {
                    $in_multiline_mode = false;
                    $current_multiline_field_key = '';
                    continue;
                }
                // 改行を追加してコンテンツを連結
                $current_response[$current_multiline_field_key] .= ($current_response[$current_multiline_field_key] ? "\n" : '') . $line;
            }
        }
        $parsed_responses[] = $current_response;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>運動会アンケート 回答結果</title>
    <link rel="stylesheet" href="result_style.css"> <!-- 結果表示用のCSSファイルを読み込みます -->
</head>
<body>
    <div class="container">
        <h1>運動会アンケート 回答結果</h1>
        <?php if (empty($parsed_responses)): ?>
            <p class="no-data-message">まだ回答がありません。</p>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <?php foreach (array_values($field_map) as $header): ?>
                                <th><?php echo htmlspecialchars($header); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parsed_responses as $response): ?>
                            <tr>
                                <?php foreach (array_values($field_map) as $display_name): ?>
                                    <td>
                                        <?php
                                        // 複数行テキストは <br> タグに変換して表示
                                        echo nl2br(htmlspecialchars($response[$display_name] ?? ''));
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <p class="back-link-container">
            <a href="index.php">アンケート入力ページに戻る</a>
        </p>
    </div>
</body>
</html>
