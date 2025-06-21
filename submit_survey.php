<?php
// submit_survey.php

// POSTリクエストかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 受け取ったデータを取得し、サニタイズ（安全な形式に変換）
    $child_name = isset($_POST['child-name']) ? htmlspecialchars($_POST['child-name']) : '';
    $child_class = isset($_POST['child-class']) ? htmlspecialchars($_POST['child-class']) : '';
    $overall_satisfaction = isset($_POST['overall-satisfaction']) ? htmlspecialchars($_POST['overall-satisfaction']) : '';
    $program_item = isset($_POST['program-item']) ? htmlspecialchars($_POST['program-item']) : '';
    $program_structure = isset($_POST['program-structure']) ? htmlspecialchars($_POST['program-structure']) : '';
    $pre_notification = isset($_POST['pre-notification']) ? htmlspecialchars($_POST['pre-notification']) : '';
    $venue_setup = isset($_POST['venue-setup']) ? htmlspecialchars($_POST['venue-setup']) : '';
    $staff_response = isset($_POST['staff-response']) ? htmlspecialchars($_POST['staff-response']) : '';
    $child_enjoyment = isset($_POST['child-enjoyment']) ? htmlspecialchars($_POST['child-enjoyment']) : '';
    $parent_participation = isset($_POST['parent-participation']) ? htmlspecialchars($_POST['parent-participation']) : '';
    $other_item = isset($_POST['other-item']) ? htmlspecialchars($_POST['other-item']) : '';
    $good_points = isset($_POST['good-points']) ? htmlspecialchars($_POST['good-points']) : '';
    $improvements = isset($_POST['improvements']) ? htmlspecialchars($_POST['improvements']) : '';
    $other_comments = isset($_POST['other-comments']) ? htmlspecialchars($_POST['other-comments']) : '';

    // タイムスタンプを追加
    $timestamp = date("Y-m-d H:i:s");

    // 保存するデータのフォーマット
    $data_to_save = <<<EOT
----- 回答日時: {$timestamp} -----
お子様の名前: {$child_name}
お子様のクラス: {$child_class}
運動会全体の満足度: {$overall_satisfaction}
--- 各項目について ---
【プログラム内容】
  種目の内容: {$program_item}
  プログラムの構成: {$program_structure}
【運営・準備】
  事前のお知らせ: {$pre_notification}
  会場設営（安全性、見やすさなど）: {$venue_setup}
  職員の対応: {$staff_response}
【その他】
  お子様の楽しんでいる様子: {$child_enjoyment}
  保護者の方の参加状況: {$parent_participation}
  その他項目: {$other_item}
-----------------------
特に良かった点:
{$good_points}
-----------------------
改善してほしい点・要望:
{$improvements}
-----------------------
その他コメント:
{$other_comments}
======================================


EOT;

    // ファイルにデータを追記 (追記モード 'a' を使用)
    // ファイルが存在しない場合は作成されます
    $file_path = 'survey_responses.txt';
    if (file_put_contents($file_path, $data_to_save, FILE_APPEND | LOCK_EX) !== false) {
        // 保存成功したら、サンクスページへリダイレクト
        echo <<<EOT
            <!DOCTYPE html>
            <html lang="ja">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>回答ありがとうございました！</title>
                
                <link rel="stylesheet" href="thank_you_style.css"> <!-- このCSSファイルを読み込みます -->
            </head>
            <body>
                <div class="container">
                    <h1>ご回答ありがとうございました！</h1>
                    <p>貴重なご意見をお寄せいただき、誠にありがとうございます。<br>今後の運動会運営の参考にさせていただきます。</p>
                    <a href="result.php">アンケート結果参照</a><br>
                    <a href="index.php">アンケートページに戻る</a>
                </div>
            </body>
            </html>
            EOT;
        exit;
    } else {
        // 保存失敗
        echo "エラー: 回答を保存できませんでした。";
    }
} else {
    // POSTリクエストではない場合
    header('Location: index.php'); // アンケートページへリダイレクト
    exit;
}
?>
