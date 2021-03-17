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

            $file = "../../xml/medicos.xml";
            $xml = simplexml_load_file($file);

            foreach ($xml->children() as $medico) {
                if($_SESSION['username'] == $medico->email){
                    $id = $medico->id;
                    $nome = $medico->nome;
                    $email = $medico->email;
                    $idade = $medico->idade;
                    $telefone = $medico->telefone;
                    $crm = $medico->crm;
                    $endereco = $medico->endereco;
                    $especialidade = $medico->especialidade;
                    $genero = $medico->genero;
                    $info = $medico->infos;
                    setcookie("id",strval($medico->id),time()+60,"/");
                    setcookie("nome",strval($medico->nome),time()+60,"/");
                    setcookie("email",strval($medico->email),time()+60,"/");
                    setcookie("idade",strval($medico->idade),time()+60,"/");
                    setcookie("telefone",strval($medico->telefone),time()+60,"/");
                    setcookie("crm",strval($medico->crm),time()+60,"/");
                    setcookie("endereco",strval($medico->endereco),time()+60,"/");
                    setcookie("especialidade",strval($medico->especialidade),time()+60,"/");
                    setcookie("genero",strval($medico->genero),time()+60,"/");
                    setcookie("infos",strval($medico->infos),time()+60,"/");

                    echo '<div id="container">';
                    echo 'Nome: ' .$nome .'<br>';
                    echo 'E-mail: ' .$email .'<br>';
                    echo 'Idade: ' .$idade .'<br>';
                    echo 'Telefone: ' .$telefone .'<br>';
                    echo 'CRM: ' .$crm .'<br>';
                    echo 'Endereço: ' .$endereco .'<br>';
                    echo 'Especialidade: ' .$especialidade .'<br>';
                    echo 'Genero: ' .$genero .'<br>';
                    echo 'Info: ' .$info .'<br>';
                    echo '</div>';
                }
            }
          ?>
            <div class="submit">
                <button type="button" id="form_button"><a href="alteraMedicos.php">Alterar</a></button>
            </div>
      </div><!-- // End #container -->
</body>
</html>


