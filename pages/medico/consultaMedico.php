<!DOCTYPE html>
<html lang="en">

<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'medico')){
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

    <title>Médico</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Dados Médico &bull;</h1>
        <div class="underline">
        </div>
        <?php
            $id = $paciente = $data = $lab = $diagnostico = $exames = $dados = "";

            $idLab = pegaID('laboratorios', pegaNome($logado));
            
            $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
            $user = "root";
            $pass = "Oitona66.";
            $db = "CLINICA_PW";

            try {
                $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
                $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = "SELECT * FROM medicos WHERE id=:i";
                $resposta = $conn->prepare($sql);
                $resposta->bindParam(':i',$idLab);
                $resposta->execute();
                $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
                //print_r($conteudo);
             
                setcookie("id",strval($conteudo['id']),time()+60,"/");
                setcookie("nome",strval($conteudo['nome']),time()+60,"/");
                setcookie("email",strval($conteudo['email']),time()+60,"/");
                setcookie("idade",strval($conteudo['idade']),time()+60,"/");
                setcookie("telefone",strval($conteudo['telefone']),time()+60,"/");
                setcookie("crm",strval($conteudo['crm']),time()+60,"/");
                setcookie("endereco",strval($conteudo['endereco']),time()+60,"/");
                setcookie("especialidade",strval($conteudo['especialidade']),time()+60,"/");
                setcookie("genero",strval($conteudo['genero']),time()+60,"/");
                setcookie("infos",strval($conteudo['infos']),time()+60,"/");

                $nome = $conteudo['nome'];
                $email = $conteudo['email'];
                $idade = $conteudo['idade'];
                $telefone = $conteudo['telefone'];
                $crm = $conteudo['crm'];
                $endereco = $conteudo['endereco'];
                $especialidade = $conteudo['especialidade'];
                $genero = $conteudo['genero'];
                $infos = $conteudo['infos'];

                echo '<div id="container">';
                echo 'Nome: ' .$nome .'<br>';
                echo 'Email: ' .$email .'<br>';
                echo 'Idade: ' .$idade .'<br>';
                echo 'Telefone: ' .$telefone .'<br>';
                echo 'CRM: ' .$crm .'<br>';
                echo 'Endereço: ' .$endereco .'<br>';
                echo 'Especialidade: ' .$especialidade .'<br>';
                echo 'Genero: ' .$genero .'<br>';
                echo 'Infos: ' .$infos .'<br>';
                echo '</div>';
                
                
            }catch (PDOEXception $e){
                echo "Erro: " . "<br>" . $e->getMessage();
            }
        
            $conn = null;        

          ?>
            <div class="submit">
                <button type="button" id="form_button"><a href="alteraMedicos.php">Alterar</a></button>
            </div>
      </div><!-- // End #container -->
</body>
</html>


