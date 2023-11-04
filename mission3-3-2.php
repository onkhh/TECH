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
        <input type="submit" name="submit">
    </form>
    
    <form action="" method="post">
        <input type="number" name="delete_post_number" placeholder="削除対象の投稿番号">
        <input type="submit" name="delete_submit" value="削除">
    </form>

    <?php
        if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
            // 値の受け取りと変数の代入
            $name = $_POST["name"];
            $str = $_POST["comment"];
            
            // 投稿日時の取得
            $date = date("Y年m月d日 H時i分s秒");
            
            // 投稿番号の取得
            $filename = "mission3-2.txt";
            if (file_exists($filename)) {
                $num = count(file($filename)) + 1;
            } else {
                $num = 1;
            }
            
            // テキストに書き込む
            $message = "$num<>$name<>$str<>$date";
            $fp = fopen($filename, "a");
            fputs($fp, $message.PHP_EOL);
            fclose($fp);
        }

        if (isset($_POST["delete_post_number"]) && !empty($_POST["delete_post_number"])) {
            $delete_post_number = $_POST["delete_post_number"];
            $filename = "mission3-2.txt";
            
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            
            // 新たなファイルを作成
            $new_filename = "mission3-2-new.txt";
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
                           //ファイルを一行ずつ読み込み配列変数に代入する
                $lines=file($filename,FILE_IGNORE_NEW_LINES);
                //読み込んだ配列を配列の数（行数）だけループさせる
                foreach($lines as $line){
                //要素を"<>"で分割して値を配列に格納
                $elements = explode("<>",$line);
                //格納した要素を取り出して表示する
                for($i = 0 ; $i < count($elements); $i++){
                echo "$elements[$i]<br>";
                }
        }
        }
    ?>
</body>
</html>
