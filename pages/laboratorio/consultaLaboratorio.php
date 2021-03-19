<!DOCTYPE html>
<?php

include("../../php/cadastraDB.php");

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

    <title><?php echo pegaNome($logado) ?></title>

</head>
<body>

<div id="container">
        <h1>&bull; <?php echo pegaNome($logado) ?> &bull;</h1>
        <div class="underline">
        </div>  
        
        <?php
            $nome = $email = $senha = $telefone = $cnpj = "";
            $endereco = $tipoExame = $infos = "";

            $idLab = pegaID('laboratorios', pegaNome($logado));
            
            $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
            $user = "root";
            $pass = "Oitona66.";
            $db = "CLINICA_PW";

            try {
                $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
                $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = "SELECT * FROM laboratorios WHERE id=:i";
                $resposta = $conn->prepare($sql);
                $resposta->bindParam(':i',$idLab);
                $resposta->execute();
                $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
                //print_r($conteudo);
             
                setcookie("id",strval($conteudo['id']),time()+60,"/");
                setcookie("nome",strval($conteudo['nome']),time()+60,"/");
                setcookie("email",strval($conteudo['email']),time()+60,"/");
                setcookie("telefone",strval($conteudo['telefone']),time()+60,"/");
                setcookie("cnpj",strval($conteudo['cnpj']),time()+60,"/");
                setcookie("endereco",strval($conteudo['endereco']),time()+60,"/");
                setcookie("tipoExame",strval($conteudo['tipoExame']),time()+60,"/");
                setcookie("infos",strval($conteudo['infos']),time()+60,"/");

                $nome = $conteudo['nome'];
                $email = $conteudo['email'];
                $telefone = $conteudo['telefone'];
                $cnpj = $conteudo['cnpj'];
                $endereco = $conteudo['endereco'];
                $tipoExame = $conteudo['tipoExame'];
                $infos = $conteudo['infos'];

                echo '<div id="container">';
                echo 'Nome: ' .$nome .'<br>';
                echo 'Email: ' .$email .'<br>';
                echo 'Telefone: ' .$telefone .'<br>';
                echo 'CNPJ: ' .$cnpj .'<br>';
                echo 'Endereço: ' .$endereco .'<br>';
                echo 'Tipo de Exame: ' .$tipoExame .'<br>';
                echo 'Infos: ' .$infos .'<br>';
                echo '</div>';
                
                
            }catch (PDOEXception $e){
                echo "Erro: " . "<br>" . $e->getMessage();
            }
        
            $conn = null;            
            
          ?>
      
        <div class="submit">
          <button type="button" id="form_button"><a href="alteraLaboratorio.php">Alterar</a></button>
        </div>
 
    </div>
</body>
</html>


