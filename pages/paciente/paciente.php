<!DOCTYPE html>

<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'paciente')){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }

$logado = $_SESSION['username'];


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Clínica RW</title>
</head>
<body>
    <div id="container">
        <h1>&bull; <?php echo $logado;?> &bull;</h1>
        <div class="underline">
        </div>

        <?php
            $id = $nome = $email = $idade = $telefone = $cpf = $endereco = "";
            $genero = $infos = '';

            $xml = simplexml_load_file("../../xml/pacientes.xml");

            foreach ($xml as $paciente) {
                //echo $_SESSION['username'] .' -> ' .$paciente->email .'<br>';
                if($_SESSION['username'] == $paciente->email){
                    setcookie("id",strval($paciente->id),time()+60,"/");
                    setcookie("nome",strval($paciente->nome),time()+60,"/");
                    setcookie("email",strval($paciente->email),time()+60,"/");
                    setcookie("idade",strval($paciente->idade),time()+60,"/");
                    setcookie("telefone",strval($paciente->telefone),time()+60,"/");
                    setcookie("cpf",strval($paciente->cpf),time()+60,"/");
                    setcookie("endereco",strval($paciente->endereco),time()+60,"/");
                    setcookie("genero",strval($paciente->genero),time()+60,"/");
                    setcookie("infos",strval($paciente->infos),time()+60,"/");
                    $nome = $paciente->nome;
                    $email = $paciente->email;
                    $idade = $paciente->idade;
                    $telefone = $paciente->telefone;
                    $cpf = $paciente->cpf;
                    $endereco = $paciente->endereco;
                    $genero = $paciente->genero;
                    $info = $paciente->infos;
                }
            }

            echo '<div id="container">';
            echo 'Nome: ' .$nome .'<br>';
            echo 'E-mail: ' .$email .'<br>';
            echo 'Idade: ' .$idade .'<br>';
            echo 'Telefone: ' .$telefone .'<br>';
            echo 'CPF: ' .$cpf .'<br>';
            echo 'Endereço: ' .$endereco .'<br>';
            echo 'Genero: ' .$genero .'<br>';
            echo 'Info: ' .$info .'<br>';
            echo '</div>';
          ?>

        <div class="submit">
          <button type="button" id="form_button"><a href="alteraPaciente.php">Alterar</a></button>
        </div>
       
      </div><!-- // End #container -->
</body>
</html>


