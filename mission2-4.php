<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission2-4</title>
</head>
<body>
    <?php
        $filename="mission2-4.txt";
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            echo "$line<br>";
        }
    ?>
</body>
</html>