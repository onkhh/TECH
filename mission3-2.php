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
    <?php
        if(!empty($_POST["name"]) && !empty($_POST["comment"])){
            //値の受け取りと変数の代入
            $name=$_POST["name"];
            $str=$_POST["comment"];
            //投稿日時の取得
            $date = date("Y年m月d日 H時i分s秒");
            
            //投稿番号の取得
            $filename="mission3-2.txt";
            if (file_exists($filename)){
                $num=count(file($filename)) + 1;
            }else{
                $num=1;
            }
            //テキストに書き込む
            $message="$num<>$name<>$str<>$date";
            $fp=fopen($filename,"a");
            fputs($fp,$message.PHP_EOL);
            fclose($fp);
            
            //ファイルを一行ずつ読み込み配列変数に代入する
            $lines=file($filename,FILE_IGNORE_NEW_LINES);
            //読み込んだ配列を配列の数（行数）だけループさせる
            foreach($lines as $line){
            //要素を"<>"で分割して値を配列に格納
            $elements = explode("<>",$line);
            //格納した要素を取り出して表示する
            echo "$elements[0]<br>$elements[1]<br>$elements[2]<br>$elements[3]<br>";
            }
        }
    ?>
</body>
</html>