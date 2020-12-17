<!DOCTYPE html>
<html lang="en">

<?php

  session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Seguros</title>

</head>
<body>

    <div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>  
        <?php
            $id = $paciente = $data = $lab = $diagnostico = $exames = $dados = "";

            $file = "../../xml/consultas.xml";
            $xml = simplexml_load_file($file);

            foreach ($xml->children() as $consulta) {
              $id = $consulta->id;
              $paciente= $consulta->paciente;
              $data= $consulta->data;
              $lab= $consulta->lab;
              $diagnostico = $consulta->diagnostico;
              $exames = $consulta->exames;
              $resultados = $consulta->resultados;
              echo '<div id="container">';
              echo '<p>Paciente: ' .$paciente .'<br>';
              echo 'Data: ' .$data .'<br>';
              echo 'Laboratório: ' .$lab .'<br>';
              echo 'Diagnóstico: ' .$diagnostico .'<br>';
              echo 'Exames: ' .$exames .'<br>';
              echo 'Resultados: ' .$resultados .'<br>';
              setcookie("id", $id , time()+60000, '/');
              echo '<a href ="altera.php">Alterar</a>';
              echo '</div>';
            }
          ?>
    </div>
</body>
</html>