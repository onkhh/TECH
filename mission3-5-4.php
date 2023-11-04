<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission3-5</title>
</head>
<body>
    <?php
        $filename="mission3-5.txt";        
        // 編集フォーム表示処理
        if (isset($_POST["edit_submit")) {
            
        if (!empty($_POST["edit_post_number"]) && !empty($_POST["password3"])) {
            $edit_post_number = $_POST["edit_post_number"];
            $password3 = $_POST["password3"];
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
            $edit_password = $line_parts[4];
                    
            // 投稿番号が編集対象番号と一致してパスワードも一致する場合、名前とコメントを取得
            if ($postnum == $edit_post_number && $password3 == $edit_password) { 
                $edit_number = $line_parts[0];
                $edit_name = $line_parts[1];
                $edit_comment = $line_parts[2];
                }
            }
        }
        }

        if (!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["password1"])) {
            // 値の受け取りと変数の代入
            $name = $_POST["name"];
            $str = $_POST["comment"];
            $password1 = $_POST["password1"];

            // 投稿日時の取得
            $date = date("Y年m月d日 H時i分s秒");
    
            // editNoがないときは新規投稿、ある場合は編集 ***ここで判断
            if (empty($_POST['editNO'])) {
      
            // 以下、新規投稿機能
            //ファイルの存在がある場合は投稿番号+1、なかったら1を指定する
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $last_line = end($lines);
                    $last_line_elements = explode("<>", $last_line);
                    $num = $last_line_elements[0] + 1;
                } else {
                    $num = 1;
                }

                $message = "$num<>$name<>$str<>$date<>$password1".PHP_EOL;
                $fp = fopen($filename, "a");
                fputs($fp, $message);
                fclose($fp);
            } else {

                // 以下編集機能
                //入力データの受け取りを変数に代入
                $editNO = $_POST['editNO'];
                
                //読み込んだファイルの中身を配列に格納する
                $ret_array = file($filename, FILE_IGNORE_NEW_LINES);

                //ファイルを書き込みモードでオープン＋中身を空に
                $fp = fopen($filename, "w");

                //配列の数だけループさせる
                    foreach ($ret_array as $line) {
                    $elements = explode("<>", $line);

                        //投稿番号と編集番号が一致してパスワードも一致したら
                        if ($elements[0] == $editNO && $password1 == $elements[4]) {

                        //編集のフォームから送信された値と差し替えて上書き
                        fwrite($fp, $editNO . "<>" . $name . "<>" . $str . "<>" . $date . "<>" . $password1 . "<>" . "\n");
                        } else {
                            fwrite($fp, $line.PHP_EOL);
                        }
                    }
                    fclose($fp);
                }
        }

        // 削除処理
        if (!empty($_POST["delete_post_number"]) && !empty($_POST["password2"])) {
            $delete_post_number = $_POST["delete_post_number"];
            $password2 = $_POST["password2"];

            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
        
            // 新たなファイルを作成
            $new_filename = "mission3-5-new.txt";
            $new_fp = fopen($new_filename, "w");
        
            // ファイルの行数の数だけ繰り返し処理を行う
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
            $delete_password = $line_parts[4];
            
            // 投稿番号が削除対象番号と一致しない場合、またはパスワードが一致しない場合新しいファイルに書き込む
                if ($postnum != $delete_post_number || $password2 != $delete_password) { 
                fputs($new_fp, $line.PHP_EOL);
                }
            }
        
            // ファイルを閉じる
            fclose($new_fp);
        
            // 新しいファイルを元のファイルにリネームする
            rename($new_filename, $filename);
        }
    ?>
    <form action="" method="post">
        [投稿フォーム]<br>
        <input type="text" name="name" placeholder="名前" value="<?php if(isset($edit_name)) {echo $edit_name;}?>">
        <input type="text" name="comment" placeholder="コメント" value="<?php if(isset($edit_comment)) {echo $edit_comment;} ?>">
        <input type="hidden" name="editNO" value="<?php if(isset($edit_number)) {echo $edit_number;} ?>">
        <input type="password" name="password1" placeholder="パスワード">
        <input type="submit" name="submit" value="投稿"><br>
        [削除フォーム]<br>
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="password" name="password2" placeholder="パスワード">
        <input type="submit" name="delete_submit" value="削除"><br>
        [編集フォーム]<br>
        <input type="number" name="edit_post_number" placeholder="編集対象番号">
        <input type="password" name="password3" placeholder="パスワード">
        <input type="submit" name="edit_submit" value="編集">
    </form>
            
 <?php
        // 投稿一覧を表示
        $filename="mission3-5.txt";
        if(file_exists($filename)){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line) {
            // 要素を"<>"で分割して値を配列に格納
            $elements = explode("<>", $line);
            // 投稿番号と内容を表示
            echo "投稿番号: $elements[0]<br>";
            echo "名前: $elements[1]<br>";
            echo "コメント: $elements[2]<br>";
            echo "投稿日時: $elements[3]<br>";
            echo "<hr>"; // 区切り線
        }
        }
?>
</body>
</html>





