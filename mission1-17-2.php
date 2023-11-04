<!DOCTYpE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission1-16</title>
    </head>
    <body>
        <?php
        $num=3;
        if($num%3==0){
            if ($num%5==0){
            echo"FizzBuzz<br>";
             }else{
            echo"Fizz<br>";
             }
        }elseif($num%5==0){
            echo"Buzz<br>";
        }else{
            echo "$num<br>";
        }?>
    </body>
</html>