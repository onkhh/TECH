<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission4-1</title>
</head>
<body>
    <?php
        // DB接続設定
        $dsn = 'mysql:dbname=データベース名;host=localhost';
        $user = 'ユーザ名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        $name = 'かほ';
        $comment = 'こんにちは'; //好きな名前、好きな言葉は自分で決めること
    
        $sql = "INSERT INTO tbtest (name, comment) VALUES (:name, :comment)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();
        //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
    ?>
</body>
</html>


