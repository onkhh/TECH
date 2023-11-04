<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission3-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント"> 
        <input type="submit" name="submit" value="投稿">
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="submit" name="delete_submit" value="削除">
        <input type="number" name="edit_post_number" placeholder="編集対象番号">
        <input type="submit" name="edit_submit" value="編集">
    </form>

    <?php
    if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
        // 値の受け取りと変数の代入
        $name = $_POST["name"];
        $str = $_POST["comment"];
                
        // 投稿日時の取得
        $date = date("Y年m月d日 H時i分s秒");
                
        // 投稿番号の取得
        $filename = "mission3-4.txt";
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            $last_line = end($lines);
            $last_line_elements = explode("<>", $last_line);
            $num = $last_line_elements[0] + 1;
            } else {
                $num = 1;
            }
                
            // テキストに書き込む
            $message = "$num<>$name<>$str<>$date".PHP_EOL;
            $fp = fopen($filename, "a");
            fputs($fp, $message);
            fclose($fp);
            }
        
        // 削除処理
        if (!empty($_POST["delete_post_number"])) {
            $delete_post_number = $_POST["delete_post_number"];
            $filename = "mission3-4.txt";
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            // 新たなファイルを作成
            $new_filename = "mission3-4-new.txt";
            $new_fp = fopen($new_filename, "w");
                
            // ファイルの行数の数だけ繰り返し処理を行う
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
                    
            // 投稿番号が削除対象番号と一致しない場合、新しいファイルに書き込む
            if ($postnum != $delete_post_number) { 
                fputs($new_fp, $line.PHP_EOL);
                }
            }
                
            // ファイルを閉じる
            fclose($new_fp);
                
            // 新しいファイルを元のファイルにリネームする
            rename($new_filename, $filename);
            }
        
        // 編集フォーム表示処理
        if (!empty($_POST["edit_post_number"])) {
            $edit_post_number = $_POST["edit_post_number"];
            $filename = "mission3-4.txt";
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            // 編集対象番号と一致する投稿を取得
            $edit_name = "";
            $edit_comment = "";
                
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
                    
            // 投稿番号が編集対象番号と一致する場合、名前とコメントを取得
            if ($postnum == $edit_post_number) { 
                $edit_name = $line_parts[1];
                $edit_comment = $line_parts[2];
                break; // 一致する投稿が見つかったらループを終了
                }
            }
        }

        // 投稿一覧を表示
        $filename="mission3-4.txt";
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

    <!-- 編集フォーム -->
    <form action="" method="post">
        <input type="hidden" name="edit_post_number" value="<?php echo $edit_post_number; ?>">
        <input type="text" name="edit_name" placeholder="名前" value="<?php echo $edit_name; ?>">
        <input type="text" name="edit_comment" placeholder="コメント" value="<?php echo $edit_comment; ?>">
        <input type="submit" name="update_submit" value="更新">
    </form>
</body>
</html>





