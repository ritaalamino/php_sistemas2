<!DOCTYPE html>
<html lang="en">

<?php

  session_start();

  function getConsultas(){
    $file = "../../xml/consultas.xml";
    $xml = simplexml_load_file($file);
    $vetor = array();
    foreach ($xml->children() as $consulta) {
      $vetor[$consulta->id] = array(
        'paciente' => strval($consulta->paciente),
        'data' => strval($consulta->data),
        'lab' => strval($consulta->lab),
        'diagnostico' => strval($consulta->diagnostico),
        'exames' => strval($consulta->exames),
        'resultados' => strval($consulta->resultados)
      );
    }
    return $vetor;
  }

  function getConsulta($consultaID){
    $file = "../../xml/consultas.xml";
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

    <title>Seguros</title>

</head>
<body>

    <div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>  
        <?php
            alterarCadastro(1,'paciente','Joana');
          ?>
    </div>
</body>
</html>


