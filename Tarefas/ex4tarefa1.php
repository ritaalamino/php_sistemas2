<?php 
    $vetor = array('Joana' => "Estudante",'Julia' => "Estudante",'Flávia' => "Professora" );
    foreach ($vetor as $nome => $tipo) {
        echo "A " . $nome . " é uma " . $tipo . ".\n";
    }
?>