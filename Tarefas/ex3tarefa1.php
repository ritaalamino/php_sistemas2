<?php 
    const pi = 3.14151;
    
    function calculaArea($num){
        $area = pi*pow($num,2);    
        echo "A área de $num é $area \n";
    }
    for ($cont = 100; $cont <= 200; $cont++){
        if ($cont%2 == 0){
            calculaArea($cont);
        }
    }
?>