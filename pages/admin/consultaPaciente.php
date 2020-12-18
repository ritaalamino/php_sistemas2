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

    <title>Saúde</title>
</head>
<body>
    <div id="container">
        <h1>&bull; <?php echo $logado;?> &bull;</h1>
        <div class="underline">
        </div>

        <?php
            $id = $nome = $email = $idade = $telefone = $cpf = $endereco = "";
            $genero = $infos = '';

            $file = "../../xml/pacientes.xml";
            $xml = simplexml_load_file($file);

            foreach ($xml->children() as $paciente) {
                    $id = $paciente->id;
                    $nome = $paciente->nome;
                    $email = $paciente->email;
                    $idade = $paciente->idade;
                    $telefone = $paciente->telefone;
                    $cpf = $paciente->cpf;
                    $endereco = $paciente->endereco;
                    $especialidade = $paciente->especialidade;
                    $genero = $paciente->genero;
                    $info = $paciente->infos;
                    echo '<div id="container">';
                    echo '<p>Nome: ' .$nome .'<br>';
                    echo 'E-mail: ' .$email .'<br>';
                    echo 'Idade: ' .$idade .'<br>';
                    echo 'Telefone: ' .$telefone .'<br>';
                    echo 'CPF: ' .$cpf .'<br>';
                    echo 'Endereço: ' .$endereco .'<br>';
                    echo 'Especialidade: ' .$especialidade .'<br>';
                    echo 'Genero: ' .$genero .'<br>';
                    echo 'Info: ' .$info .'<br>';
                    setcookie("id", $id , time()+60000, '/');
                    setcookie("tipo", 'paciente' , time()+60000, '/');
                    echo '<a href ="../../php/altera.php">Alterar</a>';
                    echo '</div>';
            }
          ?>

        
       
      </div><!-- // End #container -->
</body>
</html>


