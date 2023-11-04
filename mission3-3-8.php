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
            if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
                $filename = "mission_3-3.txt";
                $fp = fopen($filename, "a");

                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $last_line = end($lines);
                    $last_line_elements = explode("<>", $last_line);
                    $num = $last_line_elements[0] + 1;
                } else {
                    $num = 1;
                }

                $name = $_POST["name"];
                $comment = $_POST["comment"];
                $date = date("Y/m/d H:i:s");
                $save = $num ."<>". $name ."<>". $comment ."<>". $date;

                fwrite($fp, $save.PHP_EOL);
                fclose($fp);
            }

            if (!empty($_POST["delete"])) {
                $filename = "mission_3-3.txt";
                $lines = file ($filename, FILE_IGNORE_NEW_LINES);
                $delete = $_POST["delete"];
                $fp = fopen($filename, "w");
                foreach ($lines as $line) {
                    $parts = explode("<>", $line);
                    $num = $parts[0];
                    if ($num != $delete) {
                        fwrite($fp, $line.PHP_EOL);
                    }
                }
                fclose($fp);
            }

            $filename = "mission_3-3.txt";
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    $parts = explode ("<>", $line);
                    $num = $parts[0];
                    $name = $parts[1];
                    $comment = $parts[2];
                    $date = $parts[3];
                    echo $num ." ". $name ." ". $comment ." ". $date;
                    echo "<br>";
                }
            }
        ?>
        </body>
</html>