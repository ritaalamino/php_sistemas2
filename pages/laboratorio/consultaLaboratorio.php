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
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>  
        
        <?php
            $nome = $email = $senha = $telefone = $cnpj = "";
            $endereco = $tipoExame = $infos = "";
            
            $xml = simplexml_load_file("../../xml/labs.xml") or die("ERRO: Não foi possível abrir o XML");
            
            foreach($xml as $Labs){
              if(strval($Labs->email) == strval($logado)){
                setcookie("id",strval($Labs->id),time()+60,"/");
                setcookie("nome",strval($Labs->nome),time()+60,"/");
                setcookie("email",strval($Labs->email),time()+60,"/");
                setcookie("telefone",strval($Labs->telefone),time()+60,"/");
                setcookie("cnpj",strval($Labs->cnpj),time()+60,"/");
                setcookie("endereco",strval($Labs->endereco),time()+60,"/");
                setcookie("tipoExame",strval($Labs->tipoExame),time()+60,"/");
                setcookie("infos",strval($Labs->infos),time()+60,"/");

                $nome = $Labs->nome;
                $email = $Labs->email;
                $telefone = $Labs->telefone;
                $cnpj = $Labs->cnpj;
                $endereco = $Labs->endereco;
                $tipoExame = $Labs->tipoExame;
                $infos = $Labs->infos;
              }
            }

            echo '<div id="container">';
            echo 'Nome: ' .$nome .'<br>';
            echo 'Email: ' .$email .'<br>';
            echo 'Telefone: ' .$telefone .'<br>';
            echo 'CNPJ: ' .$cnpj .'<br>';
            echo 'Endereço: ' .$endereco .'<br>';
            echo 'Tipo de Exame: ' .$tipoExame .'<br>';
            echo 'Infos: ' .$infos .'<br>';
            echo '</div>';
            
          ?>
      
        <div class="submit">
          <button type="button" id="form_button"><a href="alteraLaboratorio.php">Alterar</a></button>
        </div>
 
    </div>
</body>
</html>


