<?php 
    for($cont = 1; $cont <= 100; $cont++){
        switch ($cont) {
            case (($cont % 3) == 0):
                echo "$cont DING \n";
            case (($cont % 5) == 0):
                echo "$cont DOiNG \n";
            case (($cont % 7) == 0):
                echo "$cont DUNG \n";
        }
    }
?>