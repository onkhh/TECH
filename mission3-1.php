<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission3-1</title>
</head>
<body>
    <form action="" method="post">
         <input type="text" name="name" placeholder="名前">
        <input type="text" name="comment" placeholder="コメント"> 
        <input type="submit" name="submit">
    </form>
    <?php
        if(!empty($_POST["name"]) && !empty($_POST["comment"])){
            //値の受け取りと変数の代入
            $name=$_POST["name"];
            $str=$_POST["comment"];
            //投稿日時の取得
            $date = date("Y年m月d日 H時i分s秒");
            
            //投稿番号の取得
            $filename="mission3-1.txt";
            if (file_exists($filename)){
                $num=count(file($filename)) + 1;
            }else{
                $num=1;
            }
            
            $message="$num<>$name<>$str<>$date";
            $fp=fopen($filename,"a");
            fputs($fp,$message.PHP_EOL);
            fclose($fp);
        }  
    ?>     