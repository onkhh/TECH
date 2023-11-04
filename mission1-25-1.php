<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title mision1-25>
        </title>
    </head>
    <body>
        <?php
        $str = "こんにちは";
        $filename="mission_1-25.txt";
        $fp = fopen($filename,"a");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
        echo "書き込み成功！";
        ?>
    </body>
</html>