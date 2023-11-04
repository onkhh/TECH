<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission3-5</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php
        $filename="mission6-2.txt";        
        // 編集フォーム表示処理
        if (!empty($_POST["edit_post_number"])) {
            $edit_post_number = $_POST["edit_post_number"];
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
                    
            // 投稿番号が編集対象番号と一致してパスワードも一致する場合、名前とコメントを取得
            if ($postnum == $edit_post_number) { 
                $edit_number = $line_parts[0];
                $edit_name = $line_parts[1];
                $edit_comment = $line_parts[2];
                $edit_time = $line_parts[3];
                $edit_memo = $line_parts[4];
                }
            }
        }

        if (!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["time"]) && !empty($_POST["memo"])) {
            // 値の受け取りと変数の代入
            $name = $_POST["name"];
            $str = $_POST["comment"];
            $time = $_POST["time"];
            $memo = $_POST["memo"];

    
            // editNoがないときは新規投稿、ある場合は編集 ***ここで判断
            if (empty($_POST['editNO'])) {
      
            // 以下、新規投稿機能
            //ファイルの存在がある場合は投稿番号+1、なかったら1を指定する
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $last_line = end($lines);
                    $last_line_elements = explode("<>", $last_line);
                    $num = $last_line_elements[0] + 1;
                } else {
                    $num = 1;
                }

                $message = "$num<>$name<>$str<>$time<>$memo".PHP_EOL;
                $fp = fopen($filename, "a");
                fputs($fp, $message);
                fclose($fp);
            } else {

                // 以下編集機能
                //入力データの受け取りを変数に代入
                $editNO = $_POST['editNO'];
                
                //読み込んだファイルの中身を配列に格納する
                $ret_array = file($filename, FILE_IGNORE_NEW_LINES);

                //ファイルを書き込みモードでオープン＋中身を空に
                $fp = fopen($filename, "w");

                //配列の数だけループさせる
                    foreach ($ret_array as $line) {
                    $elements = explode("<>", $line);

                        //投稿番号と編集番号が一致してパスワードも一致したら
                        if ($elements[0] == $editNO) {

                        //編集のフォームから送信された値と差し替えて上書き
                        fwrite($fp, $editNO . "<>" . $name . "<>" . $str . "<>" . $time . "<>" . $memo . "<>" . "\n");
                        } else {
                            fwrite($fp, $line.PHP_EOL);
                        }
                    }
                    fclose($fp);
                }
        }

        // 削除処理
        if (!empty($_POST["delete_post_number"])) {
            $delete_post_number = $_POST["delete_post_number"];

            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
        
            // 新たなファイルを作成
            $new_filename = "mission6-2-new.txt";
            $new_fp = fopen($new_filename, "w");
        
            // ファイルの行数の数だけ繰り返し処理を行う
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
            
            // 投稿番号が削除対象番号と一致しない場合、またはパスワードが一致しない場合新しいファイルに書き込む
                if ($postnum != $delete_post_number) { 
                fputs($new_fp, $line.PHP_EOL);
                }
            }
        
            // ファイルを閉じる
            fclose($new_fp);
        
            // 新しいファイルを元のファイルにリネームする
            rename($new_filename, $filename);
        }
        
        // Date calculation
        function calculateRemainingDays($targetDate) {
            $currentDate = date('Y-m-d'); // Get the current date
            $diff = strtotime($targetDate) - strtotime($currentDate); // Calculate the time difference
            $remainingDays = floor($diff / (60 * 60 * 24)); // Convert the difference to days
            return $remainingDays;
        }
    ?>
    <form action="" method="post">
        <p>[投稿フォーム]<br>
      <input type="text" name="name" placeholder="企業" value="<?php if(isset($edit_name)) {echo $edit_name;}?>">
        <input type="text" name="comment" placeholder="内容" value="<?php if(isset($edit_comment)) {echo $edit_comment;} ?>">
        <input type="date" name="time" placeholder="いつ">
        <input type="text" name="memo" placeholder="メモ">
        <input type="hidden" name="editNO" value="<?php if(isset($edit_number)) {echo $edit_number;} ?>">
        <input type="submit" name="submit" value="投稿"><br>
        [削除フォーム]<br>
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="submit" name="delete_submit" value="削除"><br>
        [編集フォーム]<br>
        <input type="number" name="edit_post_number" placeholder="編集対象番号">
        <input type="submit" name="edit_submit" value="編集"><br></p>
    </form>
    <form action="mission6-2_new.php" method="post" enctype="application/x-www-form-urlencoded">
	<p>[入力欄]<br>
    <textarea name="memo" placeholder="自由に記入してください"></textarea>
    <input type="submit" value="送信"></p>
    <br>
</form>
<?php
// Store elements with red text
$redText = [];

if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        // Split the elements and store them in an array
        $elements = explode("<>", $line);

        // Check if the memo contains "完了" and apply the class "completed" for black text
        $memo = $elements[4];
        $class = (strpos($memo, "完了") !== false) ? 'completed' : 'not-completed'; // Add a "not-completed" class

        // Calculate remaining days
        $remainingDays = calculateRemainingDays($elements[3]);

        // Store elements in the appropriate array
        if ($class === 'not-completed') {
            $redText[] = "<span class='$class'>$elements[0]　$elements[1]　$elements[2]　$elements[3]　$elements[4]　(残り{$remainingDays}日)</span>";
        } else {
            $blackText[] = "<span class='$class'>$elements[0]　$elements[1]　$elements[2]　$elements[3]　$elements[4]　(残り{$remainingDays}日)</span>";
        }
    }

   // Output the list
foreach ($redText as $element) {
    echo $element;
    echo "<hr>"; // Add a horizontal rule for separation
}
    foreach ($blackText as $element) {
        echo $element;
        echo "<hr>"; // Add a horizontal rule for separation
    }
}


?>
</body>
</html>