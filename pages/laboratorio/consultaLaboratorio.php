<!DOCTYPE html>
<html lang="en">

<?php

include("../../php/funcoes.php");

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}

if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'lab')){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }

$logado = $_SESSION['username'];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Saúde</title>

</head>
<body>

    <div id="container">
        <h1>&bull; Laboratório &bull;</h1>
        <div class="underline">
        </div>  
        <?php
            $id = $nome = $lab = $email = $telefone = '';
            $cnpj = $endereco = $tipoExame = $infos = '';

            $file = "../../xml/labs.xml" or die('XML não acessado.'); 
            $xml = simplexml_load_file($file);

            
            foreach ($xml->children() as $lab) {
              if(strval($_SESSION['username']) == strval($lab->email)){
                $id = $lab->id;
                $nome= $lab->nome;
                $email= $lab->email;
                $telefone = $lab->telefone;
                $cnpj = $lab->cnpj;
                $endereco = $lab->endereco;
                $tipoExame = $lab->tipoExame;
                $infos = $lab->infos;
                echo '<div id="container">';
                echo '<p>ID: ' .$id .'<br>';
                echo 'Nome: ' .$nome .'<br>';
                echo 'Email: ' .$email .'<br>';
                echo 'Telefone: ' .$telefone .'<br>';
                echo 'CNPJ: ' .$cnpj .'<br>';
                echo 'Endereço: ' .$endereco .'<br>';
                echo 'Tipo de Exame: ' .$tipoExame .'<br>';
                echo 'Infos: ' .$infos .'<br>';
                setcookie("id", $id , time()+60000, '/');
                setcookie("tipo", 'lab' , time()+60000, '/');
                echo '<a href ="../../php/altera.php">Alterar</a>';
                echo '</div>';
              }
            }
          ?>
    </div>
</body>
</html>


