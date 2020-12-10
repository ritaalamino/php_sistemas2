<!DOCTYPE html>
<html lang="en">

<?php

  session_start();

  function getConsultas(){
    $file = "xml/consultas.xml";
    $xml = simplexml_load_file($file);
    $vetor = array();
    foreach ($xml->children() as $consulta) {
      $vetor['id'] = strval($consulta->id);
      $vetor['paciente'] = strval($consulta->paciente);
      $vetor['data'] = strval($consulta->data);
      $vetor['lab'] = strval($consulta->lab);
      $vetor['diagnostico'] = strval($consulta->diagnostico);
      $vetor['exames'] = strval($consulta->exames);
      $vetor['resultados'] = strval($consulta->resultados);
    }
    return $vetor;
  }

  function getConsulta($consultaID){
    $file = "xml/consultas.xml";
    $xml = simplexml_load_file($file);
    $vetor = array();
    foreach ($xml->children() as $consulta) {
      if(strval($xml->id) == strval($consultaID)){
        $vetor['id'] = strval($consulta->id);
        $vetor['paciente'] = strval($consulta->paciente);
        $vetor['data'] = strval($consulta->data);
        $vetor['lab'] = strval($consulta->lab);
        $vetor['diagnostico'] = strval($consulta->diagnostico);
        $vetor['exames'] = strval($consulta->exames);
        $vetor['resultados'] = strval($consulta->resultados);
      }
    }
    return $vetor;
  }
  function getConsulta2(){
    $file = "xml/consultas.xml";
    $xml = simplexml_load_file($file);
    return $xml;
  }

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
          <?php
            $consultas = getConsulta2();
            echo $consultas->consulta->paciente;
          ?>
        </div>  
    </div>
</body>
</html>


