<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>保育園 運動会アンケート</title>
    <link rel="stylesheet" href="style.css"> <!-- CSSファイルを読み込みます -->
</head>
<body>
    <div class="container">
        <h1>保育園 運動会アンケート（保護者向け）</h1>
        <p>この度は、保育園の運動会にご参加いただき、誠にありがとうございました。皆様からの貴重なご意見を参考に、今後の運動会運営をより良いものにするため、アンケートにご協力をお願いいたします。</p>

        <form action="submit_survey.php" method="post">
            <div class="form-section">
                <label for="child-name">1. お子様の名前をご記入ください。</label>
                <input type="text" id="child-name" name="child-name" placeholder="例：山田 花子" required>
            </div>

            <div class="form-section">
                <label for="child-class">2. お子様のクラスをご記入ください。</label>
                <select id="child-class" name="child-class" required>
                    <option value="">選択してください</option>
                    <option value="年少">年少</option>
                    <option value="年中">年中</option>
                    <option value="年長">年長</option>
                </select>
            </div>

            <div class="form-section">
                <fieldset>
                    <legend>3. 運動会全体の満足度をお聞かせください。（○をお付けください）</legend>
                    <div class="radio-group">
                        <label><input type="radio" name="overall-satisfaction" value="大変満足" required> 大変満足</label>
                        <label><input type="radio" name="overall-satisfaction" value="満足"> 満足</label>
                        <label><input type="radio" name="overall-satisfaction" value="普通"> 普通</label>
                        <label><input type="radio" name="overall-satisfaction" value="やや不満"> やや不満</label>
                        <label><input type="radio" name="overall-satisfaction" value="不満"> 不満</label>
                    </div>
                </fieldset>
            </div>

            <div class="form-section">
                <fieldset>
                    <legend>4. 各項目についてお聞かせください。（該当するものに○をお付けください）</legend>
                    <table>
                        <thead>
                            <tr>
                                <th>項目</th>
                                <th>大変満足</th>
                                <th>満足</th>
                                <th>普通</th>
                                <th>やや不満</th>
                                <th>不満</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="category-title" colspan="6">【プログラム内容】</td>
                            </tr>
                            <tr>
                                <td>種目の内容</td>
                                <td><label><input type="radio" name="program-item" value="大変満足"></label></td>
                                <td><label><input type="radio" name="program-item" value="満足"></label></td>
                                <td><label><input type="radio" name="program-item" value="普通"></label></td>
                                <td><label><input type="radio" name="program-item" value="やや不満"></label></td>
                                <td><label><input type="radio" name="program-item" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td>プログラムの構成</td>
                                <td><label><input type="radio" name="program-structure" value="大変満足"></label></td>
                                <td><label><input type="radio" name="program-structure" value="満足"></label></td>
                                <td><label><input type="radio" name="program-structure" value="普通"></label></td>
                                <td><label><input type="radio" name="program-structure" value="やや不満"></label></td>
                                <td><label><input type="radio" name="program-structure" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td class="category-title" colspan="6">【運営・準備】</td>
                            </tr>
                            <tr>
                                <td>事前のお知らせ</td>
                                <td><label><input type="radio" name="pre-notification" value="大変満足"></label></td>
                                <td><label><input type="radio" name="pre-notification" value="満足"></label></td>
                                <td><label><input type="radio" name="pre-notification" value="普通"></label></td>
                                <td><label><input type="radio" name="pre-notification" value="やや不満"></label></td>
                                <td><label><input type="radio" name="pre-notification" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td>会場設営（安全性、見やすさなど）</td>
                                <td><label><input type="radio" name="venue-setup" value="大変満足"></label></td>
                                <td><label><input type="radio" name="venue-setup" value="満足"></label></td>
                                <td><label><input type="radio" name="venue-setup" value="普通"></label></td>
                                <td><label><input type="radio" name="venue-setup" value="やや不満"></label></td>
                                <td><label><input type="radio" name="venue-setup" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td>職員の対応</td>
                                <td><label><input type="radio" name="staff-response" value="大変満足"></label></td>
                                <td><label><input type="radio" name="staff-response" value="満足"></label></td>
                                <td><label><input type="radio" name="staff-response" value="普通"></label></td>
                                <td><label><input type="radio" name="staff-response" value="やや不満"></label></td>
                                <td><label><input type="radio" name="staff-response" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td class="category-title" colspan="6">【その他】</td>
                            </tr>
                            <tr>
                                <td>お子様の楽しんでいる様子</td>
                                <td><label><input type="radio" name="child-enjoyment" value="大変満足"></label></td>
                                <td><label><input type="radio" name="child-enjoyment" value="満足"></label></td>
                                <td><label><input type="radio" name="child-enjoyment" value="普通"></label></td>
                                <td><label><input type="radio" name="child-enjoyment" value="やや不満"></label></td>
                                <td><label><input type="radio" name="child-enjoyment" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td>保護者の方の参加状況</td>
                                <td><label><input type="radio" name="parent-participation" value="大変満足"></label></td>
                                <td><label><input type="radio" name="parent-participation" value="満足"></label></td>
                                <td><label><input type="radio" name="parent-participation" value="普通"></label></td>
                                <td><label><input type="radio" name="parent-participation" value="やや不満"></label></td>
                                <td><label><input type="radio" name="parent-participation" value="不満"></label></td>
                            </tr>
                            <tr>
                                <td>その他</td>
                                <td><label><input type="radio" name="other-item" value="大変満足"></label></td>
                                <td><label><input type="radio" name="other-item" value="満足"></label></td>
                                <td><label><input type="radio" name="other-item" value="普通"></label></td>
                                <td><label><input type="radio" name="other-item" value="やや不満"></label></td>
                                <td><label><input type="radio" name="other-item" value="不満"></label></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>

            <div class="form-section">
                <label for="good-points">5. 運動会で特に良かった点、お子様の様子で印象に残ったことなど、ご自由にお書きください。</label>
                <textarea id="good-points" name="good-points" rows="5"></textarea>
            </div>

            <div class="form-section">
                <label for="improvements">6. 改善してほしい点、次回以降の運動会へのご要望などございましたら、具体的にお書きください。</label>
                <textarea id="improvements" name="improvements" rows="5"></textarea>
            </div>

            <div class="form-section">
                <label for="other-comments">7. その他、運動会について何かございましたらご記入ください。</label>
                <textarea id="other-comments" name="other-comments" rows="3"></textarea>
            </div>

            <button type="submit">回答を送信する</button>
        </form>

        <p class="thanks-message">ご協力いただきありがとうございました。</p>
    </div>
</body>
</html>
