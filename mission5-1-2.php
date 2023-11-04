<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission5-1</title>
</head>
<body>
    <?php
        $dsn = 'mysql:dbname=データベース名;host=localhost';
        $user = 'ユーザ名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        //保存するテーブル作成
        $sql = "CREATE TABLE IF NOT EXISTS Mission5"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name CHAR(32),"
        . "comment TEXT,"
        . "password TEXT"
        .");";
        $stmt = $pdo->query($sql);
        
        //新規投稿を行う
        //データを入力
        if (!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["new_password"])) {
            // 値の受け取りと変数の代入
            $name = $_POST["name"];
            $str = $_POST["comment"];
            $new_password = $_POST["new_password"];

            // 投稿日時の取得
            $date = date("Y年m月d日 H時i分s秒");
            $sql = "INSERT INTO Mission5 (name, comment, password) VALUES (:name, :comment, :new_password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $str, PDO::PARAM_STR);
            $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
            $stmt->execute();
            } 
            
           
        // 削除処理
        if (!empty($_POST["delete_post_number"]) && !empty($_POST["delete_password"])) {
            $delete_post_number = $_POST["delete_post_number"];
            $delete_password = $_POST["delete_password"];               
            
            // 投稿番号が削除対象番号と一致し、パスワードも一致する場合削除する
            $sql = 'delete from Mission5 where id=:id AND password=:delete_password';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $delete_post_number, PDO::PARAM_INT);
            $stmt->bindParam(':delete_password', $delete_password, PDO::PARAM_STR);
            $stmt->execute();
        }
    ?>
    
    <form action="" method="post">
        [投稿フォーム]<br>
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント"> 
        <input type="password" name="new_password" placeholder="パスワード">
        <input type="submit" name="submit"><br>
        [削除フォーム]<br>
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="text" name="delete_password" placeholder="パスワード">
        <input type="submit" name="delete_submit" value="削除"><br>
    </form>
    
    <?php
        $sql = 'SELECT * FROM Mission5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['password'].'<br>';
            echo "<hr>";
        }    
    ?>
</body>
</html>