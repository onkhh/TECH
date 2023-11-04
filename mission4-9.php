<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission4-1</title>
</head>
<body>
    <?php
         //記入例；以下は <?php から  で挟まれるPHP領域に記載すること。
        //4-2以降でも毎回接続は必要。
        //$dsnの式の中にスペースを入れないこと！


        // DB接続設定
        $dsn = 'mysql:dbname=データベース名;host=localhost';
        $user = 'ユーザ名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    ?>
</body>
</html>
