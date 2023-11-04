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
        
        $sql = "CREATE TABLE IF NOT EXISTS tbtest"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name CHAR(32),"
        . "comment TEXT"
        .");";
        $stmt = $pdo->query($sql);
    ?>
</body>
</html>
