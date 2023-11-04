<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><mission3-4></mission3-4></title>
</head>
<body>
    <?php
    if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
        // 値の受け取りと変数の代入
        $name = $_POST["name"];
        $str = $_POST["comment"];
                
        // 投稿日時の取得
        $date = date("Y年m月d日 H時i分s秒");
                
        // 投稿番号の取得
        $filename = "mission3-4.txt";
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            $last_line = end($lines);
            $last_line_elements = explode("<>", $last_line);
            $num = $last_line_elements[0] + 1;
            } else {
                $num = 1;
            }
                
            // テキストに書き込む
            $message = "$num<>$name<>$str<>$date".PHP_EOL;
            $fp = fopen($filename, "a");
            fputs($fp, $message);
            fclose($fp);
            }
        
        // 削除処理
        if (!empty($_POST["delete_post_number"])) {
            $delete_post_number = $_POST["delete_post_number"];
            $filename = "mission3-4.txt";
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            // 新たなファイルを作成
            $new_filename = "mission3-4-new.txt";
            $new_fp = fopen($new_filename, "w");
                
            // ファイルの行数の数だけ繰り返し処理を行う
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
                    
            // 投稿番号が削除対象番号と一致しない場合、新しいファイルに書き込む
            if ($postnum != $delete_post_number) { 
                fputs($new_fp, $line.PHP_EOL);
                }
            }
                
            // ファイルを閉じる
            fclose($new_fp);
                
            // 新しいファイルを元のファイルにリネームする
            rename($new_filename, $filename);
            }
        
        // 編集フォーム表示処理
        if (!empty($_POST["edit_post_number"])) {
            $edit_post_number = $_POST["edit_post_number"];
            $filename = "mission3-4.txt";
                
            // ファイルの中身を1行1要素として配列変数に代入する
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
            foreach ($lines as $line) {
            // 区切り文字「<>」で分割
            $line_parts = explode("<>", $line);
            $postnum = $line_parts[0];
                    
            // 投稿番号が編集対象番号と一致する場合、名前とコメントを取得
            if ($postnum == $edit_post_number) { 
                $edit_number = $line_parts[0];
                $edit_name = $line_parts[1];
                $edit_comment = $line_parts[2];
                }
            }
        }
    
        // 更新機能
        //フォーム内が空でない場合に以下を実行する

    if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
        // 値の受け取りと変数の代入
        $name = $_POST["name"];
        $str = $_POST["comment"];
                
        // 投稿日時の取得
        $date = date("Y年m月d日 H時i分s秒");
    
    // editNoがないときは新規投稿、ある場合は編集 ***ここで判断
    if (empty($_POST['editNO'])) {
      
      // 以下、新規投稿機能
      //ファイルの存在がある場合は投稿番号+1、なかったら1を指定する
      if (file_exists($filename)) {
        $num = count(file($filename)) + 1;
      } else {
        $num = 1;
      }

      //書き込む文字列を組み合わせた変数
      $newdata = $num . "<>" . $name . "<>" . $str . "<>" . $date;

      //ファイルを追記保存モードでオープンする
      $fp = fopen($filename, "a");

      //入力データのファイル書き込み
      fwrite($fp, $newdata . "\n");
      fclose($fp);
    } else {

      // 以下編集機能
      //入力データの受け取りを変数に代入
      $editNO = $_POST['editNO'];

      //読み込んだファイルの中身を配列に格納する
      $ret_array = file($filename);

      //ファイルを書き込みモードでオープン＋中身を空に
      $fp = fopen($filename, "w");

      //配列の数だけループさせる
      foreach ($ret_array as $line) {

        //explode関数でそれぞれの値を取得
        $data = explode("<>", $line);

        //投稿番号と編集番号が一致したら
        if ($data[0] == $editNO) {

          //編集のフォームから送信された値と差し替えて上書き
          fwrite($fp, $editNO . "<>" . $name . "<>" . $str . "<>" . $date . "\n");
        } else {
          //一致しなかったところはそのまま書き込む
          fwrite($fp, $line);
        }
      }
      fclose($fp);
    }
  }
  ?>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" value="<?php if(isset($edit_name)) {echo $edit_name;}?>">
        <input type="text" name="comment" placeholder="コメント" value="<?php if(isset($edit_comment)) {echo $edit_comment;} ?>">
        <input type="hidden" name="editNO" value="<?php if(isset($edit_number)) {echo $edit_number;} ?>">
        <input type="submit" name="submit" value="投稿">
        <input type="number" name="delete_post_number" placeholder="削除対象番号">
        <input type="submit" name="delete_submit" value="削除">
        <input type="number" name="edit_post_number" placeholder="編集対象番号">
        <input type="submit" name="edit_submit" value="編集">
    </form>
            
 <?php
        // 投稿一覧を表示
        $filename="mission3-4.txt";
        if(file_exists($filename)){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line) {
            // 要素を"<>"で分割して値を配列に格納
            $elements = explode("<>", $line);
            // 投稿番号と内容を表示
            echo "投稿番号: $elements[0]<br>";
            echo "名前: $elements[1]<br>";
            echo "コメント: $elements[2]<br>";
            echo "投稿日時: $elements[3]<br>";
            echo "<hr>"; // 区切り線
        }
        }
?>
</body>
</html>