<?php 
    $sum;
    for ($cont = 85; $cont <= 901; $cont++){
        if ($cont%2 == 0){
            $sum += $cont;
            echo "$cont \n";
        }
    }
    echo "A soma é $sum";
?>