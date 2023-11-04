<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="UTF-8">
   <title>ファイル受信ページ1</title>
 </head>
 <body>
 
    <?php
        $filename="mission6-2_new.txt";        

        if (!empty($_POST["memo"])) {
            // 値の受け取りと変数の代入
            $memo = $_POST["memo"];

            $fp = fopen($filename, "a");
            fputs($fp, $memo.PHP_EOL);
            fclose($fp);
            }
            
        if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line) {
            echo  "$line<br>" ;
        }  
        }
    echo '<form method="post" action="delete_file.php">';
    echo '<input type="submit" name="delete" value="Delete File">';
    echo '</form>';
    ?>
</body>
</html>
