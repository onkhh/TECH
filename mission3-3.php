<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission3-3</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント"> 
        <input type="submit" name="submit">
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="submit" name="delete_submit" value="削除">
    </form>

    <?php
        // 新規投稿処理
        if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
            // 値の受け取りと変数の代入
            $name = $_POST["name"];
            $str = $_POST["comment"];
                
            // 投稿日時の取得
            $date = date("Y年m月d日 H時i分s秒");
                
            // 投稿番号の取得
            $filename = "mission3-3.txt";
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
            $filename = "mission3-3.txt";
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            // 新たなファイルを作成
            $new_filename = "mission3-3-new.txt";
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
        
        // 投稿一覧を表示
        $filename = "mission3-3.txt";
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


