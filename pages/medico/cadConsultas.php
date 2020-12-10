<?php


  function alerta($texto){
    echo "<script>alert('${texto}');</script>";
  }

  function redireciona($url){
    echo "<script> window.location.href = '{$url}'; </script>";
  }

  function verifica($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  session_start();

  /////////////////////////////////////////////

  $nome = $email = $senha = $idade = $telefone = $crm = "";
  $endereco = $especialidade = $genero = $infos = "";


  ///////////////////////////////////////////
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = verifica($_POST["data_input"]);
    $email = verifica($_POST["laboratorio_input"]);
    $senha = verifica($_POST["paciente_input"]);
    $idade = verifica($_POST["diagnostico_input"]);
    $telefone = verifica($_POST["exames_input"]);
    $crm = verifica($_POST["resultados_input"]);

    $xml = simplexml_load_file("../xml/consultas.xml") or die("ERRO: Não foi possível abrir o XML");

    $node = $xml->addChild('consulta');

    $node->addChild('data',$data);
    $node->addChild('laboratorio',$laboratorio);
    $node->addChild('paciente',$paciente);
    $node->addChild('diagnostico',$diagnostico);
    $node->addChild('exames',$exames);
    $node->addChild('resultados',$resultados);

    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("consultas.xml");

    foreach($xml->children() as $ca){
      alerta($ca->nome);
    }

    alerta("Consulta cadastrada.");
    redireciona("Consultas.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
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
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div class="data">
            <label for="data"></label>
            <input type="text" placeholder="Data" name="data" id="data_input" required>
          </div>
          <div class="subject">
            <label for="laboratorio"></label>
            <select placeholder="Laboratório" name="laboratorio" id="laboratorio_input" required>
              <option disabled hidden selected>Médico</option>
              <option>Laboratório 1</option>
              <option>Laboratório 2</option>
            </select>
          </div>
          <div class="paciente">
            <label for="paciente"></label>
            <input type="text" placeholder="Paciente" name="paciente" id="paciente_input" required>
          </div>
          <div class="diagnostico">
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico_input" required>
          </div>
          <div class="exames">
            <label for="exames"></label>
            <input type="text" placeholder="Exames" name="exames" id="exames_input" required>
          </div>
          <div class="resultados">
            <label for="resultados"></label>
            <input type="text" placeholder="Resultados" name="resultados" id="resultados_input" required>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>


