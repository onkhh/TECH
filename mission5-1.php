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
        
        // テーブル作成
        $sql = "CREATE TABLE IF NOT EXISTS Mission5 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name CHAR(32),
            comment TEXT,
            password TEXT
        );";
        $stmt = $pdo->query($sql);
        
        // 初期化
        $edit_name = "";
        $edit_comment = "";
        $edit_number = "";
        
        // 編集機能
        if (!empty($_POST["edit_post_number"]) && !empty($_POST["edit_password"])) {
            $edit_post_number = $_POST["edit_post_number"];
            $edit_password = $_POST["edit_password"];
            
            // Check if the edit post number exists and the password matches、ここでWHEREを使う
            $sql = 'SELECT * FROM Mission5 WHERE id = :id AND password = :edit_password';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $edit_post_number, PDO::PARAM_INT);
            $stmt->bindParam(':edit_password', $edit_password, PDO::PARAM_STR);
            $stmt->execute();
            $edit_row = $stmt->fetch();

            if ($edit_row) {
                $edit_name = $edit_row['name'];
                $edit_comment = $edit_row['comment'];
                $edit_number = $edit_post_number;
            }
        }

        //新規投稿か編集か
        if (!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["new_password"])) {
            $name = $_POST["name"];
            $str = $_POST["comment"];
            $new_password = $_POST["new_password"];
            
            if (empty($_POST['editNO'])) {
                //新規投稿
                $sql = "INSERT INTO Mission5 (name, comment, password) VALUES (:name, :comment, :new_password)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $str, PDO::PARAM_STR);
                $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                //編集機能
                $editNO = $_POST['editNO'];
                $sql = 'UPDATE Mission5 SET name = :name, comment = :comment, password = :new_password WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $str, PDO::PARAM_STR);
                $stmt->bindParam(':id', $editNO, PDO::PARAM_INT);
                $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
                $stmt->execute();
            }
        }    
           
        // 削除機能
        if (!empty($_POST["delete_post_number"]) && !empty($_POST["delete_password"])) {
            $delete_post_number = $_POST["delete_post_number"];
            $delete_password = $_POST["delete_password"];
            
            $sql = 'DELETE FROM Mission5 WHERE id = :id AND password = :delete_password';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $delete_post_number, PDO::PARAM_INT);
            $stmt->bindParam(':delete_password', $delete_password, PDO::PARAM_STR);
            $stmt->execute();
        }
    ?>
    
    <form action="" method="post">
        [投稿フォーム]<br>
        <input type="text" name="name" placeholder="名前" value="<?php echo $edit_name; ?>">
        <input type="text" name="comment" placeholder="コメント" value="<?php echo $edit_comment; ?>">
        <input type="hidden" name="editNO" value="<?php echo $edit_number; ?>">
        <input type="password" name="new_password" placeholder="パスワード">
        <input type="submit" name="submit" value="投稿"><br>
        [削除フォーム]<br>
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="text" name="delete_password" placeholder="パスワード">
        <input type="submit" name="delete_submit" value="削除"><br>
         [編集フォーム]<br>
        <input type="number" name="edit_post_number" placeholder="編集対象番号">
        <input type="text" name="edit_password" placeholder="パスワード">
        <input type="submit" name="edit_submit" value="編集">
    </form>
    
    <?php
        $sql = 'SELECT * FROM Mission5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].'<br>';
            echo "<hr>";
        }    
    ?>
</body>
</html>