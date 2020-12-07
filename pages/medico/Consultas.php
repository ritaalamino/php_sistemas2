<!DOCTYPE html>
<html lang="en">

<?php
  function getConsultas(){
    $file = "xml/consultas.xml";
    $xml = simplexml_load_file($file);
    $json = new stdClass();
    foreach ($xml->children() as $consulta) {
      $json->paciente = strval($consulta->paciente);
      $json->data = strval($consulta->data);
      $json->lab = strval($consulta->lab);
      $json->diagnostico = strval($consulta->diagnostico);
      $json->exames = strval($consulta->exames);
      $json->resultados = strval($consulta->resultados);
      $myJSON = json_encode($json);
    }
    return $myJSON;
  }

  function getConsulta($consultaID){
    $file = "xml/consultas.xml";
    $xml = simplexml_load_file($file);
    $json = new stdClass();
    foreach ($xml->children() as $consulta) {
      if(strval($xml->id) == strval($consultaID)){
        $json->paciente = strval($consulta->paciente);
        $json->data = strval($consulta->data);
        $json->lab = strval($consulta->lab);
        $json->diagnostico = strval($consulta->diagnostico);
        $json->exames = strval($consulta->exames);
        $json->resultados = strval($consulta->resultados);
        $myJSON = json_encode($json);
      }
    }
    return $myJSON;
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
        </div>
    </div>
</body>
</html>


