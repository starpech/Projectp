<?php 
    function hello () {
        echo "Say Hello <br>";
    }
    function goodbye() {
        echo "Goodbye ! <br>";
    }

for($i = 1; $i<= 20; $i++){
    echo $i."";
    if ($i<15){
        hello();
    } 
    else{
        goodbye();
    }
}

?>

<a href="index.php">Back</a>