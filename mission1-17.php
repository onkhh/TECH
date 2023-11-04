<!DOCTYpE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission1-16</title>
    </head>
    <body>
        <?php
        $num=15;
        if($num%3==0 && $num%5==0){
            echo"FizzBuzz<br>";
        }elseif($num%5==0){
            echo"Buzz<br>";
        }elseif($num%3==0){
            echo"Fizz<br>";
        }else{
            echo "$num<br>";
        }?>
    </body>
</html>