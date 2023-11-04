    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="name" placeholder="名前">
            <input type="text" name="comment" placeholder="コメント">
            <input type="submit" name="submit" value="送信">
            <input type="number" name="delete_number" placeholder="削除投稿番号">
            <input type="submit" name="delete_submit" value="削除">
        </form>
    <?php
        $filename="3-1.txt";
        //受け取って変数に代入
        if(!empty($_POST["name"]) && !empty($_POST["comment"])){
            $name=$_POST["name"];
            $comment=$_POST["comment"];
        

            //日時を決める
            $date=date("Y/m/d H/i/s");

            //投稿番号を決める
            if(file_exists($filename)){
                $lines=file($filename);
                $lastline=end($lines);
                $lastline_element=explode("<>",$lastline);
                $num = $lastline_element[0] +1;
            }else{
                $num=1;
            }

            $message="$num<>$name<>$comment<>$date".PHP_EOL;
        
            //テキストファイルに書きこむ
            $fp=fopen($filename,("a"));
            fputs($fp,$message);
            fclose($fp);
        }

        //削除機能
        if(!empty($_POST["delete_number"])){
            $delete_number=$_POST["delete_number"];
                
            $new_filename="new_3-1.txt";
            $new_fp=fopen($new_filename,("w"));
            $lines=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
                $line_parts=explode("<>",$line);
                $postnum=$line_parts[0];
                
                if($postnum != $delete_number){
                    fputs($new_fp,$line.PHP_EOL);
                }
            }
                fclose($new_fp);
                rename($new_filename,$filename);
        }
        
                
            //テキストファイルを読み込み表示する
            $lines=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
            $elements=explode("<>",$line);
            echo "$elements[0]<br>$elements[1]<br>$elements[2]<br>$elements[3]<br>";
            }
    ?>
    </body>
    </html>