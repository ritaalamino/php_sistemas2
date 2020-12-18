<!DOCTYPE html>
<html lang="en">

<?php
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


  function alterarCadastro($consultaID,$parametro,$valor){
    $file = "../../xml/consultas.xml";
    $xml = simplexml_load_file($file) or die("XML não acessado.");

    for($i = 0; $i < $xml->count(); $i++){
      if ($xml->consulta[$i]->id == $consultaID){
        $xml->consulta[$i]->$parametro = $valor;
      }
    }
  
    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/consultas.xml");
  }

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
            $id = $lab = $data = $medico = $paciente = $email = $diagnostico = $receita = "";
            $receita = $exames = $infos = '';


            $file = "../../xml/exames.xml";    
            $xml = simplexml_load_file($file);

            foreach ($xml->children() as $exame) {
              $id = $exame->id;
              $data= $exame->data;
              $medico= $exame->medico;
              $paciente= $exame->paciente;
              $lab = $exame->lab;
              $email = $exame->email;
              $diagnostico = $exame->diagnostico;
              $receita = $exame->receita;
              $exames = $exame->exames;
              $infos = $exame->infos;
              echo '<div id="container">';
              echo '<p>ID: ' .$id .'<br>';
              echo 'Paciente: ' .$paciente .'<br>';
              echo 'Laboratório: ' .$lab .'<br>';
              echo 'Data: ' .$data .'<br>';
              echo 'Médico: ' .$medico .'<br>';
              echo 'Email: ' .$email .'<br>';
              echo 'Diagnóstico: ' .$diagnostico .'<br>';
              echo 'Receita: ' .$receita .'<br>';
              echo 'Exames: ' .$exames .'<br>';
              echo 'Infos: ' .$infos .'<br>';
              setcookie("id", $id , time()+60000, '/');
              setcookie("tipo", 'exame' , time()+60000, '/');
              echo '<a href ="../../php/altera.php">Alterar</a>';
              echo '</div>';
            }
          ?>
    </div>
</body>
</html>


