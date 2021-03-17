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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Histórico de Exames</title>

</head>
<body>

<div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>  
        <?php
          //Funções
          include("../../php/funcoes.php");

          $data = $medico = $paciente = $email = "";
          $lab = $exames = $infos = '';

          $fileExames = simplexml_load_file("../../xml/exames.xml");
          //$Nomepaciente = pegaNome($logado);

          foreach ($fileExames->children() as $Exame){
            if(strval($Exame->email) == strval($logado)){
              $data= $Exame->data;
              $medico= $Exame->medico;
              $paciente= $Exame->paciente;
              $lab = $Exame->lab;
              $email = $Exame->email;
              $exames = $Exame->exame;
              $infos = $Exame->infos;
              echo '<div id="container">';
              echo 'Paciente: ' .$paciente .'<br>';
              echo 'Laboratório: ' .$lab .'<br>';
              echo 'Data: ' .$data .'<br>';
              echo 'Médico: ' .$medico .'<br>';
              echo 'Email: ' .$email .'<br>';
              echo 'Exames: ' .$exames .'<br>';
              echo 'Infos: ' .$infos .'<br>';
              echo '</div>';
            }
          }
        ?>
      
        <div class="submit">
          <button type="button" id="form_button"><a href="userPac.php">Voltar</a></button>
        </div>
 
    </div>

</body>
</html>


