<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title mision1-26>
        </title>
    </head>
    <body>
<?php
    $str="Hello World";
    $filename="mission1-26.txt";
    $fp=fopen($filename,"a");
    fputs($fp,$str.PHP_EOL);
    fclose($fp);
    echo"書き込み成功！<br>";
    
    if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        echo $line . "<br>";
    }
}
?>