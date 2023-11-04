<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission1-23</title>
    </head>
    <body>
        <?php    
        $items = array("Ken","Alice","Judy","BOSS","Bob");
        foreach($items as $item){
        if($item=="BOSS"){
            echo "Good morning $item!<br>";
        }else{
            echo "Hi! $item<br>";
        }
    }?>
    </body>
</html>