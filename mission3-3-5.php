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
        if(!empty($_POST[name]) && !empty($_POST[comment])){
            //名前の取得
            $name=$_POST[name];
            //コメントの取得
            $comment=$_POST[comment];
            //日時の取得
            $date=date("Y/m/d H:i:s");
            
            //番号の取得
            $filename="mission3-3-5.txt";
            if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $last_line = end($lines);
                    $last_line_elements = explode("<>", $last_line);
                    $num = $last_line_elements[0] + 1;
                } else {
                    $num = 1;
                }
                
                //テキストに書き込む
                $message = "$num<>$name<>$str<>$date".PHP_EOL;
                $fp = fopen($filename, "a");
                fputs($fp, $message);
                fclose($fp);
                
        }
        
        if(!empty($_POST["delete_post_number"])){
            $delete_post_number = $_POST["delete_post_number"];
            $filename="mission3-3-5.txt";
            $newfilename="mission3-3-5-new";
            $new_fp = fopen($new_filename, "w");
            if (file_exists($filename)) {
                
                
            }
        }    
    ?>
    