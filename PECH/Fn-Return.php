<?php 

function area($A,$B) {
    $result = (1/2)*$A*$B;
    return $result;
}



$AA = 2 ; $BB = 3 ;
$triangle1 = area ($AA,$BB);
echo "Area 1 = $triangle1<br>";

$X = 10 ; $Y = 5 ;
$triangle2 = area($X,$Y);
echo "Area 2 = $triangle2 <br>";

?>