<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-1</title>
</head>
<body>
    <form action="", method="post">
        <input type="text" name="comment" value="コメント">
        <input type="submit" name="submit">
    </form>
    
    <?php
        $input_date=$_POST["comment"];
        $message = $input_date."を受け付けました";
        echo "$message"
    ?>
</body>
