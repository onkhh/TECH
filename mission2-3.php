<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission2-3</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="comment">
        <input type="submit" name="submit">
    </form>

    <?php
        if(!empty($_POST["comment"])){
            $str=$_POST["comment"];
            $filename="mission2-3.txt";
            $fp=fopen($filename,"a");
            fputs($fp,$str.PHP_EOL);
            fclose($fp);
                
            if($str=="お誕生日"){
                echo "おめでとう";
            }else{
                echo "書き込み成功";
            }
        }
    ?>
</body>
</html>